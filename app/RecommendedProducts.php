<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendedProducts extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'recommended_id'
    ];    
    
    protected  $table = 'ce_recommended_products';
    
}
