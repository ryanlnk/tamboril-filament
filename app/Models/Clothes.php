<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    public function clothes_sales()
    {
        return $this->hasMany(ClothesSale::class);
    }
}
