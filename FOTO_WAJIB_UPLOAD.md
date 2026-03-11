# 📸 Foto Wajib Upload - Dokumentasi

## ✨ Fitur Baru

Foto lapangan sekarang **WAJIB** diupload saat menambah lapangan baru. Jika tidak upload foto, data tidak bisa disimpan.

## 🎯 Perubahan yang Dibuat

### 1. **Validasi di Controller** ✅

**Sebelum:**
```php
'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```
- Foto opsional (nullable)
- Bisa tambah lapangan tanpa foto

**Sesudah:**
```php
'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
```
- Foto wajib (required)
- Tidak bisa tambah lapangan tanpa foto

**Custom Error Messages:**
```php
[
    'foto.required' => 'Foto lapangan wajib diupload',
    'foto.image' => 'File harus berupa gambar',
    'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif',
    'foto.max' => 'Ukuran foto maksimal 2MB',
]
```

### 2. **Input File di Form** ✅

**Perubahan:**
- ✅ Ditambahkan atribut `required` di input file
- ✅ Label ditambah tanda bintang merah (*)
- ✅ Ditambahkan keterangan format file
- ✅ Tampilan error validasi di modal

**Kode:**
```blade
<label class="form-label" for="foto">
    Foto <span style="color: #ef4444;">*</span>
</label>
<input type="file" id="foto" name="foto" accept="image/*" required>
<small>Format: JPG, PNG, GIF (Max 2MB)</small>
```

### 3. **Error Display** ✅

**Jika validasi gagal:**
```
┌─────────────────────────────────┐
│ Error:                          │
│ • Foto lapangan wajib diupload  │
└─────────────────────────────────┘
```

- Error ditampilkan di dalam modal
- Background merah muda
- List error jelas
- Modal auto-open jika ada error

### 4. **Keep Old Values** ✅

**Jika submit gagal:**
- ✅ Nama lapangan tetap terisi
- ✅ Harga tetap terisi
- ✅ Keterangan tetap terisi
- ❌ Foto harus upload ulang (browser security)

**Kode:**
```blade
value="{{ old('nama_lapangan') }}"
value="{{ old('harga') }}"
{{ old('keterangan') }}
```

## 🎯 Flow Validasi

### **Skenario 1: Submit Tanpa Foto**
```
User Isi Form (tanpa upload foto)
    ↓
Klik Simpan
    ↓
Browser Validasi (HTML5 required)
    ↓
Muncul pesan: "Please select a file"
    ↓
Form tidak submit
    ↓
User harus upload foto
```

### **Skenario 2: Upload File Bukan Gambar**
```
User Upload file .pdf
    ↓
Klik Simpan
    ↓
Server Validasi
    ↓
Error: "File harus berupa gambar"
    ↓
Modal auto-open dengan error
    ↓
User upload file gambar
```

### **Skenario 3: Upload Foto > 2MB**
```
User Upload foto 5MB
    ↓
Klik Simpan
    ↓
Server Validasi
    ↓
Error: "Ukuran foto maksimal 2MB"
    ↓
Modal auto-open dengan error
    ↓
User upload foto lebih kecil
```

### **Skenario 4: Semua Valid**
```
User Isi Form Lengkap
    ↓
Upload Foto Valid
    ↓
Klik Simpan
    ↓
Server Validasi ✅
    ↓
Foto Tersimpan
    ↓
Data Tersimpan
    ↓
Redirect dengan Notifikasi Sukses
```

## 🧪 Testing

### **Test 1: Submit Tanpa Foto**
**Steps:**
1. Klik tombol Tambah
2. Isi Nama Lapangan
3. Isi Harga
4. Isi Keterangan
5. **JANGAN upload foto**
6. Klik Simpan

**Expected Result:**
- ❌ Browser menampilkan: "Please select a file"
- ❌ Form tidak submit
- ❌ Data tidak tersimpan

### **Test 2: Upload File Bukan Gambar**
**Steps:**
1. Klik tombol Tambah
2. Isi semua field
3. Upload file .pdf atau .txt
4. Klik Simpan

**Expected Result:**
- ❌ Error: "File harus berupa gambar"
- ❌ Modal tetap terbuka
- ❌ Error ditampilkan di modal
- ❌ Data tidak tersimpan

### **Test 3: Upload Foto Terlalu Besar**
**Steps:**
1. Klik tombol Tambah
2. Isi semua field
3. Upload foto > 2MB
4. Klik Simpan

