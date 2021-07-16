<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>User Management</h1>    
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
                        <a href="{{url('manage/users/register')}}" class="btn btn-info btn-flat">Create New User</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <form method="post" name="bulkuserUpdate" id="bulkuserUpdate" action="{{url('manage/users/bulkUserUpdate')}}">
                    <div style="display: none" class="option-icon " id="change_status_user">                
                        <span class="change_status btn-success" data-val="1">
                            <i title="Enable" class="bulk_action_form fa fa-check-square-o text-success"></i>
                        </span>
                        <span class="change_status" data-val="2">
                            <i title="Disable" class="bulk_action_form fa fa-ban text-danger"></i>
                        </span>
                        <span class="change_status" data-val="3">
                            <i title="Delete" class="bulk_action_form fa fa-trash-o text-danger"></i>
                        </span>
                    </div>

                    <div class="box-body table-responsive padding user_listing">

                        <table class="table table-hover">
                            <tbody><tr>
                                    <th>
                                        <input type="checkbox" name="check_all_user" value="1" id="check_all_user" />
                                    </th>
                                    <th>S.No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                                <?php
                                $i = 1;
                                 if($page){
                                      $i =  env('RECORDS_PER_PAGE', 10) *  ($page-1) + 1;
                                 }
                                ?>
                                @foreach ($users as $user)
                                <tr>
                                    <td><input name="check_user[]" data-id="{{$user->id}}" type="checkbox"></td>
                                    <td>{{$i++}}</td>
                                    <td>{{ucfirst($user->first_name)}}</td>
                                    <td>{{ucfirst($user->last_name)}}</td>                                
                                    <td>{{$user->email}}</td>
                                    @if ($user->status == 1)
                                    <td><span class="label label-success">Active</span></td>
                                    @else
                                    <td><span class="label label-warning">Inactive</span></td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{url('manage/users/edit/'.$user->id)}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil"></i></a>

                                            <a href="javascript:void(0)" data-url="{{url('manage/users/delete/'.$user->id)}}" class="btn btn-danger btn-sm btn-flat delete"><i class="fa fa-trash"></i></a>
                                        </div>	          	
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                <!-- /.box-body -->
                
                </form>
                
                <div class="box-footer clearfix">                  
                    <ul class="pagination pagination-sm no-margin pull-right">
                      
                      {{ $users->links('vendor.pagination.bootstrap-4') }}
 
                    </ul>
                </div>                
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    
</section>

<script src="{{ asset('js/user.js') }}"></script>