<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    protected $table = 'ce_transactions';
    protected $fillable = [
        'order_id', 'txn_id', 'txn_amount', 'currency', 'txn_status', 'payment_source_id', 'payment_object', 'payment_brand', 'payment_last4', 'cvc_check', 'address_zip_check','failure_message', 'failure_code'
    ];
}
