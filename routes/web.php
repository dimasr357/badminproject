<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LapanganController;

Route::get('/', function () {
    $lapangans = \App\Models\Lapangan::where('status', 'tersedia')->take(3)->get();
    return view('welcome', compact('lapangans'));
});

Route::get('/lapangan', [LapanganController::class, 'publicIndex'])->name('lapangan');

Route::get('/kontak', function () {
    return view('kontak');
});

// Customer Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Booking Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/infobooking', [BookingController::class, 'infobooking'])->name('infobooking');
    Route::get('/booking/{id}/bayar', [BookingController::class, 'showPembayaran'])->name('booking.payment');
    Route::post('/booking/{id}/bayar', [BookingController::class, 'bayar'])->name('booking.bayar');
    Route::post('/booking/upload-payment', [BookingController::class, 'uploadPayment'])->name('booking.upload-payment');
    Route::get('/booking/{id}/proof', [BookingController::class, 'showProof'])->name('booking.proof');
    Route::delete('/booking/{id}/hapus', [BookingController::class, 'hapus'])->name('booking.hapus');
    Route::get('/lapangan/{id}/jadwal', [BookingController::class, 'getJadwal'])->name('lapangan.jadwal');
});

// Admin Authentication Routes (use the same form as user)
Route::get('/admin/login', function(){ return redirect('/login'); })->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes (Protected)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }

        // Get counts for dashboard. Use try/catch to avoid breaking the page
        // if the database or tables are not yet available (e.g. during setup).
        try {
            $lapanganCount = \App\Models\Lapangan::count();
            $memberCount = \App\Models\User::count();
            $bookingCount = \App\Models\Booking::where(function($q){
                $q->where('status', 'bayar')
                  ->orWhereNotNull('payment_proof');
            })->count();
            $revenueTotal = \App\Models\Booking::where(function($q){
                $q->where('status', 'bayar')
                  ->orWhereNotNull('payment_proof');
            })->sum('total_harga');
        } catch (\Exception $e) {
            $lapanganCount = 0;
            $memberCount = 0;
            $bookingCount = 0;
            $revenueTotal = 0;
        }

        return view('admin.dashboard', compact('lapanganCount', 'memberCount', 'bookingCount', 'revenueTotal'));
    });

    Route::get('/lapangan', function () {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        return app(LapanganController::class)->index();
    })->name('admin.lapangan');

    Route::post('/lapangan', function (\Illuminate\Http\Request $request) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        return app(LapanganController::class)->store($request);
    })->name('admin.lapangan.store');

    Route::post('/lapangan/{id}/update', function (\Illuminate\Http\Request $request, $id) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        return app(LapanganController::class)->update($request, $id);
    })->name('admin.lapangan.update');

    Route::post('/lapangan/{id}/delete', function ($id) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        return app(LapanganController::class)->destroy($id);
    })->name('admin.lapangan.delete');

    Route::get('/booking', function () {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        // Tampilkan hanya booking yang sudah melakukan pembayaran
        try {
            $bookings = \App\Models\Booking::with(['user', 'lapangan'])
                ->where(function($q){
                    $q->where('status', 'bayar')
                      ->orWhereNotNull('payment_proof');
                })
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $bookings = collect();
        }

        return view('admin.booking', compact('bookings'));
    });

    Route::get('/admins', function () {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        try {
            $admins = \App\Models\Admin::select('id','username','nama_lengkap','email','no_hp')->orderBy('created_at','desc')->get();
        } catch (\Exception $e) {
            $admins = collect();
        }
        return view('admin.admins', compact('admins'));
    })->name('admin.admins');

    Route::post('/admins', function (\Illuminate\Http\Request $request) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);
        try {
            \App\Models\Admin::create($validated);
            return redirect()->route('admin.admins')->with('success','Admin ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('admin.admins')->withErrors(['email' => 'Gagal menambah admin']);
        }
    })->name('admin.admins.store');

    Route::post('/admins/{id}/delete', function ($id) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        try {
            $count = \App\Models\Admin::count();
            if ($count <= 1) {
                return redirect()->route('admin.admins')->with('error','Minimal satu admin harus ada');
            }
            $admin = \App\Models\Admin::findOrFail($id);
            $admin->delete();
            return redirect()->route('admin.admins')->with('success','Admin dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.admins')->with('error','Gagal menghapus admin');
        }
    })->name('admin.admins.delete');

    Route::get('/users', function () {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        try {
            $members = \App\Models\User::select('id','name','email','no_hp','jenis_kelamin')->orderBy('created_at','desc')->get();
        } catch (\Exception $e) {
            $members = collect();
        }
        return view('admin.users', compact('members'));
    })->name('admin.users');

    Route::post('/users/{id}/delete', function ($id) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        try {
            $user = \App\Models\User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.users')->with('success','User dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error','Gagal menghapus user');
        }
    })->name('admin.users.delete');

    // Konfirmasi pembayaran booking oleh admin
    Route::post('/booking/{id}/confirm', function (\Illuminate\Http\Request $request, $id) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        try {
            $booking = \App\Models\Booking::findOrFail($id);
            $booking->update([
                'status' => 'bayar',
                'paid_at' => now(),
            ]);
            return redirect('/admin/booking')->with('success', 'Booking berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            return redirect('/admin/booking')->with('error', 'Gagal konfirmasi: ' . $e->getMessage());
        }
    })->name('admin.booking.confirm');

    // Tampilkan bukti pembayaran tanpa bergantung pada storage:link
    Route::get('/booking/{id}/proof', function (\Illuminate\Http\Request $request, $id) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        try {
            $booking = \App\Models\Booking::findOrFail($id);
            $path = $booking->payment_proof ?: $booking->bukti_pembayaran;
            if (!$path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                abort(404);
            }
            $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($path);
            $mime = \Illuminate\Support\Facades\File::mimeType($fullPath);
            return response()->file($fullPath, ['Content-Type' => $mime]);
        } catch (\Exception $e) {
            abort(404);
        }
    })->name('admin.booking.proof');

    // Download bukti pembayaran
    Route::get('/booking/{id}/download', function (\Illuminate\Http\Request $request, $id) {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }
        try {
            $booking = \App\Models\Booking::findOrFail($id);
            $path = $booking->payment_proof ?: $booking->bukti_pembayaran;
            if (!$path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                abort(404, 'File bukti pembayaran tidak ditemukan');
            }
            $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($path);
            $mime = \Illuminate\Support\Facades\File::mimeType($fullPath);
            $originalName = basename($path);
            
            // Generate nama file untuk download
            $customerName = $booking->user->name ?? 'Customer';
            $lapanganName = $booking->lapangan->nama_lapangan ?? 'Lapangan';
            $tanggal = $booking->tanggal_pesan ? $booking->tanggal_pesan->format('Y-m-d') : date('Y-m-d');
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $downloadName = 'Bukti_Pembayaran_' . $customerName . '_' . $lapanganName . '_' . $tanggal . '.' . $extension;
            $downloadName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $downloadName);
            
            return response()->download($fullPath, $downloadName, [
                'Content-Type' => $mime,
            ]);
        } catch (\Exception $e) {
            abort(404, 'Gagal mendownload file: ' . $e->getMessage());
        }
    })->name('admin.booking.download');
});
