<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Donations extends Model {

    protected $table = 'ce_donations';
    public $timestamps = false;
    protected $fillable = [
        'is_recurring', 'zipcode', 'order_number' ,'state', 'country','active_status', 'city', 'address_line_2', 'address_line_1', 'phone', 'donation_date', 'goal_id', 'email', 'first_name', 'last_name', 'donation_amount', 'payment_status'
    ];

    public function getAllDonations($search=null, $goal_id=null) {
        $records_per_page = env('RECORDS_PER_PAGE', 10);
        $db = DB::table('ce_donations')
                ->join('ce_donation_goals','ce_donation_goals.id', '=', 'ce_donations.goal_id')
                ->select('ce_donations.id','is_recurring', 'zipcode', 'state','active_status', 'country', 'city', 'address_line_2', 'address_line_1', 'phone', 'donation_date', 'goal_id', 'email', 'first_name', 'last_name', 'donation_amount', 'payment_status', 'ce_donation_goals.title');

        if($search){
            $db->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        }

        if($goal_id){
            $db->where('goal_id', '=', $goal_id);
        }

        return $db->orderBy('ce_donations.id', 'desc')->paginate($records_per_page);
    }

    public function getAllNoFilterDonations(){
        return DB::table('ce_donations')
                ->join('ce_donation_goals','ce_donation_goals.id', '=', 'ce_donations.goal_id')
                ->select('ce_donations.id','is_recurring', 'zipcode', 'state', 'country', 'city', 'address_line_2', 'address_line_1', 'phone', 'donation_date', 'goal_id', 'email', 'first_name', 'last_name', 'donation_amount', 'payment_status', 'ce_donation_goals.title')->get();

    }

    public function getAllFilterDonations($search=null, $goal_id=null){
          $db = DB::table('ce_donations')
                ->join('ce_donation_goals','ce_donation_goals.id', '=', 'ce_donations.goal_id')
                ->select('ce_donations.id','is_recurring', 'zipcode', 'state', 'country', 'city', 'address_line_2', 'address_line_1', 'phone', 'donation_date', 'goal_id', 'email', 'first_name', 'last_name', 'donation_amount', 'payment_status', 'ce_donation_goals.title');

        if($search){
            $db->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        }

        if($goal_id){
            $db->where('goal_id', '=', $goal_id);
        }

        return $db->orderBy('ce_donations.id', 'desc')->get();

    }


    public function getDonationDetails($id) {
        return DB::table('ce_donations')
                ->leftJoin('ce_donation_transactions','ce_donation_transactions.doantions_id', '=', 'ce_donations.id')
                ->join('ce_donation_goals','ce_donation_goals.id', '=', 'ce_donations.goal_id')
                ->where('ce_donations.id', '=', $id)->first();
    }

    public function getRecurringDonationDetails($id) {
        return DB::table('ce_donation_transactions')
                ->leftJoin('ce_donations','ce_donation_transactions.doantions_id', '=', 'ce_donations.id')
                ->where('ce_donations.id', '=', $id)->get();
    }
public function getCountryName($id) {
        return DB::table('ce_country')
                ->where('id', '=', $id)->first();
    }

}
