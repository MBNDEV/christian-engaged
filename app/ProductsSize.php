<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsSize extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'size','sku','weight'
    ];    
    
    protected  $table = 'ce_products_size';
    
}
