<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;

class Video extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'video_title', 
        'topic_id',
        'video_image',
        'video_url',                
        'sort_order',        
        'source',
        'transcript',
        'video_duration',
        'video_description',
        'is_featured',
        'featured_image',
        'featured_sort_order',
        'publish_status',
        'source_pdf',
        'transcript_pdf',
        'created_at',
        'seo_keywords',
        'seo_slug',
        'seo_description',
        'seo_title'

    ];    
    
    protected  $table = 'ce_videos';
    
    
    public function loadVideos(Request $request, $search=array()) {
        //echo "<pre>"; print_r($search); exit; 
        $records_per_page = env('RECORDS_PER_PAGE', 10);      
        $results = DB::table('ce_videos')
                ->join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                ->select('ce_videos.*','ce_video_topics.video_topic')
                //->where('publish_status', '=', '1');
                ->where('ce_videos.publish_status', '=', '1')->where('ce_video_topics.status', '=', '1'); 

        if(isset($search['topic']) && $search['topic']){
            $results->where('ce_videos.topic_id', $search['topic']);
            //$results->orderBy('ce_videos.sort_order', 'DESC');
        } //else{
           // $results->orderBy('ce_videos.updated_at', 'DESC');
        //}
        
        // if(isset($search['date']) && $search['date']){
        //     $date = date('Y-m', strtotime($search['date']));            
        //     $results->where('ce_videos.updated_at', 'like', $date.'%');
        // }

        if(!empty($search['sort'])) {
            $results->orderBy('ce_videos.created_at', $search['sort']);
          // $results->orderBy('ce_videos.updated_at', $search['sort']);  
        } 

        if(!empty($search['topic']) && empty($search['sort'])) {
            $results->orderBy('ce_videos.sort_order', 'ASC');
        }
        
        if(empty($search['sort']) && empty($search['topic'])) {
            $results->orderBy('ce_videos.created_at', 'DESC');
        }


        return $results->paginate($records_per_page);
    }
    public function videoamenity($id=null) {
        $results = DB::table('ce_video_amenities');
                
        if($id)
            $results->where('id', $id);
                
        return $results->first();
    }
    
    
    public function updatevideoamenity($update,$id) {
        return DB::table('ce_video_amenities')
            ->where('id', $id)
            ->update($update);
    }
    
    public function videoDetail($slug) {
        return DB::table('ce_videos')
                    ->join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                    ->select('ce_videos.*','ce_video_topics.video_topic')
                    ->where('publish_status', '=', '1')
                    ->where('ce_videos.seo_slug', '=', $slug)->first();
    }
    
    public function relatedVideos($ids) {        
        return DB::table('ce_videos')
                   ->where('publish_status', '=', '1')
                   ->whereRaw('FIND_IN_SET(id,"'.$ids.'")')->get();
    }
    
}
