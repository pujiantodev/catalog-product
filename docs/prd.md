# Product Requirement Document

## Overview

merupakan project sederhana untuk menyediakan webiste catalog produk yang minimalis namun tampil secara modern.

## Fitur Utama

### Menu Admin

1. Admin Login
2. Admin upload produk
3. Admin edit produk
4. Admin delete produk
5. Admin edit stok secara cepat
6. Admin melihat detail pesanan
7. Admin memproses pesanan

### User / Pembeli

1. Halaman utama / landing page catalog product
2. User melakukan pencarian produk
3. User melihat detail produk
4. User memasukan ke keranjang
5. User setup kuantiti pada keranjang
6. User checkout
7. User melakukan pembayaran.
8. User melihat detail pesanan
9. Admin Merespon Pesanan
10. Admin Mengirim produk
11. User menerima produk
12. User review produk

## Stack & Teknologi

| Layer            | Technology                              |
| ---------------- | --------------------------------------- |
| `Frontend`       | Blade Laravel + Tailwind CSS            |
| `Backend`        | Laravel (latest, Monolith architecture) |
| `Database`       | PostgreSQL                              |
| `Authentication` | Laravel Breeze (Admin)                  |
| `Deployment`     | VPS → Nginx + Ubuntu + PHP (latest)     |

## Struktur Database

### Tabel: `users`

| Kolom               | Tipe Data        | Nullable | Default        | Keterangan                          |
| ------------------- | ---------------- | -------- | -------------- | ----------------------------------- |
| `id`                | BIGINT (Auto ID) | N        | Auto-Increment | Primary key                         |
| `name`              | VARCHAR(255)     | N        | -              | Nama pengguna                       |
| `email`             | VARCHAR(255)     | N        | -              | Harus unik                          |
| `email_verified_at` | TIMESTAMP        | Y        | NULL           | Waktu verifikasi email              |
| `password`          | VARCHAR(255)     | N        | -              | Password terenkripsi                |
| `remember_token`    | VARCHAR(100)     | Y        | NULL           | Token untuk "remember me"           |
| `is_admin`          | BOOLEAN          | N        | `false`        | Menandakan apakah user adalah admin |
| `created_at`        | TIMESTAMP        | N        | Auto           | Waktu pembuatan record              |
| `updated_at`        | TIMESTAMP        | N        | Auto           | Waktu update terakhir               |

### Tabel: `brands`

| Kolom        | Tipe Data        | Nullable | Default | Keterangan                             |
| ------------ | ---------------- | -------- | ------- | -------------------------------------- |
| `id`         | BIGINT (Auto ID) | N        | Auto    | Primary key                            |
| `name`       | VARCHAR(255)     | N        | -       | Nama brand                             |
| `slug`       | VARCHAR(255)     | N        | -       | Slug unik, diindeks untuk pencarian    |
| `logo_url`   | VARCHAR(255)     | Y        | NULL    | URL logo brand                         |
| `created_at` | TIMESTAMP        | N        | Auto    | Waktu pembuatan record                 |
| `updated_at` | TIMESTAMP        | N        | Auto    | Waktu update terakhir                  |
| `deleted_at` | TIMESTAMP        | Y        | NULL    | Soft delete (arsip, bukan hapus fisik) |

### Tabel: `categories`

| Kolom        | Tipe Data        | Nullable | Default | Keterangan                                          |
| ------------ | ---------------- | -------- | ------- | --------------------------------------------------- |
| `id`         | BIGINT (Auto ID) | N        | Auto    | Primary key                                         |
| `parent_id`  | BIGINT (FK)      | Y        | NULL    | Relasi ke `categories.id`, null saat parent dihapus |
| `name`       | VARCHAR(255)     | N        | -       | Nama kategori                                       |
| `slug`       | VARCHAR(255)     | N        | -       | Slug unik untuk URL atau pencarian                  |
| `created_at` | TIMESTAMP        | N        | Auto    | Waktu pembuatan record                              |
| `updated_at` | TIMESTAMP        | N        | Auto    | Waktu update terakhir                               |
| `deleted_at` | TIMESTAMP        | Y        | NULL    | Soft delete                                         |

### Tabel: `products`

