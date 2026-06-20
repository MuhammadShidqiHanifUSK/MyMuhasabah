# 🌙 MyMuhasabah

> _"Hisablah dirimu semua sebelum (nanti) dihisab. Dan timbanglah diri kamu semua sebelum (nanti) ditimbang. Karena nanti hisabmu akan lebih mudah jika engkau evaluasi dirimu sekarang. Dan hiaslah dirimu untuk pertemuan akbar (besar). Di hari akan ditampakkan semua dari kamu dan tidak ada yang tersembunyi."_
> — Umar bin Khattab Radhiyallahu 'Anhu

**MyMuhasabah** adalah aplikasi web jurnal muhasabah harian berbasis Laravel yang memungkinkan pengguna untuk mencatat refleksi diri, melacak ibadah, dan mengevaluasi diri secara jujur setiap harinya.

![Laravel](https://img.shields.io/badge/Laravel-v13-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4-blue?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)
![Version](https://img.shields.io/badge/Version-1.0.0-green)

---

## 📸 Tampilan Aplikasi

| Halaman      | Deskripsi                          |
| ------------ | ---------------------------------- |
| Landing Page | Halaman utama sebelum login        |
| Dashboard    | Streak, heatmap, statistik, grafik |
| Muhasabah    | Jurnal catatan harian              |
| Tracker      | Tracker ibadah harian              |
| Admin        | Panel kelola sistem                |

---

## ✨ Fitur Utama

### 👤 Autentikasi

- Register akun baru dengan validasi lengkap
- Login & Logout
- Role-based access (user & admin)
- Proteksi halaman dengan middleware

### 📔 Jurnal Muhasabah (CRUD)

- Tulis catatan muhasabah harian (judul, isi, mood, tanggal)
- Lihat daftar semua catatan dengan pagination
- Edit dan hapus catatan
- Validasi form di sisi server
- Filter catatan berdasarkan tanggal

### ✅ Tracker Ibadah Harian

**Amal Kebaikan:**

- Sholat Wajib (Shubuh, Dzuhur, Ashar, Maghrib, Isya) dengan status: ✅ Tepat Waktu / 🕐 Telat / ❌ Terlewat
- Sholat Sunnah (Qabliyah Shubuh, Qabliyah Dzuhur, Ba'diyah Dzuhur, Qabliyah Ashar, Qabliyah Maghrib, Ba'diyah Maghrib, Qabliyah Isya, Ba'diyah Isya, Tahajud, Dhuha, Witir)
- Tilawah Al-Quran (input jumlah halaman)
- Dzikir Pagi & Petang
- Puasa Sunnah, Sedekah, Membantu Orang, Silaturahmi

**Amal Keburukan (Muhasabah Jujur):**

- Berkata Kotor, Berbohong, Ghibah, Berkata Kasar
- Merokok, Begadang Sia-sia, Scrolling Berlebihan
- Marah Berlebihan, Iri/Dengki, Sombong

### 📅 Kalender Tracker

- Tampilan kalender bulanan
- Navigasi antar bulan
- Indikator hijau untuk hari yang sudah diisi
- Bisa isi tracker untuk hari-hari sebelumnya

### 📊 Dashboard & Visualisasi

- **Streak harian** 🔥 — hari berturut-turut menulis muhasabah
- **Heatmap aktivitas** — seperti GitHub contribution graph, hingga 1 tahun ke belakang
- **Tracker Hari Ini** — ringkasan status ibadah hari ini
- **Line Chart Tilawah** — tren tilawah 30 hari terakhir
- **Bar Chart Sholat** — statistik sholat 7 hari terakhir (tepat waktu/telat/terlewat)
- **Mood terakhir** — emoji + keterangan
- **Catatan terbaru** — 3 catatan terakhir

### 💭 Mood Tracker

7 pilihan mood dengan emoji:
😊 Bersyukur | 😌 Tenang | 😐 Biasa | 😟 Gelisah | 😢 Sedih | 😤 Marah | 😰 Khawatir

### ⚙️ Panel Admin

- Dashboard admin: total user, total catatan, total tracker, catatan hari ini
- Daftar semua user dengan jumlah catatan
- Hapus akun user
- Admin tidak bisa akses isi catatan pribadi user (privasi terjaga)

---

## 🛠️ Teknologi yang Digunakan

| Layer           | Teknologi                               |
| --------------- | --------------------------------------- |
| Backend         | Laravel 13 (PHP 8.4)                    |
| Frontend        | Blade Template + Tailwind CSS           |
| Database        | MySQL                                   |
| Autentikasi     | Laravel Breeze                          |
| Chart           | Chart.js                                |
| Font            | Playfair Display + Inter (Google Fonts) |
| Version Control | Git + GitHub                            |
| Development     | XAMPP / Laragon                         |

---

## 🗄️ Struktur Database

### Tabel `users`

| Kolom    | Tipe    | Keterangan             |
| -------- | ------- | ---------------------- |
| id       | bigint  | Primary key            |
| name     | varchar | Nama pengguna          |
| email    | varchar | Email (unique)         |
| password | varchar | Hashed (bcrypt)        |
| role     | enum    | 'user' / 'admin'       |
| avatar   | varchar | Path foto (nullable)   |
| bio      | text    | Bio singkat (nullable) |

### Tabel `muhasabahs`

| Kolom   | Tipe    | Keterangan           |
| ------- | ------- | -------------------- |
| id      | bigint  | Primary key          |
| user_id | bigint  | FK → users.id        |
| title   | varchar | Judul catatan        |
| content | text    | Isi catatan          |
| mood    | varchar | Kode mood (nullable) |
| tanggal | date    | Tanggal catatan      |

### Tabel `trackers`

| Kolom                | Tipe    | Keterangan                            |
| -------------------- | ------- | ------------------------------------- |
| id                   | bigint  | Primary key                           |
| user_id              | bigint  | FK → users.id                         |
| tanggal              | date    | Tanggal tracker                       |
| shubuh               | varchar | tepat_waktu / telat / terlewat / null |
| dzuhur               | varchar | tepat_waktu / telat / terlewat / null |
| ashar                | varchar | tepat_waktu / telat / terlewat / null |
| maghrib              | varchar | tepat_waktu / telat / terlewat / null |
| isya                 | varchar | tepat_waktu / telat / terlewat / null |
| sunnah\_\*           | boolean | Sholat-sholat sunnah                  |
| tilawah              | integer | Jumlah halaman tilawah                |
| dzikir_pagi          | boolean | —                                     |
| dzikir_petang        | boolean | —                                     |
| puasa_sunnah         | boolean | —                                     |
| sedekah              | boolean | —                                     |
| membantu_orang       | boolean | —                                     |
| silaturahmi          | boolean | —                                     |
| berkata_kotor        | boolean | —                                     |
| berbohong            | boolean | —                                     |
| ghibah               | boolean | —                                     |
| berkata_kasar        | boolean | —                                     |
| merokok              | boolean | —                                     |
| begadang_siasia      | boolean | —                                     |
| scrolling_berlebihan | boolean | —                                     |
| marah_berlebihan     | boolean | —                                     |
| iri_dengki           | boolean | —                                     |
| sombong              | boolean | —                                     |

### Relasi

```
users ──< muhasabahs   (one-to-many)
users ──< trackers     (one-to-many)
```

---

## 🚀 Cara Instalasi

### Prasyarat

- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM
- XAMPP / Laragon

### Langkah Instalasi

**1. Clone repository**

```bash
git clone https://github.com/MuhammadShidqiHanifUSK/MyMuhasabah.git
cd mymuhasabah
```

**2. Install dependencies**

```bash
composer install
npm install
```

**3. Konfigurasi environment**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Edit file `.env`**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mymuhasabah
DB_USERNAME=root
DB_PASSWORD=
```

**5. Buat database**

Buat database bernama `mymuhasabah` di phpMyAdmin dengan collation `utf8mb4_unicode_ci`.

**6. Jalankan migration & seeder**

```bash
php artisan migrate
php artisan db:seed
```

> Atau gunakan dump file SQL (lihat bagian Import Database di bawah).

**7. Jalankan aplikasi**

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

**8. Buka di browser**

```
http://127.0.0.1:8000
```

---

## 🗃️ Import Database

Tersedia dump file SQL di folder `database/dump/mymuhasabah.sql` sebagai alternatif migrasi.

**Cara import via phpMyAdmin:**

1. Buka phpMyAdmin → buat database baru bernama `mymuhasabah`
2. Klik tab **Import**
3. Pilih file `database/dump/mymuhasabah.sql`
4. Klik **Go**

**Atau via terminal:**

```bash
mysql -u root -p mymuhasabah < database/dump/mymuhasabah.sql
```

> Jika menggunakan dump file, tidak perlu menjalankan `php artisan migrate` dan `php artisan db:seed` — data sudah termasuk di dalamnya.

---

## 👤 Akun Default (Seeder)

| Role      | Email           | Password |
| --------- | --------------- | -------- |
| Admin     | admin@gmail.com | admin123 |
| User Demo | fulan@gmail.com | fulan123 |

> ⚠️ Ganti password setelah pertama kali login!

---

## 📁 Struktur Folder Penting

```
mymuhasabah/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── MuhasabahController.php
│   │   │   └── TrackerController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── Muhasabah.php
│       ├── Tracker.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── UserSeeder.php
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   └── users.blade.php
│       ├── auth/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── guest.blade.php
│       ├── muhasabah/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── tracker/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── dashboard.blade.php
│       └── welcome.blade.php
└── routes/
    └── web.php
```

---

## 🌐 Daftar Route

| Method | URL                  | Nama                | Keterangan           |
| ------ | -------------------- | ------------------- | -------------------- |
| GET    | /                    | —                   | Landing page         |
| GET    | /dashboard           | dashboard           | Dashboard user       |
| GET    | /muhasabah           | muhasabah.index     | Daftar catatan       |
| GET    | /muhasabah/create    | muhasabah.create    | Form buat catatan    |
| POST   | /muhasabah           | muhasabah.store     | Simpan catatan       |
| GET    | /muhasabah/{id}      | muhasabah.show      | Detail catatan       |
| GET    | /muhasabah/{id}/edit | muhasabah.edit      | Form edit catatan    |
| PUT    | /muhasabah/{id}      | muhasabah.update    | Update catatan       |
| DELETE | /muhasabah/{id}      | muhasabah.destroy   | Hapus catatan        |
| GET    | /tracker             | tracker.index       | Kalender tracker     |
| GET    | /tracker/{tanggal}   | tracker.show        | Isi tracker per hari |
| POST   | /tracker/{tanggal}   | tracker.store       | Simpan tracker       |
| GET    | /admin/dashboard     | admin.dashboard     | Dashboard admin      |
| GET    | /admin/users         | admin.users         | Kelola user          |
| DELETE | /admin/users/{id}    | admin.users.destroy | Hapus user           |

---

## 🔐 Keamanan

- Setiap user hanya bisa mengakses data miliknya sendiri
- Admin tidak bisa membaca isi catatan pribadi user
- Semua form divalidasi di sisi server
- Password di-hash menggunakan bcrypt
- CSRF protection pada semua form
- Middleware auth melindungi semua halaman yang memerlukan login
- Middleware admin melindungi halaman khusus admin

---

## 👨‍💻 Developer

**Nama:** Muhammad Shidqi Hanif  
**NPM:** 2408107010096  
**Program Studi:** Informatika  
**Kelas:** A  
**Semester:** 4  
**Mata Kuliah:** SINF2032 - Pemrograman Berbasis Web

---

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

© 2026 Muhammad Shidqi Hanif

---

_Dibuat dengan ❤️ untuk perjalanan diri yang lebih baik — MyMuhasabah v1.0_
