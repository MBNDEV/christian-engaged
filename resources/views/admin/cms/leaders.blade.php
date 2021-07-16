<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Leaders
    </h1>
    
    <ol class="breadcrumb">
        <li><a href="{{url('manage/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li class="active">Leaders</li>
    </ol>
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
                <div class="box-header ">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        <a href="{{url('manage/cms/create-leader')}}" class="btn btn-info btn-flat">Create New Leader</a>                       
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix paddingb10"></div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Short Description</th>
                                <th>Status</th>
                                <th width="8%">Action</th>
                            </tr>

                            <?php
                            $i = 1;
                            ?>
                            @if($leaders->count())
                                @foreach ($leaders as $leader)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$leader->name}}</td>
                                    <td>{{$leader->designation}}</td>                                
                                    <td>{{$leader->short_description}}</td>

                                    @if ($leader->status == 1)
                                    <td><span class="label label-success">Active</span></td>
                                    @else
                                    <td><span class="label label-warning">Inactive</span></td>
                                    @endif

                                    <td>
                                        <div class="btn-group">
                                            <a href="{{url('manage/cms/edit-leader/'.$leader->id)}}" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:void(0)" data-url="{{url('manage/cms/delete-leader/'.$leader->id)}}" class="btn btn-danger btn-flat delete"><i class="fa fa-trash"></i></a>
                                        </div>	          	
                                    </td>
                                </tr>
                                @endforeach
                            @else    
                                <tr>
                                    <td colspan="6">No Leaders found</td>
                                </tr>
                            @endif    
                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<script src="{{ asset('js/leaders.js') }}"></script>