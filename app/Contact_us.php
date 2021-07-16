<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_us extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address','address_line_2', 'mobile', 'email', 'landline_phone'
    ];    
    
    protected  $table = 'contact_us';
    
}
