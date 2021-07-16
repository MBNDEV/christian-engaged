<!-- Content Header (Page header) -->
<script>
    var sizearray = [];
    var count=1;
</script>
<section class="content-header">
    <h1>Edit Product Category</h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/product-categories')}}"><i class="fa fa-user"></i>Product Categories</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/productcategory/edit/'.$category->id)}}" id="edit_category" method="post">
                        {{ csrf_field() }}
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('product_category');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                    <div class="form-group {{ $class }}">
                                        <label for="">Product Category</label>
                                        <input type="text" class="form-control" name="product_category" id="product_category" value="{{(null !== old('product_category')) ? old('product_category') : $category->product_category }}" placeholder="Product Category" autocomplete="off"> @if ($error)
                                        <span class="help-block">
                                        {{ $error }}
                                    </span> @endif
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
                                    <label for="">Status</label> 
                                    <select name="status" class="form-control">
                                    <option value="1"  {{ (null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' : $category->status == "1" ? 'selected='.'"selected"' : '' }} >Active</option>
                                    <option value="0" {{ (null !== old('status')) ? old('status')=="0" ? 'selected='.'"selected"' : '' : $category->status == "0" ? 'selected='.'"selected"' : '' }} >Inactive</option>
                                </select> @if ($error)
                                    <span class="help-block">
                                    {{ $error }}
                                </span> @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('slug');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                    <div class="form-group {{ $class }}">
                                        <label for="">Product Slug</label>
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{(null !== old('slug')) ? old('slug') : $category->slug }}" placeholder="Product Slug" autocomplete="off"> @if ($error)
                                        <span class="help-block">
                                        {{ $error }}
                                    </span> @endif
                                    </div>
                            </div>
                            
                            
                        </div>
                                               
                        
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('/manage/product-categories')}}">Cancel</a>
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