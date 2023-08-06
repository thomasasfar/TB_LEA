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
            'nama' => 'required',
            'kode_barang' => 'required',
            'hari_ambil' => 'required|date',
            'hari_kembali' => 'required|date',
        ]);

        $barang = Barang::find($validated['id']);

        if ($barang) {
            $lama_peminjaman = Carbon::parse($validated['hari_ambil'])->diffInDays(Carbon::parse($validated['hari_kembali']));
            $total_harga = $lama_peminjaman * $barang->harga;

            $dataPinjaman = [
                'id_user' => $validated['username'],
                'id_barang' => $validated['id'],
                'hari_ambil' => $validated['hari_ambil'],
                'hari_kembali' => $validated['hari_kembali'],
                'lama_peminjaman' => $lama_peminjaman,
                'total_harga' => $total_harga,
                'status' => 'verified',
                'pembayaran' => 'lunas',
                'ktp' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ];

            if ($request->file('ktp')) {
                $extension = $request->file('ktp')->getClientOriginalExtension();
                $newName = $request->nama_barang . '-' . now()->timestamp . '.' . $extension;
                $request->file('ktp')->storeAs('ktp', $newName, 'public');
                $validasi['ktp'] = $newName;
            } else {
                $newName = '';
            }

            $barang->status = 'Tidak Tersedia';
            $barang->save();
            Transaksi::create($dataPinjaman);

            return redirect('transaction')->with('success', 'Peminjaman Berhasil Dilakukan!');
        }
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
        //
    }
}
