<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Leaders extends Model {

    protected $table = 'ce_leaders';
    public $timestamps = false;
    
    protected $fillable = [
        'name', 'designation', 'profile_pic', 'short_description', 'status',
    ];
        
}
