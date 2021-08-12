<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailService;
use App\Newsletter;
use App\DonationGoal;
use App\Productcategory;
use App\Product;
use App\Video;
use App\Cms;
use App\Donations;
use App\RelatedVideos;
use App\Videotopic;
use App\Message;
use App\Contact_us;
use PDF;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use MetaTag;
use Illuminate\Support\Str;

class HomeController extends Controller {

    protected $mail_service;

    public function __construct() {
        $this->mail_service = new MailService();
    }

    public function index() {
        $donationGoal = DonationGoal::where('status', '=', '1')->first();
        $resultsocial = DB::table('ce_socials')
                ->select('*')
                ->whereRaw('id', '1')
                ->get();


        $donationsTotal = 0;
        $goal_amount = 0;
        if ($donationGoal) {
            $goal_id = $donationGoal->id;
            $donationsTotal = Donations::where('goal_id', '=', $goal_id)->where('payment_status', '=', 1)->sum('donation_amount');

            $goal_amount = $donationGoal->goal_amount;
        }

        $goalPercent = 0;
        if ($goal_amount && $donationsTotal) {
            $goalPercent = ($donationsTotal / $goal_amount) * 100;
        }

//        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
//                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
//                ->where('ce_products.publish_status', '=', '1')
//                ->where('ce_products.is_featured', '=', '1')
//                ->orderBy('ce_products.featured_sort_order', 'asc')
//                ->get();

        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.publish_status', '=', '1')
                        ->where('ce_video_topics.status', '=', '1')
                        ->where('is_featured', '=', '1')
                        ->orderBy('ce_videos.featured_sort_order', 'ASC')->get();

        $newvideo = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('publish_status', '!=', '3')->where('ce_videos.is_new', '=', 1)->first();

//        print_r($newvideo); die();
        $cmsObj = new Cms();


        //echo "<pre>"; print_r($message->all()); exit;

        $leaders = $cmsObj->getLeaders();
        $aboutUsPageSlug = $cmsObj->getSlug(1);
        $videoPageSlug = $cmsObj->getSlug(3);
        $merchPageSlug = $cmsObj->getSlug(5);


        $section2 = $cmsObj->getAboutusAmenities(2);
        $section2Amenities = json_decode($section2->amenity_details);
        $videoDetail = $this->getYoutubevideoDetail($section2Amenities->youtube_url);
        $videoIframe = 'Not Found';
        if ($videoDetail != 'Not Found' && is_object($videoDetail)) {
            $videoIframe = $videoDetail->html;
        }

        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '2')->get();
        //print_r($meta);
        if ($meta[0]->page_title) {
            MetaTag::set('title', $meta[0]->page_title);
        } else {
            MetaTag::set('title', 'Christianity Engaged');
        }

        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);
        $data['content'] = view('web.homepage', compact('donationGoal', 'videos', 'about_us_page', 'goalPercent', 'resultsocial', 'videoIframe', 'aboutUsPageSlug', 'videoPageSlug', 'merchPageSlug', 'newvideo'));
        return view('layouts.homepage-template', $data);
    }

    public function demo() {
        $donationGoal = DonationGoal::where('status', '=', '1')->first();
        $resultsocial = DB::table('ce_socials')
                ->select('*')
                ->whereRaw('id', '1')
                ->get();


        $donationsTotal = 0;
        $goal_amount = 0;
        if ($donationGoal) {
            $goal_id = $donationGoal->id;
            $donationsTotal = Donations::where('goal_id', '=', $goal_id)->where('payment_status', '=', 1)->sum('donation_amount');

            $goal_amount = $donationGoal->goal_amount;
        }

        $goalPercent = 0;
        if ($goal_amount && $donationsTotal) {
            $goalPercent = ($donationsTotal / $goal_amount) * 100;
        }

//        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
//                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
//                ->where('ce_products.publish_status', '=', '1')
//                ->where('ce_products.is_featured', '=', '1')
//                ->orderBy('ce_products.featured_sort_order', 'asc')
//                ->get();

        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.publish_status', '=', '1')
                        ->where('ce_video_topics.status', '=', '1')
                        ->where('is_featured', '=', '1')
                        ->orderBy('ce_videos.featured_sort_order', 'ASC')->get();

        $newvideo = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('publish_status', '!=', '3')->where('ce_videos.is_new', '=', 1)->first();

//        print_r($newvideo); die();
        $cmsObj = new Cms();


        //echo "<pre>"; print_r($message->all()); exit;

        $leaders = $cmsObj->getLeaders();
        $aboutUsPageSlug = $cmsObj->getSlug(1);
        $videoPageSlug = $cmsObj->getSlug(3);
        $merchPageSlug = $cmsObj->getSlug(5);


        $section2 = $cmsObj->getAboutusAmenities(2);
        $section2Amenities = json_decode($section2->amenity_details);
        $videoDetail = $this->getYoutubevideoDetail($section2Amenities->youtube_url);
        $videoIframe = 'Not Found';
        if ($videoDetail != 'Not Found' && is_object($videoDetail)) {
            $videoIframe = $videoDetail->html;
        }

        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '2')->get();
        //print_r($meta);
        if ($meta[0]->page_title) {
            MetaTag::set('title', $meta[0]->page_title);
        } else {
            MetaTag::set('title', 'Christianity Engaged');
        }

        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);

        
        
        $userName = env('WOOCOMMERCE_CONSUMER_KEY');
        $password = env('WOOCOMMERCE_CONSUMER_SECRET');

        $endpoint = 'https://storechristianityengaged.mbndigital-staging.com/wp-json/wc/v2/products?featured=true&consumer_key='.$userName.'&consumer_secret='.$password;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $products = curl_exec($ch);
        curl_close($ch); 
        echo(gettype(json_encode($products)));
        $data['content'] = view('web.homepage_demo', compact('donationGoal', 'videos', 'goalPercent', 'resultsocial', 'videoIframe', 'aboutUsPageSlug', 'videoPageSlug', 'merchPageSlug', 'newvideo', 'products'));   
        // return view('layouts.homepage-template', $data);
    }

    public function subscribe(Request $request) {
        $email = $request->email;
        $sendEmail = 0;
        $msg = 'Email and Confirm Email should be the same.';
        if ($request->email == $request->confirm_email) {
            $msg = 'Subscribed successfully.';
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $Newsletter = Newsletter::where('email', '=', $email)->first();

                if ($Newsletter) {
                    //if mail exists and having status unsubscribed
                    if ($Newsletter->status == 2) {
                        $Newsletter->status = 1;
                        $Newsletter->save();
                        $sendEmail = 1;
                    } else {
                        $msg = 'Already subscribed.';
                    }
                } else {
                    $result = Newsletter::create($request->all());
                    $sendEmail = 1;
                }

                if ($sendEmail && $email) {
                    $this->mail_service->newsletter_subscription($email);
                }
            } else {
                $msg = 'Invalid Email.';
            }
        }
        return json_encode(array('message' => $msg));
    }

    public function pages(Request $request, $slug) {
        try {
            $pageDetail = Cms::where('publish_status', '=', '1')->where('page_url', '=', $slug)->first();
            // print_r($pageDetail); die;
            if (!$pageDetail) {
                return redirect('/pagenotfound');
                // return abort(404);
            }

            //print_r($pageDetail);
            MetaTag::set('title', $pageDetail->page_title);
            MetaTag::set('description', $pageDetail->meta_description);
            MetaTag::set('keywords', $pageDetail->meta_keyword);
            //echo $pageDetail->id;

            if ($pageDetail->id == 1) {
                return $this->aboutus();
                die;
            }

            if ($pageDetail->id == 3) {
                return $this->videolibrary();
                die;
            }
            if ($pageDetail->id == 5) {

                // return $this->allmerch($request);
                // die;
                return redirect('/pagenotfound');
            }
            if ($pageDetail->id == 8) {
                return $this->contactus();
                die;
            }

            $data['content'] = view('web.cmspages', compact('pageDetail'));
            return view('layouts.web-template', $data);
        } catch (\Exception $e) {
            // abort(404, 'Page not found');
            return redirect('/pagenotfound');
        }
    }

    public function videolibrary() {
        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '3')->get();
        //print_r($meta);
        MetaTag::set('title', $meta[0]->page_title);
        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);
        $videoTopics = Videotopic::select('id', 'video_topic')
                        ->where('status', '=', '1')->orderBy('sort_order', 'ASC')->get();

        $records_per_page = env('RECORDS_PER_PAGE', 10);

        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.publish_status', '=', '1')->where('ce_video_topics.status', '=', '1')
                        ->orderBy('ce_videos.created_at', 'DESC')->paginate($records_per_page);
        // ->orderBy('ce_videos.sort_order', 'DESC')->paginate($records_per_page);

        $videoObj = new Video();
        $videoamenity = $videoObj->videoamenity();

        $data['content'] = view('web.videolibrary', compact('videos', 'videoTopics', 'videoamenity'));
        return view('layouts.web-template', $data);
    }

    // public function loadvideos(Request $request){
    //     $search = array();
    //     $search['topic'] = $request->query('topic');
    //     $search['date'] = $request->query('date');
    //     $video= new Video();
    //     $showNoVideos = true;
    //     if($request->page>1)
    //         $showNoVideos = false;
    //     $videos = $video->loadVideos($search);
    //     return view('web.video-list', compact('videos','showNoVideos'));
    // }

    public function loadvideos(Request $request) {

        $search = array();
        $search['topic'] = $request->query('topic');
        $search['sort'] = $request->query('sort');

        $video = new Video();

        $showNoVideos = true;
        if ($request->page > 1)
            $showNoVideos = false;

//        $videos = $video->loadVideos($request,$search);

        $records_per_page = env('RECORDS_PER_PAGE', 10);
        $results = DB::table('ce_videos')
                        ->join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        //->where('publish_status', '=', '1');
                        ->where('ce_videos.publish_status', '=', '1')->where('ce_video_topics.status', '=', '1');

        if (isset($search['topic']) && $search['topic']) {
            $results->where('ce_videos.topic_id', $search['topic']);
            //$results->orderBy('ce_videos.sort_order', 'DESC');
        } //else{
        // $results->orderBy('ce_videos.updated_at', 'DESC');
        //}
        // if(isset($search['date']) && $search['date']){
        //     $date = date('Y-m', strtotime($search['date']));            
        //     $results->where('ce_videos.updated_at', 'like', $date.'%');
        // }

        if (!empty($search['sort'])) {
            $results->orderBy('ce_videos.created_at', $search['sort']);
            // $results->orderBy('ce_videos.updated_at', $search['sort']);  
        }

        if (!empty($search['topic']) && empty($search['sort'])) {
            $results->orderBy('ce_videos.sort_order', 'ASC');
        }

        if (empty($search['sort']) && empty($search['topic'])) {
            $results->orderBy('ce_videos.created_at', 'DESC');
        }


        $videos = $results->paginate($records_per_page);



        return view('web.video-list', compact('videos', 'showNoVideos'));
    }

    public function videodetail($slug) {

        try {
            $videoObj = new Video();
            if ($slug == 'the-skeptics-journey-part-4') {
                $slug = 'the-skeptics-journey-part-3';
            }
            $video = $videoObj->videoDetail($slug);

            MetaTag::set('title', $video->seo_title);
            MetaTag::set('description', $video->seo_description);
            MetaTag::set('keywords', $video->seo_keywords);


            $videoDetail = $this->getYoutubevideoDetail($video->video_url);
            $videoIframe = 'Not Found';

            if ($videoDetail != 'Not Found' && is_object($videoDetail)) {
                $videoIframe = $videoDetail->html;
            }

            $related_videos = RelatedVideos::where('video_id', '=', $video->id)->get();
            $related_videos_array = array();
            foreach ($related_videos as $key => $value) {
                $related_videos_array[] = $value->related_id;
            }
            $relatedVideos = null;
            if (count($related_videos_array)) {
                $relatedVideos = $videoObj->relatedVideos(implode(',', $related_videos_array));
            }
            $donationGoal = DonationGoal::where('status', '=', '1')->first();

            $donationsTotal = 0;
            $goal_amount = 0;
            if ($donationGoal) {
                $goal_id = $donationGoal->id;
                $donationsTotal = Donations::where('goal_id', '=', $goal_id)->where('payment_status', '=', 1)->sum('donation_amount');

                $goal_amount = $donationGoal->goal_amount;
            }

            $goalPercent = 0;
            if ($goal_amount && $donationsTotal) {
                $goalPercent = ($donationsTotal / $goal_amount) * 100;
            }

            $data['metaShare'] = 'meta';
            $data['video'] = $video;
            $data['content'] = view('web.video-detail', compact('videoIframe', 'metaShare', 'video', 'relatedVideos', 'donationGoal', 'goalPercent'));
            return view('layouts.web-template', $data);
        } catch (\Exception $e) {
            return redirect('/pagenotfound');
            // abort(404, 'Page not found');
        }
    }

    public function social() {
        //token="IGQVJVeXNLUWd6bWQtc1ZAhTEFud0pVek90OHM1ZAEpDV2IyTDI2VDFhX3NieDNvb3ZAvOXJMZA2tYamRUdXVBOW5uSkhSQTBRRndaUUhjV29tenZA6UEJDcEl1dDVGQk1DLWxVcW92UUdn"
        $donationGoal = DonationGoal::where('status', '=', '1')->first();



        $resultsocial = DB::table('ce_socials')
                ->select('*')
                ->whereRaw('id', '1')
                ->get();


        $donationsTotal = 0;
        $goal_amount = 0;
        if ($donationGoal) {
            $goal_id = $donationGoal->id;
            $donationsTotal = Donations::where('goal_id', '=', $goal_id)->where('payment_status', '=', 1)->sum('donation_amount');

            $goal_amount = $donationGoal->goal_amount;
        }

        $goalPercent = 0;
        if ($goal_amount && $donationsTotal) {
            $goalPercent = ($donationsTotal / $goal_amount) * 100;
        }

        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
                ->where('ce_products.publish_status', '=', '1')
                ->where('ce_products.is_featured', '=', '1')
                ->orderBy('ce_products.featured_sort_order', 'asc')
                ->get();

        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.publish_status', '=', '1')
                        ->where('ce_video_topics.status', '=', '1')
                        ->where('is_featured', '=', '1')
                        ->orderBy('ce_videos.featured_sort_order', 'ASC')->get();

        $cmsObj = new Cms();


        //echo "<pre>"; print_r($message->all()); exit;

        $leaders = $cmsObj->getLeaders();
        $aboutUsPageSlug = $cmsObj->getSlug(1);
        $videoPageSlug = $cmsObj->getSlug(3);
        $merchPageSlug = $cmsObj->getSlug(5);


        $section2 = $cmsObj->getAboutusAmenities(2);
        $section2Amenities = json_decode($section2->amenity_details);
        $videoDetail = $this->getYoutubevideoDetail($section2Amenities->youtube_url);
        $videoIframe = 'Not Found';
        if ($videoDetail != 'Not Found' && is_object($videoDetail)) {
            $videoIframe = $videoDetail->html;
        }

        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '2')->get();
        //print_r($meta);
        if ($meta[0]->page_title) {
            MetaTag::set('title', $meta[0]->page_title);
        } else {
            MetaTag::set('title', 'Christianity Engaged');
        }

        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);
        $data['content'] = view('web.socialmedia', compact('donationGoal', 'products', 'videos', 'about_us_page', 'resultsocial', 'goalPercent', 'videoIframe', 'aboutUsPageSlug', 'videoPageSlug', 'merchPageSlug'));
        return view('layouts.web-template', $data);
    }

    public function aboutus() {

        $cmsObj = new Cms();

        $leaders = $cmsObj->getLeaders();

        $section1 = $cmsObj->getAboutusAmenities(1);
        $section2 = $cmsObj->getAboutusAmenities(2);
        $section3 = $cmsObj->getAboutusAmenities(3);

        $section2Amenities = json_decode($section2->amenity_details);

        $videoDetail = $this->getYoutubevideoDetail($section2Amenities->youtube_url);
        $videoIframe = 'Not Found';
        if ($videoDetail != 'Not Found' && is_object($videoDetail)) {
            $videoIframe = $videoDetail->html;
        }

        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '1')->get();
        //print_r($meta);
        MetaTag::set('title', $meta[0]->page_title);
        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);


        //Gaurav Added on 11/11/2019 Social link and donate section page functionality
        $resultsocial = DB::table('ce_socials')
                ->select('*')
                ->whereRaw('id', '1')
                ->get();

        $data['content'] = view('web.about-us', compact('leaders', 'section1', 'section2', 'section3', 'videoIframe', 'resultsocial'));
        return view('layouts.web-template', $data);
    }

    public function getYoutubevideoDetail($youtube_url) {
        $youtube = "https://www.youtube.com/oembed?url=" . $youtube_url . "&format=json";
        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $resultData = json_decode($output);
        curl_close($curl);
        return $resultData;
    }

    public function allmerch(Request $request) {
        $category = $request->query('category');
        if ($category == '')
            $category = 'feature-products';

        $categories = Productcategory::where('status', '=', '1')->orderBy('sort_order', 'ASC')->get();
//       print_r($categories); die;
//        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
//                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
//                ->where('ce_products.publish_status', '=', '1')
//                ->orderBy('ce_products.id', 'asc')
//                ->get();
        $categoryName = 'All Products';
        $featureproducts = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
                ->where('ce_product_categories.status', '=', '1')
                ->where('ce_products.publish_status', '=', '1');

        $table_col = 'ce_products.id';
        $order = 'desc';

        if ($category == 'feature-products') {
            $featureproducts = $featureproducts->where('ce_products.is_featured', '1');
            $categoryName = 'Featured Products';
            $table_col = 'ce_products.featured_sort_order';
            $order = 'asc';
        } else if ($category != 'all') {
            $categoryName = '';
            $featureproducts = $featureproducts->where('ce_product_categories.slug', $category);
        }


        $featureproducts = $featureproducts->orderBy($table_col, $order)->paginate(20);

        if ((count($featureproducts) > 0) && ($categoryName == '')) {
            $categoryName = $featureproducts[0]->cataogyName;
        }

        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '5')->get();
        //print_r($meta);
        MetaTag::set('title', $meta[0]->page_title);
        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);

        $data['content'] = view('web.allmerch', compact('products', 'categories', 'category', 'featureproducts', 'categoryName'));
        return view('layouts.web-template', $data);
    }

    // public function downloadVideo(Request $request) {
    //     try{
    //         $videoObj= new Video();
    //         $video = $videoObj->videoDetail($request->video_id);
    //         $download_type = $request->download_type;
    //         $video_name= $video->video_title.'-'.$download_type.'-'.time();
    //         $pdf = \App::make('dompdf.wrapper');
    //         $pdf->loadHTML($video->$download_type);
    //         return $pdf->download($video_name.'.pdf');
    //     }catch(\Exception $e){
    //         abort(404,'Page not found');
    //     }
    // }

    public function downloadVideo(Request $request) {

        try {
            $videoObj = new Video();
            $video = $videoObj->videoDetail($request->video_id);
            $download_type = $request->download_type;
            $video_name = $video->video_title . '-' . $download_type . '-' . time();

            $body = $video->$download_type;
            PDF::setOptions(['defaultFont' => 'Roboto']);
            $pdf = PDF::loadView('web.video-template', compact('body'));
            return $pdf->download($video_name . '.pdf');
        } catch (\Exception $e) {
            // abort(404, 'Page not found');
            return redirect('/pagenotfound');
        }
    }

    public function contactus() {


        //Social link and donate section page functionality
        $resultsocial = DB::table('ce_socials')
                ->select('*')
                ->whereRaw('id', '1')
                ->get();

        $contact_us = Contact_us::select('*')->first();
        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '8')->get();
        //print_r($meta);
        MetaTag::set('title', $meta[0]->page_title);
        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);
        $data['content'] = view('web.contact-us', compact('contact_us', 'resultsocial'));
        return view('layouts.web-template', $data);
    }

    public function saveContactUs(Request $request) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $data = [
            'secret' => '6LfBP0EaAAAAAIUj1sxak0kXAL4FikeTTpxLM49S',
            'response' => $request->get('recaptcha'),
            'remoteip' => $remoteip
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        if ($resultJson->success != true) {
            return back()->withErrors(['message' => 'ReCaptcha Error']);
        }
        if ($resultJson->score >= 0.3) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);

            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $message = $request->message;

            if (isset($name) && isset($email) && isset($phone) && isset($message)) {

               // $this->mail_service->contactUs($request);
            }
            // $videoTopics = Message::where('name', '=', 'Contact us')->pluck('value');
            $videoTopics = Message::where('id', '=', '2')->where('publish_status', '=', 1)->pluck('value');
            $data['content'] = view('web.contact-us');
            Session::flash('message', $videoTopics[0]);
            return redirect('/contact-us');
            //Validation was successful, add your form submission logic here
