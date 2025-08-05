# POS ICT - Point of Sale System

Sistem Point of Sale (POS) sederhana menggunakan Laravel untuk mengelola barang, transaksi, dan kasir.

## Setup Project

### 1. Clone Repository

```bash
git clone https://github.com/WibowoMulyo/pos-ict.git
cd pos-ict
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

```bash
copy .env.example .env
php artisan key:generate
```

### 4. Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### 5. Jalankan Aplikasi

```bash
# Terminal 1 - Laravel Server
php artisan serve

# Terminal 2 - Frontend Assets
npm run dev
```

Aplikasi akan berjalan di: `http://localhost:8000`

## Login Credentials

Gunakan akun berikut untuk login:

**Email:** `test@example.com`  
**Password:** `password`

## Fitur

-   ✅ Manajemen Barang
-   ✅ Transaksi Penjualan
-   ✅ Sistem Kasir
-   ✅ Laporan Transaksi

## Tech Stack

-   **Backend:** Laravel 12
-   **Frontend:** Bootstrap 5, Vite
-   **Database:** MySQL
-   **Authentication:** Laravel UI
