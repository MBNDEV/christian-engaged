<?php if($videos->count()){ 
        foreach ($videos as $video){ ?>
            <li>
                <div class="play home-play">
                    <a class="animate-fade  bounce-in delay-200 po-bounce-in" href="{{url('/videos/'.$video->seo_slug)}}">
                        <img src="{{ asset('images/play-button.png') }} " alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'">
                    </a>
                </div>
                <figure>
                    <a href="{{url('/videos/'.$video->seo_slug)}}" title="<?php echo $video->video_title; ?>">
                        <img src="{{asset('/uploads/videoimages/thumbs/thumb-'.$video->video_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
                    </a>                        
                </figure>
            </li>
    <?php } 
    }else if($showNoVideos){ ?>
        <li class="no-video">No Videos Found</li>
<?php } ?>

               