<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Orders extends Model {

    protected $table = 'ce_orders';
    protected $fillable = [
        'order_date', 'email', 'first_name','order_number' ,'last_name', 'order_amount','shipping_amount', 'billing_address_id', 'shipping_address_id', 'order_status', 'payment_status'
    ];    
    
    public function getAllOrders($search=null, $start_date=null, $end_date=null) {
        $records_per_page = env('RECORDS_PER_PAGE', 10);
        $db = DB::table('ce_orders');
        
        if($start_date && $end_date){
            $start_date = date('Y-m-d H:i', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date)).' 23:59';
            $db->whereBetween('order_date', array($start_date, $end_date));                
        }
        
        if($search){
            $db->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');                
        }
        $db->where('payment_status', '!=', 0); // show only those payment is not pending
                
        return $db->orderBy('id', 'desc')->paginate($records_per_page);
    }
    
    public function getOrderDetails($id) {
        return DB::table('ce_orders')
                ->leftJoin('ce_transactions','ce_transactions.order_id', '=', 'ce_orders.id')
                ->join('ce_address_details as ca1','ce_orders.billing_address_id', '=', 'ca1.id')
                ->join('ce_address_details as ca2','ce_orders.shipping_address_id', '=', 'ca2.id')
                ->join('ce_country as c1','c1.id', '=', 'ca1.country_id')
                ->join('ce_country as c2','c2.id', '=', 'ca2.country_id')
                ->select('ce_orders.first_name as fname', 'ce_orders.order_number as order_number', 'ce_orders.last_name as lname','ce_orders.*', 'ca1.*','ce_transactions.*','c1.country_code as billing_country_code', 'c2.country_code as shipping_country_code', 'ca2.first_name as shipping_fname', 'ca2.last_name as shipping_lname','ca1.first_name as billing_fname', 'ca1.last_name as billing_lname','c1.country_name as billing_country', 'c2.country_name as shipping_country', 'ca2.address_line_1 as ship_address_line_1', 'ca2.address_line_2 as ship_address_line_2', 'ca2.city as ship_city', 'ca2.state as ship_state', 'ca2.zipcode as ship_zipcode', 'ca2.telephone as ship_telephone')
                ->where('ce_orders.id', '=', $id)->first();
    }
    
     public function getExportOrderDetails($search=null, $start_date=null, $end_date=null) {
      
            $db =  DB::table('ce_orders')
                ->leftJoin('ce_transactions','ce_transactions.order_id', '=', 'ce_orders.id')
                ->join('ce_address_details as ca1','ce_orders.billing_address_id', '=', 'ca1.id')
                ->join('ce_address_details as ca2','ce_orders.shipping_address_id', '=', 'ca2.id')
                ->join('ce_country as c1','c1.id', '=', 'ca1.country_id')
                ->join('ce_country as c2','c2.id', '=', 'ca2.country_id')
                ->select('ce_orders.*','ca1.*','ce_transactions.*','c1.country_code as billing_country_code', 'c2.country_code as shipping_country_code','ce_orders.first_name','ce_orders.last_name', 'ca2.first_name as shipping_fname', 'ca2.last_name as shipping_lname','ca1.first_name as billing_fname', 'ca1.last_name as billing_lname','c1.country_name as billing_country', 'c2.country_name as shipping_country', 'ca2.address_line_1 as ship_address_line_1', 'ca2.address_line_2 as ship_address_line_2', 'ca2.city as ship_city', 'ca2.state as ship_state', 'ca2.zipcode as ship_zipcode', 'ca2.telephone as ship_telephone');
                 
                 if($start_date && $end_date){
            $start_date = date('Y-m-d H:i', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date)).' 23:59';
            $db->whereBetween('ce_orders.order_date', array($start_date, $end_date));                
        }
        
        if($search){
            $db->where('ce_orders.first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('ce_orders.last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('ce_orders.email', 'LIKE', '%' . $search . '%');                
        }
             $db->where('ce_orders.payment_status', '!=', 0); // show only those payment is not pending             
        return $db->orderBy('ce_orders.id', 'desc')->get();
        
        
    }


    public function getExportAllOrderDetails(){
         return DB::table('ce_orders')
                ->leftJoin('ce_transactions','ce_transactions.order_id', '=', 'ce_orders.id')
                ->join('ce_address_details as ca1','ce_orders.billing_address_id', '=', 'ca1.id')
                ->join('ce_address_details as ca2','ce_orders.shipping_address_id', '=', 'ca2.id')
                ->join('ce_country as c1','c1.id', '=', 'ca1.country_id')
                ->join('ce_country as c2','c2.id', '=', 'ca2.country_id')
                ->select('ce_orders.*','ca1.*','ce_transactions.*','c1.country_code as billing_country_code', 'c2.country_code as shipping_country_code','ce_orders.first_name','ce_orders.last_name', 'ca2.first_name as shipping_fname', 'ca2.last_name as shipping_lname','ca1.first_name as billing_fname', 'ca1.last_name as billing_lname','c1.country_name as billing_country', 'c2.country_name as shipping_country', 'ca2.address_line_1 as ship_address_line_1', 'ca2.address_line_2 as ship_address_line_2', 'ca2.city as ship_city', 'ca2.state as ship_state', 'ca2.zipcode as ship_zipcode', 'ca2.telephone as ship_telephone')
                ->where('ce_orders.payment_status', '!=', 0)
                ->orderBy('ce_orders.id', 'desc')->get();
    }

    public function getOrderItems($id) {
        return DB::table('ce_orders')
                ->join('ce_order_details','ce_order_details.order_id', '=', 'ce_orders.id')
                ->join('ce_products','ce_order_details.product_id', '=', 'ce_products.id')
                ->where('ce_orders.id', '=', $id)->get();  
    }
    
    public function updateorderstatus($order_id, $order_status) {
        return DB::table('ce_orders')
            ->where('id', $order_id)
            ->update(['order_status' => $order_status]);
    }
    
}
