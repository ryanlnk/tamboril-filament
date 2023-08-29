<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Inicio de relacionamentos com as tabelas intermediárias
    public function accessory_sales()
    {
        return $this->hasMany(AccessorySale::class);
    }

    public function book_sales()
    {
        return $this->hasMany(BookSale::class);
    }

    public function clothes_sales()
    {
        return $this->hasMany(ClothesSale::class);
    }
}
