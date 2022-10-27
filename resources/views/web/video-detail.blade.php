<section class="videowrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="video_detail">
                    <h1><?php echo ucfirst($video->video_title); ?></h1>
                    <div class="timesharing">
                        <div class="time">
                            <ul>
                                <li>
                                    <?php echo date('M j, Y', strtotime($video->created_at)); ?>
                                </li>
                                <li>
                                    <?php echo $video->video_duration; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="sharing">

                            <!--                            <div class="sharethis-inline-share-buttons"></div>
                            -->

                            <ul>

                                <li><a href="https://www.instagram.com/accounts/login/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <li>
                                    <a data-network="facebook"  class="st-custom-button share-facebook" data-title="{{ucfirst(addslashes($video->video_title))}}">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-network="linkedin" class="st-custom-button" data-title="{{ucfirst(addslashes($video->video_title))}}" >
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-network="twitter" class="st-custom-button" data-image ="{{asset('/uploads/videoimages/'.$video->video_image) }}"  data-title="{{ucfirst(addslashes($video->video_title))}}">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-network="googleplus" class="st-custom-button" data-title="{{ucfirst(addslashes($video->video_title))}}">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <figure>

                        <div class="about-video">
                            <div class="play home-play">
                                <a class="animate-fade  bounce-in delay-200 po-bounce-in" id="play" href="javascript:void(0)">
                                    <img src="{{ asset('images/play-button.png') }} " alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'">
                                </a>
                            </div>
                            <img src="{{asset('/uploads/videoimages/'.$video->video_image) }}" alt="No Image Found">
                            <div class="close-video hide" id="close-video">
                                <i class="fa fa-times"></i>
                            </div>
                            <div class='hide' id='videoIframe'>
                                <?php echo $videoIframe; ?>
                            </div>
                        </div>

                        <figcaption>
                            <p>
                                <?php echo $video->video_description; ?>
                            </p>
                        </figcaption>
                    </figure>

                    <div class="video-tab">
                        <ul>
                            <li>
                                <a href="javascript:void(0);" data-id="sources"><span class="source-icon">&nbsp;</span> <em>Sources</em></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-id="transcript"><span class="transcript-icon">&nbsp;</span> <em>Transcript</em></a>
                            </li>
                        </ul>
                    </div>

                    <div id="sources" class="video-content-wrap video-content" style="display: none">
                        <?php echo $video->source; ?>
                        <!-- @if(!empty($video->source_pdf))
                        <a class="blue-btn" href="/uploads/pdf/{{ $video->source_pdf }}" download="{{ $video->source_pdf }}"> <i class="fa fa-file-pdf-o"></i>  DOWNLOAD A PDF FOR THIS SOURCE</a>
                        @else
                        @endif -->
                       <!--  <button type="submit" class="blue-btn"><i class="fa fa-file-pdf-o"></i>  DOWNLOAD A PDF FOR THIS SOURCE</button> -->
                       <!-- <form action="{{url('/video/downloadVideo')}}" method="post" name='downloadsourceform'>
                            {{ csrf_field() }}
                            <input type="hidden" name='download_type' value='source'>
                            <input type="hidden" name='video_id' value='{{$video->id}}'>
                            <div class="download-btn">
                                <button type="submit" class="blue-btn"><i class="fa fa-file-pdf-o"></i>  DOWNLOAD A PDF FOR THIS SOURCE</button>
                            </div>
                        </form>  -->
                    </div>
                    <div id="transcript" class="video-content-wrap video-content" style="display: none">
                        <?php echo $video->transcript; ?>
                        <!-- @if(!empty($video->transcript_pdf))
                        <a class="blue-btn" href="/uploads/pdf/<?php //echo $video->transcript_pdf?>" download="{{ $video->transcript_pdf }}"> <i class="fa fa-file-pdf-o"></i>  DOWNLOAD A PDF FOR THIS TRANSCRIPT</a>
                        @else
                        @endif -->
                        <!-- <form action="{{url('/video/downloadVideo')}}" method="post" name='downloadtranscriptform'>
                            {{ csrf_field() }}
                            <input type="hidden" name='video_id' value='{{$video->id}}'>
                            <input type="hidden" name='download_type' value='transcript'>
                            <div class="download-btn">
                                <button type="submit" class="blue-btn"><i class="fa fa-file-pdf-o"></i>  DOWNLOAD A PDF FOR THIS TRANSCRIPT</button>
                            </div>
                        </form> -->
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>

 <section class="relatedpdct-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if ($relatedVideos && $relatedVideos->count()) { ?>
                    <h3>Related <span>videos</span> </h3>
                    <ul>
                        <?php foreach ($relatedVideos as $relatedVideo) { ?>
                            <li>
                                <figure>
                                    <div class="play home-play">
                                        <a class="animate-fade bounce-in delay-200 po-bounce-in" id="play" href="{{url('/videos/'.$relatedVideo->seo_slug)}}"  title="<?php echo $relatedVideo->video_title; ?>">
                                            <img src="{{ asset('images/play-button.png') }} " alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'">
                                        </a>
                                    </div>
                                    <img src="{{asset('/uploads/videoimages/thumbs/thumb-'.$relatedVideo->video_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
                                </figure>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <div class="view-btn">
                    <a href="{{url('/videos')}}" class="blue-btn"><span>+</span> VIEW ALL VIDEOS</a>
                </div>
            </div>
        </div>
    </div>
</section> 



<section class="newsletter-wrap">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12">
                <h3>We invite you join our newsletter to be notified when we release new videos.</h3>
                    <h3>You can also <a href="javascript:void(0)">subscribe</a> and click the bell notification on YouTube.</h3>

                    <ul>
                        <li>
                            <a class="join-btn btn btn-primary" data-toggle="modal" data-target="#newsletter">JOIN</a>
                        </li>
                        <li>
                            <a class="join-btn btn btn-primary" href="https://www.youtube.com/ChristianityEngaged" target="_blank"><img src="/images/yt-w.png" class="sub-img" />SUBSCRIBE</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- End newsletter-wrap -->
<!-- Newsletter Modal -->

<div id="newsletter" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close_newsletter" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Newsletter</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('/subscribe')}}" id="newsletterForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" class="form-control" id="newsletter_email" name="email" required placeholder="Enter Your Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="newsletter_confirm_email" onpaste="return false;" required name="" placeholder="Confirm Email">
                    </div>
                    <!-- Gaurav Added for recaptcha on 09/01/2019 -->
                 <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    
                      {!! app('captcha')->display() !!}
                      @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                      @endif
                       <span class="error hide" id="g-recaptcha-response_error">
                       recaptcha
                    </span>
                    
                   
                </div>
<!-- Ends  -->
                    <div class="clearfix">
                        <button type="submit" id="newsletter_subscribe" class="btn btn-primary">Submit</button>
                        <br>
                        <div id="newsletter_message" class="success-msg text-center"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- End .newsletter -->

<script type="text/javascript">
// Change tab class and display content
    function fbs_click() {
        let  u = window.location.href;
        let  t = "<?php echo ucfirst(addslashes($video->video_title)); ?>";
       // let s = "<?php //echo strip_tags(addslashes($video->source)); ?>";
        let i = "{{asset('/uploads/videoimages/'.$video->video_image) }}";
        alert(i)
        //let d = "<?php //echo strip_tags(addslashes($video->video_description)); ?>";
        window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&title='+encodeURIComponent(t)+'&picture='+i,
//window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),
                'sharer',
                'toolbar=0,status=0,width=626,height=436');

        return false;
    }



    $('.video-tab a').on('click', function (event) {

        var current = $(this).data('id');
        $("#" + current).toggle();

        if (current == 'sources') {
            $("#transcript").hide();
            $(".video-tab li:first").addClass("tab-active");
            $(".video-tab li:last").removeClass("tab-active");
        } else if (current == 'transcript') {
            $("#sources").hide();
            $(".video-tab li:first").removeClass("tab-active");
            $(".video-tab li:last").addClass("tab-active");

        }
    });

//    $(document).ready(function () {
//
//
//        us = window.location.href;
//        ts = "<?php  echo ucfirst($video->video_title); ?>";
        ss = "<?php //echo $video->source; ?>";
//        is = "{{asset('/uploads/videoimages/'.$video->video_image) }}";
//        //ds = "<?php //echo $video->video_description; ?>";
//
//        $('meta[property="og:url"]').attr("content", us);
//        $('meta[property="og:type"]').attr("content", "video");
//        $('meta[property="og:title"]').attr("content", ts);
//       // $('meta[property="og:description"]').attr("content", ds);
//        $('meta[property="og:image"]').attr("content", is);
//
//
//    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('#newsletter_subscribe').click(function(){
          if(!validateStep()){
            return false;            
          }
      });

        function validateStep() {
            
            var response = grecaptcha.getResponse();

            var valid = true;
        
            if(response.length == 0)
            {
              $('#g-recaptcha-response_error').html('Recaptcha required.');
              $('#g-recaptcha-response_error').removeClass('hide');
              valid = false;
            }
           
           
            return valid;
        }

    });
</script>