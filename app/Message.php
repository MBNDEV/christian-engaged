<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $table = 'ce_message';
    protected $fillable = [
        'name', 'value',
    ];

}
