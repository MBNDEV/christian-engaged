<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonationGoal;
use App\Donations;
use DB;

class DonationController extends Controller {

    public function goalListing(Request $request) {
        $goals = DonationGoal::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $data['content'] = view('admin.donation.goallisting', compact('goals'));
        return view('layouts.template', $data);
    }

    public function addgoal(Request $request) {
        $data['content'] = view('admin.donation.addgoal');
        return view('layouts.template', $data);
    }

    public function savegoal(Request $request) {

        $messages = [
            'regex' => 'Only numbers having upto 15 digits and 2 decimal places are allowed',

        ];

        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
            'goal_amount' => 'required|regex:/^(\b\d{1,15})*(\.[0-9][0-9]?)?$/',
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:min_width=1000,min_height=563',
        ], $messages);

        $image = $request->file('background_image');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/donation_goal_images');
        $image->move($destinationPath, $imagename);

        $savedata=$request->all();
        $savedata['background_image'] = $imagename;

        $goal = DonationGoal::create($savedata);

        if($goal->status==1)
            DonationGoal::where('id', '!=', $goal->id)->where('status', '=','1')->update(['status'=>2]);

        if ($goal->id) {
            return redirect('/manage/donation-goals')->withSuccess('Donation Goal added Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function editgoal(Request $request, $id) {
        $goal = DonationGoal::find($id);
        $data['content'] = view('admin.donation.editgoal', compact('goal'));
        return view('layouts.template', $data);
    }

    public function updategoal(Request $request, $id) {


        if($request->backgroundImageStatus == 1){

            $this->validate($request, [
                'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $image = $request->file('background_image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/donation_goal_images');
            $image->move($destinationPath, $imagename);
            $savedata=$request->except(['_token','backgroundImageStatus']);
            $savedata['background_image'] = $imagename;
       }

        $messages = [
            'regex' => 'Only numbers having upto 2 decimal places are allowed',
        ];

        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
            'goal_amount' => 'required|regex:/^(\b\d{1,15})*(\.[0-9][0-9]?)?$/'
        ], $messages);

        if($request->backgroundImageStatus != 1)
        {
            $savedata=$request->except(['_token','backgroundImageStatus']);
        }

        $active_status = DonationGoal::select('*')->where('status', 1)->count();
         //echo "<pre>"; print_r($active_status); exit;
         if($active_status == 1 && $request->status != 1){
            return redirect()->back()
                        ->withInput()
                        ->withErrors('Kindly activate atliest One Goal');

         }
        $update = DonationGoal::where('id', $id)->update($savedata);

        if($request->status==1)
            DonationGoal::where('id', '!=', $id)->where('status', '=', 1)->update(['status'=>2]);

        if ($update) {
            return redirect('/manage/donation-goals')->withSuccess('Donation Goal Updated Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function deletegoal(Request $request, $id) {

        $totalCountStatus = DonationGoal::where('status','=','1')->count('id');
        $videotopic = DonationGoal::find($id);

        if($videotopic->status==1 && $totalCountStatus==1){

           return redirect()->back()
                        ->withInput()
                        ->withErrors('Kindly activate atleast one goal!');

        }
        //echo "<pre>"; print_r($videotopic->status); exit;


        $videotopic = DonationGoal::find($id);
        $videotopic->status = '3';

        if ($videotopic->save()) {
            return redirect('/manage/donation-goals')->withSuccess('Donation Goal Deleted Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function closemonthlyrecurring(Request $request){
        if(!isset($request->donation_id) || $request->donation_id == ""){
            return redirect('/manage/donations')->withErrors('Invalid Id pass!');
        }
        $donation = Donations::where('id',$request->donation_id)->where('is_recurring',1)->first();
//        if(count($donation) <=0){
        if(!isset($donation->id)){
            return redirect('/manage/donations')->withErrors('Invalid monthly donation detail!');
        }

        $update = Donations::where('id',"=",$request->donation_id)->where('is_recurring',"=",1)->update(['active_status'=>0]);

        if ($update) {
            return redirect('/manage/donations')->withSuccess('Monthly Donation Cancelled Successfully!');
        }
    }

    public function donationlisting(Request $request) {
        $donationObj = new Donations();

        $search = $request->query('search');
        $goal_id = $request->query('goal_id');

        $donations = $donationObj->getAllDonations($search, $goal_id);

        $page = $request->query('page');

        $goals = DonationGoal::orderBy('id', 'desc')->get();

        $data['content'] = view('admin.donation.donationlisting', compact('goals','donations', 'page', 'search', 'goal_id'));
        return view('layouts.template', $data);
    }


 public function donationexport(Request $request) {
            $search = $request->query('search');
        $goal_id = $request->query('goal_id');
       $donationObj = new Donations();
     if($request->goal_id !='' || $request->search !=''){

$allDonations = $donationObj->getAllFilterDonations($request->search, $request->goal_id);
     }else{

$allDonations =  $donationObj->getAllNoFilterDonations();
     }

         //$allDonations= DB::table('ce_donations')
               // ->join('ce_donation_goals','ce_donation_goals.id', '=', 'ce_donations.goal_id')
                //->select('ce_donations.id','is_recurring', 'zipcode', 'state', 'country', 'city', 'address_line_2', 'address_line_1', 'phone', 'donation_date', 'goal_id', 'email', 'first_name', 'last_name', 'donation_amount', 'payment_status', 'ce_donation_goals.title');
               // print_r($allDonations);


      // die('hii');
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
header("Content-Disposition: attachment; filename=\"Donations".date("Y-m-d").".xls\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
// start exporting
xlsBOF();
// first row
xlsWriteLabel(0, 0, "First Name");
xlsWriteLabel(0, 1, "Last Name ");
xlsWriteLabel(0, 2, "Email");
xlsWriteLabel(0, 3, "Donation Date");
xlsWriteLabel(0, 4, "#Goal");
xlsWriteLabel(0, 5, "Amount");
xlsWriteLabel(0, 6, "Payment Status");
xlsWriteLabel(0, 7, "Donation Type");
// second row
$i = 1;
foreach ($allDonations as $key) {


     if ($key->payment_status == 0){
                 $status="Pending";
             }
       elseif ($key->payment_status == 1){
                  $status="Paid";
              }
        elseif ($key->payment_status == 2){
                 $status="Error";
        }

         if ($key->is_recurring == 1){
                  $type="Monthly"; }
           else{
                    $type="Onetime";
           }

xlsWriteLabel($i, 0, $key->first_name);
xlsWriteLabel($i, 1, $key->last_name);
xlsWriteLabel($i, 2, $key->email);
xlsWriteLabel($i, 3, $key->donation_date);
xlsWriteLabel($i, 4, $key->title);
xlsWriteLabel($i, 5, $key->donation_amount);
xlsWriteLabel($i, 6, $status);
xlsWriteLabel($i, 7, $type);
++$i;
  }
xlsEOF();

    }

    public function donationdetail(Request $request) {
        $donationObj = new Donations();
        $donationdetails=array();
        $id = $request->query('donation_id');
        $is_recurring = $request->query('is_recurring');

        $transactions='';
        if($is_recurring){
            $transactions = $donationObj->getRecurringDonationDetails($id);
            foreach ($transactions as $value) {
                $donationdetails = $value;
                 $countrydetails= $donationObj->getCountryName($donationdetails->country);
                 break;
            }
        }else{
            $donationdetails = $donationObj->getDonationDetails($id);
            $countrydetails = $donationObj->getCountryName($donationdetails->country);
        }

        return view('admin.donation.donationdetail', compact('donationdetails', 'is_recurring', 'transactions','countrydetails'));
    }

}
