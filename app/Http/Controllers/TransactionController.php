<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        $user = User::all();
        $barang = Barang::all();

        return view('transactions.transaction' , compact('transactions', 'user', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storeByAdmin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'kode' => 'required',
            'hari_ambil' => 'required|date',
            'hari_kembali' => 'required|date',
            'ktp' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $barang = Barang::find($validated['kode']);

        if ($barang) {
            $hari_ambil = Carbon::parse($validated['hari_ambil'])->format('Y-m-d');
            $hari_kembali = Carbon::parse($validated['hari_kembali'])->format('Y-m-d');
            $lama_peminjaman = Carbon::parse($validated['hari_ambil'])->diffInDays(Carbon::parse($validated['hari_kembali']));
            $total_harga = $lama_peminjaman * $barang->harga;

            $dataPinjaman = [
                'id_user' => $validated['username'],
                'id_barang' => $validated['kode'],
                // 'hari_ambil' => $validated['hari_ambil'],
                // 'hari_kembali' => $validated['hari_kembali'],
                'hari_ambil' => $hari_ambil,
                'hari_kembali' => $hari_kembali,
                'lama_peminjaman' => $lama_peminjaman,
                'total_harga' => $total_harga,
                'status' => 'verified',
                'pembayaran' => 'lunas',
                'ktp' => $validated['ktp']
            ];

            if ($request->file('ktp')) {
                $extension = $request->file('ktp')->getClientOriginalExtension();
                $newName = $request->username . '-' . now()->timestamp . '.' . $extension;
                // $newName = $request->input('username') . '-' . now()->timestamp . '.' . $extension;
                $request->file('ktp')->storeAs('ktp', $newName, 'public');
                $dataPinjaman['ktp'] = $newName;
            } else {
                $dataPinjaman['ktp'] = '';
            }

            $barang->status = 'Tidak Tersedia';
            $barang->save();
            Transaction::create($dataPinjaman);

            return redirect('transactions')->with('success', 'Peminjaman Berhasil Dilakukan!');
        }
    }


    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $transactions = Transaction::find($id);
        $transactions->update($request->all());

        if ($transactions->status == 'done') {
            $barang = Barang::find($transactions->id);
            if($barang){
                $barang->update(['status' => 'Tersedia']);
            }
        }else{
            $barang = Barang::find($transactions->id);
            if($barang){
            $barang->update(['status' => 'Tidak Tersedia']);
            }
        }

        if($transactions->status == 'verified') {
            $transactions->pembayaran = 'lunas';
            $transactions->save();
        }

        return redirect()->back()->with('success', 'Transaksi berhasil diverifikasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactions = Transaksi::findOrFail($id);
        $rooms = Barang::find($transactions->id_barang);
            if($rooms){
                $rooms->update(['status' => 'Tersedia']);
            }

        $transactions->delete();

        // if (Auth::user()->role == 'customer') {
        //     // return redirect('booking')->with('success', 'Transaction deleted successfully');
        // } elseif (Auth::user()->role == 'admin') {
        //     return redirect('transactions')->with('success', 'Transaction deleted successfully');
        // }
    }
}
