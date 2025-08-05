<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        return view('kasir', compact('barangs'));
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'keranjang' => 'required|json',
            ]);

            $keranjang = json_decode($validated['keranjang'], true);

            if (empty($keranjang)) {
                return redirect()->back()->with('error', 'Keranjang belanja kosong!');
            }

            DB::beginTransaction();

            // Hitung total
            $totalHarga = 0;
            $totalBarang = 0;

            foreach ($keranjang as $item) {
                $totalHarga += $item['subtotal'];
                $totalBarang += $item['jumlah'];
            }

            // Save transaksi utama
            $transaksi = Transaksi::create([
                'tanggal' => Carbon::now(),
                'total_barang' => $totalBarang,
                'total_harga' => $totalHarga,
            ]);

            // Save detail transaksi
            foreach ($keranjang as $item) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_barang' => $item['id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'] * $item['jumlah'],
                ]);
            }

            DB::commit();

            return redirect()->route('kasir')->with('success', 'Transaksi berhasil disimpan! ID Transaksi: #' . $transaksi->id);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Data tidak valid!');

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan transaksi: ' . $e->getMessage());
        }
    }
}
