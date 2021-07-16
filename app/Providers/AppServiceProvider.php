<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Cms;
use App\Message;
use App\DonationGoal;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use App\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $cmsPages = Cms::where('publish_status', '=', '1')->get();
        
        View::share('cmsPages', $cmsPages);  
        
        $donationGoal = DonationGoal::where('status', '=', '1')->first(); 
        
        if($donationGoal && is_object($donationGoal)){
            View::share('active_goal', Crypt::encryptString($donationGoal->id)); 
        }
        $message = Message::where('publish_status', '=', '1')->get();
        View::share('message', $message);  
        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {
    
        // This will only accept alpha and spaces. 
        // If you want to accept hyphens use: /^[\pL\s-]+$/u.
        return preg_match('/^[\pL\s]+$/u', $value);

        }); 
        
        
        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
                ->where('ce_products.publish_status', '=', '1')
                ->where('ce_products.is_featured', '=', '1')
                ->orderBy('ce_products.featured_sort_order', 'asc')
                ->get();
        View::share('products', $products);  
        
        $cmsObj = new Cms();
        $merchPageSlug = $cmsObj->getSlug(5);
        View::share('merchPageSlug', $merchPageSlug);
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
