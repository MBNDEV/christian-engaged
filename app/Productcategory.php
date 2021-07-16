<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','product_category','sort_order', 'status', 'created_at','slug'
    ];    
    
    protected  $table = 'ce_product_categories';
    
}
