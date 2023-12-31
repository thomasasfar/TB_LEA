<?php

namespace App\Http\Controllers;

use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        //cek apakah login valid
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/barang'); // Redirect admin ke halaman barang
            } else {
                return redirect()->intended('/katalog'); // Redirect user ke halaman katalog
            }
        }
        return back()->withErrors([
            'email' => 'Username atau Password Salah',
        ]);
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password'  => 'required|min:8' ,
            'no_hp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('register')->withErrors($validator)->withInput();
        }

        $data = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password'  => 'required|min:8' ,
            'no_hp' => 'required|numeric',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'customer';

        User::create($data);
        return redirect('login')->with('success', 'Registrasi Berhasil');
    }
    public function show()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required|numeric',
        ]);

        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');

        $user->save();
        return redirect('profile')->with('success', "Profile berhasil di-update");
    }

    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        $photoprofile = $request->validate([
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $user->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('photo', $newName, 'public');
            $photoprofile['photo'] = $newName;

            // Hapus gambar lama jika ada
            if ($user->photo) {
                Storage::disk('public')->delete('photo/' . $user->photo);
            }
        } else {
            $photoprofile['photo'] = $user->photo; // Gunakan gambar lama jika tidak ada gambar baru
        }

        $user->update($photoprofile);

        return redirect()->back();

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
    public function change()
    {
        $user = Auth::user();
        return view('profile.password', compact('user'));
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
        ]);

        $user = Auth::user();

        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect('/profile')->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'Password saat ini tidak cocok.');
        }
    }


}
