<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h1>Featured Videos</h1>    
        </div>  
    </div>  
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">                            
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        @if($videos->count())
                            <button class="btn btn-primary margin-left-10" id='enable-featured-sort' data-text="Enable Sorting">Enable Sorting</button>
                            <button class="btn btn-danger margin-left-10 hide" id='cancel-featured' data-text="Cancel">Cancel</button>
                            <button data-url="{{url('manage/featured-videos/sort')}}" class="btn btn-primary hide" data-text="Save Sorting" id='save-featured'>Save Sorting</button>
                        @endif
                    </div>
                </div>
                <!-- /.box-header -->
                
                <!-- <div class=""> -->
                <div class="photoGrid video-list clearfix">
                    @foreach ($videos as $video)
                        <div class="item" id="<?=$video->id?>">
                            <figure class="effect-lily">
                                <a href="javascript:void(0);" title="{{ucfirst($video->video_title)}}">
                                    <img src="{{asset('/uploads/videoimages/thumbs/thumb-'.$video->video_image) }}" alt="No Image Found" onerror="this.src='{{url('/images/no_image.png')}}'">
                                </a>                        
                            </figure>
                            <date>{{$video->created_at}}</date>
                        </div>
                    @endforeach
                </div>
                 
                
            </div>
            <!-- /.box -->
        </div>
    </div>
    
</section>

<script src="{{ asset('js/video.js') }}"></script>