<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        $barangs = Barang::all();

        return view('barang', compact('barangs'));
    }

    public function create(Request $request){
        try {

            $validated = $request->validate([
                'kode_barang' => 'required|string|max:255',
                'nama_barang' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
            ]);

            Barang::create($validated);

            return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('barang')->with('error', 'Gagal menambahkan barang: ' . $e->getMessage());
        }
    }
}