| Kolom              | Tipe Data        | Nullable | Default        | Keterangan                                            |
| ------------------ | ---------------- | -------- | -------------- | ----------------------------------------------------- |
| `id`               | BIGINT (Auto ID) | N        | Auto           | Primary key                                           |
| `brand_id`         | BIGINT (FK)      | Y        | NULL           | Relasi ke `brands.id`, null saat brand dihapus        |
| `category_id`      | BIGINT (FK)      | Y        | NULL           | Relasi ke `categories.id`, null saat kategori dihapus |
| `name`             | VARCHAR(255)     | N        | -              | Nama produk                                           |
| `slug`             | VARCHAR(255)     | N        | Unik           | Slug unik untuk URL atau pencarian                    |
| `description`      | TEXT             | Y        | NULL           | Deskripsi produk                                      |
| `status`           | VARCHAR(255)     | N        | `STATUS_DRAFT` | Status produk (draft/publish, bisa pakai enum)        |
| `meta_title`       | VARCHAR(255)     | Y        | NULL           | Judul meta SEO                                        |
| `meta_description` | TEXT             | Y        | NULL           | Deskripsi meta SEO                                    |
| `created_at`       | TIMESTAMP        | N        | Auto           | Waktu pembuatan record                                |
| `updated_at`       | TIMESTAMP        | N        | Auto           | Waktu update terakhir                                 |
| `deleted_at`       | TIMESTAMP        | Y        | NULL           | Soft delete                                           |

### Tabel: `product_variants`

| Kolom           | Tipe Data        | Nullable | Default | Keterangan                                         |
| --------------- | ---------------- | -------- | ------- | -------------------------------------------------- |
| `id`            | BIGINT (Auto ID) | N        | Auto    | Primary key                                        |
| `product_id`    | BIGINT (FK)      | N        | -       | Relasi ke `products.id`, hapus cascade             |
| `name`          | VARCHAR(255)     | Y        | NULL    | Nama varian (opsional)                             |
| `sku`           | VARCHAR(255)     | N        | Unik    | SKU unik untuk identifikasi varian                 |
| `price`         | UNSIGNED BIGINT  | N        | -       | Harga varian dalam satuan terkecil (misal: rupiah) |
| `stock`         | UNSIGNED BIGINT  | N        | `0`     | Jumlah stok tersedia                               |
| `weight`        | DECIMAL          | Y        | NULL    | Berat produk (kg atau gram, tergantung sistem)     |
| `length`        | DECIMAL          | Y        | NULL    | Panjang produk                                     |
| `width`         | DECIMAL          | Y        | NULL    | Lebar produk                                       |
| `height`        | DECIMAL          | Y        | NULL    | Tinggi produk                                      |
| `is_default`    | BOOLEAN          | N        | `false` | Menandakan varian default untuk produk             |
| `display_order` | UNSIGNED INTEGER | N        | `0`     | Urutan tampilan varian                             |
| `created_at`    | TIMESTAMP        | N        | Auto    | Waktu pembuatan record                             |
| `updated_at`    | TIMESTAMP        | N        | Auto    | Waktu update terakhir                              |
| `deleted_at`    | TIMESTAMP        | Y        | NULL    | Soft delete                                        |

### Tabel: `product_variant_attributes`

| Kolom        | Tipe Data        | Nullable | Default | Keterangan                                     |
| ------------ | ---------------- | -------- | ------- | ---------------------------------------------- |
| `id`         | BIGINT (Auto ID) | N        | Auto    | Primary key                                    |
| `variant_id` | BIGINT (FK)      | N        | -       | Relasi ke `product_variants.id`, hapus cascade |
| `key`        | VARCHAR(255)     | N        | -       | Nama atribut (misal: `color`, `size`)          |
| `value`      | VARCHAR(255)     | N        | -       | Nilai atribut (misal: `Red`, `XL`)             |
| `created_at` | TIMESTAMP        | N        | Auto    | Waktu pembuatan record                         |
| `updated_at` | TIMESTAMP        | N        | Auto    | Waktu update terakhir                          |

### Tabel: `product_images`

> sistem akan membatasi setiap product hanya boleh memiligi gambar 5 atau 10 saja, tergantung config dari .env

| Kolom        | Tipe Data        | Nullable | Default | Keterangan                  |
| ------------ | ---------------- | -------- | ------- | --------------------------- |
| `id`         | BIGINT (Auto ID) | N        | Auto    | Primary key                 |
| `product_id` | BIGINT (FK)      | N        | -       | Relasi ke `products.id`     |
| `title`      | VARCHAR(255)     | Y        | NULL    | Judul atau deskripsi gambar |
| `url`        | VARCHAR(255)     | N        | -       | URL gambar produk           |
| `is_default` | BOOLEAN          | N        | `false` | Menandakan gambar utama     |
| `order_id`   | UNSIGNED INTEGER | Y        | `0`     | Urutan tampilan gambar      |
| `created_at` | TIMESTAMP        | N        | Auto    | Waktu pembuatan record      |
| `updated_at` | TIMESTAMP        | N        | Auto    | Waktu update terakhir       |
