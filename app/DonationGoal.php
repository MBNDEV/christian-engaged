<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationGoal extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'background_image', 'goal_amount', 'status', 'created_at'
    ];    
    
    protected  $table = 'ce_donation_goals';
    
}
