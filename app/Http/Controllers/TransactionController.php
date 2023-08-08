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
    public function bookingByUser(Request $request)
    {
        $validasi = $request->validate([
            'id_barang'=> 'required|exists:barangs,id',
            'hari_ambil' => 'required|date',
            'hari_kembali' => 'required|date',
        ]);

        $barang = Barang::find($validasi['id_barang']);

        if (!$barang) {
            return redirect()->back()->with('error', 'Kode barang invalid');
        }

        $hari_ambil = Carbon::parse($validasi['hari_ambil'])->format('Y-m-d');
        $hari_kembali = Carbon::parse($validasi['hari_kembali'])->format('Y-m-d');
        $lama_peminjaman = Carbon::parse($validasi['hari_ambil'])->diffInDays(Carbon::parse($validasi['hari_kembali']));
        $total_harga = $lama_peminjaman * $barang->harga;

        $dataPinjaman = [
            'id_user' => Auth::id(),
            'id_barang' => $barang->id,
            'hari_ambil' => $hari_ambil,
            'hari_kembali' => $hari_kembali,
            'lama_peminjaman' => $lama_peminjaman,
            'total_harga' => $total_harga,
            'status' => 'booking',
            'pembayaran' => 'dp',
            // 'ktp' =>'3-1691326638.png'
        ];

        $barang->status = 'Tidak Tersedia';
        $barang->save();
        Transaction::create($dataPinjaman);

        return redirect('katalog')->with('success', 'Peminjaman Berhasil Dilakukan!');
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
        $user = User::find($validated['username']);

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
                $newName = $user->username . '-' . now()->timestamp . '.' . $extension;
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
        $user = User::find($transactions->id_user);
        $transactions->update($request->all());

        if ($transactions->status == 'done') {
            $barang = Barang::find($transactions->id_barang);
            if($barang){
                $barang->update(['status' => 'Tersedia']);
            }
        }else{
            $barang = Barang::find($transactions->id_barang);
            if($barang){
            $barang->update(['status' => 'Tidak Tersedia']);
            }
        }

        if($transactions->status == 'verified') {
            if (!$request->hasFile('ktp')) {
                return redirect()->back()->with('error', 'Anda harus mengunggah KTP untuk verifikasi');
            }

        $ktpExtension = $request->file('ktp')->getClientOriginalExtension();
        $ktpFilename = $user->username . '-' . now()->timestamp . '.' . $ktpExtension;
        $request->file('ktp')->storeAs('ktp', $ktpFilename, 'public');
        $transactions->ktp = $ktpFilename;

            $transactions->pembayaran = 'lunas';
            $transactions->save();
        }

        return redirect()->back()->with('success', 'Transaksi berhasil diverifikasi');
    }

    public function verifyBooking(Request $request, $id)
    {
        $verifikasi = $request->validate([
            'ktp' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $transactions = Transaction::findOrFail($id);

        if ($request->hasFile('ktp')) {
            $extension = $request->file('ktp')->getClientOriginalExtension();
            $newName = Auth::user()->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('ktp')->storeAs('ktp', $newName, 'public');

             // Simpan nama file gambar ke kolom ktp
            $transactions->ktp = $newName;
        }

        $transactions->status = 'pending';

        $transactions->pembayaran = 'lunas';
        $transactions->save();

        return redirect()->back()->with('success', 'Orderan anda akan segera diverifikasi admin');
    }

    public function updateKembali(Request $request, $id)
    {
        $verifikasi = $request->validate([
            'hari_kembali' => 'required|date',
            'hari_ambil' => 'required|date|exists:transactions,hari_ambil'
        ]);

        $transactions = Transaction::findOrFail($id);
        $barang = Barang::findOrFail($transactions->id_barang);

        $hari_ambil = Carbon::parse($verifikasi['hari_ambil'])->format('Y-m-d');
        $hari_kembali = Carbon::parse($verifikasi['hari_kembali'])->format('Y-m-d');
        $lama_peminjaman = Carbon::parse($verifikasi['hari_ambil'])->diffInDays(Carbon::parse($verifikasi['hari_kembali']));
        $total_harga = $lama_peminjaman * $barang->harga;

        $transactions->hari_kembali = $hari_kembali;
        $transactions->hari_ambil = $hari_ambil;
        $transactions->lama_peminjaman = $lama_peminjaman;
        $transactions->total_harga = $total_harga;

        $transactions->save();
        return redirect()->back()->with('success', 'Tanggal pengembalian telah diperbarui');
    }

    public function verifyTransaction($id)
    {
    $transaksi = Transaction::findOrFail($id);

    // Ubah status transaksi menjadi "verifikasi"
    $transaksi->status = 'verifikasi';
    $transaksi->save();

    return redirect('transactions')->with('success', 'Status transaksi berhasil diubah menjadi verifikasi.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id_user = Auth::user();
        $transactions = Transaction::where('id_user', $id_user->id)
            ->get();
        $user = User::find('id');
        $barang = Barang::all();
        return view('transactions.riwayat', compact('user', 'barang','transactions'));
    }

    public function showBook()
    {
        $id_user = Auth::user();
        $transactions = Transaction::where('id_user', $id_user->id)
            ->whereIn('status', ['booking', 'pending'])
            ->get();
        $user = User::find($id_user->id);
        $barang = Barang::all();
        return view('transactions.booking', compact('user', 'barang', 'transactions'));
    }

    public function showVerified()
    {
        $id_user = Auth::user();
        $transactions = Transaction::where('id_user', $id_user->id)
            ->whereIn('status', ['verified'])
            ->get();
        $user = User::find($id_user->id);
        $barang = Barang::all();
        return view('transactions.verified', compact('user', 'barang', 'transactions'));
    }

    public function showDone()
    {
        $id_user = Auth::user();
        $transactions = Transaction::where('id_user', $id_user->id)
            ->whereIn('status', ['done'])
            ->get();
        $user = User::find($id_user->id);
        $barang = Barang::all();
        return view('transactions.done', compact('user', 'barang', 'transactions'));
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
        $validasi = $request->validate([
            'kode' => 'required',
            'hari_ambil' => 'required',
            'hari_kembali' => 'required',
        ]);

        $transactions = Transaction::findOrFail($id);

        $barang = Barang::find($validasi['kode']);

        $hari_ambil = Carbon::parse($validated['hari_ambil'])->format('Y-m-d');
        $hari_kembali = Carbon::parse($validated['hari_kembali'])->format('Y-m-d');
        $lama_peminjaman = Carbon::parse($validated['hari_ambil'])->diffInDays(Carbon::parse($validated['hari_kembali']));
        $total_harga = $lama_peminjaman * $barang->harga;

        $updatePinjaman = [
            'id_barang' => $validasi['kode'],
            'hari_ambil' => $hari_ambil,
            'hari_kembali' => $hari_kembali,
            'lama_peminjaman' => $lama_peminjaman,
            'total_harga' => $total_harga,
        ];

        $transactions->update($updatePinjaman);
        $barang->statu = 'Tidak Tersedia';
        $barang->save();

        return redirect('transactions')->with('success', 'Booking berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactions = Transaction::findOrFail($id);
        $barang = Barang::find($transactions->id_barang);
            if($barang){
                $barang->update(['status' => 'Tersedia']);
            }

        $transactions->delete();

        return redirect('transactions')->with('success', 'Transaction deleted successfully');

    }

    public function showItem($id)
    {
        $barang = Barang::findOrFail($id);
        return view('transactions.itemOrder', compact('barang'));
    }

    public function showDetail($id)
    {
        $transactions = Transaction::findOrFail($id);
        return view('transactions.detail', compact('transactions'));
    }

    public function cetakInvoice($id)
    {
        $transactions = Transaction::findOrFail($id);

        $html = View::make('print.invoice', compact('transactions'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->setBasePath(public_path());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();

        return Response::make($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="invoice.pdf"',
        ]);

    }
}
