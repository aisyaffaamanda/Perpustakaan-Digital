# Perpustakaan Digital

Aplikasi Perpustakaan Digital berbasis web yang dibangun menggunakan CodeIgniter 4. Aplikasi ini memungkinkan pengelolaan data buku secara digital dengan fitur CRUD lengkap, autentikasi pengguna, pencarian, dan upload cover buku.

<p align="center">
  <img src="docs/halaman%20beranda%20perpustakaan%20digital.png" alt="Halaman Beranda" width="800"/>
</p>

## 🚀 Fitur Utama

- **Autentikasi Pengguna**: Sistem login yang aman dengan password ter-hash
- **Manajemen Buku**: CRUD (Create, Read, Update, Delete) data buku
- **Pencarian**: Pencarian buku berdasarkan judul, penulis, atau kategori
- **Upload Cover**: Upload dan manajemen gambar cover buku
- **Pagination**: Navigasi halaman untuk data buku
- **Responsive Design**: Tampilan yang responsif di berbagai perangkat
- **Validasi Form**: Validasi input data yang ketat
- **Session Management**: Manajemen session pengguna

## 📋 Prasyarat

Pastikan sistem Anda telah memenuhi requirements berikut:

- **PHP**: Version 8.2 atau lebih tinggi
- **MySQL/MariaDB**: Version 5.7 atau lebih tinggi
- **Composer**: Dependency manager untuk PHP
- **Web Server**: Apache/Nginx (atau gunakan PHP built-in server untuk development)

### Ekstensi PHP yang Diperlukan:

- intl
- mbstring
- json
- mysqlnd
- libcurl

## 📦 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd perpustakaandigital
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `env` menjadi `.env`:

```bash
copy env .env
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
# Environment
CI_ENVIRONMENT = development

# Base URL
app.baseURL = 'http://localhost:8080/'

# Database Configuration
database.default.hostname = localhost
database.default.database = perpustakaandigital
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 5. Buat Database

Buat database baru di MySQL:

```sql
CREATE DATABASE perpustakaandigital CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

### 6. Jalankan Migration

```bash
php spark migrate
```

Migration akan membuat 2 tabel:
- `users` - Tabel untuk pengguna/admin
- `buku` - Tabel untuk data buku

### 7. Jalankan Seeder (Opsional)

Untuk membuat user admin default:

```bash
php spark db:seed AdminSeeder
```

**Kredensial Default:**
- Username: `admin`
- Password: `admin123`

### 8. Buat Direktori Upload

Pastikan direktori untuk upload cover buku sudah ada dan memiliki permission yang tepat:

```bash
mkdir public\uploads
mkdir public\uploads\covers
```

### 9. Jalankan Aplikasi

Gunakan PHP built-in server:

```bash
php spark serve
```

Atau jika menggunakan Laragon/XAMPP/WAMP, arahkan virtual host ke folder `public/`.

Aplikasi akan berjalan di: `http://localhost:8080`

## 🗄️ Struktur Database

### Tabel `users`

| Kolom       | Tipe         | Keterangan                    |
|-------------|--------------|-------------------------------|
| id          | INT(11)      | Primary key, auto increment   |
| username    | VARCHAR(50)  | Unique, username pengguna     |
| password    | VARCHAR(255) | Password ter-hash (bcrypt)    |
| created_at  | TIMESTAMP    | Waktu pembuatan record        |

### Tabel `buku`

| Kolom        | Tipe         | Keterangan                    |
|--------------|--------------|-------------------------------|
| id           | INT(11)      | Primary key, auto increment   |
| judul        | VARCHAR(150) | Judul buku                    |
| penulis      | VARCHAR(100) | Nama penulis                  |
| kategori     | VARCHAR(50)  | Kategori buku                 |
| tahun_terbit | YEAR         | Tahun terbit buku             |
| penerbit     | VARCHAR(100) | Nama penerbit                 |
| stok         | INT          | Jumlah stok buku              |
| deskripsi    | TEXT         | Deskripsi buku (opsional)     |
| cover        | VARCHAR(255) | Path file cover (opsional)    |
| created_at   | TIMESTAMP    | Waktu pembuatan record        |
| updated_at   | TIMESTAMP    | Waktu update record           |

## 📱 Fitur & Halaman

### 1. Halaman Login

<p align="center">
  <img src="docs/login%20perpustakaan%20digital.png" alt="Login" width="600"/>
</p>

- URL: `/login`
- Autentikasi pengguna dengan username dan password
- Session-based authentication
- Redirect ke halaman daftar buku setelah login berhasil

### 2. Halaman Daftar Buku

<p align="center">
  <img src="docs/halaman%20beranda%20perpustakaan%20digital.png" alt="Halaman Beranda" width="800"/>
</p>

- URL: `/buku`
- Menampilkan semua buku dalam bentuk tabel
- Fitur pencarian real-time
- Pagination (10 buku per halaman)
- Tombol aksi: Tambah, Detail, Edit, Hapus

### 3. Halaman Detail Buku

<p align="center">
  <img src="docs/halaman%20detail.png" alt="Halaman Detail" width="700"/>
