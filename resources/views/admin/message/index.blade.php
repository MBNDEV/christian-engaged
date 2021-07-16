<!-- Content Header (Page header) -->

<section class="content-header">
    <h1>
        {{ $page_title or "Message Management System" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('manage/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li class="active">Message Management</li>
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
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                       <!--  <a href="{{url('manage/message/create')}}" class="btn btn-info btn-flat">Create New Message</a> -->
            <!--   <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
            -->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                                <th>S.No</th>
                                <th>Message Name</th>
                                <th>Message</th>
<!--                                <th>Status</th>-->
                                <th>Action</th>
                            </tr>

                            <?php
                            $i = 1;
                            ?>
                            @foreach ($messages as $message)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$message->name}}</td>
                                <td>{{$message->value}}</td>
<!--                                @if ($message->publish_status == 1)
                                <td><span class="label label-success">Active</span></td>
                                @else
                                <td><span class="label label-warning">Inactive</span></td>
                                @endif-->
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/message/edit/'.$message->id)}}" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                                    </div>	          	
                                </td>
                            </tr>
                            @endforeach
                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>