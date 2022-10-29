<section class="helpfund-wrap">
        <figure>
            <?php foreach ($resultsocial as $video1) { ?>
            <a class="animate-fade  bounce-in delay-200 po-bounce-in photoGrid clearfix" id="play" target="blank" href="{{url($video1->video_url)}}">
                    <!-- <img src="{{asset('/uploads/videoimages/'.$video1->video_image) }} " class="img-responsive" width="100%" height="100%" alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'"> -->
                    <img src="{{asset('/images/donate-bg-5.png') }} " class="img-responsive" width="100%" height="100%" alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'">
                </a>
             <?php } ?>   
        </figure>
        <figcaption>
            <h1>
                How can you help?
            </h1>
             <h3>None of this would be possible without your support. If you would like to help us share Jesus with the world, please prayerfully consider financially supporting our ministry.</h3>
            <div class="donate-btn">
                <a class="btn btn-default" href="{{url('/donate')}}">DONATE</a>
                <!-- <a href="{{url('/donate')}}"><img src="/images/donate.png" width="200" /></a> -->
            </div>
            <small>
                Christianity Engaged is a 501(c)3 non-profit organization. Your donations are fully tax deductible.
            </small>
        </figcaption>
                
    </section><!-- End helpfund-wrap -->