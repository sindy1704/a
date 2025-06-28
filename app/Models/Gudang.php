<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gudang extends Model
{
    protected $table = 'gudangs';

    protected $fillable = [
        'nama',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'bool',
    ];

     public function stocks(): HasMany
    {
        return $this->hasMany(Stock ::class,'gudang_id','id');
    }
}