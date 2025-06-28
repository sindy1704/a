<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiStock extends Model
{
    protected $table = 'transaksi_stocks';

    protected $fillable = [
        'tanggal',
        'stock_id',
        'keterangan',
        'jenis_transaksi',
        'jumlah',
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(
            Stock::class,
            'stock_id',
            'id'
        );
    }
}