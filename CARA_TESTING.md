# Cara Testing Fitur Lapangan

## Persiapan

### 1. Pastikan Database Sudah Siap
```bash
# Jalankan migration jika belum
php artisan migrate

# (Opsional) Jalankan seeder untuk data contoh
php artisan db:seed --class=LapanganSeeder
```

### 2. Jalankan Server
```bash
php artisan serve
```
Atau akses melalui XAMPP: `http://localhost/badminproject/public`

## Testing Flow Lengkap

### A. Testing di Admin Dashboard

#### 1. Login Admin
- URL: `http://localhost/badminproject/public/admin/login`
- Gunakan kredensial admin yang sudah ada

#### 2. Akses Halaman Data Lapangan
- Setelah login, klik menu **Data Lapangan** di sidebar
- URL: `http://localhost/badminproject/public/admin/lapangan`
- Anda akan melihat tabel data lapangan

#### 3. Test Tambah Lapangan Baru
**Langkah:**
1. Klik tombol **Tambah** (hijau dengan icon +)
2. Modal akan muncul dengan form
3. Isi data:
   - **Nama Lapangan**: `Lapangan Premium Gold`
   - **Harga**: `50000`
   - **Foto**: Upload gambar (contoh: foto lapangan badminton)
   - **Keterangan**: `Lapangan premium dengan fasilitas lengkap, AC, dan pencahayaan LED`
4. Klik tombol **Simpan**

**Expected Result:**
- Modal akan tertutup
- Muncul notifikasi hijau: "Lapangan berhasil ditambahkan!"
- Lapangan baru muncul di tabel paling atas
- Foto yang diupload tersimpan di folder `public/images/lapangan/`

#### 4. Test Edit Lapangan
**Langkah:**
1. Pada salah satu lapangan di tabel, klik tombol **Edit** (hijau)
2. Modal edit akan muncul dengan data lapangan yang dipilih
3. Ubah data, misalnya:
   - Ubah harga menjadi `55000`
   - Ubah keterangan
   - (Opsional) Upload foto baru
4. Klik tombol **Update**

**Expected Result:**
- Modal tertutup
- Muncul notifikasi: "Lapangan berhasil diupdate!"
- Data di tabel terupdate sesuai perubahan
- Jika upload foto baru, foto lama akan terhapus dan diganti

#### 5. Test Hapus Lapangan
**Langkah:**
1. Pada salah satu lapangan, klik tombol **Hapus** (merah)
2. Akan muncul konfirmasi: "Yakin ingin menghapus lapangan ini?"
3. Klik **OK**

**Expected Result:**
- Muncul notifikasi: "Lapangan berhasil dihapus!"
- Lapangan hilang dari tabel
- Foto lapangan terhapus dari folder `public/images/lapangan/`

#### 6. Test Pagination
**Langkah:**
1. Jika ada lebih dari 10 lapangan, akan muncul pagination di bawah tabel
2. Klik tombol **Next** atau nomor halaman
3. Tabel akan menampilkan data halaman berikutnya

### B. Testing di Halaman Publik

#### 1. Akses Halaman Lapangan Publik
- URL: `http://localhost/badminproject/public/lapangan`
- Halaman akan menampilkan semua lapangan yang tersedia

**Expected Result:**
- Semua lapangan yang ditambahkan di admin muncul di sini
- Setiap card menampilkan:
  - Foto lapangan
  - Nama lapangan
  - Deskripsi (dipotong 80 karakter)
  - Tombol "Booking Sekarang"

#### 2. Test Sinkronisasi Data
**Langkah:**
1. Buka 2 tab browser:
   - Tab 1: `/admin/lapangan` (login sebagai admin)
   - Tab 2: `/lapangan` (halaman publik)
2. Di Tab 1, tambah lapangan baru dengan nama "Test Lapangan Baru"
3. Refresh Tab 2

**Expected Result:**
- Lapangan "Test Lapangan Baru" muncul di halaman publik
- Data yang ditampilkan sesuai dengan yang diinput (nama, harga, foto, deskripsi)

#### 3. Test Booking (Jika User Sudah Login)
**Langkah:**
1. Login sebagai user biasa (bukan admin)
2. Buka `/lapangan`
3. Klik tombol **Booking Sekarang** pada salah satu lapangan

**Expected Result:**
- Modal booking muncul dengan detail lapangan
- Form booking siap diisi

#### 4. Test Redirect Login (Jika User Belum Login)
**Langkah:**
1. Logout atau buka browser incognito
2. Buka `/lapangan`
3. Klik tombol **Booking Sekarang**

