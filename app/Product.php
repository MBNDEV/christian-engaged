<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'product_name', 'size', 'product_description','product_category_id','product_image','product_image1','product_image2','price','sku','weight','is_featured','featured_sort_order','publish_status','created_at','updated_at','seo_keywords','seo_slug','seo_description','seo_title'
    ];    
    
    protected  $table = 'ce_products';        
    
}
