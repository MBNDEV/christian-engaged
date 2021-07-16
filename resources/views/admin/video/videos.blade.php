<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h1>Videos</h1>    
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
                <div class="box-header">

                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="selectTopicFilter">
                                <option value="all"> All Videos</option>
                                @foreach($videoTopic as $topic)

                                <option value="{{$topic->id}}" @if($topic->id == request()->segment(3)) selected @else ; @endif >{{$topic->video_topic}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{url('manage/new-videos/')}}" class="btn btn-primary">New Video</a>
                        </div>
                        <div class="col-md-6">
                             @if(request()->segment(3)!='')
                            <div class="right">
                                @if($videos->count())
                                    <button class="btn btn-primary sort-row " data-text="Enable Sorting">Enable Sorting</button>
                                    <button class="btn btn-danger margin-left-10 hide" id='cancel-video' data-text="Cancel">Cancel</button>
                                    <button style="display:none" data-url="{{url('manage/videos/sortVideos')}}"  class="btn btn-primary save-video-sort" data-text="Save Sorting">Save Sorting</button>&nbsp;
                                @endif
                                <a href="{{url('manage/videos/add/'.request()->segment(3))}}" class="btn btn-info btn-flat">Add New Video</a>
                            </div>
                             @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive padding user_listing">
                    <table class="table table-hover">
                        <tbody><tr class="disable-sort-item">
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Topic</th>
                                <th>Video Image</th>
                                <th>Date</th>
                                <th>Is Featured?</th>
                                <th>Is New</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr></tbody><tbody>

                            <?php $i = 1; ?>                           
                            @foreach ($videos as $video) 
                            <tr id="<?=$video->id?>">
                                <td class="serial_no">{{$i++}}</td>
                                <td>{{ucfirst($video->video_title)}}</td>
                                <td>{{ $video->video_topic }}</td>
                                <td><img src="{{asset('/uploads/videoimages/'.$video->video_image) }}" width="80" onerror="this.src='{{asset("/images/no_image.png") }}'">
                                </td>
                                <td>{{$video->created_at}}</td>
                                <td>
                                    @if ($video->is_featured == 1)
                                        <span class="label label-success">Yes</span>
                                    @else
                                        <span class="label label-warning">No</span>
                                    @endif    
                                </td>
                                <td><input type="radio" class="new-video" name="newvideo" value="{{$video->id}}" @if($video->is_new == 1) checked @endif></td>
                                <td>
                                    @if ($video->publish_status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-warning">Inactive</span>
                                    @endif
                                </td>                                
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/videos/edit/'.$video->id)}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil"></i></a>
                                       
                                        <a href="javascript:void(0)" data-url="{{url('manage/videos/delete/'.$video->id)}}" class="btn btn-danger btn-sm btn-flat delete"><i class="fa fa-trash"></i></a>
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