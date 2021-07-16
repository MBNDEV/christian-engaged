<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model {

    protected $table = 'ce_order_details';
    
    public $timestamps = false;
    
    protected $fillable = [
        'order_id', 'product_id', 'product_sku', 'sale_price', 'quantity'
    ];
}
