<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productcategory;
use App\Product;
use App\Orders;
use App\RecommendedProducts;
use App\ProductsSize;
use App\ProductsSizeList;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as Image;
use App\ShipStation;
use DB;
use MetaTag;

class ProductController extends Controller {

    public function categorylisting(Request $request) {
        $products = Productcategory::where('status', '!=', '3')->orderBy('sort_order', 'ASC')->get();
        $data['content'] = view('admin.product.categorylisting', compact('products'));
        return view('layouts.template', $data);
    }

    public function addcategory(Request $request) {
        $data['content'] = view('admin.product.addproductcategory');
        return view('layouts.template', $data);
    }
    public function categorySort(Request $request) {

        $postData = $request->all();
        $categoryList = $postData['categorylist'];
        foreach ($categoryList as $k => $v) {
            $productcategory = null;
            if ($k && $v) {
                $productcategory = Productcategory::find($v);
                $productcategory->sort_order = $k;
                $productcategory->save();
            }
        }

        $data = json_encode(['success' => 1]);
        print_r($data);
        die;
    }

    public function savecategory(Request $request) {

        $this->validate($request, [
            'product_category' => 'required|min:3|max:30',
            'status' => 'required',
            'slug' => 'required'
        ]);
        $category = Productcategory::orderBy('id', 'desc')->first();

        $sort_order = 1;
        if ($category && $category->id) {
            $sort_order = $category->id + 1;
        }

        $request->merge(['sort_order' => $sort_order]);

        $productcategory = Productcategory::create($request->all());

        if ($productcategory->id) {
            return redirect('/manage/product-categories')->withSuccess('Product Category added Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function editcategory(Request $request, $id) {
        $category = Productcategory::find($id);
        // print_r($category); die;
        $data['content'] = view('admin.product.editproductcategory', compact('category'));
        return view('layouts.template', $data);
    }

    public function featuredProducts(Request $request) {
        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                        ->select('ce_products.*', 'ce_product_categories.product_category')
                        ->where('ce_products.publish_status', '=', '1')
                        ->where('ce_product_categories.status', '=', '1')
                        ->where('ce_products.is_featured', '=', '1')
                        ->orderBy('ce_products.featured_sort_order', 'ASC')->get();

        $data['content'] = view('admin.product.featured-products', compact('products'));
        return view('layouts.template', $data);
    }
    public function sortFeaturedProducts(Request $request) {

        $postData = $request->all();
        $productList = $postData['productList'];
        foreach ($productList as $k => $v) {
            $product = null;
            if ($v) {
                $product = Product::find($v);
                $product->featured_sort_order = $k;
                $product->save();
            }
        }

        $data = json_encode(['success' => 1]);
        print_r($data);
        die;
    }
    public function updatecategory(Request $request, $id) {

        $this->validate($request, [
            'product_category' => 'required|min:3|max:30',
            'status' => 'required',
            'slug' => 'required'
        ]);

        $productcategory = Productcategory::find($id);

        $productcategory->product_category = $request->product_category;
        $productcategory->status = $request->status;
        $productcategory->slug = $request->slug;


        if ($productcategory->save()) {
            return redirect('/manage/product-categories')->withSuccess('Product Category Updated Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function deletecategory(Request $request, $id) {
        $productcategory = Productcategory::find($id);
        $productcategory->status = '3';

        if ($productcategory->save()) {
            return redirect('/manage/product-categories')->withSuccess('Product Category Deleted Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function productlisting(Request $request) {
        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')->where('ce_products.publish_status', '!=', '3')->orderBy('ce_products.id', 'asc')->get();

        $data['content'] = view('admin.product.productlisting', compact('products'));
        return view('layouts.template', $data);
    }

    public function addproduct(Request $request) {

        $products_category = Productcategory::where('status', '!=', '3')->orderBy('sort_order', 'ASC')->get();

        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                        ->select('ce_products.*', 'ce_product_categories.product_category')
                        ->where('ce_products.publish_status', '=', '1')->where('ce_product_categories.status', '!=', '3')->get();
        $sizelist = ProductsSizeList::select('size_name')->get();
        $sizelist_array = array();
        foreach ($sizelist as $key => $value) {
            $sizelist_array[$value->size_name] = ucwords($value->size_name);
        }
        $data['content'] = view('admin.product.addproduct', compact('products_category','products','sizelist_array'));
        return view('layouts.template', $data);
    }

    // public function getrecommendedproduct(Request $request){
    //     if($request->type == 'edit'){
    //         $products = Product::where('product_category_id', '=',$request->cat_id )->where('id', '!=',$request->id )->where('publish_status', '!=', '3')->pluck('product_name','id')->toArray();            
    //     }else{
    //         $products = Product::where('product_category_id', '=',$request->cat_id )->where('publish_status', '!=', '3')->pluck('product_name','id')->toArray();            
    //     }
    //     if(empty($products)){
    //         return json_encode(['status'=>'error','data'=>'No data found']);
    //     }
    //     return json_encode(['status'=>'success','data'=> $products]);
    // }

    public function checkuniquesku(Request $request){
        $skuset = array();
        if($request->type == 'edit'){
            foreach ($request->sku as $key => $value) {
                $skuset[$key] = "";
                $product     = Product::where('sku', '=',$value )->where('id', '=',$request->productid )->get();            
                $productsize = ProductsSize::where('sku', '=',$value )->where('product_id', '=',$request->productid )->get();            
                if(count($product) || count($productsize))
                    continue;
                $product     = Product::where('sku', '=',$value )->get();            
                $productsize = ProductsSize::where('sku', '=',$value )->get();            
                if(count($product) || count($productsize))
                    $skuset[$key] = "error";

            }
        }else{
            foreach ($request->sku as $key => $value) {
                $product     = Product::where('sku', '=',$value )->get();            
                $productsize = ProductsSize::where('sku', '=',$value )->get();            
                $skuset[$key] = "";
                if(count($product) || count($productsize))
                    $skuset[$key] = "error";
            }
        }

        if(empty($skuset)){
            return json_encode(['status'=>'error','data'=>'No data found']);
        }
        return json_encode(['status'=>'success','data'=> $skuset]);
    }

    public function detail(Request $request, $seo_slug) {
        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName','ce_product_categories.slug as cataogySlug')->where('ce_products.publish_status', '!=', '3')->where('ce_products.seo_slug', '=', $seo_slug)->orderBy('ce_products.id', 'asc')->get();
        if(count($products) < 1){
             return redirect('/pagenotfound');
        }

        MetaTag::set('title', $products[0]->seo_title);
        MetaTag::set('description', $products[0]->seo_description);
        MetaTag::set('keywords', $products[0]->seo_keywords);

        $recommended_products = RecommendedProducts::where('product_id', '=', $products[0]->id)->get();
        $recommended_products_array = array();
        foreach ($recommended_products as $key => $value) {
            $recommended_products_array[]=$value->recommended_id;
        }

        $recomendedProduct = [];
        if(count($products)){
            // $recomendedProduct = $this->recomendedProduct($products[0]->product_category_id, $products[0]->id);
            $recomendedProduct = Product::where('publish_status', '!=', '3')
                   ->whereRaw('FIND_IN_SET(id,"'.implode(',',$recommended_products_array).'")')->get();
        }
        $sizeList = [];
        if($products[0]->size != ''){
            $sizeList[0]['size'] = $products[0]->size;
            $sizeList[0]['sku'] = $products[0]->sku;
            $sizeList[0]['weight'] = $products[0]->weight;
        }
        $product_size_list = ProductsSize::where('product_id', '=', $products[0]->id)->get();
        if(count($product_size_list)){
            foreach ($product_size_list as $key => $value) {
                $sizeList[$key]['size'] = $value->size;
                $sizeList[$key]['sku']  = $value->sku;
                $sizeList[$key]['weight']  = $value->weight;
            }
        }

        $data['content'] = view('web.merchdetail', compact('products','recomendedProduct','sizeList'));
        return view('layouts.web-template', $data);
    }

    private function recomendedProduct($category, $productId) {
        return $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
                ->where('ce_products.publish_status', '!=', '3')
                ->where('ce_products.id', '!=', $productId)
                ->where('ce_products.product_category_id', '=', $category)
                ->orderBy('ce_products.id', 'asc')
                ->paginate(4);
    }

    public function productByCategory(Request $request, $category = null) {
        $products = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                ->select('ce_products.*', 'ce_product_categories.product_category as cataogyName')
                ->where('ce_product_categories.id', $category)
                ->where('ce_products.publish_status', '!=', '3')
                ->where('ce_products.seo_slug', '=', $seo_slug)
                ->orderBy('ce_products.id', 'asc')
                ->get();
        //echo "<pre>";
        // print_r($products);
        //die;
        MetaTag::set('title', $products[0]->seo_title);
        MetaTag::set('description', $products[0]->seo_description);
        MetaTag::set('keywords', $products[0]->seo_keywords);
        $data['content'] = view('web.merchdetail', compact('products'));
        return view('layouts.web-template', $data);
    }

    public function saveproduct(Request $request) {
        $this->validate($request, [
            'product_name' => 'required|min:3|max:30',
            'product_description' => 'required',
            'product_category_id' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'product_image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'product_image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'price' => 'required|numeric|min:1|max:999',
            'weight' => 'required|numeric|min:0',
            'sku' => 'required|alpha_dash|max:100|unique:ce_products,sku|unique:ce_products_size,sku',
            'publish_status' => 'required',
            'seo_slug' => 'required|alpha_dash|max:100|unique:ce_products,seo_slug',
            'seo_keywords' => 'required',
            'seo_title' => 'required',
            'seo_description' => 'required',
        ]);
        $product_size_array = array();
        if($request->sizerange){
            $count_size=1;
            unset($request['sizerange']);
            while(true){
                if(!isset($request['product_size'.$count_size]) || !isset($request['product_sku'.$count_size]) || !isset($request['product_weight'.$count_size])){
                    break;
                }
                $this->validate($request,['product_sku'.$count_size => 'required|unique:ce_products,sku|unique:ce_products_size,sku']);

                $product_size_array[$count_size-1]['size']   = $request['product_size'.$count_size];
                $product_size_array[$count_size-1]['sku']    = $request['product_sku'.$count_size];
                $product_size_array[$count_size-1]['weight'] = $request['product_weight'.$count_size];
                unset($request['product_size'.$count_size]);
                unset($request['product_sku'.$count_size]);
                unset($request['product_weight'.$count_size]);
                $count_size++;
            }
        }
        $savedata = $request->all();

        $image = $request->file('product_image');
        $imagename = time() . '_'.uniqid().'.'. $image->getClientOriginalExtension();

        $thumbimageObj = Image::make($image);
        $thumbimageObj->fit(100, 100)->save(public_path('/uploads/productimages/thumbs/thumb-' . $imagename));


        $destinationPath = public_path('/uploads/productimages');
        $image->move($destinationPath, $imagename);
        $savedata['product_image']  = $imagename;


        $savedata['product_image1'] = "";
        $savedata['product_image2'] = "";


        if($request->file('product_image1')){
            $image1 = $request->file('product_image1');
            $imagename1 = time() . '_'.uniqid().'.'. $image1->getClientOriginalExtension();

            $thumbimageObj = Image::make($image1);
            $thumbimageObj->fit(100, 100)->save(public_path('/uploads/productimages/thumbs/thumb-' . $imagename1));

            $destinationPath1 = public_path('/uploads/productimages');
            $image1->move($destinationPath1, $imagename1);
            $savedata['product_image1'] = $imagename1;
        }

        if($request->file('product_image2')){
            $image2 = $request->file('product_image2');
            $imagename2 = time() . '_'.uniqid().'.'. $image2->getClientOriginalExtension();

            $thumbimageObj = Image::make($image2);
            $thumbimageObj->fit(100, 100)->save(public_path('/uploads/productimages/thumbs/thumb-' . $imagename2));

            $destinationPath2 = public_path('/uploads/productimages');
            $image2->move($destinationPath2, $imagename2);
            $savedata['product_image2'] = $imagename2;
        }




        // if ($request->recommended_products && count($request->recommended_products)) {
        //     $savedata['recommended_products'] = implode(',', $request->recommended_products);
        // }


        $featuredProducts = Product::orderBy('featured_sort_order', 'asc')->where('is_featured', '=', 1)->where('publish_status', '=', '1')->get();

        $featured_sort_order = 1;
        if ($featuredProducts->count()) {
            foreach ($featuredProducts as $featuredProduct) {
                $featured_sort_order++;
                $ProductDetail = Product::find($featuredProduct->id);
                $ProductDetail->featured_sort_order = $featured_sort_order;
                $ProductDetail->save();
            }
        }

        $savedata['featured_sort_order'] = 1;



        $product_id = Product::create($savedata);

        if ($request->recommended_products && count($request->recommended_products)) {
            foreach ($request->recommended_products as $value) {
                RecommendedProducts::insert(['product_id' => $product_id->id,'recommended_id' => $value]);
            }
            // $savedata['related_videos'] = implode(',', $request->related_videos);
        }
        if(count($product_size_array)){
            foreach ($product_size_array as $key => $value) {
                $psize   = $value['size'];
                $psku    = $value['sku'];
                $pweight = $value['weight'];
                 ProductsSize::insert(['product_id' => $product_id->id,'size' => $psize, 'sku' => $psku, 'weight' => $pweight]);
            }
        }


        if ($product_id->id) {
            return redirect('/manage/products')->withSuccess('Product added Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function editproduct(Request $request, $id) {
        $product = Product::find($id);

        $productCategory = Productcategory::where('status', '!=', '3')->orderBy('sort_order', 'ASC')->get();
        $recommended_products_all = Product::join('ce_product_categories', 'ce_product_categories.id', '=', 'ce_products.product_category_id')
                        ->select('ce_products.*', 'ce_product_categories.product_category')
                        ->where('ce_products.id', '!=', $id)->where('ce_products.publish_status', '=', '1')->where('ce_product_categories.status', '!=', '3')->get();

        $recommended_products = RecommendedProducts::where('product_id', '=', $id)->get();
        $recommended_products_array = array();
        foreach ($recommended_products as $key => $value) {
            $recommended_products_array[]=$value->recommended_id;
        }

        $product_size = ProductsSize::where('product_id', '=', $id)->get();
        $product_size_array = array();
        foreach ($product_size as $key => $value) {
            $product_size_array[$key]['size']   =  $value['size'];
            $product_size_array[$key]['sku']    =  $value['sku'];
            $product_size_array[$key]['weight'] =  $value['weight'];
        }
        $sizelist = ProductsSizeList::select('size_name')->get();
        $sizelist_array = array();
        foreach ($sizelist as $key => $value) {
            $sizelist_array[$value->size_name] = ucwords($value->size_name);
        }

        $data['content'] = view('admin.product.editproduct', compact('product', 'productCategory','recommended_products_all','recommended_products_array','sizelist_array','product_size_array'));
        return view('layouts.template', $data);
    }

    public function deleteproduct(Request $request, $id) {
        $productcategory = Product::find($id);
        $productcategory->publish_status = '3';

        if ($productcategory->save()) {
            return redirect('/manage/products')->withSuccess('Product Deleted Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function editproductbyadmin(Request $request, $id) {
        $productdata = Product::find($id);

        $product_size_array = array();
        if($request->sizerange){
            $count_size=1;
            unset($request['sizerange']);
            while(true){
                if(!isset($request['product_size'.$count_size]) || !isset($request['product_sku'.$count_size]) || !isset($request['product_weight'.$count_size])){
                    break;
                }

                $pattern_sku = 'required|unique:ce_products,sku|unique:ce_products_size,sku';

                $sku_url = ProductsSize::where('sku', '=', $request['product_sku'.$count_size])->where('size', '=', $request['product_size'.$count_size])->pluck('product_id');   
                if (isset($sku_url[0]) && $sku_url[0] == $id) {
                        $pattern_sku = 'required|alpha_dash|max:100';
                }     

                $this->validate($request,['product_sku'.$count_size => $pattern_sku]);

                $product_size_array[$count_size-1]['size']   = $request['product_size'.$count_size];
                $product_size_array[$count_size-1]['sku']    = $request['product_sku'.$count_size];
                $product_size_array[$count_size-1]['weight'] = $request['product_weight'.$count_size];
                unset($request['product_size'.$count_size]);
                unset($request['product_sku'.$count_size]);
                unset($request['product_weight'.$count_size]);
                $count_size++;
            }
        }

        $savedata = $request->except(['_token', 'productImageStatus','productImage1Status','productImage2Status']);



        if ($request->productImageStatus == 1) {

            $this->validate($request, [
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
        }
        if ($request->productImage1Status == 1) {

            $this->validate($request, [
                'product_image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
        }

        if ($request->productImage2Status == 1) {

            $this->validate($request, [
                'product_image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
        }

        if ($request->productImageStatus == 1) {

            if(file_exists(public_path('/uploads/productimages/thumbs/thumb-' . $productdata->product_image)))
                unlink(public_path('/uploads/productimages/thumbs/thumb-' . $productdata->product_image));

            $image = $request->file('product_image');
            $imagename = time() . '_'. uniqid() .'.'. $image->getClientOriginalExtension();

            $thumbimageObj = Image::make($image);
            $thumbimageObj->fit(100, 100)->save(public_path('/uploads/productimages/thumbs/thumb-' . $imagename));

            $destinationPath = public_path('/uploads/productimages');
            $image->move($destinationPath, $imagename);
            $savedata['product_image'] = $imagename;
        }
        
        if ($request->productImage1Status == 1) {
            $savedata['product_image1'] = "";
            if(file_exists(public_path('/uploads/productimages/thumbs/thumb-' . $productdata->product_image1)))
                unlink(public_path('/uploads/productimages/thumbs/thumb-' . $productdata->product_image1));
            if($request->file('product_image1')){
                $image1 = $request->file('product_image1');
                $imagename1 = time() . '_'. uniqid() .'.'. $image1->getClientOriginalExtension();

                $thumbimageObj = Image::make($image1);
                $thumbimageObj->fit(100, 100)->save(public_path('/uploads/productimages/thumbs/thumb-' . $imagename1));

                $destinationPath1 = public_path('/uploads/productimages');
                $image1->move($destinationPath1, $imagename1);
                $savedata['product_image1'] = $imagename1;                
            }
        }

        if ($request->productImage2Status == 1) {

            $savedata['product_image2'] = "";    
            if(file_exists(public_path('/uploads/productimages/thumbs/thumb-' . $productdata->product_image2)))
                unlink(public_path('/uploads/productimages/thumbs/thumb-' . $productdata->product_image2));       
            if($request->file('product_image2')){
                $image2 = $request->file('product_image2');
                $imagename2 = time() . '_'. uniqid() .'.'. $image2->getClientOriginalExtension();

                $thumbimageObj = Image::make($image2);
                $thumbimageObj->fit(100, 100)->save(public_path('/uploads/productimages/thumbs/thumb-' . $imagename2));


                $destinationPath2 = public_path('/uploads/productimages');
                $image2->move($destinationPath2, $imagename2);
                $savedata['product_image2'] = $imagename2;
            }
        }

        // $url = Product::where('sku', '=', $request->sku)->where('seo_slug', '=', $request->seo_slug)->pluck('id');

        // if (isset($url[0])) {
        //     if ($url[0] == $id) {
        //         $pattern_slug = 'required|alpha_dash|max:100';
        //         $pattern_sku  = 'required|alpha_dash|max:100';
        //     }
        // } else {
        //     $pattern_slug = 'required|alpha_dash|max:100|unique:ce_products,seo_slug';
        //     $pattern_sku = 'required|alpha_dash|max:100|unique:ce_products,sku';
        // }

        $pattern_slug = 'required|alpha_dash|max:100|unique:ce_products,seo_slug';
        $pattern_sku = 'required|alpha_dash|max:100|unique:ce_products,sku';

        $sku_url = Product::where('sku', '=', $request->sku)->pluck('id');   
        
        $productsizesku_url = ProductsSize::where('sku', '=', $request->sku)->get(); 
        
        if (isset($sku_url[0]) && $sku_url[0] == $id) {
                $pattern_sku = 'required|alpha_dash|max:100';
        }     
        if(isset($productsizesku_url[0]) && ($productsizesku_url[0]['product_id'] != $id || ($productsizesku_url[0]['id'] == $id && $productsizesku_url[0]['size'] != $request->size))){
                $pattern_sku .= '|unique:ce_products_size,sku';
        }

        $slug_url = Product::where('seo_slug', '=', $request->seo_slug)->pluck('id');   
        
        if (isset($slug_url[0]) && $slug_url[0] == $id) {
                $pattern_slug = 'required|alpha_dash|max:100';
        }     

        $this->validate($request, [
            'product_name' => 'required|min:3|max:30',
            'product_description' => 'required',
            'product_category_id' => 'required',
            'price'  => 'required|numeric|min:1|max:999',
            'sku'    => $pattern_sku,
            'weight' => 'required|numeric|min:0',
            'publish_status' => 'required',
            'seo_slug' => $pattern_slug,
            'seo_keywords' => 'required',
            'seo_title' => 'required',
            'seo_description' => 'required',
        ]);
        ProductsSize::where('product_id', '=' ,$id)->delete();
        if(count($product_size_array)){
            foreach ($product_size_array as $key => $value) {
                $psize   = $value['size'];
                $psku    = $value['sku'];
                $pweight = $value['weight'];
                 ProductsSize::insert(['product_id' => $id,'size' => $psize, 'sku' => $psku, 'weight' => $pweight]);
            }
        }

        if (!isset($savedata['is_featured']))
            $savedata['is_featured'] = 0;

        RecommendedProducts::where('product_id', '=' ,$id)->delete();
        if ($request->recommended_products && count($request->recommended_products)) {
            foreach ($request->recommended_products as $value) {
                RecommendedProducts::insert(['product_id' => $id,'recommended_id' => $value]);
            }
            // $savedata['related_videos'] = implode(',', $request->related_videos);
        }
        unset($savedata['recommended_products']);
        unset($savedata['sizerange']);
        unset($savedata['addsize']);
        $productcategory = Product::where('id', $id)->update($savedata);
        if ($productcategory) {
            return redirect('/manage/products')->withSuccess('Product Updated Successfully!');
        }

        return redirect()->back()
                        ->withInput()
                        ->withErrors('Please try after some time.');
    }

    public function orderlisting(Request $request) {
        $orderObj = new Orders();

        $search = $request->query('search');
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        $orders = $orderObj->getAllOrders($search, $start_date, $end_date);

        $page = $request->query('page');

        $data['content'] = view('admin.product.orderlisting', compact('orders', 'page', 'search', 'start_date', 'end_date'));
        return view('layouts.template', $data);
    }

    public function orderexport(Request $request) {
        $orderObj = new Orders();
        $search = $request->search;
        $start_date = date($request->start_date);
        $end_date = date($request->end_date);
        if ($request->search != '' || $request->start_date != '' || $request->end_date != '') {
            $exportOrders = $orderObj->getExportOrderDetails($search, $start_date, $end_date);
        } else {

            $exportOrders = $orderObj->getExportAllOrderDetails();
        }

        function xlsBOF() {
            echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
        }

        function xlsEOF() {
            echo pack("ss", 0x0A, 0x00);
        }

        function xlsWriteNumber($Row, $Col, $Value) {
            echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
            echo pack("d", $Value);
        }

        function xlsWriteLabel($Row, $Col, $Value) {
            $L = strlen($Value);
            echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
            echo $Value;
        }

// prepare headers information
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=\"Orders" . date("Y-m-d") . ".xls\"");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Expires: 0");
// start exporting
        xlsBOF();
// first row 
        xlsWriteLabel(0, 0, "S No.");
        xlsWriteLabel(0, 1, "Order Sku.");
        xlsWriteLabel(0, 2, "First Name");
        xlsWriteLabel(0, 3, "Last Name");
        xlsWriteLabel(0, 4, "Email");
        xlsWriteLabel(0, 5, "Purchased On");
        xlsWriteLabel(0, 6, "Amount");
        xlsWriteLabel(0, 7, "Order Status");
        xlsWriteLabel(0, 8, "Payment Status");

// second row 
        $i = 1;
        foreach ($exportOrders as $key) {
            if ($key->order_status == 0) {
                $status = "Not Initiated";
            } elseif ($key->order_status == 1) {
                $status = "Pending";
            } elseif ($key->order_status == 2) {
                $status = "Awaiting Shipment";
            } elseif ($key->order_status == 3) {
                $status = "Shipped";
            } elseif ($key->order_status == 4) {
                $status = "On Hold";
            } elseif ($key->order_status == 5) {
                $status = "Cancelled";
            }


            if ($key->payment_status == 0) {
                $payment_status = "Pending";
            } elseif ($key->payment_status == 1) {
                $payment_status = "Paid";
            } elseif ($key->payment_status == 2) {
                $payment_status = "Error";
            }

            xlsWriteLabel($i, 0, $i);
            xlsWriteLabel($i, 1, $key->order_number);
            xlsWriteLabel($i, 2, $key->first_name);
            xlsWriteLabel($i, 3, $key->last_name);
            xlsWriteLabel($i, 4, $key->email);
            xlsWriteLabel($i, 5, $key->created_at);
            xlsWriteLabel($i, 6, $key->order_amount);
            xlsWriteLabel($i, 7, $status);
            xlsWriteLabel($i, 8, $payment_status);
            ++$i;
        }
        xlsEOF();
    }

    public function orderdetail(Request $request) {
        $orderObj = new Orders();
        $id = $request->query('order_id');
        $orderdetails = $orderObj->getOrderDetails($id);
        $orderItems = $orderObj->getOrderItems($id);

        return view('admin.product.orderdetail', compact('orderdetails', 'orderItems'));
    }

    public function productexport(Request $request) {


        $allProducts = Product::select('*')->where('publish_status', '!=', 3)->orderBy('id', 'asc')->get();

        function xlsBOF() {
            echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
        }

        function xlsEOF() {
            echo pack("ss", 0x0A, 0x00);
        }

        function xlsWriteNumber($Row, $Col, $Value) {
            echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
            echo pack("d", $Value);
        }

        function xlsWriteLabel($Row, $Col, $Value) {
            $L = strlen($Value);
            echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
            echo $Value;
        }

// prepare headers information
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=\"Products" . date("Y-m-d") . ".xls\"");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Expires: 0");
// start exporting
        xlsBOF();
// first row 
        xlsWriteLabel(0, 0, "id");
        xlsWriteLabel(0, 1, "Product Name");
        xlsWriteLabel(0, 2, "Product Description");
        xlsWriteLabel(0, 3, "Product Price");
        xlsWriteLabel(0, 4, "Product SKU");
        xlsWriteLabel(0, 5, "Added Date");
// second row 
        $i = 1;
        foreach ($allProducts as $key) {

            // if($key->status == 1){
            //$status ="subscribe";
            // }else{
            // $status ="Un Subscribe";
            //}
            xlsWriteNumber($i, 0, $i);
            xlsWriteLabel($i, 1, $key->product_name);
            xlsWriteLabel($i, 2, $key->product_description);
            xlsWriteLabel($i, 3, $key->price);
            xlsWriteLabel($i, 4, $key->sku);
            xlsWriteLabel($i, 5, $key->created_at);
            ++$i;
        }
        xlsEOF();
    }

    public function changeorderstatus(Request $request) {
        $orderObj = new Orders();
        try {

//            $orderdetails = $orderObj->getOrderDetails($request->input('order_id'));
//                        
//            $orderData = new \MichaelB\ShipStation\Models\Order();
//              
//            $orderData['orderNumber'] = "CHE ORDER:".$orderdetails->order_id;
//            $orderData['orderKey'] =  $orderdetails->order_id;
//            $orderData['orderDate'] = $orderdetails->order_date; 
//            
//            if($request->input('order_status')=='2')
//                $order_status = "awaiting_shipment";
//            else if($request->input('order_status')=='3')
//                $order_status = "shipped";
//            else if($request->input('order_status')=='4')
//                $order_status = "on_hold";
//            if($request->input('order_status')=='5')
//                $order_status = "cancelled";
//               
//            $orderData['orderStatus'] = $order_status;
//            $orderData['customerUsername'] = $orderdetails->first_name.''.$orderdetails->last_name;
//            $orderData['customerEmail'] = $orderdetails->email;
//
//            $orderData['billTo'] = [   "name" => $orderdetails->billing_fname.' '.$orderdetails->billing_lname,
//                                      "street1" => $orderdetails->address_line_1,
//                                      "street2" => $orderdetails->address_line_2,
//                                      "street3" => ' ',
//                                      "city" => $orderdetails->city,
//                                      "state" => $orderdetails->state,
//                                      "postalCode" => $orderdetails->zipcode,
//                                      "country" => $orderdetails->billing_country_code,
//                                      "phone" => $orderdetails->telephone,
//                                  ];
//            $orderData['shipTo'] = [   "name" => $orderdetails->shipping_fname.' '.$orderdetails->shipping_lname,
//                                      "street1" => $orderdetails->ship_address_line_1,
//                                      "street2" => $orderdetails->ship_address_line_2,
//                                      "street3" => '',
//                                      "city" => $orderdetails->ship_city,
//                                      "state" => $orderdetails->ship_state,
//                                      "postalCode" => $orderdetails->ship_zipcode,
//                                      "country" => $orderdetails->shipping_country_code,
//                                      "phone" => $orderdetails->ship_telephone
//                                  ];
//            
//            $orderItems = $orderObj->getOrderItems($request->input('order_id'));
//            
//            $orderitems = [];
//                        
//            foreach($orderItems as $orderItem){                
//                $orderitems[] = [
//                                      "sku" => $orderItem->sku,
//                                      "name" => $orderItem->product_name,
//                                      "quantity" => $orderItem->quantity,
//                                      "unitPrice" => (float)$orderItem->sale_price                      
//                                    ];
//            }
//            
//            $orderData['items'] = $orderitems;
//            $orderData['amountPaid'] = (float)$orderdetails->order_amount;  
//            $orderData["customerNotes"] = "Thanks for ordering!";
//            $orderData["paymentMethod"] = "Credit Card";
//
//            $ShipStationObj = new ShipStation();
//
//            $result = $ShipStationObj->createOrder($orderData);    
//            $result = json_decode($result);
//
//            if($result->error)
//                return json_encode(['status'=>'error', 'message'=> $result->message]);
//            else{
//                $orderObj->updateorderstatus($request->input('order_id'), $request->input('order_status'));        
//            
//                //print_r($request->input('order_status'));
//                
//                //print_r($result->response);
//            
//               // $shipstationResponse = $result->response;              
//                return json_encode(['status'=>'success']); 
//            }

            $orderObj->updateorderstatus($request->input('order_id'), $request->input('order_status'));

            return json_encode(['status' => 'success']);
        } catch (Exception $ex) {
            return json_encode(['status' => 'error', 'message' => 'Some error occured. please try again after Sometime!']);
        }
    }

}
