<!-- Content Header (Page header) -->
<script>
    var sizearray = [];
    var count=1;
</script>

<section class="content-header">
    <h1>Manage Products</h1>
    
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
                <div class="box-header col-xs-12">
                   
                    <div class="col-md-2 pull-right">
                        <a href="{{url('manage/product/add')}}" class="btn btn-info btn-flat">Add New Product</a>
                    </div>
                     <div class="col-md-2 pull-right">
                     <form action="/manage/productexport" method="post" id="export" class="export"> 
            {{ csrf_field() }}
           
                <button class="btn btn-primary sort-row large-btn" data-text="Export">Export</button>
          
        </form>
          </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive padding user_listing">
                    <table class="table table-hover">
                        <tbody><tr>
                                <th>S.No</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Catagory Name</th>
                                <th>Is Featured</th>
                                <th>Published Status</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>

                            <?php $i = 1; ?>                           
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ucfirst($product->product_name)}}</td>
                                <td>{{strip_tags($product->product_description)}}</td>
                                <td>{{$product->cataogyName}}</td>
                                <td>
                                  @if ($product->is_featured == 1)
                                        <span class="label label-success">Yes</span>
                                    @else
                                        <span class="label label-warning">No</span>
                                    @endif
 
                                </td>
                                <td>
                                    @if ($product->publish_status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>{{$product->price}}</td>                                
                                
                                <td>
                                    <div class="btn-group wdt70">
                                        <a href="{{url('manage/product/edit/'.$product->id)}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil"></i></a>
                                       
                                        <a href="javascript:void(0)" data-url="{{url('manage/product/delete/'.$product->id)}}" class="btn btn-danger btn-sm btn-flat delete"><i class="fa fa-trash"></i></a>
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