//            return back()->with('message', 'Thanks for your message!');
        } else {
            return back()->withErrors(['message' => 'ReCaptcha Error']);
        }
    }

    public function prayer(Request $request) {
        MetaTag::set('title', 'Prayer | Christianity Engaged');
        $data['content'] = view('web.prayer.index');
        return view('layouts.web-template', $data);
    }

    public function newsletter(Request $request) {


        $donationGoal = DonationGoal::where('status', '=', '1')->first();
        $resultsocial = DB::table('ce_socials')
                ->select('*')
                ->whereRaw('id', '1')
                ->get();

        $donationsTotal = 0;
        $goal_amount = 0;
        if ($donationGoal) {
            $goal_id = $donationGoal->id;
            $donationsTotal = Donations::where('goal_id', '=', $goal_id)->where('payment_status', '=', 1)->sum('donation_amount');

            $goal_amount = $donationGoal->goal_amount;
        }

        $goalPercent = 0;
        if ($goal_amount && $donationsTotal) {
            $goalPercent = ($donationsTotal / $goal_amount) * 100;
        }

        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
                ->where('ce_products.publish_status', '=', '1')
                ->where('ce_products.is_featured', '=', '1')
                ->orderBy('ce_products.featured_sort_order', 'asc')
                ->get();

        $videos = Video::join('ce_video_topics', 'ce_video_topics.id', '=', 'ce_videos.topic_id')
                        ->select('ce_videos.*', 'ce_video_topics.video_topic')
                        ->where('ce_videos.publish_status', '=', '1')
                        ->where('ce_video_topics.status', '=', '1')
                        ->where('is_featured', '=', '1')
                        ->orderBy('ce_videos.featured_sort_order', 'ASC')->get();

        $cmsObj = new Cms();


        //echo "<pre>"; print_r($message->all()); exit;

        $leaders = $cmsObj->getLeaders();
        $aboutUsPageSlug = $cmsObj->getSlug(1);
        $videoPageSlug = $cmsObj->getSlug(3);
        $merchPageSlug = $cmsObj->getSlug(5);


        $section2 = $cmsObj->getAboutusAmenities(2);
        $section2Amenities = json_decode($section2->amenity_details);
        $videoDetail = $this->getYoutubevideoDetail($section2Amenities->youtube_url);
        $videoIframe = 'Not Found';
        if ($videoDetail != 'Not Found' && is_object($videoDetail)) {
            $videoIframe = $videoDetail->html;
        }

        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '2')->get();
        //print_r($meta);
        if ($meta[0]->page_title) {
            MetaTag::set('title', $meta[0]->page_title);
        } else {
            MetaTag::set('title', 'Christianity Engaged');
        }

        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);
        $data['content'] = view('web.newsletter', compact('donationGoal', 'products', 'videos', 'about_us_page', 'resultsocial', 'goalPercent', 'videoIframe', 'aboutUsPageSlug', 'videoPageSlug', 'merchPageSlug'));
        return view('layouts.web-template', $data);
    }

}