</p>

- URL: `/buku/detail/{id}`
- Menampilkan informasi lengkap buku
- Menampilkan cover buku (jika ada)
- Tombol kembali ke daftar dan edit buku

### 4. Halaman Tambah/Edit Buku

<p align="center">
  <img src="docs/halaman%20edit%20perpustakaan%20digital.png" alt="Halaman Edit" width="700"/>
</p>

- URL: `/buku/create` (tambah) atau `/buku/edit/{id}` (edit)
- Form input data buku dengan validasi
- Upload cover buku (JPG, JPEG, PNG, WEBP, max 2MB)
- Opsi hapus cover pada mode edit
- Validasi input di sisi server

## 🔐 Keamanan

- **Password Hashing**: Password di-hash menggunakan algoritma bcrypt
- **Session Management**: Session-based authentication untuk kontrol akses
- **Input Validation**: Validasi ketat pada semua input form
- **File Upload Security**: 
  - Validasi tipe file (hanya gambar)
  - Validasi ukuran file (max 2MB)
  - Random filename untuk mencegah overwrite
- **CSRF Protection**: Built-in CSRF protection dari CodeIgniter 4
- **SQL Injection Prevention**: Query builder CodeIgniter mencegah SQL injection

## 📂 Struktur Folder Penting

```
perpustakaandigital/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php          # Controller autentikasi
│   │   ├── Buku.php          # Controller manajemen buku
│   │   └── Home.php          # Controller home
│   ├── Models/
│   │   ├── BukuModel.php     # Model untuk tabel buku
│   │   └── UserModel.php     # Model untuk tabel users
│   ├── Views/
│   │   ├── auth/
│   │   │   └── login.php     # View halaman login
│   │   ├── buku/
│   │   │   ├── index.php     # View daftar buku
│   │   │   ├── detail.php    # View detail buku
│   │   │   ├── create.php    # View tambah buku
│   │   │   └── edit.php      # View edit buku
│   │   └── layout/
│   │       ├── header.php    # Layout header
│   │       └── footer.php    # Layout footer
│   ├── Database/
│   │   ├── Migrations/       # Database migrations
│   │   └── Seeds/            # Database seeders
│   └── Config/               # File konfigurasi
├── public/
│   ├── uploads/
│   │   └── covers/           # Folder upload cover buku
│   └── index.php             # Entry point aplikasi
├── writable/                 # Cache, logs, session
├── docs/                     # Screenshot aplikasi
├── .env                      # Environment configuration
└── composer.json             # Composer dependencies
```

## 🛠️ Penggunaan

### Login ke Aplikasi

1. Akses `http://localhost:8080/login`
2. Masukkan username dan password
3. Klik tombol "Login"

### Menambah Buku Baru

1. Dari halaman daftar buku, klik tombol "Tambah Buku"
2. Isi semua field yang diperlukan
3. Upload cover buku (opsional)
4. Klik "Simpan"

### Mencari Buku

1. Pada halaman daftar buku, gunakan search box
2. Ketik kata kunci (judul, penulis, atau kategori)
3. Hasil akan ditampilkan secara real-time

### Edit Buku

1. Klik tombol "Edit" pada buku yang ingin diubah
2. Ubah data yang diperlukan
3. Upload cover baru atau hapus cover lama (opsional)
4. Klik "Update"

### Hapus Buku

1. Klik tombol "Hapus" pada buku yang ingin dihapus
2. Konfirmasi penghapusan
3. Buku dan cover-nya akan dihapus dari sistem

### Logout

1. Klik tombol "Logout" di menu navigasi
2. Session akan dihapus dan redirect ke halaman login

## 🔧 Command-Line Tools

### Migration Commands

```bash
# Jalankan semua migrations
php spark migrate

# Rollback migration terakhir
php spark migrate:rollback

# Reset semua migrations
php spark migrate:reset

# Refresh migrations (reset + migrate)
php spark migrate:refresh
```

### Seeder Commands

```bash
# Jalankan seeder tertentu
php spark db:seed AdminSeeder

# Jalankan semua seeders
php spark db:seed
```

### Development Server

```bash
# Jalankan server di port default (8080)
php spark serve

# Jalankan server di port custom
php spark serve --port=3000

# Jalankan server di host tertentu
php spark serve --host=192.168.1.100
```

## 🐛 Troubleshooting

### Error: "Unable to connect to the database"

- Pastikan MySQL/MariaDB sudah berjalan
- Periksa konfigurasi database di file `.env`
- Pastikan database sudah dibuat

### Error: "Class 'IntlCalendar' not found"

- Install atau aktifkan ekstensi PHP `intl`
- Edit `php.ini` dan uncomment `extension=intl`
- Restart web server

### Upload File Gagal

- Pastikan direktori `public/uploads/covers` sudah dibuat
- Pastikan direktori memiliki permission write
- Periksa ukuran maksimum upload di `php.ini` (`upload_max_filesize` dan `post_max_size`)

### Session Tidak Tersimpan

- Pastikan direktori `writable/session` ada dan writable
- Periksa konfigurasi session di `app/Config/Session.php`
