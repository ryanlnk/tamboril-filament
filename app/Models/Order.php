<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class);
    }


    // Inicio de relacionamentos com a tabela intermediária
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
