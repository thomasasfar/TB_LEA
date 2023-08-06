<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('barang', compact('barang'));
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
        $validasi = $request->validate([
            'kode' => 'required',
            'nama_barang' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->nama_barang.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('image', $newName, 'public');
            $validasi['image'] = $newName;
        } else {
            $newName = '';
        }

        Barang::create($validasi);
        return redirect()->back();

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
    public function update(Request $request, $id )
    {
        // $barang->update([
        //     'kode' => $request->kode,
        //     'nama_barang' => $request->nama_barang,
        //     'status' => $request->status,
        //     'harga' => $request->harga,
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        // ]);

        // if($request->hasFile('image')){
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $newName = $request->nama_barang.'-'.now()->timestamp.'.'.$extension;
        //     $request->file('image')->storeAs('image', $newName, 'public');
        //     $validasi['image'] = $newName;
        //     // Hapus gambar lama jika ada
        //     if ($barang->image) {
        //         Storage::disk('public')->delete('image/' . $barang->image);
        //     }
        // } else {
        //     $validasi['image'] = $barang->image;
        // }

        // return redirect()->back();

        $validasi = $request->validate([
            'kode' => 'required',
            'nama_barang' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        // Ambil data barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Jika ada gambar yang diunggah, simpan gambar baru
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->nama_barang . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('image', $newName, 'public');
            $validasi['image'] = $newName;

            // Hapus gambar lama jika ada
            if ($barang->image) {
                Storage::disk('public')->delete('image/' . $barang->image);
            }
        } else {
            $validasi['image'] = $barang->image; // Gunakan gambar lama jika tidak ada gambar baru
        }

        // Update data barang
        $barang->update($validasi);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->back();
    }
}
