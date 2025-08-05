@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Daftar Transaksi</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Total Barang</th>
                <th>Total Harga</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->id }}</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y H:i') }}</td>
                <td>{{ $transaksi->total_barang }}</td>
                <td>Rp {{ number_format($transaksi->total_harga) }}</td>
                <td>
                    <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $transaksi->id }}">Detail</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modals Detail Transaksi -->
    @foreach($transaksis as $transaksi)
    <div class="modal fade" id="modalDetail{{ $transaksi->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi #{{ $transaksi->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y H:i') }}<br>
                        <strong>Total Barang:</strong> {{ $transaksi->total_barang }}<br>
                        <strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga) }}
                    </div>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detailTransaksis as $detailTransaksi)
                            <tr>
                                <td>{{ $detailTransaksi->barang->kode_barang }}</td>
                                <td>{{ $detailTransaksi->barang->nama_barang }}</td>
                                <td>Rp {{ number_format($detailTransaksi->barang->harga) }}</td>
                                <td>{{ $detailTransaksi->jumlah }}</td>
                                <td>Rp {{ number_format($detailTransaksi->harga) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
