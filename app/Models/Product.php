<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_reference',
        'barcode',
        'designation',
        'internal_reference',
        'supplier_id',
        'uuidProduct',
        'product_name',
        'quantity',
        'amount'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

 
}
