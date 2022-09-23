<section class="banner">
    <figure>
        <img src="{{ asset('images/video-bg.png') }} " alt="Video">
        <figcaption>
            <div class="content">
                <h1><?php echo ($videoamenity) ? $videoamenity->heading : ''; ?></h1>
                <h4>
                    <?php echo ($videoamenity) ? $videoamenity->short_description : ''; ?>
                </h4>
            </div>
        </figcaption>
    </figure>
</section><!-- End banner -->

<section class="videowrapper">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-md-offset-1">

                <ul class="sorting">
                    <li>
                        <label>Topic:</label>
                    </li>
                    <li>
                        <select id="topic" name='topic'>
                            <option value=''>All Items</option>
                            <?php foreach ($videoTopics as $videoTopic) { ?>
                                <option value='<?php echo $videoTopic->id; ?>'>
                                    <?php echo $videoTopic->video_topic; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </li>

                    <li>
                        <label>Sort:</label>
                    </li>
                    <li>
                        <select id="sort" name="sort">
                            <option value="">Sort By</option>
                            <option value="ASC">Oldest to Newest</option>
                            <option value="DESC" selected>Newest to Oldest</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="video-list" data-page='1'>
                    <?php foreach ($videos as $video) { ?>
                        <li>
                            <div class="play home-play">
                                <a class="animate-fade  bounce-in delay-200 po-bounce-in" href="{{url('/videos/'.$video->seo_slug)}}">
                                    <img src="{{ asset('images/play-button.png') }} " alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'">
                                </a>
                            </div>
                            <figure>
                                <a href="{{url('/videos/'.$video->seo_slug)}}" title="<?php echo $video->video_title; ?>">
                                    <img src="{{asset('/uploads/videoimages/'.$video->video_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
                                </a>
                            </figure>
                        </li>
                    <?php } ?>
                </ul>

                <div class="overlay">
                    <div class="loader">Loading...</div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 center">
                <a href="javascript:void(0)" onclick="loadMore()"  class="btn btn-info load-more">LOAD MORE VIDEOS</a>
            </div>
        </div>


<!--        <div class="video-loading">
        </div>-->
    </div>
</section><!-- End videowrapper -->


<!--<div class="overlay">
    <div class="loader">Loading...</div>
</div>-->


<section class="newsletter-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2">
                <h3>Stay informed about new videos and exclusive updates.</h3>
                <h4>Join our newsletter or <a href="javascript:void(0)">subscribe</a> to our YouTube channel. </h4>

                <ul>
                    <li>
                        <a class="join-btn btn btn-primary" data-toggle="modal" data-target="#newsletter">JOIN</a>
                    </li>
                    <li>
                        <a class="join-btn btn btn-primary" href="https://www.youtube.com/ChristianityEngaged" target="_blank">SUBSCRIBE</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section><!-- End newsletter-wrap -->

<script type="text/javascript" src="{{ asset("js/videolibrary.js") }}"></script>
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
                        <input type="text" class="form-control" id="newsletter_confirm_email"  onpaste="return false;" required name="" placeholder="Confirm Email">
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


<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>

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
