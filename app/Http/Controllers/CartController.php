<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Country;
use App\Cms;
use App\AddressDetails;
use App\Orders;
use App\DonationGoal;
use App\Orderdetails;
use App\ProductsSize;
use Illuminate\Support\Facades\Crypt;
use Stripe\Stripe;
use App\Transaction;
use App\Donations;
use App\DonationTransactions;
use App\MailService;
use App\Message;
use App\Setting;
use PDF;
use Storage;
use App\Template;
use App;
use App\Product;
use MetaTag;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller {

    private $skey, $pkey;
    protected $mail_service;

    public function __construct() {
        $environment = env('APP_ENV');
        if ($environment == 'local' || $environment == 'staging') {
            $this->skey = env('STRIPE_TEST_SK');
            $this->pkey = env('STRIPE_TEST_PK');
        } else {
            $this->skey = env('STRIPE_LIVE_SK');
            $this->pkey = env('STRIPE_LIVE_PK');
        }

        \Stripe\Stripe::setApiKey($this->skey);
        //\Stripe\Stripe::setApiKey("sk_test_5IRMCnro5MAOvxX4lDqElgHl");
        $this->mail_service = new MailService();
    }

    public function cart() {
        //$meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '9')->get();
        //print_r($meta);
        MetaTag::set('title', "Shopping Cart | Christianity Engaged");
        //MetaTag::set('description', $meta[0]->meta_description);
        //MetaTag::set('keywords', $meta[0]->meta_keyword);
        $shipping = Setting::select('start_range','end_range','cost')->get();
        $data['content'] = view('web.cart', compact('shipping'));
        return view('layouts.web-template', $data);
    }

    public function checkout() {
        MetaTag::set('title', "Secure Transaction | Christianity Engaged");
        $countryList = Country::where('status_id', '=', 1)->get();
        $shipping = Setting::select('start_range','end_range','cost')->get();

        $data['content'] = view('web.checkout', compact('countryList','shipping'));
        return view('layouts.web-template', $data);
    }

    private function setOrderNumber() {
        $date = date("m-d-y");
        $orderNumber = 'CE' . str_replace("-", "", $date);
        $lastOrder = Orders::where('payment_status', '!=', 0)->whereDate('order_date', '=', date('Y-m-d'))->orderBy('id', 'DESC')->get();
        $newOrder = count($lastOrder) + 1;
        // $lenght = 5 - strlen($newOrder);
        $newOrderWithPadd = str_pad($newOrder, 5, '0', STR_PAD_LEFT);
        $orderNumber = $orderNumber . $newOrderWithPadd;
        return $orderNumber;
    }

    public function placeorder(Request $request) {

        $rules = ['first_name' => 'required|max:190',
            'last_name' => 'required|max:190',
            'email' => 'required|email|max:190',
            'billing_first_name' => 'required|max:190',
            'billing_last_name' => 'required|max:190',
            'billing_address_line_1' => 'required',
            //'billing_address_line_2' => 'required',
            'billing_country_id' => 'required',
            'billing_city' => 'required|max:190',
            'billing_state' => 'required|max:190',
            'billing_zip_code' => 'required|max:10',
            'billing_telephone' => 'required|max:15'
        ];

        if ($request->same_billing_address) {
            $rules['shiping_first_name'] = 'required|max:190';
            $rules['shiping_last_name'] = 'required|max:190';
            $rules['shiping_address_line_1'] = 'required';
            //$rules['shiping_address_line_2'] = 'required';
            $rules['shiping_country_id'] = 'required';
            $rules['shiping_city'] = 'required||max:190';
            $rules['shiping_state'] = 'required||max:190';
            $rules['shiping_zip_code'] = 'required|max:10';
            $rules['shiping_telephone'] = 'required|max:15';
        }

        $this->validate($request, $rules);

        try {

            /** Order Start */
            $order = [];

            /** Billing Address Start */
            $billingAddress = [];
            $billingAddress['first_name'] = $request->billing_first_name;
            $billingAddress['last_name'] = $request->billing_last_name;
            $billingAddress['address_line_1'] = $request->billing_address_line_1;
            $billingAddress['address_line_2'] = $request->billing_address_line_2;
            $billingAddress['country_id'] = $request->billing_country_id;
            $billingAddress['city'] = $request->billing_city;
            $billingAddress['state'] = $request->billing_state;
            $billingAddress['zipcode'] = $request->billing_zip_code;
            $billingAddress['telephone'] = $request->billing_telephone;

            $billingAddressResult = AddressDetails::create($billingAddress);
            $billingAddressId = $billingAddressResult->id;
            /** Billing Address End */
            /** Shipping Address Start */
            if ($request->same_billing_address) {              //Ship to a different address
                $shippingAddress = [];
                $shippingAddress['first_name'] = $request->shiping_first_name;
                $shippingAddress['last_name'] = $request->shiping_last_name;
                $shippingAddress['address_line_1'] = $request->shiping_address_line_1;
                $shippingAddress['address_line_2'] = $request->shiping_address_line_2;
                $shippingAddress['country_id'] = $request->shiping_country_id;
                $shippingAddress['city'] = $request->shiping_city;
                $shippingAddress['state'] = $request->shiping_state;
                $shippingAddress['zipcode'] = $request->shiping_zip_code;
                $shippingAddress['telephone'] = $request->shiping_telephone;

                $shippingAddressResult = AddressDetails::create($shippingAddress);
                $shippingAddressId = $shippingAddressResult->id;
            } else {
                $shippingAddressId = $billingAddressId;
            }
            /** Shipping Address End */
            $order['order_date'] = date('Y-m-d H:i:s');
            $order['email'] = $request->email;
            $order['first_name'] = $request->first_name;
            $order['last_name'] = $request->last_name;
            $order['order_amount'] = $request->order_amount;
            $order['shipping_amount'] = $request->shipping_amount;
            $order['billing_address_id'] = $billingAddressId;
            $order['shipping_address_id'] = $shippingAddressId;

            $order['order_status'] = 0;   //Default order status : Unpaid
            $order['payment_status'] = 0;   //Default payment status : pending



            $orderResult = Orders::create($order);

            $order_id = $orderResult->id;

            /** Order End */
            /** Order Details Start */
            $products = json_decode($request->products);
            $orderDetails = [];
            $orderDetails['order_id'] = $order_id;
            foreach ($products as $product) {

                $orderDetails['product_id'] = $product->product_id;
                $orderDetails['product_sku'] = $product->product_sku;
                $orderDetails['quantity'] = $product->quantity;
                $orderDetails['sale_price'] = $product->sale_price;

                Orderdetails::create($orderDetails);
            }
            /** Order Details End */
            return json_encode(['order_id' => $order_id]);

            // return redirect('payment/make-payment/'.Crypt::encryptString($order_id));
        } catch (Exception $e) {
            //print_r($e);
            return redirect()->back()
                            ->with('error', ['Some error occured. Please try after some time.']);
        }

        return redirect()->back()
                        ->withInput();
    }

    //public function payment(Request $request, $encrypted) {
//    public function payment(Request $request, $encrypted) {
//        $order = '';
//        try {
//            $order_id = Crypt::decryptString($encrypted);
//
//            $order = Orders::where('payment_status', '!=', 1)->where('id', '=', $order_id)->first();
//
//            if (!$order) {
//                return redirect('/checkout')->with('error', ['Payment already made for this order!']);
//            }
//        } catch (Exception $e) {
//            \Session::flash('error', 'Some error occured while processing your payment.');
//        }
//
//        $data['content'] = view('web.payment', compact('order', 'encrypted'));
//        return view('layouts.web-template', $data);
//    }

    public function makepayment(Request $request) {

        $payment_name = "Order";
        $source = $request->stp_token;
        $order_id = $request->reference_id;
//        if (isset($encrypted)) {
//            $request->session()->put('encrypted_orderId', $encrypted);
//        } else {
//            $encrypted_orderId = $request->session()->get('encrypted_orderId');
//            return redirect('payment/make-payment/' . $encrypted_orderId);
//        }
        //$order_id = Crypt::decryptString($encrypted);
        $order = Orders::where('payment_status', '!=', 1)->where('id', '=', $order_id)->first();

        if (!$order) {
            \Session::flash('error', 'Payment already made for this order!');
            return redirect('payment/make-payment/' . $encrypted);
        }
        $order->order_number = $this->setOrderNumber(); // update order number after payment

        $temp_order_id = $order_id;
        $amount = floatval($order->order_amount+$order->shipping_amount) * 100;
        $description = 'Payment for ORDER ID:' . $order->id;
        $metadata = ['transaction_made_for' => 'product'];

        $error = 0;
        $message = '';
        try {
            $charge = \Stripe\Charge::create(['amount' => $amount,
                        'currency' => 'usd',
                        'source' => $source,
                        'description' => $description,
                        // 'receipt_email' => $order->email,
                        'statement_descriptor' => 'Paid on Christianity',
                        'metadata' => $metadata
                            ]
            );
            //echo $charge;
            $charge->jsonSerialize();

            $charge_id = $charge['id'];

            if ($charge['status'] == 'succeeded' && $charge['paid']) {
                $order->order_status = 1;       //Set order status to pending
                $order->payment_status = 1;     //Set order's status to paid

                $order->save();

                $transactionDetails = [];
                $transactionDetails['order_id'] = $order_id;
                $transactionDetails['txn_id'] = $charge['id'];
                $transactionDetails['txn_amount'] = $charge['amount'];
                $transactionDetails['currency'] = $charge['currency'];
                $transactionDetails['txn_status'] = $charge['status'];
                $transactionDetails['payment_source_id'] = $charge['source']['id'];
                $transactionDetails['payment_object'] = $charge['source']['object'];
                $transactionDetails['payment_brand'] = $charge['source']['brand'];
                $transactionDetails['payment_last4'] = $charge['source']['last4'];
                $transactionDetails['cvc_check'] = $charge['source']['cvc_check'];
                $transactionDetails['address_zip_check'] = $charge['source']['address_zip_check'];
                $transactionDetails['failure_code'] = $charge['failure_code'];
                $transactionDetails['failure_message'] = $charge['failure_message'];

                Transaction::create($transactionDetails);

                //dynamic messages
                $dyanamicMessage = '';
                $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',5)->get();
                // Payment Successful
                // foreach ($videoTopics as $key => $value) {
                //     // if($value->name =='Payment Successful'){
                //     if ($value->id == '5') {
                //         $dyanamicMessage = $value->value;
                //     }
                // }
                $dyanamicMessage = $videoTopics[0]->value;
                // $message = $message;
                $message = $dyanamicMessage;
            } else {

                // Payment Not done
                // foreach ($videoTopics as $key => $value) {
                //     //if($value->name =='Payment Not done'){
                //     if ($value->id == '6') {
                //         $dyanamicMessage = $value->value;
                //     }
                // }
                $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',6)->get();
                $dyanamicMessage = $videoTopics[0]->value;

                $message = $dyanamicMessage;
                $error = 1;
                $order->payment_status = 2;     //Payment error
                $order->save();
                $error_msg = "";
                if(isset($charge['failure_message'])){
                    $error_msg = $charge['failure_message'];
                }
                $this->getpaymentfaileddetail($temp_order_id,$dyanamicMessage,$error_msg);

                $orderdetails = '';
                $orderItems = '';
                $size_list_array = array();
                $sizetableshow = '';

                $data['orderdetails'] = $orderdetails;
                $data['orderItems'] = $orderItems;

                $data['content'] = view('web.order-invoice', compact('message', 'error', 'orderdetails', 'orderItems','size_list_array','sizetableshow'))->render();
                // $html =  view('layouts.web-template', $data);
                return json_encode(['html' => $data['content'],'status'=>$error]);


            }
        } catch (\Stripe\Error\Card $e) {
            $order->payment_status = 2;     //Payment error
            $order->save();
            // Payment Unsuccessful
            // foreach ($videoTopics as $key => $value) {
            //     // if($value->name =='Payment Unsuccessful'){
            //     if ($value->id == '7') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }
            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',7)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $error = 1;

            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $this->getpaymentfaileddetail($temp_order_id,$dyanamicMessage,$e->getMessage());


            $orderdetails = '';
            $orderItems = '';
            $size_list_array = array();
            $sizetableshow = '';

            $data['orderdetails'] = $orderdetails;
            $data['orderItems'] = $orderItems;

            $data['content'] = view('web.order-invoice', compact('message', 'error', 'orderdetails', 'orderItems','size_list_array','sizetableshow'))->render();
            // $html =  view('layouts.web-template', $data);
            return json_encode(['html' => $data['content'],'status'=>$error]);

            //$e_json = $e->getJsonBody();
            //$error = $e_json['error'];
            //print_r($error);
        } catch (\Stripe\Error\ApiConnection $e) {
            $order->payment_status = 2;     //Payment error
            $order->save();
            // Network problem
            // foreach ($videoTopics as $key => $value) {
            //     // if($value->name =='Network problem'){
            //     if ($value->id == '8') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }
            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',8)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $error = 1;
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $this->getpaymentfaileddetail($temp_order_id,$dyanamicMessage,$e->getMessage());

            $orderdetails = '';
            $orderItems = '';
            $size_list_array = array();
            $sizetableshow = '';

            $data['orderdetails'] = $orderdetails;
            $data['orderItems'] = $orderItems;

            $data['content'] = view('web.order-invoice', compact('message', 'error', 'orderdetails', 'orderItems','size_list_array','sizetableshow'))->render();
            // $html =  view('layouts.web-template', $data);
            return json_encode(['html' => $data['content'],'status'=>$error]);

            //$e_json = $e->getJsonBody();
            //$error = $e_json['error'];
            //print_r($error);
        } catch (\Stripe\Error\InvalidRequest $e) {
            $order->payment_status = 2;     //Payment error
            $order->save();
            // Invalid Request
            // foreach ($videoTopics as $key => $value) {
            //     // if($value->name =='Invalid Request'){
            //     if ($value->id == '9') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }
            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',7)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $error = 1;
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $this->getpaymentfaileddetail($temp_order_id,$dyanamicMessage,$e->getMessage());

            // $e_json = $e->getJsonBody();
            // $error = $e_json['error'];
            // print_r($error);

            $orderdetails = '';
            $orderItems = '';
            $size_list_array = array();
            $sizetableshow = '';

            $data['orderdetails'] = $orderdetails;
            $data['orderItems'] = $orderItems;

            $data['content'] = view('web.order-invoice', compact('message', 'error', 'orderdetails', 'orderItems','size_list_array','sizetableshow'))->render();
            // $html =  view('layouts.web-template', $data);
            return json_encode(['html' => $data['content'],'status'=>$error]);

        } catch (\Stripe\Error\Api $e) {
            $order->payment_status = 2;     //Payment error
            $order->save();
            //Stripes down
            // foreach ($videoTopics as $key => $value) {
            //     //if($value->name =='Stripes down'){
            //     if ($value->id == '10') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }

            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',10)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $error = 1;
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $this->getpaymentfaileddetail($temp_order_id,$dyanamicMessage,$e->getMessage());


            $orderdetails = '';
            $orderItems = '';
            $size_list_array = array();
            $sizetableshow = '';

            $data['orderdetails'] = $orderdetails;
            $data['orderItems'] = $orderItems;

            $data['content'] = view('web.order-invoice', compact('message', 'error', 'orderdetails', 'orderItems','size_list_array','sizetableshow'))->render();
            // $html =  view('layouts.web-template', $data);
            return json_encode(['html' => $data['content'],'status'=>$error]);

            // $e_json = $e->getJsonBody();
            // $error = $e_json['error'];
            // print_r($error);
        } catch (\Stripe\Error\Card $e) {
            $order->payment_status = 2;     //Payment error
            $order->save();
            // Payment Unsuccessful
            // foreach ($videoTopics as $key => $value) {
            //     // if($value->name =='Payment Unsuccessful'){
            //     if ($value->id == '7') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }

            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',7)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $error = 1;
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $this->getpaymentfaileddetail($temp_order_id,$dyanamicMessage,$e->getMessage());


            $orderdetails = '';
            $orderItems = '';
            $size_list_array = array();
            $sizetableshow = '';

            $data['orderdetails'] = $orderdetails;
            $data['orderItems'] = $orderItems;

            $data['content'] = view('web.order-invoice', compact('message', 'error', 'orderdetails', 'orderItems','size_list_array','sizetableshow'))->render();
            // $html =  view('layouts.web-template', $data);
            return json_encode(['html' => $data['content'],'status'=>$error]);

            //$e_json = $e->getJsonBody();
            //$error = $e_json['error'];
            //print_r($error);
        }

        $orderObj = new Orders();

        $orderdetails = $orderObj->getOrderDetails($order_id);

        $orderItems = $orderObj->getOrderItems($order_id);
        $size_list_array = array();
        $sizetableshow = false;
        if ($error == 0) {
            foreach ($orderItems as $key => $value) {
               $size = '';
               $productsize = ProductsSize::where('sku', '=', $value->product_sku)->get();
               if(count($productsize)){
                  $size = $productsize[0]->size;
                  $sizetableshow = true;
               }
               $size_list_array[$value->product_sku] = $size;
            }

            $data['orderdetails'] = $orderdetails;
            $data['orderItems'] = $orderItems;


            $product_all_detail = '';


            foreach ($data['orderItems'] as $key => $value) {

                $imageUrl = Product::where('id', '=', $value->product_id)->pluck('product_image');
                $imageURL = 'uploads/productimages/thumbs/thumb-' . $imageUrl[0];
                //echo "<pre>"; print_r('uploads/videoimages/'.$imageUrl[0]); exit;
                $product_datas = '';
                $size_blank = '-';
                if($size_list_array[$value->product_sku] != '')
                    $size_blank = ucfirst($size_list_array[$value->product_sku]);
                $product_datas = '<tr>

                        <td style="vertical-align:center; font-size: 14px;text-align:center;"><img width="100px" src="'.env('APP_URL') . $imageURL . '" /></td>
                        <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->product_name . '</td>
                        <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $size_blank . '</td>
                        <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->quantity . '</td>
                        <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->price . '</td>

                </tr>';

                //$text_admin = ["{{imageurl}}","{{product_name}}", "{{prize}}", "{{quantity}}"];
                //$rpc_admin   = [$imageURL,$value->product_name,$value->price,$value->quantity];
                // $mailbody=str_replace($text_admin,$rpc_admin,$product_details);
                $product_all_detail .= $product_datas;
            }


            $order_template = Template::where('id', '=', '7')->first();
            $today = date("F j, Y");
            // echo "<pre>"; print_r($today); exit;
            $shipping = $data['orderdetails']->shipping_amount;
            $total = $data['orderdetails']->order_amount + $shipping;

            $text_admin = ["{{user_name}}", "{{email}}", "{{total}}", "{{amount}}", "{{shipping}}", "{{blng_phone}}", "{{ship_phone}}", "{{ship_user_name}}", "{{address_line_1}}", "{{address_line_2}}", "{{address_line_3}}", "{{product_details}}", "{{order_id}}", "{{date}}"];

            $rpc_admin = [$data['orderdetails']->fname . ' ' . $data['orderdetails']->lname, $data['orderdetails']->email, $total , $data['orderdetails']->order_amount, $shipping, $data['orderdetails']->telephone, $data['orderdetails']->ship_telephone, $data['orderdetails']->shipping_fname . ' ' . $data['orderdetails']->shipping_lname, $data['orderdetails']->ship_address_line_1, $data['orderdetails']->ship_address_line_2, $data['orderdetails']->ship_city . ',' . $data['orderdetails']->ship_state, $product_all_detail, $data['orderdetails']->order_number, $today];



            $mailbody = str_replace($text_admin, $rpc_admin, $order_template->message);

            //echo "<pre>"; print_r($mailbody); exit;
            //$mailbody = view('web.order_details_template', compact('data'));
            $this->mail_service->order_confirm_mail($mailbody, $data['orderdetails']->email, $data);


            // $mailbody = view('web.order_details_template', compact('data'));
            //  $this->mail_service->order_confirm_mail($mailbody,$data['orderdetails']->email,$data);
            //   }


            $data['content'] = view('web.order-invoice', compact('message', 'error', 'orderdetails', 'orderItems','size_list_array','sizetableshow'))->render();
            // $html =  view('layouts.web-template', $data);
            return json_encode(['html' => $data['content'],'status'=>$error]);
        }
    }
    public function reSentMail(Request $request){
          if(!isset($request->orderid)){
            exit("Order id is missing");
          }
          if(!isset($request->mailtype) || ($request->mailtype != 'user' && $request->mailtype != 'admin') ){
            exit("Mail type is missing");
          }
          $order_id = $request->orderid;
          $type     = $request->mailtype;
          $orderObj = new Orders();

          $orderdetails = $orderObj->getOrderDetails($order_id);

          $orderItems = $orderObj->getOrderItems($order_id);
          $size_list_array = array();
          $sizetableshow = false;
            foreach ($orderItems as $key => $value) {
               $size = '';
               $productsize = ProductsSize::where('sku', '=', $value->product_sku)->get();
               if(count($productsize)){
                  $size = $productsize[0]->size;
                  $sizetableshow = true;
               }
               $size_list_array[$value->product_sku] = $size;
            }

            $data['orderdetails'] = $orderdetails;
            $data['orderItems'] = $orderItems;


            $product_all_detail = '';


            foreach ($data['orderItems'] as $key => $value) {

                $imageUrl = Product::where('id', '=', $value->product_id)->pluck('product_image');
                $imageURL = 'uploads/productimages/thumbs/thumb-' . $imageUrl[0];
                //echo "<pre>"; print_r('uploads/videoimages/'.$imageUrl[0]); exit;
                $product_datas = '';
                $size_blank = '-';
                if($size_list_array[$value->product_sku] != '')
                    $size_blank = ucfirst($size_list_array[$value->product_sku]);
                $product_datas = '<tr>

                        <td style="vertical-align:center; font-size: 14px;text-align:center;"><img width="100px" src="'.env('APP_URL') . $imageURL . '" /></td>
                        <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->product_name . '</td>
                        <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $size_blank . '</td>
                        <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->quantity . '</td>
                        <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->price . '</td>

                </tr>';

                //$text_admin = ["{{imageurl}}","{{product_name}}", "{{prize}}", "{{quantity}}"];
                //$rpc_admin   = [$imageURL,$value->product_name,$value->price,$value->quantity];
                // $mailbody=str_replace($text_admin,$rpc_admin,$product_details);
                $product_all_detail .= $product_datas;
            }


            $order_template = Template::where('id', '=', '7')->first();
            $today = date("F j, Y");
            // echo "<pre>"; print_r($today); exit;
            $shipping = $data['orderdetails']->shipping_amount;
            $total = $data['orderdetails']->order_amount + $shipping;

            $text_admin = ["{{user_name}}", "{{email}}", "{{total}}", "{{amount}}", "{{shipping}}", "{{blng_phone}}", "{{ship_phone}}", "{{ship_user_name}}", "{{address_line_1}}", "{{address_line_2}}", "{{address_line_3}}", "{{product_details}}", "{{order_id}}", "{{date}}"];

            $rpc_admin = [$data['orderdetails']->fname . ' ' . $data['orderdetails']->lname, $data['orderdetails']->email, $total , $data['orderdetails']->order_amount, $shipping, $data['orderdetails']->telephone, $data['orderdetails']->ship_telephone, $data['orderdetails']->shipping_fname . ' ' . $data['orderdetails']->shipping_lname, $data['orderdetails']->ship_address_line_1, $data['orderdetails']->ship_address_line_2, $data['orderdetails']->ship_city . ',' . $data['orderdetails']->ship_state, $product_all_detail, $data['orderdetails']->order_number, $today];



            $mailbody = str_replace($text_admin, $rpc_admin, $order_template->message);

            //echo "<pre>"; print_r($mailbody); exit;
            //$mailbody = view('web.order_details_template', compact('data'));
            if($type == 'user'){
              $this->mail_service->reorder_confirm_mail_to_user($mailbody, $data['orderdetails']->email, $data);
            }else {
              $this->mail_service->reorder_confirm_mail_to_admin($mailbody, $data['orderdetails']->email, $data);
            }

            exit("Mail sent to ". $type);

    }
    public function getpaymentfaileddetail($order_id,$user_error_message,$actual_error_message){
        $orderObj = new Orders();

        $orderdetails = $orderObj->getOrderDetails($order_id);

        $orderItems = $orderObj->getOrderItems($order_id);
        $size_list_array = array();
        $sizetableshow = false;

        foreach ($orderItems as $key => $value) {
           $size = '';
           $productsize = ProductsSize::where('sku', '=', $value->product_sku)->get();
           if(count($productsize)){
              $size = $productsize[0]->size;
              $sizetableshow = true;
           }
           $size_list_array[$value->product_sku] = $size;
        }

        $data['orderdetails'] = $orderdetails;
        $data['orderItems'] = $orderItems;


        $product_all_detail = '';


        foreach ($data['orderItems'] as $key => $value) {

            $imageUrl = Product::where('id', '=', $value->product_id)->pluck('product_image');
            $imageURL = 'uploads/productimages/thumbs/thumb-' . $imageUrl[0];
            //echo "<pre>"; print_r('uploads/videoimages/'.$imageUrl[0]); exit;
            $product_datas = '';
            $size_blank = '-';
            if($size_list_array[$value->product_sku] != '')
                $size_blank = ucfirst($size_list_array[$value->product_sku]);
            $product_datas = '<tr>

                    <td style="vertical-align:center; font-size: 14px;text-align:center;"><img width="100px" src="'.env('APP_URL') . $imageURL . '" /></td>
                    <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->product_name . '</td>
                    <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $size_blank . '</td>
                    <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->quantity . '</td>
                    <td style="vertical-align:center; font-size: 14px;text-align:center;">' . $value->price . '</td>

            </tr>';

            //$text_admin = ["{{imageurl}}","{{product_name}}", "{{prize}}", "{{quantity}}"];
            //$rpc_admin   = [$imageURL,$value->product_name,$value->price,$value->quantity];
            // $mailbody=str_replace($text_admin,$rpc_admin,$product_details);
            $product_all_detail .= $product_datas;
        }


        $order_template = Template::where('id', '=', '10')->first();
        $today = date("F j, Y");
        // echo "<pre>"; print_r($today); exit;
        $shipping = $data['orderdetails']->shipping_amount;
        $total = $data['orderdetails']->order_amount + $shipping;

        $text_admin = ["{{user_name}}", "{{email}}", "{{total}}", "{{amount}}", "{{shipping}}", "{{blng_phone}}", "{{ship_phone}}", "{{ship_user_name}}", "{{address_line_1}}", "{{address_line_2}}", "{{address_line_3}}", "{{product_details}}", "{{order_id}}", "{{date}}","{{user_error_message}}","{{actual_error_message}}"];

        $rpc_admin = [$data['orderdetails']->fname . ' ' . $data['orderdetails']->lname, $data['orderdetails']->email, $total , $data['orderdetails']->order_amount, $shipping, $data['orderdetails']->telephone, $data['orderdetails']->ship_telephone, $data['orderdetails']->shipping_fname . ' ' . $data['orderdetails']->shipping_lname, $data['orderdetails']->ship_address_line_1, $data['orderdetails']->ship_address_line_2, $data['orderdetails']->ship_city . ',' . $data['orderdetails']->ship_state, $product_all_detail, $data['orderdetails']->order_number, $today,$user_error_message,$actual_error_message];



        $mailbody = str_replace($text_admin, $rpc_admin, $order_template->message);
        $subject  = $order_template->subject;
        $this->mail_service->payment_fail_mail($mailbody,$subject);


    }

    public function test() {
        $orderObj = new Orders();
        //$order_id=28;
        $error = 0;
        $orderdetails = $orderObj->getOrderDetails(34);

        $orderItems = $orderObj->getOrderItems(34);

        if ($error == 0) {

            $data['orderdetails'] = $orderdetails;
            $data['orderItems'] = $orderItems;


            $product_all_detail = '';


            foreach ($data['orderItems'] as $key => $value) {

                $imageUrl = Product::where('id', '=', $value->product_id)->pluck('product_image');
                $imageURL = 'uploads/productimages/' . $imageUrl[0];
                //echo "<pre>"; print_r('uploads/videoimages/'.$imageUrl[0]); exit;
                $product_datas = '';

                $product_datas = '<tr>

                        <td style="vertical-align: top;"><img width="50" height="50" src="'.env('APP_URL') . $imageURL . '" /></td>
                        <td style="vertical-align: top; color: #58595b;">' . $value->product_name . '</td>
                        <td style="vertical-align: top; color: #58595b;">' . $value->quantity . '</td>
                        <td style="vertical-align: top; color: #58595b;">' . $value->price . '</td>

                </tr>';

                //$text_admin = ["{{imageurl}}","{{product_name}}", "{{prize}}", "{{quantity}}"];
                //$rpc_admin   = [$imageURL,$value->product_name,$value->price,$value->quantity];
                // $mailbody=str_replace($text_admin,$rpc_admin,$product_details);
                $product_all_detail .= $product_datas;
            }


            $order_template = Template::where('id', '=', '7')->first();
            $today = date("F j, Y");
            // echo "<pre>"; print_r($today); exit;

            $text_admin = ["{{user_name}}", "{{email}}", "{{amount}}", "{{phone}}", "{{address_line_1}}", "{{address_line_2}}", "{{address_line_3}}", "{{product_details}}", "{{order_id}}", "{{date}}"];
            $rpc_admin = [$data['orderdetails']->first_name . ' ' . $data['orderdetails']->last_name, $data['orderdetails']->email, $data['orderdetails']->order_amount, $data['orderdetails']->telephone, $data['orderdetails']->ship_address_line_1, $data['orderdetails']->ship_address_line_2, $data['orderdetails']->ship_city . ',' . $data['orderdetails']->ship_state, $product_all_detail, $data['orderdetails']->order_id, $today];



            $mailbody = str_replace($text_admin, $rpc_admin, $order_template->message);

            //echo "<pre>"; print_r($mailbody); exit;
            //$mailbody = view('web.order_details_template', compact('data'));
            $this->mail_service->order_confirm_mail($mailbody, $data['orderdetails']->email, $data);


            // $mailbody = view('web.order_details_template', compact('data'));
            //  $this->mail_service->order_confirm_mail($mailbody,$data['orderdetails']->email,$data);
            //   }


            $data['content'] = view('web.order-invoice', compact('message', 'error', 'orderdetails', 'orderItems'));
            return view('layouts.web-template', $data);
        }
    }


    public function makedonation() {
        $countryList = Country::where('status_id', '=', 1)->get();
        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '4')->get();

        MetaTag::set('title', $meta[0]->page_title);
        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);
        $donationGoal = DonationGoal::where('status', '=', '1')->first();
        // $encrypt="eyJpdiI6IjRZK1N0bDlReDZ2Q0JJeXAwSnY1cFE9PSIsInZhbHVlIjoiSXY5NTIwQzE0a0lTUVFwUUVXYzFNUT09IiwibWFjIjoiYmQ5YzU4ZWZiNTZjM2Y3Nzk0Mzg2NjIyN2UxMDU2NDY5ZjViMzdkYWZhOWU2MjVhOGJjMTZkZmJmMzNlMDY3ZCJ9";
        $encrypt = Crypt::encryptString($donationGoal->id);

        $data['content'] = view('web.make-donation', compact('countryList', 'encrypt'));
        return view('layouts.web-template', $data);
    }

    public function donationpayment(Request $request) {
        $payment_name = "Donation";
        $source = $request->stp_token;
        $encrypted = $request->reference_id;

        $goal_id = Crypt::decryptString($encrypted);

        $donation['donation_date'] = date('Y-m-d H:i:s');
        $donation['email'] = $request->email;
        $donation['first_name'] = $request->first_name;
        $donation['last_name'] = $request->last_name;
        $donation['donation_amount'] = $request->amount;
        $donation['phone'] = $request->phone;
        $donation['address_line_1'] = $request->address_line_1;
        $donation['address_line_2'] = $request->address_line_2;
        $donation['city'] = $request->city;
        $donation['country'] = $request->country;
        $donation['state'] = $request->state;
        $donation['zipcode'] = $request->zipcode;
        $donation['goal_id'] = $goal_id;
        $donation['payment_status'] = 0;   //Default payment status : pending

        $donation['is_recurring'] = ($request->gifttype == 'one_time') ? 0 : 1;
        

//        print_r($donation); die;
        $donationResult = Donations::create($donation);
        $donation_id = $donationResult->id;
        $donationResult->order_number = $this->setDonationOrderNumber($donation['is_recurring']);


        $amount = floatval($request->amount) * 100;
        $metadata = ['transaction_made_for' => 'donation'];

        // echo '<pre>';
        $message = '';
        $success = true;
        try {

            $chargeArray = ['amount' => $amount,
                'currency' => 'usd',
                'description' => 'Donation on Christianity',
                // 'receipt_email' => $request->email,
                'statement_descriptor' => 'Donation on CHE',
                'metadata' => $metadata
            ];
            if ($request->gifttype == 'one_time') {
                $chargeArray['source'] = $source;
            } else {
                $customer = \Stripe\Customer::create(array(
                            "description" => "Recurring Donation Payment",
                            // "email" => $request->email,
                            "source" => $source
                ));
                $chargeArray['customer'] = $customer->id;
                $donationResult->stripe_customer_id = $customer->id;
                $donationResult->next_payment_date = date('Y-m-d', strtotime("+1 month"));
                $donationResult->save();
            }

            $charge = \Stripe\Charge::create($chargeArray);

            $charge->jsonSerialize();

            $charge_id = $charge['id'];

            if ($charge['status'] == 'succeeded' && $charge['paid']) {

                $donationResult->payment_status = 1;     //Set payment status to paid
                $donationResult->save();

                $transactionDetails = [];
                $transactionDetails['doantions_id'] = $donation_id;
                $transactionDetails['txn_id'] = $charge['id'];
                $transactionDetails['txn_amount'] = $charge['amount'];
                $transactionDetails['currency'] = $charge['currency'];
                $transactionDetails['txn_status'] = $charge['status'];
                $transactionDetails['payment_source_id'] = $charge['source']['id'];
                $transactionDetails['payment_object'] = $charge['source']['object'];
                $transactionDetails['payment_brand'] = $charge['source']['brand'];
                $transactionDetails['payment_last4'] = $charge['source']['last4'];
                $transactionDetails['cvc_check'] = $charge['source']['cvc_check'];
                $transactionDetails['failure_code'] = $charge['failure_code'];
                $transactionDetails['failure_message'] = $charge['failure_message'];

                DonationTransactions::create($transactionDetails);
                $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',5)->get();
                $dyanamicMessage = '';
                // Payment Successful
                // foreach ($videoTopics as $key => $value) {
                //     // if($value->name =='Payment Successful'){
                //     if ($value->id == '5') {
                //         $dyanamicMessage = $value->value;
                //     }
                // }
                $dyanamicMessage = $videoTopics[0]->value;
                $message = $dyanamicMessage;
                $success = true;
            } else {
                // Payment Not done
                // foreach ($videoTopics as $key => $value) {
                //     if ($value->id == '6') {
                //         $dyanamicMessage = $value->value;
                //     }
                // }
                $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',6)->get();
                $dyanamicMessage = $videoTopics[0]->value;

                $message = $dyanamicMessage;
                $success = false;
                $donationResult->payment_status = 2;     //Payment error
                $donationResult->save();
                if(isset($charge['failure_message'])){
                    $error_msg = $charge['failure_message'];
                }
                // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$error_msg);
                $donation_type = ($request->gifttype == 'one_time') ? 'One Time Gift' : 'Monthly Gift';
                $this->donationpaymentfailed($donationResult,$donation_type,$dyanamicMessage,$error_msg);


            }
        } catch (\Stripe\Error\Card $e) {
            $donationResult->payment_status = 2;     //Payment error
            $donationResult->save();
            // Payment Unsuccessful
            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',7)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            // foreach ($videoTopics as $key => $value) {
            //     if ($value->id == '7') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $success = false;
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $donation_type = ($request->gifttype == 'one_time') ? 'One Time Gift' : 'Monthly Gift';
            $this->donationpaymentfailed($donationResult,$donation_type,$dyanamicMessage,$e->getMessage());

            //print_r($error);
        } catch (\Stripe\Error\ApiConnection $e) {
            $donationResult->payment_status = 2;     //Payment error
            $donationResult->save();
            // Network problem
            // foreach ($videoTopics as $key => $value) {
            //     if ($value->id == '8') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }
            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',8)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $success = false;
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $donation_type = ($request->gifttype == 'one_time') ? 'One Time Gift' : 'Monthly Gift';
            $this->donationpaymentfailed($donationResult,$donation_type,$dyanamicMessage,$e->getMessage());

            //print_r($error);
        } catch (\Stripe\Error\InvalidRequest $e) {
            $donationResult->payment_status = 2;     //Payment error
            $donationResult->save();
            // Invalid Request
            // foreach ($videoTopics as $key => $value) {
            //     if ($value->id == '9') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }
            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',7)->get();
            $dyanamicMessage = $videoTopics[0]->value;


            $message = $dyanamicMessage;
            $success = false;
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $donation_type = ($request->gifttype == 'one_time') ? 'One Time Gift' : 'Monthly Gift';
            $this->donationpaymentfailed($donationResult,$donation_type,$dyanamicMessage,$e->getMessage());

            //print_r($error);
        } catch (\Stripe\Error\Api $e) {
            $donationResult->payment_status = 2;     //Payment error
            $donationResult->save();
            // Stripes down
            // foreach ($videoTopics as $key => $value) {
            //     if ($value->id == '10') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }

            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',10)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $success = false;
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $donation_type = ($request->gifttype == 'one_time') ? 'One Time Gift' : 'Monthly Gift';
            $this->donationpaymentfailed($donationResult,$donation_type,$dyanamicMessage,$e->getMessage());

            //print_r($error);
        } catch (\Stripe\Error\Card $e) {
            $donationResult->payment_status = 2;     //Payment error
            $donationResult->save();
            // Payment Unsuccessful
            // foreach ($videoTopics as $key => $value) {
            //     if ($value->id == '7') {
            //         $dyanamicMessage = $value->value;
            //     }
            // }

            $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id','=',7)->get();
            $dyanamicMessage = $videoTopics[0]->value;

            $message = $dyanamicMessage;
            $success = false;
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            // $this->mail_service->payment_fail_mail($payment_name,$dyanamicMessage,$e->getMessage());
            $donation_type = ($request->gifttype == 'one_time') ? 'One Time Gift' : 'Monthly Gift';
            $this->donationpaymentfailed($donationResult,$donation_type,$dyanamicMessage,$e->getMessage());

            //print_r($error);
        }


        if ($success == true) {
            $donation = $donationResult;
            $donation->donation_type = ($request->gifttype == 'one_time') ? 'One Time Gift' : 'Monthly Gift';
            // $mailbody = view('web.donation_template', compact('donation'));
            // //attchment
            // $todayDate=date("F j, Y");
            // $pdfTemplate = PDF::loadView('web.order-details-pdf',compact('donation','todayDate'));
            // $output = $pdfTemplate->output();
            // Storage::put('/folder/abc.pdf', $output);
            // $mailbody = view('web.donation_template', compact('donation'));
            // $file = storage_path('app/folder/abc.pdf');
            // $this->mail_service->donation_mail($mailbody,$donation->email,$donation,$file);
            $donation_template = Template::where('id', '=', '8')->first();
            if ($request->gifttype == 'one_time') {
                $donation_template = Template::where('id', '=', '6')->first();
            }

            $text_admin = ["XXXXXX", "{{donation_date}}", "{{user_name}}", "{{donation_type}}", "{{amount}}", "{{email}}", "{{phone}}", "{{address_line_1}}", "{{address_line_2}}", "{{address_line_3}}"];
            $rpc_admin = [$donation->order_number, date('M d, Y', strtotime($donation->donation_date)), $donation->first_name . ' ' . $donation->last_name, $donation->donation_type, $donation->donation_amount, $donation->email, $donation->phone, $donation->address_line_1, $donation->address_line_2, $donation->city . ',' . $donation->state];

            $mailbody = str_replace($text_admin, $rpc_admin, $donation_template->message);

            // PDF Content attachment in mail
            $todayDate = date("F j, Y");
            $pdfTemplate = PDF::loadView('web.order-details-pdf', compact('donation', 'todayDate'));
            $output = $pdfTemplate->output();
            Storage::put('/folder/abc.pdf', $output);

            // $mailbody = view('web.donation_template', compact('donation'));
            $file = storage_path('app/folder/abc.pdf');
            $this->mail_service->donation_mail($mailbody, $donation->email, $donation, $file);
            Storage::delete($file);

            $check_donation_goal_reach = $this->getdonationgoal();

            if($check_donation_goal_reach >= 25 && $check_donation_goal_reach < 50){
                    $donationGoal = DonationGoal::where('status', '=', '1')->where('goal_25', '=', '0')->get();
                    if(count($donationGoal)){
                        $this->mail_service->donationgoal_mail($donationGoal[0]->title,'25');
                        DonationGoal::where('status', '=', '1')->where('goal_25', '=', '0')->update(['goal_25'=>'1']);
                    }
            }
            if($check_donation_goal_reach >= 50 && $check_donation_goal_reach < 75){
                    $donationGoal = DonationGoal::where('status', '=', '1')->where('goal_50', '=', '0')->get();
                    if(count($donationGoal)){
                        $this->mail_service->donationgoal_mail($donationGoal[0]->title,'50');
                        DonationGoal::where('status', '=', '1')->where('goal_50', '=', '0')->update(['goal_50'=>'1']);
                    }
            }
            if($check_donation_goal_reach >= 75 && $check_donation_goal_reach < 100){
                    $donationGoal = DonationGoal::where('status', '=', '1')->where('goal_75', '=', '0')->get();
                    if(count($donationGoal)){
                        $this->mail_service->donationgoal_mail($donationGoal[0]->title,'75');
                        DonationGoal::where('status', '=', '1')->where('goal_75', '=', '0')->update(['goal_75'=>'1']);
                    }
            }
            if($check_donation_goal_reach >= 100){
                    $donationGoal = DonationGoal::where('status', '=', '1')->where('goal_100', '=', '0')->get();
                    if(count($donationGoal)){
                        $this->mail_service->donationgoal_mail($donationGoal[0]->title,'100');
                        DonationGoal::where('status', '=', '1')->where('goal_100', '=', '0')->update(['goal_100'=>'1']);
                    }
            }

        }

        return json_encode(['success' => $success, 'message' => $message, 'donation_id' => $donation_id]);
    }
    public function donationpaymentfailed($donation,$donation_type,$user_error_message,$actual_error_message){
            $donation_template = Template::where('id', '=', '11')->first();

            $text_admin = ["XXXXXX", "{{donation_date}}", "{{user_name}}", "{{donation_type}}", "{{amount}}", "{{email}}", "{{phone}}", "{{address_line_1}}", "{{address_line_2}}", "{{address_line_3}}","{{user_error_message}}","{{actual_error_message}}"];
            $rpc_admin = [$donation->order_number, date('M d, Y', strtotime($donation->donation_date)), $donation->first_name . ' ' . $donation->last_name, $donation_type, $donation->donation_amount, $donation->email, $donation->phone, $donation->address_line_1, $donation->address_line_2, $donation->city . ',' . $donation->state,$user_error_message,$actual_error_message];

            $mailbody = str_replace($text_admin, $rpc_admin, $donation_template->message);

            $subject  = $donation_template->subject;
            $this->mail_service->payment_fail_mail($mailbody,$subject);


    }
    public function getdonationgoal(){
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

        return $goalPercent;

    }
    public function donationreceipt($id) {
        $meta = Cms::where('publish_status', '!=', '3')->where('id', '=', '4')->get();
        MetaTag::set('title', $meta[0]->page_title);
        MetaTag::set('description', $meta[0]->meta_description);
        MetaTag::set('keywords', $meta[0]->meta_keyword);
        if (empty(session('donation_page'))) {
            return Redirect::to('/');
        } else {
            session()->forget('donation_page');
            $donation = Donations::where('id', '=', $id)->first();
            $data['content'] = view('web.donationreceipt', compact('donation'));
            return view('layouts.web-template', $data);
        }
    }

    public function setDonationOrderNumber($recurring = 1) {
        $date = date("m-d-y");
        $orderNumber = 'DG';
        if ($recurring == 1) {
            $orderNumber = 'DM';
        }
        $orderNumber = $orderNumber . str_replace("-", "", $date);
        $lastOrder = Donations::where('payment_status', '!=', 0)->whereDate('donation_date', '=', date('Y-m-d'))->orderBy('id', 'DESC')->get();
        $newOrder = count($lastOrder) + 1;
        $newOrderWithPadd = str_pad($newOrder, 5, '0', STR_PAD_LEFT);
        $orderNumber = $orderNumber . $newOrderWithPadd;
        return $orderNumber;
    }

}
