<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal_pesan',
        'jam_main',
        'lama_sewa',
        'jam_habis',
        'total_harga',
        'status',
        'payment_method',
        'payment_proof',
        'paid_at',
    ];

    protected $casts = [
        'tanggal_pesan' => 'datetime',
        'jam_main' => 'datetime',
        'jam_habis' => 'datetime',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lapangan that owns the booking.
     */
    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}
