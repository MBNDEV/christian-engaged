<header id="header" class="header about-us innernav">
    <div class="container-fluid">
        <div class="row">
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{ asset('images/logo2.png') }}" alt="" /></a>
            </div>

            <!-- <div class="cart-menu">
                <a href="{{url('/cart')}}" id='cartDetail'>
                    <span class="cart-icon">&nbsp; <em data-count='0'>0</em> </span>
                </a>
            </div> -->

            <div class="nav-right-block">
                <a href="javascript:void(0)" class="mobile-nav">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <nav class="main-nav">
                    <ul class="header-top-menu">
                        <li><a href="/<?php echo $videoPageSlug[0];?>"><span data-hover="Video"> Videos</a></li>
                        <li><a href="/<?php echo $aboutUsPageSlug[0];?>">About</a></li>
                        <li>
                            <a href="https://christianityengaged.org/store">
                                Store
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/donate/')}}">
                                Donate
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/social/')}}">
                                Social Media
                            </a>
                        </li>
                        <li class="cart-btn">
                            <a href="https://christianityengaged.org/store/cart" id='cartDetail'>
                                Cart <em data-count='0'>0</em>
                                <span class="cart-icon">&nbsp;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</header>
<div class="front-wrap" id='front-wrap'>
    <img src="images/banner-home.jpg">
    <div class="banner-text-container">
    <img class="banner-img" src="/images/footer-logo2.png" alt="Christianity Engaged"><br>
    <h1 class="banner-text">Helping you overcome<br />barriers and grow closer to God.</h1>
    </div>
    <figcaption class="fadeInUp">
{{--        <h3>We help people overcome barriers to faith and grow spiritually through</h3>--}}
{{--        <h1>--}}
{{--        the power of video.--}}
{{--        </h1>--}}
        <a class="btn btn-info" href="/<?php $Videourl= App\Cms::getStaticSlug(3); echo $Videourl[0];?>">WATCH VIDEOS</a>
    </figcaption>
    <div class="scroll-btn">
        <a href="javascript:void(0)">Scroll</a>
        <div class="scroll-info-line"><div></div></div>
    </div>
</div><!-- End front-wrap -->


<div class="body-content">

    
    <section class="videos-wrap">
        <figcaption>
            <h1>
                NEW VIDEO
            </h1>
            <h2>
                {{$newvideo->video_title}}
               
            </h2>
            <h3>
                {!! \Illuminate\Support\Str::words($newvideo->video_description, 15, ' ...')  !!}
                    
            </h3>
            <div class="donate-btn">
                <a class="btn btn-info" href="{{url('/videos/'.$newvideo->seo_slug)}}">WATCH NOW</a>
            </div>
        </figcaption>
        <figure>
            <img src="{{ asset('/uploads/videoimages/'.$newvideo->video_image) }}">
        </figure>
    </section><!-- End helpfund-wrap -->


    <section class="featured-wrap">
        <div class="heading">
            <h1>Featured Videos </h1>
        </div>

        <div class="photoGrid clearfix">
            <?php foreach ($videos as $video) { 
              ?>
                <div class="item">
                    <div class="play home-play">
                        <a class="animate-fade  bounce-in delay-200 po-bounce-in" id="play" href="{{url('/videos/'.$video->seo_slug)}}">
                            <img src="{{ asset('images/play-button.png') }} " alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'">
                        </a>
                    </div>
                    <figure class="effect-lily"> 
                        <a href="{{url('/videos/'.$video->seo_slug)}}" title="View Video Details">
                            <img src="{{asset('/uploads/videoimages/featured/'.$video->featured_image) }}" width="530" height="298" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
                        </a>
                    </figure>
                </div>

            <?php }
            ?>
        </div>
        <div class="view-btn">
            <a class="btn btn-info" href="/<?php echo $videoPageSlug[0];?>" class="">MORE VIDEOS</a>
        </div>
    </section>

    <section class="powervideo-wrap">
        <figure>
            <a href="#" class="youtube-link-dark" youtubeid="zG9x6M1cXhI">
                <!--<img src="{{ asset('images/about-img_new.jpg') }}">-->
                <img src="{{ asset('images/Introducing_Christianity_Engaged_web_v2.jpg') }}">
            </a>
         </figure>
        <figcaption>
            <h3>
                We want to meet people where they are and engage with them where they want to be engaged. Our videos address hard topics that are relevant today and help people progress along a continuum of spiritual maturity, from atheists to mature believers.
            </h3>
            <div class="donate-btn">
                <a class="btn btn-primary" href="{{url('/about')}}">ABOUT US</a>
            </div>
        </figcaption>
    </section><!-- End helpfund-wrap -->


    <section class="mission-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h1>You can <span>support</span> our mission by: </h1>

                    <ul>
                        <li>
                            <a href="{{ url('prayer')}}">
                                <span class="praying-icon icon"></span>
                                <h3>Praying </h3>
                                <h4>for our ministry</h4>
                            </a>
                        </li>
                        <li>
                            <a href="/<?php $Videourl= App\Cms::getStaticSlug(3); echo $Videourl[0];?>">
                                <span class="promoting-icon icon"></span>
                                <h3>Promoting  </h3>
                                <h4>our videos</h4>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/donate/')}}">
                                <span class="donating-icon icon"></span>
                                <h3>Donating  </h3>
                                <h4>to our cause</h4>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="{{url('store')}}">
                                <span class="purchasing-icon icon"></span>
                                <h3>Purchasing  </h3>
                                <h4>our merch</h4>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- End mission-wrap -->

    <section class="social-media">
        <h3>Follow us on social media:</h3>
        <ul>
            <li><a href="https://www.youtube.com/ChristianityEngaged" target="_blank"><i class="fa fa-youtube"></i></a></li>
            <li><a href="https://www.instagram.com/christianity.engaged" target="_blank"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://www.facebook.com/ChristianityEngaged" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.linkedin.com/company/christianity-engaged" target="_blank"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="https://twitter.com/CEvideos" target="_blank"><i class="fa fa-twitter"></i></a></li>
        </ul>
    </section>

    <section class="helpfund-wrap">
        <figure>
            <?php foreach ($resultsocial as $video1) { ?>
            <a class="animate-fade  bounce-in delay-200 po-bounce-in photoGrid clearfix" id="play" target="blank" href="{{url($video1->video_url)}}">
                    <img src="{{asset('/uploads/videoimages/'.$video1->video_image) }} " class="img-responsive" width="100%" height="100%" alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'">
                </a>
             <?php } ?>   
        </figure>
        <figcaption>
            <h1>
                How can you help?
            </h1>
             <h3>{!! $video1->video_description !!} </h3>
            <div class="donate-btn">
                <a class="btn btn-default" href="{{url('/donate')}}">DONATE</a>
            </div>
            <small>
                Christianity Engaged is a 501(c)3 non-profit organization. Your donations are fully tax deductible.
            </small>
        </figcaption>
                
    </section><!-- End helpfund-wrap -->

    @include('web.featured_product') 

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
</div>

<div class="clearfix"></div>

<script src="{{ asset ("js/homepage.js") }}"></script>


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
                        <input type="text" class="form-control" id="newsletter_confirm_email" required name="" onpaste="return false;" placeholder="Confirm Email">
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


<!-- <script type="text/javascript" src="{{ URL::to('js/contact_us.js') }}"></script> -->
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