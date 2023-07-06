<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'paket_id',
        'tanggal',
        'no_pesanan',
        'berat',
        'harga',
        'total',
        'alamat',
        'status',
        'nama_bank',
        'atas_nama',
        'no_rekening',
        'bukti_transfer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
