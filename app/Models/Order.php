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

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }


    // Inicio de relacionamentos com a tabela intermediária
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
