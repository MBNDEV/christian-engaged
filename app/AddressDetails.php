<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressDetails extends Model {

    protected $table = 'ce_address_details';
    protected $fillable = [
        'first_name', 'last_name', 'address_line_1', 'address_line_2', 'country_id', 'city', 'state', 'zipcode', 'telephone'
    ];
}
