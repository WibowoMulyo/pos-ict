<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index(){
        $transaksis = Transaksi::all();

        return view('transaksi', compact('transaksis'));
    }
}
