<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'status','signature'
    ];    
    
    protected  $table = 'ce_newsletter';
    
}

