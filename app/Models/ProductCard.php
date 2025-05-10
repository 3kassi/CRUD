<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCard extends Model
{
    use HasFactory;

    protected $table = 'product_cards';
    protected $primaryKey = 'id'; 
    public $incrementing = true; 
    protected $fillable = [
        'sku',
        'product_name',
        'product_group',
        'expiration_date',
        'description',
    ];
}
