<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\DonationTransactions;
use App\Donations;
use App\Message;

class ReccuringDonation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ce:recurring-donation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recurring Donation';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $skey, $pkey, $endpoint_secret;
    public function __construct()
    {
        parent::__construct();
        $environment = env('APP_ENV');
        if ($environment == 'local' || $environment == 'staging') {
            $this->skey = env('STRIPE_TEST_SK');
            $this->pkey = env('STRIPE_TEST_PK');
            $this->endpoint_secret = env('STRIPE_TEST_ENDPOINT_SECRET');
        } else {
            $this->skey = env('STRIPE_LIVE_SK');
            $this->pkey = env('STRIPE_LIVE_PK');
            $this->endpoint_secret = env('STRIPE_live_ENDPOINT_SECRET');
        }

        \Stripe\Stripe::setApiKey($this->skey);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->getRecurringDonations();
    }

    public function getRecurringDonations() {
        $today = date('Y-m-d');

        $recurringDonations = Donations::where('is_recurring', '=', '1')->where('active_status', '=', '1')->where('next_payment_date', '=', "$today")->get();
        Log::info('Recurring Donations Start:');
        foreach ($recurringDonations as $recurringDonation) {
            Log::info(json_encode($recurringDonation));
            $donation_id = $recurringDonation->id;

            $amount = floatval($recurringDonation->donation_amount)*100;
            $metadata = ['transaction_made_for' => 'donation'];

            $message = ''; $success=true;
            // try{

                 $chargeArray = ['amount' => $amount,
                                'currency' => 'usd',
                                'description' => 'Donation on Christianity',
                                // 'receipt_email' => $recurringDonation->email,
                                'statement_descriptor' => 'Donation on CHE',
                                'metadata' => $metadata,
                                'customer'=>$recurringDonation->stripe_customer_id
                             ];

                $charge = \Stripe\Charge::create($chargeArray);

                $charge->jsonSerialize();

                $charge_id = $charge['id'];

                if($charge['status'] == 'succeeded' && $charge['paid']){

                    $recurringDonation->payment_status = 1;     //Set payment status to paid
                    $recurringDonation->next_payment_date = date('Y-m-d', strtotime("+1 month"));
                    $recurringDonation->save();

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
                    //dynamic messages
                    $dyanamicMessage = '';
                    $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id', '=', 5)->get();
                    // foreach ($videoTopics as $key => $value) {
                    //    // if($value->name =='Payment Successful'){
                    //     if($value->id =='5'){
                    //         $dyanamicMessage = $value->value;
                    //     }
                    // }
                    $dyanamicMessage = $videoTopics[0]->value;
                    $message = $dyanamicMessage;
                    //$success=true;

                }else{
                    // Payment Not done
                    // foreach ($videoTopics as $key => $value) {
                    //     if($value->id =='6'){
                    //         $dyanamicMessage = $value->value;
                    //     }
                    // }
                    $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id', '=', 6)->get();
                    $dyanamicMessage = $videoTopics[0]->value;

                    $message = $dyanamicMessage;
                    $success=false;
                    $donationResult->payment_status = 2;     //Payment error
                    $donationResult->save();
                }
            // }
            // catch (\Stripe\Error\Card $e) {
            //     $donationResult->payment_status = 2;     //Payment error
            //     $donationResult->save();
            //     // Payment Unsuccessful
            //     // foreach ($videoTopics as $key => $value) {
            //     //     if($value->id =='7'){
            //     //         $dyanamicMessage = $value->value;
            //     //     }
            //     // }
            //     $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id', '=', 7)->get();
            //     $dyanamicMessage = $videoTopics[0]->value;

            //     $message = $dyanamicMessage;
            //     $success=false;
            //     $e_json = $e->getJsonBody();
            //     $error = $e_json['error'];
            //     //print_r($error);
            // }
            // catch (\Stripe\Error\ApiConnection $e) {
            //     $donationResult->payment_status = 2;     //Payment error
            //     $donationResult->save();
            //     // Network problem
            //     // foreach ($videoTopics as $key => $value) {
            //     //     if($value->id =='8'){
            //     //         $dyanamicMessage = $value->value;
            //     //     }
            //     // }
            //     $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id', '=', 8)->get();
            //     $dyanamicMessage = $videoTopics[0]->value;


            //     $message = $dyanamicMessage;
            //     $success=false;
            //     $e_json = $e->getJsonBody();
            //     $error = $e_json['error'];
            //     //print_r($error);
            // } catch (\Stripe\Error\InvalidRequest $e) {
            //     $donationResult->payment_status = 2;     //Payment error
            //     $donationResult->save();
            //     // Invalid Request
            //     // foreach ($videoTopics as $key => $value) {
            //     //     if($value->id =='9'){
            //     //         $dyanamicMessage = $value->value;
            //     //     }
            //     // }

            //     $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id', '=', 9)->get();
            //     $dyanamicMessage = $videoTopics[0]->value;


            //     $message = $dyanamicMessage;
            //     $success=false;
            //     $e_json = $e->getJsonBody();
            //     $error = $e_json['error'];
            //     //print_r($error);
            // } catch (\Stripe\Error\Api $e) {
            //     $donationResult->payment_status = 2;     //Payment error
            //     $donationResult->save();
            //     // Stripes down
            //     // foreach ($videoTopics as $key => $value) {
            //     //     if($value->id =='10'){
            //     //         $dyanamicMessage = $value->value;
            //     //     }
            //     // }

            //     $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id', '=', 10)->get();
            //     $dyanamicMessage = $videoTopics[0]->value;


            //     $message = $dyanamicMessage;
            //     $success=false;
            //     $e_json = $e->getJsonBody();
            //     $error = $e_json['error'];
            //     //print_r($error);
            // } catch (\Stripe\Error\Card $e) {
            //     $donationResult->payment_status = 2;     //Payment error
            //     $donationResult->save();
            //     // Payment Unsuccessful
            //     // foreach ($videoTopics as $key => $value) {
            //     //     if($value->id =='7'){
            //     //         $dyanamicMessage = $value->value;
            //     //     }
            //     // }

            //     $videoTopics = Message::select('*')->where('publish_status', '=', 1)->where('id', '=', 7)->get();
            //     $dyanamicMessage = $videoTopics[0]->value;


            //     $message = $dyanamicMessage;
            //     $success=false;
            //     $e_json = $e->getJsonBody();
            //     $error = $e_json['error'];
            //     //print_r($error);
            // }

            // echo $donation_id.'--'.$message.'<br>';
        }
    }
}
