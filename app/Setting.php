<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected  $table = 'ce_setting';      
	protected $fillable = ['start_range','end_range','cost'];    
	public $timestamps = false;

}
