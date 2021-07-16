<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Response;
use App\Excel; 
use Mail;



class NewsletterController extends Controller {

    public function listing(Request $request) {
        if(!empty($_GET['code']) && isset($_GET['code']))
        {
            $signature=urldecode($_GET['code']);

             DB::table('ce_newsletter')
            ->where('signature', $signature)
            ->update(array('status' => 1));
            $datas = 'Thanks for subscription';
       }
        $records_per_page = env('RECORDS_PER_PAGE', 10);
        $newsletters = Newsletter::orderBy('id', 'desc')->paginate($records_per_page);

        $page = $request->query('page');
        $data['content'] = view('admin.Newsletter.listing', compact('newsletters', 'page','datas'));
        return view('layouts.template', $data);
    }

    public function subscribe(Request $request) {
        //echo "<pre>"; print_r($request); exit;
        $status = $request->id; 
        $records_per_page = env('RECORDS_PER_PAGE', 10);
        $newsletters = Newsletter::orderBy('id', 'desc')->where('status',$status)->paginate($records_per_page);
        $page = $request->query('page');
        $data['content'] = view('admin.Newsletter.listing', compact('newsletters', 'page','status'));
        return view('layouts.template', $data);
    }

     public function filterbydate(Request $request) {

     	$status = $request->status;
     	$fromDate =  date($request->fromDate); 
     	$toDate =date($request->toDate); 
 
        $records_per_page = env('RECORDS_PER_PAGE', 10);
        //DB::enableQueryLog();
        $newsletters = Newsletter::orderBy('id', 'desc')->where('status',$status)->whereBetween('created_at',[$fromDate,$toDate])->paginate($records_per_page);
        
        //dd(DB::getQueryLog());
        
        $page = $request->query('page');

        $data['content'] = view('admin.Newsletter.listing', compact('newsletters', 'page','status','fromDate','toDate'));
        return view('layouts.template', $data);
    }

     public function export(Request $request) {
        
        $status = $request->status;
     	$fromDate =  date($request->fromDate);
     	$toDate =date($request->toDate);  
         $newsletters = Newsletter::select('*')->orderBy('id', 'asc');
         if($status != 0){
         	$newsletters =  $newsletters->where('status',$status);
         }
        if($fromDate != '' && $toDate != ''){
         $newsletters = $newsletters->whereBetween('created_at',[$fromDate,$toDate]);
         }
         $newsletters = $newsletters->get();

     function xlsBOF() {
	echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
   }
  function xlsEOF() {
	 echo pack("ss", 0x0A, 0x00);
  }
function xlsWriteNumber($Row, $Col, $Value) {
	echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
	echo pack("d", $Value);
}
function xlsWriteLabel($Row, $Col, $Value) {
	$L = strlen($Value);
	echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
	echo $Value;
} 
// prepare headers information
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"Newsletters".date("Y-m-d").".xls\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
// start exporting
xlsBOF();
// first row 
xlsWriteLabel(0, 0, "id");
xlsWriteLabel(0, 1, "Email");
xlsWriteLabel(0, 2, "Created At");
xlsWriteLabel(0, 3, "Status");

// second row 
$i = 1;
foreach ($newsletters as $key) {

	if($key->status == 1){
		$status ="subscribe";
	}else{
        $status ="Un Subscribe";
	}
xlsWriteNumber($i,0, $key->id);
xlsWriteLabel($i, 1, $key->email);
xlsWriteLabel($i, 2, $key->created_at);
xlsWriteLabel($i, 3, $status);

++$i;
  }
xlsEOF(); 

    }
   

 public function exportnews(Request $request) {
    
    try {
            
        $check = DB::table('ce_newsletter')->insertGetId(array(
                                                'email'      => $request->email,
                                                'status'     => '2',
                                                'signature'      =>now(),
                                                'created_at'=>now(),
                                                'updated_at'=>now()
                                                        ));
        $user = Newsletter::find($check);
        if($user->signature){
        $data=array('to_email'=>$request->email,'name'=>'User','subject'=>'Subscribe by User','signature'=>$user->signature);
            Mail::send('admin.Newsletter.mail', $data, function($msg) use($data) {
                $msg->from(env('MAIL_USERNAME'), env('MAIL_NAME'));
                $msg->to($data['to_email'], $data['name'])->subject($data['subject']);
            });
          
         return redirect()->back()->with('message', 'Please check your email.');

           
        }} catch (Exception $e) {
            print_r($e->getMessage());

            die;
        }
    
    }
}