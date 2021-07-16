<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Videotopic extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'video_topic', 'status', 'created_at', 'sort_order'
    ];    
    
    protected  $table = 'ce_video_topics';
    
}
