<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Donations</h1>
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

                    <div class="col-md-10">
                        <form action="{{url('manage/donations')}}" class="paddingbt10">
                            <div class="row">
                            <div class="col-md-3">
                                <input type="text" autocomplete="off" name='search' value='{{$search}}' class="form-control" placeholder="Search Name, Email">
                            </div>
                            <div class="col-md-2">
                                <select name="goal_id" id="goal_id1" class="form-control">
                                    <option value="">Select Goal</option>
                                    <?php foreach ($goals as $goal) { ?>
                                            <option value="{{$goal->id}}" {{($goal->id==$goal_id) ? 'selected=selected':''}} >{{$goal->title}}</option>
                                    <?php } ?>

                                </select>
                            </div>

                            <input type="submit" value="Submit" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <form action="/manage/donationexport" method="post" id="export" class="export">
                            {{ csrf_field() }}
                            <input type="hidden" name="goal_id" value="{{$goal_id}}">
                             <input type="hidden" name="search" value="{{$search}}">
                            <button class="btn btn-primary sort-row large-btn" data-text="Export">Export</button>
                        </form>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody><tr>
                                    <th>S.No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Donation Date</th>
                                    <th>#Goal</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Donation Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                                <?php
                                $i = 1;
                                 if($page){
                                      $i =  env('RECORDS_PER_PAGE', 10) *  ($page-1) + 1;
                                 }
                                ?>
                                @foreach ($donations as $donation)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$donation->first_name}}</td>
                                    <td>{{$donation->last_name}}</td>
                                    <td>{{$donation->email}}</td>
                                    <td>{{$donation->donation_date}}</td>
                                    <td>{{$donation->title}}</td>
                                    <td>{{$donation->donation_amount}}</td>
                                    @if ($donation->payment_status == 0)
                                        <td><span class="label label-warning">Pending</span></td>
                                    @elseif ($donation->payment_status == 1)
                                        <td><span class="label label-success">Paid</span></td>
                                    @elseif ($donation->payment_status == 2)
                                        <td><span class="label label-warning">Error</span></td>
                                    @endif
                                    <td>
                                        @if ($donation->is_recurring == 1)
                                            <span class="label label-success">Monthly</span>
                                        @else
                                            <span class="label label-success">Onetime</span>
                                        @endif
                                    </td>
                                    <td>
                                      @if ($donation->active_status == 1)
                                          <span class="label label-success">Active</span>
                                      @else($donation->active_status == 0)
                                          <span class="label label-warning">Inactive</span>
                                      @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="javascript:void(0)"  title="View Details" data-id="{{$donation->id}}" onclick="return view_donation_details(this, {{$donation->is_recurring}})" class="btn btn-info btn-sm btn-flat"><i class="fa fa-info"></i></a>
                                        </div>
                                        @if ($donation->is_recurring == 1 && $donation->active_status == 1)
                                            <div class="btn-group">
                                                <a href="javascript:void(0)"  title="Cancel Monthly Donation" data-id="{{$donation->id}}" onclick="return close_monthly_donation(this)" class="btn btn-info btn-sm btn-flat"><i class="fa fa-times"></i></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
                </div>
                <form action="{{url('manage/donations/close-monthly-recurring')}}" id="close-monthly-recurring" method="post" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                  <input type="hidden" name="donation_id" id="donation_id" value="">
                </form>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">

                      {{ $donations->appends($_GET)->links('vendor.pagination.bootstrap-4') }}

                    </ul>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<div id="donation_modal" class="modal fade donation-detail" role="dialog" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="width: 700px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Donation Details</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/donation.js') }}"></script>
<script>
$('#goal_id').select2();
</script>
