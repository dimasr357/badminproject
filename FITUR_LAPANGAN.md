# Fitur Manajemen Lapangan

## Deskripsi
Fitur ini memungkinkan admin untuk menambah, mengedit, dan menghapus data lapangan. Lapangan yang ditambahkan akan otomatis muncul di halaman publik `/lapangan` dan dapat dibooking oleh user yang sudah login.

## Cara Menggunakan

### 1. Jalankan Migration (Jika Belum)
```bash
php artisan migrate
```

### 2. Akses Halaman Admin
- Login sebagai admin di: `http://localhost/badminproject/public/admin/login`
- Setelah login, klik menu **Data Lapangan**

### 3. Menambah Lapangan Baru
1. Klik tombol **Tambah** (hijau)
2. Isi form:
   - **Nama Lapangan**: Nama lapangan (contoh: Lapangan Premium Gold)
   - **Harga**: Harga per jam dalam Rupiah (contoh: 50000)
   - **Foto**: Upload foto lapangan (opsional, format: jpg, png, gif, max 2MB)
   - **Keterangan**: Deskripsi lapangan
3. Klik **Simpan**
4. Lapangan akan tersimpan dan muncul di tabel

### 4. Mengedit Lapangan
1. Klik tombol **Edit** (hijau) pada lapangan yang ingin diedit
2. Ubah data yang diperlukan
3. Klik **Update**

### 5. Menghapus Lapangan
1. Klik tombol **Hapus** (merah) pada lapangan yang ingin dihapus
2. Konfirmasi penghapusan
3. Lapangan akan dihapus beserta fotonya

## Fitur yang Tersedia

### Admin Dashboard (`/admin/lapangan`)
- ✅ Tampilan tabel data lapangan dengan pagination
- ✅ Tombol tambah lapangan
- ✅ Tombol edit lapangan
- ✅ Tombol hapus lapangan
- ✅ Upload foto lapangan
- ✅ Notifikasi sukses setelah aksi
- ✅ Preview foto saat ini saat edit

### Halaman Publik (`/lapangan`)
- ✅ Menampilkan semua lapangan yang tersedia
- ✅ Menampilkan foto, nama, harga, dan deskripsi
- ✅ Tombol booking untuk user yang sudah login
- ✅ Redirect ke login untuk user yang belum login
- ✅ Data diambil langsung dari database

## Struktur Database

### Tabel: `lapangans`
| Field | Type | Deskripsi |
|-------|------|-----------|
| id | bigint | Primary key |
| nama_lapangan | varchar(255) | Nama lapangan |
| deskripsi | text | Deskripsi lapangan |
| harga_per_jam | decimal(10,2) | Harga per jam |
| tipe | varchar(255) | Tipe lapangan (default: standard) |
| status | varchar(255) | Status (default: tersedia) |
| image | varchar(255) | Path foto lapangan |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

## File yang Dibuat/Dimodifikasi

### Controller
- `app/Http/Controllers/LapanganController.php` - Controller untuk CRUD lapangan

### Routes
- `routes/web.php` - Menambahkan routes untuk admin dan publik

### Views
- `resources/views/admin/lapangan.blade.php` - Halaman admin data lapangan
- `resources/views/lapangan.blade.php` - Halaman publik daftar lapangan

### Model
- `app/Models/Lapangan.php` - Model Eloquent untuk lapangan

### Directory
- `public/images/lapangan/` - Folder untuk menyimpan foto lapangan

## Catatan Penting

1. **Upload Foto**: Foto akan disimpan di folder `public/images/lapangan/`
2. **Validasi**: 
   - Nama lapangan wajib diisi
   - Harga harus berupa angka positif
   - Foto maksimal 2MB (jpg, png, gif)
3. **Keamanan**: Hanya admin yang sudah login yang bisa mengakses halaman admin
4. **Pagination**: Data lapangan di admin ditampilkan 10 per halaman

## Testing

### Test Tambah Lapangan
1. Login sebagai admin
2. Buka `/admin/lapangan`
3. Klik tombol Tambah
4. Isi semua field dan upload foto
5. Klik Simpan
6. Cek apakah lapangan muncul di tabel
7. Buka `/lapangan` untuk melihat lapangan di halaman publik

### Test Edit Lapangan
1. Klik tombol Edit pada salah satu lapangan
2. Ubah nama atau harga
3. Klik Update
4. Cek apakah perubahan tersimpan

### Test Hapus Lapangan
1. Klik tombol Hapus pada salah satu lapangan
2. Konfirmasi penghapusan
3. Cek apakah lapangan terhapus dari tabel dan halaman publik

## Troubleshooting

### Foto tidak muncul
- Pastikan folder `public/images/lapangan/` ada dan memiliki permission write
- Cek path foto di database

### Error saat upload
- Pastikan ukuran foto tidak melebihi 2MB
- Pastikan format foto adalah jpg, png, atau gif

### Lapangan tidak muncul di halaman publik
- Pastikan status lapangan adalah "tersedia"
- Cek apakah data sudah tersimpan di database

## Fitur Mendatang (Opsional)
- [ ] Filter lapangan berdasarkan tipe
- [ ] Pencarian lapangan
- [ ] Bulk delete
- [ ] Export data ke Excel
- [ ] Upload multiple foto
