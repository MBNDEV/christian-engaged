<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedVideos extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'video_id', 'related_id'
    ];    
    
    protected  $table = 'ce_related_videos';
    
}
