<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
