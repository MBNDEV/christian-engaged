<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationTransactions extends Model {

    protected $table = 'ce_donation_transactions';
    protected $fillable = [
        'doantions_id', 'txn_id', 'txn_amount', 'currency', 'txn_status', 'payment_source_id', 'payment_object', 'payment_brand', 'payment_last4', 'cvc_check', 'failure_message', 'failure_code'
    ];
}
