<!-- Content Header (Page header) -->
<script>
    var sizearray = [];
    var count=1;
</script>

<section class="content-header">
    <h1>Orders</h1>    
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

                <div class="row">
                <div class="box-body table-responsive padding user_listing">

                        <form action="{{url('manage/orders')}}" class="paddingbt10 col-md-10">
                            <div class="row">
                            <div class="col-md-3">
                                <input type="text" name='search' value='{{$search}}' class="form-control" placeholder="Search Name, Email">                        
                            </div>
                            <div class="col-md-2">
                                <input type="text" name='start_date' autocomplete="off" id='start_date' value='{{$start_date}}' class="form-control" placeholder="Start Date">                        
                            </div>
                            <div class="col-md-2">
                                <input type="text" name='end_date'  autocomplete="off" id='end_date' value='{{$end_date}}' class="form-control" placeholder="End Date">                        
                            </div>
                            <input type="submit" value="Submit" class="btn btn-success">
                        </div>
                        </form> 
                        <div class="col-md-2"> 
                            <form action="/manage/orderexport" method="post" id="export" class="export"> 
                                {{ csrf_field() }}
                                <input type="hidden" value="@if(isset($start_date)){{$start_date}}@endif" id="export_start_date" name="start_date" >
                                <input type="hidden" value="@if(isset($end_date)){{$end_date}}@endif" id="export_end_date" name="end_date" >
                                <input type="hidden" value="<?php echo $search ?>" id="search" name="search" >
                                <button class="btn btn-primary sort-row large-btn" data-text="Export">Export</button>
                            </form>   
                        </div>  
                             
                    <div class="col-md-12">  
                        <table class="table table-hover">
                            <tbody><tr>
                                    <th>S.No</th>
                                    <th>Order SKU</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Purchased On</th>
                                    <th>Amount</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>

                                <?php
                                $i = 1;
                                 if($page){
                                      $i =  env('RECORDS_PER_PAGE', 10) *  ($page-1) + 1;
                                 }
                                ?>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{$i++}}</td>
                                     <td>{{$order->order_number}}</td>
                                    <td>{{$order->first_name}}</td>
                                    <td>{{$order->last_name}}</td>                                
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->order_date}}</td>
                                    <td>{{$order->order_amount}}</td>                                
                                    <td data-id="{{$order->id}}" data-status="{{$order->order_status}}" <?php if($order->payment_status == 1){ ?>onclick="return change_order_status(this)" <?php } ?> title="Change Status">    
                                        @if ($order->order_status == 1)
                                            <span class="label label-success cursor">Pending</span>
                                            <span style="vertical-align: middle;"><a href="#"><i class="fa fa-pencil-square-o"></i></a></span>   
                                        @elseif ($order->order_status == 2)
                                            <span class="label label-success cursor">Awaiting Shipment</span>
                                        @elseif ($order->order_status == 3)
                                            <span class="label label-success cursor">Shipped</span>
                                        @elseif ($order->order_status == 4)
                                            <span class="label label-warning cursor">On Hold</span>
                                        @elseif ($order->order_status == 5)
                                            <span class="label label-warning cursor">Cancelled</span>
                                        @elseif ($order->order_status == 0)
                                            <span class="label label-warning cursor">Not Initiated</span> 

                                        @endif
                                    </td>
                                    
                                    @if ($order->payment_status == 0)
                                        <td><span class="label label-warning">Pending</span></td>
                                    @elseif ($order->payment_status == 1)
                                        <td><span class="label label-success">Paid</span></td>
                                    @elseif ($order->payment_status == 2)
                                        <td><span class="label label-warning">Error</span></td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" data-id="{{$order->id}}" onclick="return view_order(this)" class="btn btn-info btn-sm btn-flat" title="View Details"><i class="fa fa-info"></i></a>
                                        </div>	          	
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                </div>   
                <!-- /.box-body -->
                
                <div class="box-footer clearfix">                  
                    <ul class="pagination pagination-sm no-margin pull-right">                      
                      {{ $orders->appends($_GET)->links('vendor.pagination.bootstrap-4') }} 
                    </ul>
                </div>                
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>    
</section>

<div id="order_modal" class="donation-detail modal fade" role="dialog" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Details</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>        
    </div>
</div>

<div id="changestatus_modal" class="modal fade" role="dialog" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="{{url('manage/orders/change_status')}}" id="change_status_order" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Order Status</h4>
                </div>
                <div class="modal-body">                      
                    <select name="order_status" id="order_status" class="form-control">
                        <option value="1">Pending</option>
                        <option value="2">Awaiting Shipment</option>
                        <option value="3">Shipped</option>
                        <option value="4">On Hold</option>
                        <option value="5">Cancelled</option>
                    </select>
                    <input type="hidden" name="order_id" id="order_id" value="">
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>  
        </form>    
    </div>
</div>

<script src="{{ asset('js/product.js') }}"></script>

<script>
    
    $("#start_date").datepicker({
        onSelect: function(selected) {
            $("#end_date").datepicker("option","minDate", selected);
            var date = $(this).datepicker('getDate');            
            $('#end_date').val($.datepicker.formatDate('mm/dd/yy', date));        
        }
    });
    $("#end_date").datepicker(); 
    
    var start_date = "{{$start_date}}";
    var end_date = "{{$end_date}}";
    
    if(start_date && end_date){
        $("#start_date").datepicker("setDate", new Date(start_date));
        $("#end_date").datepicker("setDate", new Date(end_date));
    } 
</script>