**Expected Result:**
- ❌ Error: "Ukuran foto maksimal 2MB"
- ❌ Modal tetap terbuka
- ❌ Error ditampilkan di modal
- ❌ Data tidak tersimpan

### **Test 4: Upload Foto Valid**
**Steps:**
1. Klik tombol Tambah
2. Isi semua field
3. Upload foto JPG < 2MB
4. Klik Simpan

**Expected Result:**
- ✅ Validasi berhasil
- ✅ Foto tersimpan di `public/images/lapangan/`
- ✅ Data tersimpan di database
- ✅ Redirect ke halaman data lapangan
- ✅ Notifikasi popup sukses muncul
- ✅ Lapangan baru muncul di tabel

### **Test 5: Format Foto Valid**
**Test dengan berbagai format:**
- ✅ JPG → Berhasil
- ✅ JPEG → Berhasil
- ✅ PNG → Berhasil
- ✅ GIF → Berhasil
- ❌ BMP → Error
- ❌ WEBP → Error (bisa ditambahkan)

## 📋 Validasi Rules

| Field | Rules | Error Message |
|-------|-------|---------------|
| Nama Lapangan | required, string, max:255 | Default Laravel |
| Harga | required, numeric, min:0 | Default Laravel |
| Keterangan | required, string | Default Laravel |
| **Foto** | **required**, image, mimes:jpeg,png,jpg,gif, max:2048 | **Custom message** |

## 🎨 UI Indicators

### **Label dengan Tanda Wajib:**
```
Foto *
```
- Tanda bintang merah (*)
- Menunjukkan field wajib diisi

### **Helper Text:**
```
Format: JPG, PNG, GIF (Max 2MB)
```
- Abu-abu
- Font kecil
- Informatif

### **Error Display:**
```
┌─────────────────────────────────┐
│ ⚠️ Error:                       │
│ • Foto lapangan wajib diupload  │
│ • Format foto harus jpeg, png,  │
│   jpg, atau gif                 │
└─────────────────────────────────┘
```
- Background merah muda
- Border merah
- Icon warning
- List error

## 🔄 Edit Lapangan

**Catatan Penting:**
- ✅ Saat **EDIT**, foto tetap **OPSIONAL**
- ✅ Jika tidak upload foto baru, foto lama tetap digunakan
- ✅ Jika upload foto baru, foto lama akan diganti

**Validasi Edit:**
```php
'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```
- Foto nullable (opsional)
- Hanya validasi jika ada upload

## 💡 Tips untuk User

### **Cara Upload Foto:**
1. Klik area "Browse..."
2. Pilih file gambar dari komputer
3. Pastikan format: JPG, PNG, atau GIF
4. Pastikan ukuran < 2MB
5. Nama file akan muncul setelah dipilih

### **Jika Error Upload:**
1. Cek format file (harus gambar)
2. Cek ukuran file (max 2MB)
3. Compress foto jika terlalu besar
4. Gunakan format JPG untuk ukuran lebih kecil

### **Rekomendasi Foto:**
- Resolusi: 800x600 px atau 1024x768 px
- Format: JPG (ukuran lebih kecil)
- Ukuran: 200KB - 1MB (optimal)
- Kualitas: 80-90% (balance size & quality)

## ✅ Checklist

- [x] Validasi `required` di controller
- [x] Custom error messages
- [x] Atribut `required` di input file
- [x] Label dengan tanda *
- [x] Helper text format file
- [x] Error display di modal
- [x] Auto-open modal jika error
- [x] Keep old values saat error
- [x] Edit tetap opsional

## 🎉 Status

**READY TO USE** ✅

Foto sekarang wajib diupload saat menambah lapangan baru:
- ✅ Tidak bisa submit tanpa foto
- ✅ Validasi format file
- ✅ Validasi ukuran file
- ✅ Error message jelas
- ✅ User-friendly

## 🚀 Test Sekarang

**Coba tambah lapangan tanpa foto:**
1. Login admin
2. Klik Tambah Lapangan
3. Isi semua field **KECUALI foto**
4. Klik Simpan
5. ❌ **Browser akan mencegah submit!**
6. Upload foto
7. Klik Simpan lagi
8. ✅ **Berhasil!**

---

**Feature Complete!** 🎊

Foto lapangan sekarang wajib diupload untuk memastikan setiap lapangan memiliki gambar yang ditampilkan di halaman publik.
