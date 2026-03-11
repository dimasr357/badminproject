# Sistem Registrasi dan Login Customer

## Fitur yang Sudah Dibuat

### 1. **Registrasi Customer**
- URL: `/register`
- Form registrasi dengan field:
  - Nama Lengkap
  - Email (unique)
  - No HP
  - Password (minimum 6 karakter)
  - Alamat
  - Jenis Kelamin (Laki-laki/Perempuan)
  - Foto (opsional, max 2MB)
- Validasi form lengkap
- Auto-login setelah registrasi berhasil
- Redirect ke homepage dengan pesan sukses

### 2. **Login Customer**
- URL: `/login`
- Form login dengan:
  - Email
  - Password
  - Checkbox "Ingat saya" (remember me)
- Validasi kredensial
- Session management
- Pesan error jika login gagal
- Link ke halaman registrasi
- Link ke login admin

### 3. **Logout Customer**
- Route: `POST /logout`
- Menghapus session
- Redirect ke homepage

### 4. **Database**
Tabel `users` dengan kolom:
- id
- name
- email (unique)
- no_hp
- alamat
- jenis_kelamin (enum: Laki-laki, Perempuan)
- foto (path ke file foto)
- password (hashed)
- email_verified_at
- remember_token
- timestamps

### 5. **File yang Dibuat/Dimodifikasi**

#### Controllers:
- `app/Http/Controllers/AuthController.php` - Handle registrasi, login, logout customer

#### Models:
- `app/Models/User.php` - Updated dengan fillable fields baru

#### Migrations:
- `database/migrations/2025_10_03_055700_add_user_fields_to_users_table.php` - Menambahkan kolom baru

#### Views:
- `resources/views/register.blade.php` - Form registrasi (updated)
- `resources/views/login.blade.php` - Form login (updated)

#### Routes:
- `routes/web.php` - Ditambahkan routes untuk auth customer

## Cara Menggunakan

### Registrasi Baru:
1. Buka `/register`
2. Isi semua field yang required
3. Upload foto (opsional)
4. Klik tombol "Daftar"
5. Jika berhasil, akan auto-login dan redirect ke homepage

### Login:
1. Buka `/login`
2. Masukkan email dan password
3. Centang "Ingat saya" jika ingin tetap login (opsional)
4. Klik tombol "Login"
5. Jika berhasil, redirect ke homepage

### Logout:
1. Buat form dengan method POST ke route `/logout`
2. Tambahkan `@csrf` token
3. Submit form

## Security Features
- Password di-hash menggunakan bcrypt
- CSRF protection pada semua form
- Email validation dan unique constraint
- File upload validation (type dan size)
- Session regeneration setelah login
- Remember token untuk "ingat saya"

## Storage
- Foto user disimpan di: `storage/app/public/user_photos/`
- Accessible via: `public/storage/user_photos/`

## Testing
Untuk test sistem:
1. Jalankan server: `php artisan serve`
2. Buka browser ke `http://localhost:8000/register`
3. Daftar dengan data dummy
4. Coba login dengan akun yang baru dibuat
5. Cek database untuk memastikan data tersimpan

## Notes
- Migration sudah dijalankan
- Storage link sudah dibuat
- Semua routes sudah terdaftar
- Validation sudah lengkap
- Error handling sudah ada
