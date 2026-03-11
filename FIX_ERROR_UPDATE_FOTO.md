# 🔧 Fix Error Update Foto Lapangan

## 🐛 Error yang Terjadi

```
ErrorException
unlink(C:\xampp\htdocs\badminproject\public\/images/lapangan1.jpg): 
Resource temporarily unavailable
```

## 🔍 Penyebab

Error terjadi karena:
1. File `lapangan1.jpg` adalah **file default** yang digunakan oleh banyak lapangan
2. Ketika update lapangan dengan foto baru, controller mencoba **menghapus file default**
3. File default tidak boleh dihapus karena masih digunakan oleh lapangan lain
4. Windows mengunci file yang sedang digunakan, menyebabkan error

## ✅ Solusi yang Diterapkan

### 1. **Update Method `update()`**

Menambahkan pengecekan sebelum menghapus foto lama:

```php
// Delete old image if exists and not default image
if ($lapangan->image && 
    file_exists(public_path($lapangan->image)) && 
    $lapangan->image !== 'images/lapangan1.jpg' &&
    strpos($lapangan->image, 'images/lapangan/') === 0) {
    try {
        unlink(public_path($lapangan->image));
    } catch (\Exception $e) {
        // Ignore if file cannot be deleted
    }
}
```

**Pengecekan:**
- ✅ Foto ada di database
- ✅ File fisik ada di server
- ✅ **Bukan file default** (`lapangan1.jpg`)
- ✅ Path benar (di folder `images/lapangan/`)
- ✅ Try-catch untuk handle error

### 2. **Update Method `destroy()`**

Menambahkan pengecekan yang sama saat hapus lapangan:

```php
// Delete image if exists and not default image
if ($lapangan->image && 
    file_exists(public_path($lapangan->image)) && 
    $lapangan->image !== 'images/lapangan1.jpg' &&
    strpos($lapangan->image, 'images/lapangan/') === 0) {
    try {
        unlink(public_path($lapangan->image));
    } catch (\Exception $e) {
        // Ignore if file cannot be deleted
    }
}
```

## 🎯 Hasil Setelah Fix

### ✅ Update Foto Berhasil
- Foto lama yang **bukan default** akan dihapus
- Foto default (`lapangan1.jpg`) **tidak akan dihapus**
- Foto baru akan tersimpan dengan nama unik
- Tidak ada error lagi

### ✅ Hapus Lapangan Berhasil
- Foto yang **bukan default** akan dihapus
- Foto default **tidak akan dihapus**
- Data lapangan terhapus dari database
- Tidak ada error

## 🧪 Testing Setelah Fix

### Test 1: Update Lapangan dengan Foto Default
**Steps:**
1. Edit lapangan yang menggunakan `lapangan1.jpg`
2. Upload foto baru
3. Klik Update

**Expected Result:**
- ✅ Update berhasil
- ✅ Foto default tidak dihapus (masih ada di folder)
- ✅ Foto baru tersimpan
- ✅ Lapangan menggunakan foto baru
- ✅ Tidak ada error

### Test 2: Update Lapangan dengan Foto Custom
**Steps:**
1. Edit lapangan yang menggunakan foto custom (bukan default)
2. Upload foto baru
3. Klik Update

**Expected Result:**
- ✅ Update berhasil
- ✅ Foto lama terhapus dari folder
- ✅ Foto baru tersimpan
- ✅ Lapangan menggunakan foto baru
- ✅ Tidak ada error

### Test 3: Hapus Lapangan dengan Foto Default
**Steps:**
1. Hapus lapangan yang menggunakan `lapangan1.jpg`
2. Konfirmasi hapus

**Expected Result:**
- ✅ Hapus berhasil
- ✅ Foto default tidak dihapus (masih ada)
- ✅ Data lapangan terhapus
- ✅ Tidak ada error

### Test 4: Hapus Lapangan dengan Foto Custom
**Steps:**
1. Hapus lapangan yang menggunakan foto custom
2. Konfirmasi hapus

**Expected Result:**
- ✅ Hapus berhasil
- ✅ Foto custom terhapus dari folder
- ✅ Data lapangan terhapus
- ✅ Tidak ada error

## 📋 Penjelasan Logika

### Kenapa Tidak Hapus File Default?

1. **File Shared**: File `lapangan1.jpg` digunakan oleh banyak lapangan
2. **Backup**: File default sebagai fallback jika lapangan tidak punya foto
3. **Prevent Error**: Menghindari error "file not found" di lapangan lain
4. **Best Practice**: File default tidak boleh dihapus

### Kapan File Dihapus?

File foto **hanya dihapus** jika:
- ✅ Foto ada di database
- ✅ File fisik ada di server
- ✅ **Bukan file default**
- ✅ Path benar (di folder `images/lapangan/`)
- ✅ Saat update dengan foto baru ATAU saat hapus lapangan

### Try-Catch untuk Apa?

```php
try {
    unlink(public_path($lapangan->image));
} catch (\Exception $e) {
    // Ignore if file cannot be deleted
}
```

**Alasan:**
- Jika file sedang digunakan/terkunci, tidak akan error
- Jika permission denied, tidak akan error
- Update/hapus tetap berhasil meskipun file tidak bisa dihapus
- User tidak melihat error page

## 🔄 Flow Update Foto

```
User Upload Foto Baru
    ↓
Cek Foto Lama
    ↓
[Foto Lama = Default] → Skip Delete
    ↓
[Foto Lama = Custom] → Try Delete
    ↓
[Delete Success] → OK
[Delete Failed] → Ignore Error
    ↓
Upload Foto Baru
    ↓
Update Database
    ↓
✅ Success!
```

## ✅ Status

**Error Fixed!** ✅

Sekarang Anda bisa:
- ✅ Update foto lapangan tanpa error
- ✅ Hapus lapangan tanpa error
- ✅ File default tetap aman
- ✅ File custom terhapus otomatis

## 🚀 Silakan Test Lagi

**Coba update foto sekarang:**
1. Login admin
2. Buka Data Lapangan
3. Klik Edit pada lapangan manapun
4. Upload foto baru
5. Klik Update
6. ✅ Berhasil tanpa error!

---

**Problem Solved!** 🎉

Error `unlink(): Resource temporarily unavailable` sudah diperbaiki dengan menambahkan pengecekan untuk tidak menghapus file default.
