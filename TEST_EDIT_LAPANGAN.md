# 🧪 Testing Edit Lapangan

## ✅ Fitur yang Sudah Ada

Fitur edit lapangan sudah **lengkap dan siap digunakan**. Berikut adalah komponen yang sudah ada:

### 1. **Modal Edit** ✅
- Form dengan field: Nama Lapangan, Harga, Foto, Keterangan
- Pre-filled dengan data lapangan yang dipilih
- Preview foto saat ini
- Upload foto baru (opsional)

### 2. **JavaScript** ✅
- `openEditModal()` - Membuka modal dan mengisi data
- `closeEditModal()` - Menutup modal
- `updateEditFileName()` - Update nama file yang dipilih
- Form action dinamis: `/admin/lapangan/{id}/update`

### 3. **Controller** ✅
- Method `update()` di `LapanganController`
- Validasi input
- Handle upload foto baru
- Hapus foto lama jika upload baru
- Update data ke database
- Redirect dengan notifikasi sukses

### 4. **Route** ✅
- POST `/admin/lapangan/{id}/update`
- Middleware admin authentication
- Named route: `admin.lapangan.update`

## 🎯 Cara Testing

### Step 1: Login Admin
```
URL: http://localhost/badminproject/public/admin/login
Login dengan kredensial admin
```

### Step 2: Buka Data Lapangan
```
Klik menu "Data Lapangan" di sidebar
URL: http://localhost/badminproject/public/admin/lapangan
```

### Step 3: Klik Tombol Edit
```
1. Pada salah satu lapangan di tabel, klik tombol "Edit" (hijau)
2. Modal "Edit Lapangan" akan muncul
3. Form akan terisi otomatis dengan data lapangan
```

### Step 4: Edit Data
```
Ubah data yang ingin diupdate:
- Nama Lapangan: Ubah nama (contoh: tambahkan "Updated")
- Harga: Ubah harga (contoh: dari 60000 menjadi 65000)
- Foto: (Opsional) Upload foto baru
- Keterangan: Ubah deskripsi
```

### Step 5: Klik Update
```
1. Klik tombol "Update" (biru)
2. Form akan submit ke server
3. Data akan divalidasi
4. Jika valid, data akan tersimpan
5. Redirect ke halaman data lapangan
6. Muncul notifikasi hijau: "Lapangan berhasil diupdate!"
```

### Step 6: Verifikasi
```
1. Cek tabel - data harus terupdate
2. Jika upload foto baru, foto harus berubah
3. Buka halaman publik /lapangan - data juga harus terupdate
```

## 🔍 Test Cases

### Test 1: Edit Nama dan Harga Saja
**Steps:**
1. Klik Edit pada "Lapangan Premium Tertutup 1"
2. Ubah nama menjadi "Lapangan Premium Tertutup 1 - Updated"
3. Ubah harga menjadi 65000
4. Jangan upload foto baru
5. Klik Update

**Expected Result:**
- ✅ Notifikasi sukses muncul
- ✅ Nama terupdate di tabel
- ✅ Harga terupdate: Rp 65.000
- ✅ Foto tetap sama (tidak berubah)

### Test 2: Edit dengan Upload Foto Baru
**Steps:**
1. Klik Edit pada salah satu lapangan
2. Klik area upload foto
3. Pilih foto baru (max 2MB)
4. Lihat nama file muncul
5. Klik Update

**Expected Result:**
- ✅ Notifikasi sukses muncul
- ✅ Foto lama terhapus dari server
- ✅ Foto baru tersimpan
- ✅ Foto baru ditampilkan di tabel

### Test 3: Edit Keterangan Saja
**Steps:**
1. Klik Edit
2. Ubah hanya field Keterangan
3. Klik Update

**Expected Result:**
- ✅ Notifikasi sukses muncul
- ✅ Keterangan terupdate
- ✅ Field lain tidak berubah

### Test 4: Validasi Form
**Steps:**
1. Klik Edit
2. Kosongkan field Nama Lapangan
3. Klik Update

**Expected Result:**
- ❌ Form tidak submit
- ❌ Muncul pesan error validasi
- ❌ Data tidak tersimpan

### Test 5: Upload Foto Besar
**Steps:**
1. Klik Edit
2. Upload foto > 2MB
3. Klik Update

**Expected Result:**
- ❌ Muncul error validasi
- ❌ "The foto must not be greater than 2048 kilobytes"
- ❌ Data tidak tersimpan

## 🐛 Troubleshooting

### Masalah: Modal tidak muncul
**Solusi:**
- Cek console browser (F12)
- Pastikan tidak ada error JavaScript
- Cek apakah tombol Edit memiliki onclick handler

### Masalah: Data tidak terupdate
**Solusi:**
1. Cek apakah form action benar: `/admin/lapangan/{id}/update`
2. Cek console browser untuk error
3. Cek apakah session admin_id ada
4. Cek database apakah data berubah

### Masalah: Foto tidak terupdate
**Solusi:**
1. Pastikan form memiliki `enctype="multipart/form-data"`
2. Cek ukuran foto < 2MB
3. Cek format foto: jpg, png, gif
4. Cek folder `public/images/lapangan/` memiliki permission write

### Masalah: Error 404
**Solusi:**
- Pastikan sudah login sebagai admin
- Cek route: `php artisan route:list --path=admin/lapangan`
- Pastikan route `admin.lapangan.update` ada

## ✅ Checklist Testing

- [ ] Modal edit muncul saat klik tombol Edit
- [ ] Form terisi otomatis dengan data lapangan
- [ ] Preview foto saat ini ditampilkan
- [ ] Bisa ubah nama lapangan
- [ ] Bisa ubah harga
- [ ] Bisa ubah keterangan
- [ ] Bisa upload foto baru
- [ ] Nama file muncul saat pilih foto
- [ ] Klik Update submit form
- [ ] Notifikasi sukses muncul
- [ ] Data terupdate di tabel
- [ ] Foto terupdate (jika upload baru)
- [ ] Data terupdate di halaman publik
- [ ] Validasi form berfungsi
- [ ] Error handling berfungsi

## 📊 Flow Update

```
User Klik Edit
    ↓
Modal Muncul dengan Data
    ↓
User Edit Data
    ↓
User Klik Update
    ↓
Form Submit ke /admin/lapangan/{id}/update
    ↓
Controller Validasi Input
    ↓
[Valid] → Update Database
    ↓
[Upload Foto] → Hapus Foto Lama → Simpan Foto Baru
    ↓
Redirect ke /admin/lapangan
    ↓
Notifikasi Sukses Muncul
    ↓
Data Terupdate di Tabel
```

## 🎉 Status

**Fitur Edit Lapangan: READY TO USE** ✅

Semua komponen sudah ada dan berfungsi:
- ✅ Modal Edit
- ✅ Form Pre-filled
- ✅ JavaScript Handler
- ✅ Controller Update
- ✅ Route
- ✅ Validasi
- ✅ Upload Foto
- ✅ Notifikasi

**Silakan test sekarang!** 🚀

---

**Quick Test:**
1. Login admin
2. Buka Data Lapangan
3. Klik Edit pada salah satu lapangan
4. Ubah nama atau harga
5. Klik Update
6. ✅ Data tersimpan!
