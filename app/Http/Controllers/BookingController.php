<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Lapangan;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Show booking page
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk melakukan booking.');
        }

        return view('booking');
    }

    /**
     * Store booking
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'tanggal_main' => 'required|date',
            'lama_main' => 'required|integer|min:1',
        ]);

        // Get lapangan data
        $lapangan = Lapangan::findOrFail($request->lapangan_id);

        // Parse tanggal main
        $jamMain = Carbon::parse($request->tanggal_main);
        $lamaSewa = (int) $request->lama_main;
        $jamHabis = $jamMain->copy()->addHours($lamaSewa);
        $totalHarga = $lapangan->harga_per_jam * $lamaSewa;

        // Create booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'lapangan_id' => $lapangan->id,
            'tanggal_pesan' => now(),
            'jam_main' => $jamMain,
            'lama_sewa' => $lamaSewa,
            'jam_habis' => $jamHabis,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        return redirect()->route('infobooking')->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Show user's bookings
     */
    public function infobooking()
    {
        // Pastikan session dimulai
        if (!session()->isStarted()) {
            session()->start();
        }

        // Regenerate CSRF token
        $token = csrf_token();
        
        // Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Hapus booking yang sudah lewat lebih dari 1 jam
        $now = now();
        $expiredBookings = Booking::where('user_id', Auth::id())
            ->where('jam_habis', '<=', $now->copy()->subHour())
            ->get();

        foreach ($expiredBookings as $expired) {
            $expired->delete();
        }

        // Ambil data booking yang masih aktif
        $bookings = Booking::with('lapangan')
            ->where('user_id', Auth::id())
            ->where('jam_habis', '>=', $now->copy()->subHour()) // Hanya ambil yang belum lewat 1 jam
            ->orderBy('created_at', 'desc')
            ->get();

        return view('infobooking', compact('bookings'));
    }

    /**
     * Show payment form
     */
    public function showPembayaran($id)
    {
        $booking = Booking::with('lapangan')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'pending') {
            return redirect()->route('infobooking')->with('error', 'Pembayaran untuk booking ini sudah diproses.');
        }

        return view('pembayaran', compact('booking'));
    }

    /**
     * Process payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bayar(Request $request, $id)
    {
        try {
            $request->validate([
                'payment_method' => 'required|in:bri,qris',
                'payment_proof' => 'required_if:payment_method,bri,qris|file|mimes:jpeg,png,jpg,pdf|max:2048'
            ]);

            $booking = Booking::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($booking->status !== 'pending') {
                return redirect()->route('infobooking')->with('error', 'Pembayaran untuk booking ini sudah diproses.');
            }

            // Handle file upload if exists
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            }

            $booking->update([
                'status' => 'menunggu_konfirmasi',
                'payment_method' => $request->payment_method,
                'payment_proof' => $paymentProofPath,
            ]);

            return redirect()->route('infobooking')->with('success', 'Pembayaran berhasil dikonfirmasi!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus booking
     */
    public function hapus($id)
    {
        try {
            $booking = Booking::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Hanya boleh menghapus booking dengan status pending
            if ($booking->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking tidak dapat dihapus karena sudah diproses.'
                ], 422);
            }

            $booking->delete();

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dihapus!'
            ]);
                
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus booking: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get jadwal for a specific lapangan
     */

    public function getJadwal($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        
        // Get bookings for this lapangan that are paid (status = 'bayar')
        $bookings = Booking::with('user')
            ->where('lapangan_id', $id)
            ->where('status', 'bayar')
            ->orderBy('jam_main', 'asc')
            ->get();

        return response()->json([
            'lapangan' => $lapangan,
            'bookings' => $bookings->map(function($booking) {
                return [
                    'id' => $booking->id,
                    'tanggal_pesan' => $booking->tanggal_pesan->format('d/m/Y'),
                    'nama' => $booking->user->name,
                    'jam_mulai' => $booking->jam_main->format('H:i'),
                    'lama_sewa' => $booking->lama_sewa,
                    'jam_habis' => $booking->jam_habis->format('H:i'),
                ];
            })
        ]);
    }

    /**
     * Handle payment proof upload
     */
    public function uploadPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $booking = Booking::findOrFail($request->booking_id);
            
            // Pastikan booking milik user yang login
            if ($booking->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }

            // Upload bukti pembayaran
            if ($request->hasFile('payment_proof')) {
                $path = $request->file('payment_proof')->store('payment_proofs', 'public');
                $booking->update([
                    'bukti_pembayaran' => $path,
                    'status' => 'menunggu_konfirmasi',
                    'tanggal_pembayaran' => now()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Bukti pembayaran berhasil diupload. Menunggu konfirmasi admin.'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload bukti pembayaran.'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
