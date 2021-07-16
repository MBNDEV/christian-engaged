<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model {

    protected $table = 'ce_cms';
    protected $fillable = [
        'page_title', 'page_content','page_heading', 'page_url', 'meta_title','meta_keyword','meta_description','publish_status',
    ];
    
    public function getLeaders() {
        return DB::table('ce_leaders')
                ->where('status', '=', '1')->get();
    }

    public function getSlug($id) {
        return DB::table('ce_cms')
                ->where('id', '=', $id)->where('publish_status', '!=', 3)->pluck('page_url');;
    }
    
      public static function getStaticSlug($id) {
        return DB::table('ce_cms')
                ->where('id', '=', $id)->where('publish_status', '!=', 3)->pluck('page_url');;
    }

    public function getAboutusAmenities($id) {
        return DB::table('ce_aboutus_amenities')->where('id', '=', $id)->first();
    }
    
    public function updatevideoamenity($update,$id) {
        
        return DB::table('ce_aboutus_amenities')
                    ->where('id', $id)
                    ->update($update);
    }

}
