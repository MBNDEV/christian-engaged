<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title or "Content Management System" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('manage/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li class="active">Cms</li>
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
                        <a href="{{url('manage/cms/create')}}" class="btn btn-info btn-flat">Create New Page</a>
                        <!--                        <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        
                                                    <div class="input-group-btn">
                                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>-->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                                <th>S.No</th>
                                <th>Page Title</th>
                                <th>Page Url</th>
<!--                                <th>Page Content</th>-->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            $i = 1;
                            ?>
                            @foreach ($cms as $_cms)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$_cms->page_title}}</td>
                                <td>{{$_cms->page_url}}</td>
                                
<!--                                <td>{{$_cms->page_content}}</td>-->
                                
                                @if ($_cms->publish_status == 1)
                                <td><span class="label label-success">Active</span></td>
                                @else
                                <td><span class="label label-warning">Inactive</span></td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/cms/edit/'.$_cms->id)}}" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                                        
                                        @if ($_cms->id != 1)
                                        <a href="javascript:void(0)" data-url="{{url('cms/delete/'.$_cms->id)}}" class="btn btn-danger btn-flat delete"><i class="fa fa-trash"></i></a>
                                        @endif
<!--                                        <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>-->
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

<script src="{{ asset('js/cms.js') }}"></script>