<!-- Content Header (Page header) -->
<?php
 $count = 1;
 $check_size=false;
 if(count($product_size_array)){
    $count = count($product_size_array);
    $check_size = true;    
 }
?>
<script>
    var sizearray = <?php echo json_encode($sizelist_array);?>;
    var count= <?php echo $count;?>;
    var productid = <?php echo $product->id;?>;
</script>
<?php $recommended_products = json_encode((old('recommended_products'))?old('recommended_products'):$recommended_products_array); ?>
<section class="content-header">
    <h1>Edit Product</h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/product-categories')}}"><i class="fa fa-user"></i>Product</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/productedit/edit/'.$product->id)}}" id="add_category" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('product_name');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" maxlength="50" id="product_name"  value="{{(null !== old('product_name')) ? old('product_name') : $product->product_name }}" placeholder="Enter Product Name">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('product_category_id');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="product_name">Product Category</label>
                                   
                                    <select name="product_category_id" id="product_category_id" class="form-control">
                                        <option value ="">Select Category</option>
                                     @foreach($productCategory as $product1) 
                                       <option value="{{$product1->id}}" @if($product1->id == $product->product_category_id ) selected @else ; @endif > {{$product1-> product_category}} </option>
                                        
                                            @endforeach
                                       </select>

                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> 

                             <div class="col-md-6">
                                <?php
                                $error = $errors->first('price');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="price">Product Price</label>
                                    <input type="number" min="0" class="form-control" name="price" id="price"
                                     value="{{(null !== old('price')) ? old('price') : $product->price }}" placeholder="Enter Product Prize">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> 


                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('seo_slug');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_slug">SEO Slug</label>
                                    <input type="text" class="form-control" maxlength="50" name="seo_slug" id="seo_slug" value="{{(null !== old('seo_slug')) ? old('seo_slug') : $product->seo_slug }}" placeholder="SEO Slug">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('seo_keywords');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_keywords">SEO Meta Keywords</label>
                                    <input type="text" maxlength="50" class="form-control" name="seo_keywords" id="seo_keywords" value="{{(null !== old('seo_keywords')) ? old('seo_keywords') : $product->seo_keywords }}" placeholder="SEO Meta Keywords">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('seo_title');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_title">SEO Meta Title</label>
                                    <input type="text" maxlength="50" class="form-control" name="seo_title" id="seo_title" value="{{(null !== old('seo_title')) ? old('seo_title') : $product->seo_title }}" placeholder="SEO Meta Title">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <?php
                                $error = $errors->first('seo_description');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_description">SEO Meta Description</label>
                                    <input type="text" class="form-control" maxlength="100" name="seo_description" id="seo_description" value="{{(null !== old('seo_description')) ? old('seo_description') : $product->seo_description }}" placeholder="SEO Meta Description">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('status');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }                               
                                ?>
                                <div class="form-group {{ $class }}">  
                                    <label for="">Publish Status</label>
                                    <select id="publish_status" name="publish_status" class="form-control">
                                    <option value="1" {{(null !== old('publish_status')) ? old('publish_status')=="1" ? 'selected='.'"selected"' : '' : $product->publish_status == "1" ? 'selected='.'"selected"' : '' }} >Active</option>
                                    <option value="2" {{(null !== old('publish_status')) ? old('publish_status')=="2" ? 'selected='.'"selected"' : '' : $product->publish_status == "2" ? 'selected='.'"selected"' : '' }} >Inactive</option>
                                </select> @if ($error)
                                    <span class="help-block">
                                    {{ $error }}
                                </span> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('sku');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                                $sku_disable = "";
                                $product_sku = (null !== old('sku')) ? old('sku') : $product->sku;
                                if($check_size){
                                    $sku_disable = "disabled";
                                    // $product_sku = "";
                                }

                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="price">SKU</label>
                                    <input type="text" class="form-control" maxlength="50" name="sku" id="sku" {{$sku_disable}} value="{{$product_sku}}"  placeholder="SKU">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('weight');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                                $weight_disable = "";
                                $product_weight = (null !== old('weight')) ? old('weight') : $product->weight;
                                if($check_size){
                                    // $product_weight = "";
                                    $weight_disable = "disabled";
                                }

                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_description">Weight</label>
                                    <input type="text" class="form-control" maxlength="100" min="0" name="weight" id="weight" {{$weight_disable}} value="{{$product_weight}}" placeholder="Weight">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="size" id="size" value="{{$product->size}}">

                            <!-- <div class="col-md-6">
                                <?php
                                // $error = $errors->first('size');
                                // $class = '';
                                // if($error){
                                // $class = 'has-error';    
                                // }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_description">Size</label>
                                    <input type="text" class="form-control" maxlength="100" name="size" id="size" value="{{(null !== old('size')) ? old('size') : $product->size }}" placeholder="Size">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> -->
                            <?php
                                    $sizerange_check = 0;
                                    $yes_check = '';
                                    $no_check  = 'checked';
                                    $display_check = 'style="display: none;"';
                                    if($check_size){
                                        $sizerange_check = 1;
                                        $yes_check = 'checked';
                                        $no_check  = '';
                                        $display_check = 'style="display: block;"';
                                    }
                                ?>
                                    <div class="col-md-3">
                                            <input type="hidden" name="sizerange" id="sizerange" value="{{$sizerange_check}}">
                                            <label for="size">Product Size Required </label>
                                            <div id="size">
                                                <label class="radio-inline">
                                                  <input type="radio" class="addsize" id="sizeyes" name="addsize" {{$yes_check}}>Yes
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" class="addsize" id="sizeno" name="addsize" {{$no_check}}>No
                                                </label>
                                            </div>
                                    </div>
                                    <div class="col-md-12" id="sizearea" {{$display_check}}>
                                        <?php
                                        $optionstr='';
                                            if($check_size){
                                                $check_remove = ' disabled="" style="display:none;"';
                                                if(count($product_size_array) > 1){
                                                    $check_remove= '';
                                                }

                                                echo '<div class="row"> <div class="col-md-6"> <button class="btn btn-primary" type="button" id="addsizebtn">Add Size</button> <button type="button" class="btn btn-danger" id="removesizebtn" '.$check_remove.'>Remove last row</button> </div></div>';
                                                foreach ($product_size_array as $key => $value) {
                                                    $optionstr = '';
                                                    foreach ($sizelist_array as $keylist => $valuelist) {
                                                        if(strtolower($keylist) == strtolower($value['size']))
                                                            $optionstr .= '<option value="'.$keylist.'" selected>'.$valuelist.'</option>';
                                                        else
                                                            $optionstr .= '<option value="'.$keylist.'">'.$valuelist.'</option>';

                                                    }
                                                    echo '<div class="row sizearea'.($key+1).'"> <div class="col-md-2"> <label for="product_size'.($key+1).'">Product Size</label> <select class="form-control" name="product_size'.($key+1).'" id="product_size'.($key+1).'" value="'.$value['size'].'"> '.$optionstr.'</select> <span class="help-block" id="product_size_error'.($key+1).'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_sku'.($key+1).'">Product SKU </label> <input type="text" class="form-control" maxlength="50" class="form-control" name="product_sku'.($key+1).'" id="product_sku'.($key+1).'" value="'.$value['sku'].'" placeholder="Enter Product SKU"> <span class="help-block" id="product_sku_error'.($key+1).'" style="color:red;"> </span> </div> <div class="col-md-2"> <label for="product_weight'.($key+1).'">Product Weight </label> <input type="number" class="form-control" min="0" name="product_weight'.($key+1).'" id="product_weight'.($key+1).'" value="'.$value['weight'].'" placeholder="Enter Product Weight"> <span class="help-block" id="product_weight_error'.($key+1).'" style="color:red;"> </span> </div> </div>';
                                                }
                                            }

                                        ?>
                                    </div>

                            <div class="col-md-2">
                                <?php
                                $error = $errors->first('product_image');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="product_name">Product Image</label>
                                    <input type="file" class="form-control" name="product_image" disabled id="productImage" value="{{(null !== old('product_image')) ? old('product_image') : $product->product_image }}" placeholder="Enter Product Image">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                                <input type="hidden" name="productImageStatus" value="0" class="form-control" id="profileImageStatus">
                                   <div class="product_pic_div" id="product_pic_div">
                                     <img id="product_image" src="{{asset('/uploads/productimages/'.$product->product_image) }}" width="100">
                                     <button id="removeProductImage" type="button" title="Remove Product Image" class="remove">×</button>
                                  </div>
                            </div> 

                            <div class="col-md-2">
                                <?php
                                $error = $errors->first('product_image1');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="product_name1">Product Image 1</label>
                                    <input type="file" class="form-control" name="product_image1" disabled id="productImage1" value="{{(null !== old('product_image1')) ? old('product_image1') : $product->product_image1 }}" placeholder="Enter Product Image 1">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                                <input type="hidden" name="productImage1Status" value="0" class="form-control" id="profileImage1Status">
                                   <div class="product_pic_div" id="product_pic1_div">
                                     <img id="product_image1" src="{{asset('/uploads/productimages/'.$product->product_image1) }}" width="100">
                                     <button id="removeProductImage1" type="button" title="Remove Product Image 1" class="remove">×</button>
                                  </div>
                            </div> 


                            <div class="col-md-2">
                                <?php
                                $error = $errors->first('product_image2');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="product_name2">Product Image 2</label>
                                    <input type="file" class="form-control" name="product_image2" disabled id="productImage2" value="{{(null !== old('product_image2')) ? old('product_image2') : $product->product_image2 }}" placeholder="Enter Product Image 2">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                                <input type="hidden" name="productImage2Status" value="0" class="form-control" id="profileImage2Status">
                                   <div class="product_pic_div" id="product_pic2_div">
                                     <img id="product_image2" src="{{asset('/uploads/productimages/'.$product->product_image2) }}" width="100">
                                     <button id="removeProductImage2" type="button" title="Remove Product Image 2" class="remove">×</button>
                                  </div>
                            </div> 

                            

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="recommended_products">Recommended Products</label>
                                        @if (count($recommended_products_all))
                                            <select id="recommended_products" name="recommended_products[]" multiple class="form-control" >
                                                <?php foreach($recommended_products_all as $product1){ ?>
                                                    <option value='<?php echo $product1->id ?>'><?php echo $product1->product_name ?></option>
                                                <?php } ?>
                                            </select>  

                                        @else
                                            <select id="recommended_products" name="recommended_products[]"  multiple class="form-control" >

                                            </select>  
                                        @endif
                                    </div>
                                </div>  

                                                        
                                <div class="col-md-12">
                                    <?php
                                    $error = $errors->first('product_description');
                                    $class = '';
                                    if($error){
                                    $class = 'has-error';    
                                    }
                                   
                                    ?>
                                    <div class="form-group {{ $class }}">
                                        <label for="product_name">Product Description</label>

                                        <!-- <input type="text" class="form-control" name="product_description" id="product_description"  value="{{(null !== old('product_description')) ? old('product_description') : $product->product_description }}" placeholder="Enter Product Description"> -->
                                        

                                        <textarea id="product_description"  name="product_description" rows="10" cols="80">
                                           {{(null !== old('product_description')) ? old('product_description') : $product->product_description }}
                                        </textarea>

                                        @if ($error)
                                        <span class="help-block">
                                            {{ $error }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            
                            <div class="col-md-6">
                                <label for="" style="margin-top: 37px;">Is Featured</label>
                                   <input type="checkbox" name="is_featured" id="is_featured" value="1" @if($product->is_featured == 1) checked @endif>
                            </div>
                            
                       
                        
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" id="submitbtn" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('manage/products')}}">Cancel</a>
                            </div>

                        </div>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<script src="{{asset('js/productedit.js')}}"></script>
<script>

$('#recommended_products').multiselect({
    buttonWidth: '100%',   
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true, 
    filterPlaceholder: 'Search Products',
    numberDisplayed: 4,
    buttonText: function(options, select) {
        if (options.length === 0) {
            return 'Select Recommended Product(s)';
        }
        else{
            return options.length+' Product(s) selected';
        }
    },
    onChange: function(option, checked) {
        // Get selected options.
        var selectedOptions = jQuery('#recommended_products option:selected');

        if (selectedOptions.length >= 4) {
          if (selectedOptions.length > 4) {
            alert('Too many selected (' + selectedOptions.length + ')');
          } else {
            // Disable all other checkboxes.
            var nonSelectedOptions = jQuery('#recommended_products option').filter(function() {
              return !jQuery(this).is(':selected');
            });

            nonSelectedOptions.each(function() {
              var input = jQuery('input[value="' + jQuery(this).val() + '"]');
              //console.log(input);
              input.prop('disabled', true);
              input.parent('li').addClass('disabled');
            });
            jQuery('#is_featured').prop('disabled', false);
            jQuery('#topic_id').prop('disabled', false);
          }
        } else {
          // Enable all checkboxes.
          jQuery('#recommended_products option').each(function() {
            var input = jQuery('input[value="' + jQuery(this).val() + '"]');
            input.prop('disabled', false);
            input.parent('li').addClass('disabled');
          });
        }
    }
});

//Set vals
$("#recommended_products").val(<?php echo $recommended_products; ?>);
// Then refresh
$("#recommended_products").multiselect("refresh");


</script>