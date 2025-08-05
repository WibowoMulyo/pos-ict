@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Halaman Kasir - Transaksi Baru</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" id="alert-success">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" id="alert-error">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            Tambah Barang ke Keranjang
        </div>
        <div class="card-body">
            <form id="formTambahBarang" class="row g-3">
                <div class="col-md-6">
                    <label for="barang" class="form-label">Pilih Barang</label>
                    <select id="barang" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                                {{ $barang->kode_barang }} - {{ $barang->nama_barang }} (Rp {{ number_format($barang->harga) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" min="1" value="1" required>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" class="btn btn-primary w-100" onclick="tambahBarang()">
                        Tambah ke Keranjang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Keranjang Belanja
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0" id="tabelKeranjang">
                <thead class="table-light">
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Total: Rp <span id="totalHarga">0</span></h5>
            <form action="{{ route('kasir-create') }}" method="POST" id="formSimpanTransaksi">
                @csrf
                <input type="hidden" name="keranjang" id="inputKeranjang">
                <button type="submit" class="btn btn-success" onclick="return validasiTransaksi()">
                    Simpan Transaksi
                </button>
            </form>
        </div>
    </div>

</div>

<script>
    let keranjang = [];

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function tambahBarang() {
        const selectBarang = document.getElementById('barang');
        const jumlah = parseInt(document.getElementById('jumlah').value);

        if (!selectBarang.value || jumlah < 1) return alert("Pilih barang dan masukkan jumlah valid!");

        const option = selectBarang.options[selectBarang.selectedIndex];
        const idBarang = selectBarang.value;
        const namaBarang = option.text.split(' - ')[1].split(' (')[0];
        const kodeBarang = option.text.split(' - ')[0];
        const harga = parseInt(option.getAttribute('data-harga'));
        const subtotal = harga * jumlah;

        keranjang.push({
            id: idBarang,
            kode: kodeBarang,
            nama: namaBarang,
            harga: harga,
            jumlah: jumlah,
            subtotal: subtotal
        });

        renderKeranjang();

        selectBarang.value = '';
        document.getElementById('jumlah').value = 1;
    }

    function hapusBarang(index) {
        keranjang.splice(index, 1);
        renderKeranjang();
    }

    function renderKeranjang() {
        const tbody = document.querySelector('#tabelKeranjang tbody');
        tbody.innerHTML = '';
        let total = 0;

        keranjang.forEach((item, index) => {
            total += item.subtotal;
            tbody.innerHTML += `
                <tr>
                    <td>${item.kode}</td>
                    <td>${item.nama}</td>
                    <td>Rp ${formatRupiah(item.harga)}</td>
                    <td>${item.jumlah}</td>
                    <td>Rp ${formatRupiah(item.subtotal)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(${index})">Hapus</button>
                    </td>
                </tr>
            `;
        });

        document.getElementById('totalHarga').innerText = formatRupiah(total);
        document.getElementById('inputKeranjang').value = JSON.stringify(keranjang);
    }

    function validasiTransaksi() {
        if (keranjang.length === 0) {
            alert('Keranjang masih kosong! Tambahkan barang terlebih dahulu.');
            return false;
        }

        if (confirm('Apakah Anda yakin ingin menyimpan transaksi ini?')) {
            return true;
        }

        return false;
    }

    // Auto hide alerts
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('alert-success');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.transition = 'opacity 0.5s ease-out';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }, 3000);
        }

        const errorAlert = document.getElementById('alert-error');
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.style.transition = 'opacity 0.5s ease-out';
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }, 5000);
        }
    });
</script>
@endsection
