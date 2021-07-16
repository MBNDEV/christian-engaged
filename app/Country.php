<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    protected $table = 'ce_country';
    protected $fillable = [
        'country_code', 'country_name',
    ];

}
