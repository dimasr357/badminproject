<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lapangan',
        'deskripsi',
        'harga_per_jam',
        'tipe',
        'status',
        'image',
    ];

    protected $casts = [
        'harga_per_jam' => 'decimal:2',
    ];

    /**
     * Get the bookings for the lapangan.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
