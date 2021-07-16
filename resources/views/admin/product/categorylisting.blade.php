<!-- Content Header (Page header) -->
<script>
    var sizearray = [];
    var count=1;
</script>
<section class="content-header">
    <h1>Product Categories</h1>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        <button class="btn btn-primary sort-row  margin-left-10" data-text="Enable Sorting">Enable Sorting</button>
                        <button style="display:none" class="btn btn-primary save-product-sort" data-text="Save Sorting">Save Sorting</button>

                        <button style="display:none" class="btn btn-danger  margin-left-10" id="cancel" data-text="Enable Sorting">Cancel</button>

                        <a href="{{url('manage/productcategory/add')}}" class="btn btn-info btn-flat">Add New Category</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive padding user_listing">
                    <table class="table table-hover">
                        <tbody><tr  class="disable-sort-item">
                                <th>S.No</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tbody>
                        <tbody>
                            <?php $i = 1; ?>                           
                            @foreach ($products as $product)
                            <tr id="<?=$product->id?>">
                                <td>{{$i++}}</td>
                                <td>{{ucfirst($product->product_category)}}</td>
                                @if ($product->status == 1)
                                <td><span class="label label-success">Active</span></td>
                                @else
                                <td><span class="label label-warning">Inactive</span></td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/productcategory/edit/'.$product->id)}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil"></i></a>
                                       
                                        <a href="javascript:void(0)" data-url="{{url('manage/productcategory/delete/'.$product->id)}}" class="btn btn-danger btn-sm btn-flat delete"><i class="fa fa-trash"></i></a>
                                    </div>	          	
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
   
            </div>
            <!-- /.box -->
        </div>
    </div>
    
</section>

<script src="{{ asset('js/product.js') }}"></script>