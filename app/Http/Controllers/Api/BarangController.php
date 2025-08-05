<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getAllBarangs()
    {
        $barangs = Barang::select('id', 'kode_barang', 'nama_barang', 'harga')->orderBy('kode_barang', 'asc')->get();

        return ApiResponseService::success($barangs, 'List of barang retrieved successfully.');
    }

    public function getBarangById($id)
    {
        $barang = Barang::select('id', 'kode_barang', 'nama_barang', 'harga')
            ->where('id', $id)
            ->first();

        if (!$barang) {
            return ApiResponseService::error(null, 'Barang not found.', 404);
        }

        return ApiResponseService::success($barang, 'Barang retrieved successfully.');
    }

    public function createBarang(Request $request){
        try{
            $validated = $request->validate([
                'kode_barang' => 'required|string|max:255|unique:barangs,kode_barang',
                'nama_barang' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
            ]);

            $barang = Barang::create($validated);

            return ApiResponseService::success($barang, 'Barang created successfully.');
        } catch (\Exception $e) {
            return ApiResponseService::error($e->getMessage(), 'Failed to create barang' );
        }
    }
}
