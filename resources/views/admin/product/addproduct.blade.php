<!-- Content Header (Page header) -->
<script>
    var sizearray = <?php echo json_encode($sizelist_array);?>;
    var count=1;
</script>
<section class="content-header">
    <h1>Add Product</h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/product-categories')}}"><i class="fa fa-user"></i>Product</a></li>
        <li class="active">Create</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/product/add')}}" id="add_category" enctype= multipart/form-data method="post">
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
                                    <input type="text" class="form-control" maxlength="50" name="product_name" id="product_name" value="{{ old('product_name') }}" placeholder="Enter Product Name">
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
                                    <label for="product_category_id">Product Category</label>
                                    <!-- <input type="text" class="form-control" name="product_category_id" id="product_category_id" value="{{ old('product_category_id') }}" placeholder="Enter Product Category"> -->
                                     <select name="product_category_id" id="product_category_id" class="form-control">
                                        <option value="">Select Category</option>
                                     @foreach($products_category as $product_category) 
                                       <option value="{{$product_category->id}}" >{{$product_category->product_category}} </option>
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
                                    <input type="number" class="form-control" min="0" name="price" id="price" value="{{ old('price') }}" placeholder="Enter Product Prize">
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
                                    <label for="seo_slug">Product Slug</label>
                                    <input type="text" class="form-control" maxlength="50" name="seo_slug" id="seo_slug" value="{{ old('seo_slug') }}" placeholder="Slug">
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
                                    <label for="seo_keywords">Product Meta Keywords</label>
                                    <input type="text" class="form-control" maxlength="50" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords') }}" placeholder="Keywords">
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
                                    <label for="seo_title">Product Meta Title</label>
                                    <input type="text" class="form-control" maxlength="50" name="seo_title" id="seo_title" value="{{ old('seo_title') }}" placeholder="Keywords">
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
                                    <label for="seo_description">Product Meta Description</label>
                                    <input type="text" class="form-control" maxlength="100" name="seo_description" id="seo_description" value="{{ old('seo_description') }}" placeholder="Seo Meta Description">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="size" id="size" value="">
                              <!-- <div class="col-md-6">
                                <?php
                                // $error = $errors->first('size');
                                // $class = '';
                                // if($error){
                                // $class = 'has-error';    
                                // }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_description">Product Size</label>
                                    <input type="text" class="form-control" maxlength="100" name="size" id="size" value="{{ old('size') }}" placeholder="Size">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> -->    
                        
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('publish_status');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }                               
                                ?>
                                <div class="form-group {{ $class }}">  
                                    <label for="">Publish Status</label>
                                    <select name="publish_status" class="form-control">   
                                    <option value="1"  {{ (null !== old('publish_status')) ? old('publish_status')=="1" ? 'selected='.'"selected"' : '' : '' }} >Active</option>
                                    <option value="2" {{ (null !== old('publish_status')) ? old('publish_status')=="2" ? 'selected='.'"selected"' : '' : '' }} >Inactive</option>
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
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="price">SKU</label>
                                    <input type="text" class="form-control" maxlength="50" name="sku" id="sku" value="{{ old('sku') }}" placeholder="SKU">
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
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="weight">Product Weight</label>
                                    <input type="number" class="form-control" min="0" name="weight" id="weight" value="{{ old('weight') }}" placeholder="Enter Product weight">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
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
                                    <input type="file" class="form-control" name="product_image" id="product_image" value="{{ old('product_image') }}" placeholder="Enter Product Image">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
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
                                    <input type="file" class="form-control" name="product_image1" id="product_image1" value="{{ old('product_image1') }}" placeholder="Enter Product Image 1">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
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
                                    <input type="file" class="form-control" name="product_image2" id="product_image2" value="{{ old('product_image2') }}" placeholder="Enter Product Image 2">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> 
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recommended_products">Recommended Products</label>
                                    <select id="recommended_products" name="recommended_products[]" multiple class="form-control" >
                                        <?php foreach($products as $product){ ?>
                                            <option value='<?php echo $product->id ?>'><?php echo $product->product_name ?></option>
                                        <?php } ?>
                                    </select>  
                                </div>
                            </div>   

                            <div class="col-md-3">
                                    <input type="hidden" name="sizerange" id="sizerange" value="0">
                                    <label for="size">Product Size Required </label>
                                    <div id="size">
                                        <label class="radio-inline">
                                          <input type="radio" class="addsize" id="sizeyes" name="addsize" >Yes
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" class="addsize" id="sizeno" name="addsize" checked="">No
                                        </label>
                                    </div>
                            </div>
                            <div class="col-md-12" id="sizearea" style="display: none;">
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
                                    <label for="product_description">Product Description</label>

                                    <!-- <input type="text" class="form-control" name="product_description" id="product_description" value="{{ old('product_description') }}" placeholder="Enter Product Description"> -->

                                    <textarea id="product_description"  name="product_description" rows="10" cols="80">
                                       {{ old('product_description') }}
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
                                   <input type="checkbox" name="is_featured" id="is_featured" value="1" checked>
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
<script src="{{ asset ("js/product.js") }}"></script>
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


<?php $recommended_products = json_encode(old('recommended_products')); ?>
//Set vals
$("#recommended_products").val(<?php echo $recommended_products; ?>);
// Then refresh
$("#recommended_products").multiselect("refresh");


</script>