<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsSizeList extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'size_name',
    ];    
    
    protected  $table = 'ce_products_size_list';
    
}
