# 🔐 Cara Login Admin

## ✅ Status: Admin Account Sudah Siap!

### 📋 Kredensial Login Admin:
```
Email    : admin@gmail.com
Password : admin123
```

---

## 🚀 Langkah-Langkah Login:

### 1. Pastikan Server Berjalan
```bash
php artisan serve
```
Server akan berjalan di: `http://127.0.0.1:8000`

### 2. Buka Halaman Login Admin
Ada 2 cara:

**Cara 1:** Langsung ke admin login
```
http://127.0.0.1:8000/admin/login
```

**Cara 2:** Dari halaman login user
1. Buka: `http://127.0.0.1:8000/login`
2. Klik link "Login sebagai Admin" di bagian bawah

### 3. Masukkan Kredensial
- **Email**: `admin@gmail.com`
- **Password**: `admin123`
- Klik tombol **Login**

### 4. Setelah Login Berhasil
Anda akan diarahkan ke: `http://127.0.0.1:8000/admin/dashboard`

---

## 📊 Halaman Admin yang Tersedia:

1. **Dashboard** - `/admin/dashboard`
   - Statistik: Member, Pesanan, Lapangan, Penjualan

2. **Data Lapangan** - `/admin/lapangan`
   - Kelola data lapangan badminton

3. **Data Pesanan** - `/admin/pesanan`
   - Lihat dan kelola booking

4. **Data Admin** - `/admin/admins`
   - Kelola akun admin

---

## 🔒 Keamanan:

- ✅ Semua halaman admin dilindungi
- ✅ Harus login untuk akses
- ✅ Password di-hash dengan bcrypt
- ✅ Session-based authentication
- ✅ Tombol Logout tersedia di kanan atas

---

## ❌ Troubleshooting:

### Jika Login Gagal:

**1. Cek apakah admin ada di database:**
```bash
php check-admin.php
```

**2. Jika admin tidak ada, jalankan seeder:**
```bash
php artisan db:seed --class=AdminSeeder
```

**3. Jika masih error, cek session:**
```bash
php artisan config:clear
php artisan cache:clear
```

**4. Pastikan XAMPP MySQL berjalan**

---

## 🔄 Reset Password Admin:

Jika lupa password, jalankan seeder lagi:
```bash
php artisan db:seed --class=AdminSeeder
```
Password akan di-reset ke: `admin123`

---

## 📝 Catatan Penting:

⚠️ **GANTI PASSWORD** setelah login pertama kali untuk keamanan!

Default password `admin123` hanya untuk development.
