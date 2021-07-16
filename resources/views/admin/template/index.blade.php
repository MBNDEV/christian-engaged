<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Manage Template</h1>   
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                                <th>S.No</th>

                                <th>Subject</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                            <?php
                            $i = 1;
                            ?>
                            @foreach ($templates as $template)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$template->subject}}</td>
                                <td>@if ($template->publish_status == 1) 
                                    Active
                                    @else
                                    Inactive
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/templates/edit/'.$template->id)}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil"></i></a>

                                    </div>	          	
                                </td>
                            </tr>
                            @endforeach
                        </tbody></table>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer clearfix">                  
                    <ul class="pagination pagination-sm no-margin pull-right">                      
                      {{ $templates->links('vendor.pagination.bootstrap-4') }} 
                    </ul>
                </div>
                
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
