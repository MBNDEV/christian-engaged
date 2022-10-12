<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Videotopic;
use App\Video;
use DB;
use App\RelatedVideos;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Input;
use Exception;

class VideoController extends Controller {

    public function videotopics(Request $request) {
        $topics = Videotopic::where('status', '!=', '3')->orderBy('sort_order', 'ASC')->get();
        $page = $request->query('page');
        $data['content'] = view('admin.video.topiclisting', compact('topics', 'page'));
        return view('layouts.template', $data);
    }

    public function add(Request $request) {
        $data['content'] = view('admin.video.addtopic');
        return view('layouts.template', $data);
    }

    public function save(Request $request) {

        $this->validate($request, [
            'video_topic' => 'required|max:255|unique:ce_video_topics',
            'status' => 'required',
        ]);

        $topic = Videotopic::orderBy('id', 'desc')->first();

        $sort_order = 1;
        if ($topic && $topic->id) {
            $sort_order = $topic->id + 1;
        }

        $request->merge(['sort_order' => $sort_order]);
        $videotopic = Videotopic::create($request->all());

        if ($videotopic->id) {
            return redirect('/manage/video-topics')->withSuccess('Video Topic added Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }
     


    public function edit(Request $request, $id) {
        $topic = Videotopic::find($id);
        $data['content'] = view('admin.video.edittopic', compact('topic'));
        return view('layouts.template', $data);
    }

    public function update(Request $request, $id) {

        $this->validate($request, [
            'video_topic' => 'required|max:190|unique:ce_video_topics,video_topic,' . $id,
            'status' => 'required',
        ]);

        $videotopic = Videotopic::find($id);

        $videotopic->video_topic = $request->video_topic;
        $videotopic->status = $request->status;

        if ($videotopic->save()) {
            return redirect('/manage/video-topics')->withSuccess('Video Topic Updated Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function delete(Request $request, $id) {
        $videotopic = Videotopic::find($id);
        Videotopic::find($id)->delete();
        $videos = Video::select('id','video_image','featured_image','source_pdf','transcript_pdf')->where('topic_id',$id)->get();
        $related_videos = array();
        foreach ($videos as $key => $value) {
            $related_videos[] = $value->id;
            
            if($value->video_image != '' && file_exists(public_path('/uploads/videoimages/thumbs/thumb-'.$value->video_image)))
                unlink(public_path('/uploads/videoimages/thumbs/thumb-'.$value->video_image));
            
            if($value->featured_image != '' && file_exists(public_path('/uploads/videoimages/featured/'.$value->featured_image)))
                unlink(public_path('/uploads/videoimages/featured/'.$value->featured_image));
            
            if($value->video_image != '' && file_exists(public_path('/uploads/videoimages/'.$value->video_image)))
                unlink(public_path('/uploads/videoimages/'.$value->video_image));
            
            if($value->source_pdf != '' && file_exists(public_path('/uploads/pdf/'.$value->source_pdf)))
                unlink(public_path('/uploads/pdf/'.$value->source_pdf));

            if($value->transcript_pdf != '' && file_exists(public_path('/uploads/pdf/'.$value->transcript_pdf)))
                unlink(public_path('/uploads/pdf/'.$value->transcript_pdf));

        }
        Video::where('topic_id',$id)->delete();
        RelatedVideos::whereRaw('FIND_IN_SET(video_id,"'.implode(',',$related_videos).'")')->delete();
        RelatedVideos::whereRaw('FIND_IN_SET(related_id,"'.implode(',',$related_videos).'")')->delete();

        if ($videotopic->save()) {
            return redirect('/manage/video-topics')->withSuccess('Video Topic Deleted Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function sort(Request $request) {

        $postData = $request->all();
        $categoryList = $postData['categorylist'];

        foreach ($categoryList as $k => $v) {
            $videotopic = null;
            if ($k && $v) {
                $videotopic = Videotopic::find($v);
                $videotopic->sort_order = $k;
                $videotopic->save();
            }
        }

        $data = json_encode(['success' => 1]);
        print_r($data);
        die;
    }

    public function videos(Request $request) {
        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.publish_status', '!=', '3')->where('ce_video_topics.status', '!=', '3')
                        ->orderBy('ce_videos.created_at', 'DESC')->get();
// ->orderBy('ce_videos.sort_order', 'ASC')->get();
//        print_r($videos); die();
        $videoTopic = Videotopic::select('id', 'video_topic')
                        ->where('status', '=', '1')->orderBy('id', 'ASC')->get();
       

        $data['content'] = view('admin.video.videos', compact('videos', 'videoTopic'));
        return view('layouts.template', $data);
    }
public function videossocials(Request $request) {
        $socialvideos = DB::table('ce_socials')
                ->select('*')
                ->whereRaw('id','1')
                ->get();


        $data['content'] = view('admin.video.socialsvideo', compact('socialvideos'));
        return view('layouts.template', $data);
    }


     public function editvideosocials(Request $request, $id) {

        $socialvideos = DB::table('ce_socials')
                ->select('*')
                ->whereRaw('id',$id)
                ->get();
           //print_r($socialvideos);die;

        $data['content'] = view('admin.video.editvideosocials', compact('socialvideos'));
        return view('layouts.template', $data);

        }


     public function deletevideosocials(Request $request, $id) {

         DB::table('ce_socials')
        ->where('id', $id)  // find your user by their email
          // optional - to ensure only one record is deleted .
        ->delete();
          
          return redirect('/manage/videossocials')->withSuccess('Video Socials Deleted Successfully!');
           }

       public function updatevideosocials(Request $request, $id) {
          
       
        $validation_rule = [
            'video_title' => 'required',
            'video_url' => 'required',
            'video_description'=>'required',
          ];
        $validation_rule['video_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:min_width=600,min_height=338';

            $msg = ['video_image.max' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
            'video_image.min_width' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
            'video_image.max_width' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
        ];

        $this->validate($request, $validation_rule, $msg);
        $video_title=$request->video_title;
        $video_url=$request->video_url;
        $video_description=$request->video_description;
        $file = $request->file('video_image');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/videoimages/');
        $file->move($destinationPath,$fileName);
        $social_pic = '/uploads/videoimages/'.$fileName; 
        DB::table('ce_socials')
        ->where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('video_title' => $video_title,'video_url'=>$video_url,'video_description'=>$video_description,'video_image'=>$fileName));
          
          return redirect('/manage/videossocials')->withSuccess('Video Socials Updated Successfully!');
        }



    public function filtervideo(Request $request, $id) {
        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('publish_status', '!=', '3')->where('ce_videos.topic_id', '=', $id)->orderBy('ce_videos.sort_order', 'ASC')->get();

        $videoTopic = Videotopic::select('id', 'video_topic')
                        ->where('status', '=', '1')->orderBy('video_topic', 'ASC')->get();

        
        $data['content'] = view('admin.video.videos', compact('videos', 'videoTopic','newVideo'));
        return view('layouts.template', $data);
    }
    
    public function newVideo(Request $request) {
        $videoTopic = Videotopic::select('id', 'video_topic')
                        ->where('status', '=', '1')->orderBy('video_topic', 'ASC')->get();

        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('publish_status', '!=', '3')->where('ce_videos.is_new', '=', 1)->get();

        $data['content'] = view('admin.video.videos', compact('videos', 'videoTopic'));
        return view('layouts.template', $data);
    }
    
    public function updateNewVideo(Request $request){
        $id = $request->id;
        
        $video = Video::where('id',$id)->update(['is_new'=>1]);
        if($video){
            Video::where('id','!=',$id)->update(['is_new'=>0]);
        }
        $data['success'] = True;
        return json_encode($data);
    }

    public function addvideo(Request $request, $topicId) {
        $topics = Videotopic::where('status', '=', '1')->orderBy('sort_order', 'ASC')->get();

        /* $videos = Video::where('publish_status', '=', '1')->orderBy('ce_videos.id', 'DESC')->get(); */
        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.publish_status', '=', '1')->where('ce_video_topics.status', '!=', '3')
                        ->orderBy('ce_videos.sort_order', 'ASC')->get();

        $data['content'] = view('admin.video.addvideo', compact('topics', 'topicId', 'videos'));
        return view('layouts.template', $data);
    }

    public function savevideo(Request $request) {

        $validation_rule = [
            'video_title' => 'required',
            'video_url' => 'required',
            'topic_id' => 'required',
            'video_duration' => 'required',
            'source' => 'required',
            'transcript' => 'required',
            'video_description' => 'required',
            'video_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:min_width=600,min_height=338',
            'source_pdf' => 'required|max:1024',
            'transcript_pdf' => 'required|max:1024',
            'seo_slug' => 'required|alpha_dash|unique:ce_videos,seo_slug',
            'seo_keywords' => 'required',
            'seo_title' => 'required',
            'seo_description' => 'required',
        ];

        $msg = ['video_image.max' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
            'video_image.min_width' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
            'video_image.max_width' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
        ];

        $this->validate($request, $validation_rule, $msg);

        $video = Video::orderBy('sort_order', 'desc')->where('topic_id', '=', $request->topic_id)->first();

        $sort_order = 1;
        if ($video && $video->id) {
            $sort_order = $video->sort_order + 1;
        }

        $savedata = $request->all();

        $savedata['sort_order'] = $sort_order;

        $featuredVideos = Video::orderBy('featured_sort_order', 'asc')->where('is_featured', '=', 1)->where('publish_status', '=', '1')->get();

        $featured_sort_order = 1;
        if ($featuredVideos->count()) {
            foreach ($featuredVideos as $featuredVideo) {
                $featured_sort_order++;
                $videoDetail = Video::find($featuredVideo->id);
                $videoDetail->featured_sort_order = $featured_sort_order;

                $videoDetail->save();
            }
        }

        $savedata['featured_sort_order'] = 1;

        $thumbimage = $request->file('video_image');
        $imagename = time();
        $thumbimageObj = Image::make($thumbimage);
        $thumbimageObj->fit(400, 225)->save(public_path('/uploads/videoimages/thumbs/thumb-' . $imagename . '.' . $thumbimage->getClientOriginalExtension()));

        if ($request->is_featured) {
            $featured_image_name = time() . '.' . $thumbimage->getClientOriginalExtension();
            $featuredthumbObj = Image::make($thumbimage);
            $featuredthumbObj->resize(530, 298)->save(public_path('/uploads/videoimages/featured/' . $featured_image_name));
            $savedata['featured_image'] = $featured_image_name;
        }

        $savedata['is_featured'] = $request->is_featured;

        if (!isset($savedata['is_featured']))
            $savedata['is_featured'] = 0;

        $image = $request->file('video_image');
        $imagename = $imagename . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/videoimages');
        $image->move($destinationPath, $imagename);
        $savedata['video_image'] = $imagename;

        /*
         * Upload pdf for Source By Mukesh Kumar Jha
         */
        if (null !== $request->file('source_pdf'))
            $savedata['source_pdf'] = $this->addPdf($request, 'source_pdf');

        /*
         * Upload pdf for Transcript By Mukesh Kumar Jha
         */
        if (null !== $request->file('transcript_pdf'))
            $savedata['transcript_pdf'] = $this->addPdf($request, 'transcript_pdf');

        //echo "<pre>"; print_r($savedata); exit;
        $video = Video::create($savedata);
        if ($request->related_videos && count($request->related_videos)) {
            foreach ($request->related_videos as $value) {
                RelatedVideos::insert(['video_id' => $video->id,'related_id' => $value]);
            }
            // $savedata['related_videos'] = implode(',', $request->related_videos);
        }
        if ($video->id) {
            return redirect('/manage/videos/' . $request->topic_id)->withSuccess('Video added Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    /*
     * Upload pdf By Mukesh Kumar Jha
     */

    private function addPdf($request, $name) {
        try {
            /*
            * Upload pdf By Rupesh Rajhans
            */
            $uniqueFileName = $request->file($name)->getClientOriginalName();
            //$uniqueFileName = $name . '_' . uniqid() . '.' . $request->file($name)->getClientOriginalExtension();

            if ($request->file($name)->move(public_path('/uploads/pdf'), $uniqueFileName)) {
                return $uniqueFileName;
            }
            return FALSE;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function deletevideo(Request $request, $id) {

        $video = Video::select('topic_id','video_image','featured_image','source_pdf','transcript_pdf')->where('id', '=', $id)->get();

        if($video[0]->video_image != '' && file_exists(public_path('/uploads/videoimages/thumbs/thumb-'.$video[0]->video_image)))
            unlink(public_path('/uploads/videoimages/thumbs/thumb-'.$video[0]->video_image));
        
        if($video[0]->featured_image != '' && file_exists(public_path('/uploads/videoimages/featured/'.$video[0]->featured_image)))
            unlink(public_path('/uploads/videoimages/featured/'.$video[0]->featured_image));
        
        if($video[0]->video_image !='' && file_exists(public_path('/uploads/videoimages/'.$video[0]->video_image)))
            unlink(public_path('/uploads/videoimages/'.$video[0]->video_image));
        
        if($video[0]->source_pdf !='' && file_exists(public_path('/uploads/pdf/'.$video[0]->source_pdf)))
            unlink(public_path('/uploads/pdf/'.$video[0]->source_pdf));

        if($video[0]->transcript_pdf != '' && file_exists(public_path('/uploads/pdf/'.$video[0]->transcript_pdf)))
            unlink(public_path('/uploads/pdf/'.$video[0]->transcript_pdf));


        Video::find($id)->delete();

        RelatedVideos::where('video_id',"=",$id)->delete();
        RelatedVideos::where('related_id',"=",$id)->delete();


        // if ($video->save()) {
        return redirect('/manage/videos/' . $video[0]->topic_id)->withSuccess('Video Deleted Successfully!');
        // }

       // return redirect()->back()->withInput()->withErrors('Please try after some time.');
    }

    public function editvideo(Request $request, $id) {
        $video = Video::find($id);
        $topics = Videotopic::where('status', '=', '1')->orderBy('sort_order', 'ASC')->get();

        /* $videos = Video::where('publish_status', '=', '1')
          ->where('id', '!=', $id)
          ->orderBy('id', 'DESC')->get(); */
        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.id', '!=', $id)->where('ce_videos.publish_status', '=', '1')->where('ce_video_topics.status', '!=', '3')
                        ->orderBy('ce_videos.sort_order', 'ASC')->get();

        $related_videos = RelatedVideos::where('video_id', '=', $id)->get();
        $related_videos_array = array();
        foreach ($related_videos as $key => $value) {
            $related_videos_array[]=$value->related_id;
        }
        $data['content'] = view('admin.video.editvideo', compact('video', 'topics', 'videos','related_videos_array'));
        return view('layouts.template', $data);
    }

    public function updatevideo(Request $request, $id) {

        $pattern_slug = 'required|alpha_dash|max:100|unique:ce_videos,seo_slug';
        $slug_url = Video::where('seo_slug', '=', $request->seo_slug)->pluck('id');   
        
        if (isset($slug_url[0]) && $slug_url[0] == $id) {
                $pattern_slug = 'required|alpha_dash|max:100';
        }     

        $validation_rule = [
            'video_title' => 'required',
            'video_url' => 'required',
            'topic_id' => 'required',
            'video_duration' => 'required',
            'source_pdf' => 'max:1024',
            'transcript_pdf' => 'max:1024',
            'seo_slug' => $pattern_slug,
            'seo_keywords' => 'required',
            'seo_title' => 'required',
            'seo_description' => 'required',

        ];

        if ($request->vedioImageStatus == 1)
            $validation_rule['video_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:min_width=600,min_height=338';

        $msg = ['video_image.max' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
            'video_image.min_width' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
            'video_image.max_width' => 'File must be jpeg,png,jpg,gif,svg, less than 1MB and must have the resolution 600×338 or higher',
        ];

        $this->validate($request, $validation_rule, $msg);

        $savedata = $request->except(['related_videos']);

        if ($request->vedioImageStatus == 1) {

            $imagename = time();

            $thumbimage = $request->file('video_image');
            $thumbimageObj = Image::make($thumbimage);
            $thumbimageObj->resize(400, 225)->save(public_path('/uploads/videoimages/thumbs/thumb-' . $imagename . '.' . $thumbimage->getClientOriginalExtension()));

            if ($request->is_featured) {
                $featured_image_name = time() . '.' . $thumbimage->getClientOriginalExtension();
                $featuredthumbObj = Image::make($thumbimage);
                $featuredthumbObj->resize(530, 298)->save(public_path('/uploads/videoimages/featured/' . $featured_image_name));
            }

            $image = $request->file('video_image');
            $imagename = $imagename . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/videoimages');
            $image->move($destinationPath, $imagename);
            $savedata = $request->except(['_token', 'vedioImageStatus']);
            $savedata['video_image'] = $imagename;

            if ($request->is_featured)
                $savedata['featured_image'] = $featured_image_name;
        }else {

            $video = Video::find($id);
            if ($request->is_featured) {
                $featured_image_name = $video->video_image;
                $featuredthumbObj = Image::make(public_path('/uploads/videoimages/' . $video->video_image));
                $featuredthumbObj->resize(530, 298)->save(public_path('/uploads/videoimages/featured/' . $featured_image_name));
                $savedata['featured_image'] = $featured_image_name;


                $featuredVideos = Video::orderBy('featured_sort_order', 'asc')->where('is_featured', '=', 1)->where('publish_status', '=', '1')->get();

                $featured_sort_order = 1;
                if ($featuredVideos->count()) {
                    foreach ($featuredVideos as $featuredVideo) {
                        $featured_sort_order++;
                        $videoDetail = Video::find($featuredVideo->id);
                        $videoDetail->featured_sort_order = $featured_sort_order;

                        $videoDetail->save();
                    }
                }
                $savedata['featured_sort_order'] = 1;
            }
        }

        $savedata['is_featured'] = $request->is_featured;

        if (!isset($savedata['is_featured']))
            $savedata['is_featured'] = 0;

        RelatedVideos::where('video_id', '=' ,$id)->delete();
        if ($request->related_videos && count($request->related_videos)) {
            foreach ($request->related_videos as $value) {
                RelatedVideos::insert(['video_id' => $id,'related_id' => $value]);
            }
            // $savedata['related_videos'] = implode(',', $request->related_videos);
        }


        /*
         * Upload pdf for Source By Mukesh Kumar Jha
         */
        if (null !== $request->file('source_pdf'))
            $savedata['source_pdf'] = $this->addPdf($request, 'source_pdf');

        /*
         * Upload pdf for Transcript By Mukesh Kumar Jha
         */
        if (null !== $request->file('transcript_pdf'))
            $savedata['transcript_pdf'] = $this->addPdf($request, 'transcript_pdf');

        $editVideo = Video::find($id);


        $pdfSourcePath = public_path('/uploads/pdf/' . $editVideo->source_pdf);

        if (isset($savedata['source_pdf']) && !empty($editVideo->source_pdf)) {
            unlink($pdfSourcePath);
            //unset($pdfPath.$editVideo->source_pdf);
        }
        $pdfTranscritpPath = public_path('/uploads/pdf/' . $editVideo->transcript_pdf);
        if (isset($savedata['transcript_pdf']) && !empty($editVideo->transcript_pdf)) {
            unlink($pdfTranscritpPath);
        }


        unset($savedata['vedioImageStatus']);
        unset($savedata['_token']);
        unset($savedata['related_videos']);
        
        $vedio = Video::where('id', $id)->update($savedata);
        if ($vedio) {
            return redirect('/manage/videos/' . $savedata['topic_id'])->withSuccess('Video Topic Updated Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function sortVideos(Request $request) {

        $postData = $request->all();
        $videoList = $postData['videoList'];

        foreach ($videoList as $k => $v) {
            $video = null;
            if ($k && $v) {
                $video = Video::find($v);
                $video->sort_order = $k;
                $video->save();
            }
        }

        $data = json_encode(['success' => 1]);
        print_r($data);
        die;
    }

    public function featuredVideos(Request $request) {
        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.publish_status', '=', '1')
                        ->where('ce_video_topics.status', '=', '1')
                        ->where('ce_videos.is_featured', '=', '1')
                        ->orderBy('ce_videos.featured_sort_order', 'ASC')->get();
        $data['content'] = view('admin.video.featured-videos', compact('videos'));
        return view('layouts.template', $data);
    }

    public function sortFeaturedVideos(Request $request) {

        $postData = $request->all();
        $videoList = $postData['videoList'];

        foreach ($videoList as $k => $v) {
            $video = null;
// if($k && $v){   
            if ($v) {
                $video = Video::find($v);
                $video->featured_sort_order = $k;
                $video->save();
            }
        }

        $data = json_encode(['success' => 1]);
        print_r($data);
        die;
    }

    public function videoamenity(Request $request) {

        $videoObj = new Video();
        $videoamenity = $videoObj->videoamenity();
        $data['content'] = view('admin.video.video-amenity', compact('videoamenity'));
        return view('layouts.template', $data);
    }

    public function editvideoamenity(Request $request, $id) {
        $videoObj = new Video();
        $videoamenity = $videoObj->videoamenity($id);

        $data['content'] = view('admin.video.editvideoamenity', compact('videoamenity'));
        return view('layouts.template', $data);
    }

    public function updatevideoamenity(Request $request, $id) {

        $this->validate($request, [
            // 'heading' => 'required',
            // 'short_description' => 'required',
        ]);

        $videoObj = new Video();

        $update = array();
        $update['heading'] = $request->heading;
        $update['short_description'] = $request->short_description;

        $videoObj->updatevideoamenity($update, $id);
        return redirect('/manage/video-amenity')->withSuccess('Video Amenity Updated Successfully!');

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

}
