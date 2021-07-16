<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Donation Goals</h1>
    
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
                
                  @if($errors->any())
                <div class="alert alert-error">{{$errors->first()}}</div>
                  @endif

                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        <a href="{{url('manage/donation-goals/addgoal')}}" class="btn btn-info btn-flat">Add New Goal</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive padding user_listing">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Goal Amount</th>
                                 <th>Created Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            <?php $i = 1; ?>                           
                            @foreach ($goals as $goal)
                            <tr>
                                <td class="serial_no">{{$i++}}</td>
                                <td>{{ucfirst($goal->title)}}</td>
                                <td>${{$goal->goal_amount}}</td>
                                <td>{{$goal->created_at}}</td>
                                @if ($goal->status == 1)
                                <td><span class="label label-success">Active</span></td>
                                @else
                                <td><span class="label label-warning">Inactive</span></td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/donation-goals/editgoal/'.$goal->id)}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil"></i></a>
                                       
                                        <a href="javascript:void(0)" data-url="{{url('manage/donation-goals/deletegoal/'.$goal->id)}}" class="btn btn-danger btn-sm btn-flat delete"><i class="fa fa-trash"></i></a>
                                    </div>	          	
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
   
            
            <!-- /.box -->
        </div>
    </div>
    
</section>

<script src="{{ asset('js/donation.js') }}"></script>