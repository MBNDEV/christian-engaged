<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h1>Socials Videos</h1>    
        </div>  
    </div>
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
                
                <!-- /.box-header -->
                <div class="box-body table-responsive padding user_listing">
                    <table class="table table-hover">
                        <tbody><tr class="disable-sort-item">
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Video Image</th>
                                <th>Video Url</th>
                                <th>Video Description</th>
                                <th>Action</th>
                                
                            </tr></tbody><tbody>

                            <?php $i = 1; ?>                           
                            @foreach ($socialvideos as $video) 
                            <tr id="<?=$video->id?>">
                                <td class="serial_no">{{$i++}}</td>
                                <td>{{ucfirst($video->video_title)}}</td>
                               <td><img src="{{asset('/uploads/videoimages/'.$video->video_image) }}" width="80" onerror="this.src='{{asset("/images/no_image.png") }}'">
                                </td>
                                <td>{{$video->video_url}}</td>
                                <td>{{$video->video_description}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/videossocials/edit/'.$video->id)}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil"></i></a>
                                       
                                        <a href="javascript:void(0)" data-url="{{url('manage/videossocials/delete/'.$video->id)}}" class="btn btn-danger btn-sm btn-flat delete"><i class="fa fa-trash"></i></a>
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

<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/video.js') }}"></script>