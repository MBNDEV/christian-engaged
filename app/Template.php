<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Template extends Model {

    protected $table = 'ce_email_template';
    protected $fillable = [
        'subject', 'publish_status', 'message'
    ];

    

}