**Expected Result:**
- User diarahkan ke halaman login

## Checklist Testing

### Admin Dashboard
- [ ] Halaman admin lapangan bisa diakses setelah login
- [ ] Tabel menampilkan data lapangan dengan benar
- [ ] Tombol Tambah membuka modal
- [ ] Form tambah bisa diisi dan disimpan
- [ ] Upload foto berhasil
- [ ] Notifikasi sukses muncul setelah tambah
- [ ] Data baru muncul di tabel
- [ ] Tombol Edit membuka modal dengan data yang benar
- [ ] Form edit bisa diupdate
- [ ] Foto lama ditampilkan saat edit
- [ ] Update foto mengganti foto lama
- [ ] Notifikasi sukses muncul setelah edit
- [ ] Tombol Hapus menampilkan konfirmasi
- [ ] Hapus berhasil menghapus data dan foto
- [ ] Notifikasi sukses muncul setelah hapus
- [ ] Pagination berfungsi (jika data > 10)

### Halaman Publik
- [ ] Halaman lapangan bisa diakses tanpa login
- [ ] Semua lapangan ditampilkan dalam grid
- [ ] Foto lapangan ditampilkan dengan benar
- [ ] Nama lapangan ditampilkan
- [ ] Harga ditampilkan dengan format Rupiah
- [ ] Deskripsi ditampilkan (dipotong jika terlalu panjang)
- [ ] Tombol booking muncul untuk user yang login
- [ ] Tombol booking redirect ke login untuk user yang belum login
- [ ] Data sinkron dengan admin dashboard
- [ ] Jika tidak ada lapangan, muncul pesan "Belum ada lapangan tersedia"

## Test Cases Edge

### 1. Upload Foto Besar
- Upload foto > 2MB
- Expected: Muncul error validasi

### 2. Upload File Bukan Gambar
- Upload file .pdf atau .txt
- Expected: Muncul error validasi

### 3. Tambah Lapangan Tanpa Foto
- Isi semua field kecuali foto
- Expected: Lapangan tersimpan dengan foto default

### 4. Edit Lapangan Tanpa Ubah Foto
- Edit data tanpa upload foto baru
- Expected: Foto lama tetap digunakan

### 5. Hapus Lapangan yang Sedang Dibooking
- (Jika ada relasi dengan booking)
- Expected: Tergantung business logic

### 6. Input Harga Negatif
- Input harga -10000
- Expected: Error validasi

### 7. Input Nama Lapangan Kosong
- Submit form tanpa isi nama
- Expected: Error validasi

## Troubleshooting

### Foto Tidak Muncul
**Solusi:**
```bash
# Pastikan folder ada
mkdir -p public/images/lapangan

# Cek permission (Linux/Mac)
chmod 755 public/images/lapangan
```

### Error 404 di Admin Lapangan
**Solusi:**
- Pastikan sudah login sebagai admin
- Cek session admin_id: `dd(session('admin_id'))`

### Data Tidak Muncul di Halaman Publik
**Solusi:**
- Cek database: `SELECT * FROM lapangans`
- Pastikan status = 'tersedia'
- Clear cache: `php artisan cache:clear`

### Error Upload Foto
**Solusi:**
- Cek php.ini: `upload_max_filesize` dan `post_max_size`
- Restart Apache/Nginx

## Hasil Testing yang Diharapkan

Setelah semua testing berhasil:
1. ✅ Admin bisa menambah lapangan baru
2. ✅ Lapangan tersimpan di database
3. ✅ Foto tersimpan di folder public/images/lapangan
4. ✅ Admin bisa edit dan hapus lapangan
5. ✅ Lapangan muncul di halaman publik
6. ✅ User bisa melihat dan booking lapangan
7. ✅ Data sinkron antara admin dan publik
8. ✅ Validasi form berfungsi dengan baik
9. ✅ Notifikasi muncul setelah setiap aksi
10. ✅ Pagination berfungsi untuk data banyak

## Screenshot Lokasi (Untuk Dokumentasi)

1. **Admin Dashboard - Data Lapangan**: `/admin/lapangan`
2. **Modal Tambah Lapangan**: Klik tombol Tambah
3. **Modal Edit Lapangan**: Klik tombol Edit
4. **Halaman Publik Lapangan**: `/lapangan`
5. **Modal Booking**: Klik Booking Sekarang (setelah login)

---

**Note:** Pastikan XAMPP Apache dan MySQL sudah running sebelum testing!
