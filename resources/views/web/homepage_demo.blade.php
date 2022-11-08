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
                        
                        <li>
                            <a href="{{url('/social/')}}">
                                Social Media
                            </a>
                        </li>
                        <li><a href="/<?php echo $aboutUsPageSlug[0];?>">About</a></li>
                        <li>
                            <a href="{{url('/donate/')}}">
                                Donate
                            </a>
                        </li>
                        <li>
                            <a href="/store">
                                Store
                            </a>
                        </li>
                        <li class="cart-btn">
                            <a href="/store/cart" id='cartDetail'>
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
    <img src="images/home-banner-1.png">
    <div class="banner-text-container-1">
    <h1 class="hero-title">We share the Gospel and encourage believers all over the world.</h1>
    <img class="banner-img" src="/images/ce-logo-hero.png" />
    </div>
    <figcaption class="fadeInUp">
        <a class="btn btn-info" href="/<?php $Videourl= App\Cms::getStaticSlug(3); echo $Videourl[0];?>">WATCH VIDEOS</a>
    </figcaption>
    <div class="scroll-btn">
        <a href="javascript:void(0)">Scroll</a>
        <div class="scroll-info-line"><div></div></div>
    </div>
</div>
<!-- End front-wrap -->
<!-- <div class="hero-image">
  <div class="hero-text">
    <h1>We share the Gospel and encourage believers all over the world.</h1>
    <img src="/public/images/hero-logo.png" />
    <figcaption class="fadeInUp">
        <a class="btn btn-info" href="/<?php $Videourl= App\Cms::getStaticSlug(3); echo $Videourl[0];?>">WATCH VIDEOS</a>
    </figcaption>
    <div class="scroll-btn">
        <a href="javascript:void(0)">Scroll</a>
        <div class="scroll-info-line"><div></div></div>
    </div>
  </div>
</div> -->

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
                {!! \Illuminate\Support\Str::words($newvideo->video_description, 50, ' ...')  !!}
                    
            </h3>
            <div class="donate-btn">
                <a class="btn btn-info" href="{{url('/videos/'.$newvideo->seo_slug)}}">WATCH NOW</a>
            </div>
        </figcaption>
        <figure>
            <img src="{{ asset('/uploads/videoimages/'.$newvideo->video_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
        </figure>
    </section><!-- End helpfund-wrap -->

    
    <section class="powervideo-wrap">
        <figure>
            <a href="#" class="youtube-link-dark" youtubeid="zG9x6M1cXhI">
                <!--<img src="{{ asset('images/about-img_new.jpg') }}">-->
                <img src="{{ asset('images/intro-1.jpg') }}">
            </a>
         </figure>
        <figcaption>
            <h2>Engaging with Jesus</h2>
            <h3>
            <p>We are a Christian video production studio and online ministry that shares the Gospel of Jesus Christ and encourages believers all over the world.</p>
            </h3>
            <div class="donate-btn">
                <a class="btn btn-primary" href="{{url('/about')}}">ABOUT US</a>
            </div>
        </figcaption>
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

    <div class="clearfix"></div>

    <section class="shop-instagram" style="padding: 25px 0 25px 0!important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <h2>
                        <span>Christianity Engaged <img src="{{ asset('images/instagram-logo.png') }}" alt="Instagram" /></span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="instagram-list">
            <ul id="instafeed">
            </ul>
        </div>

        <div class="clearfix"></div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <a href="https://www.instagram.com/christianity.engaged/" target="_blank" class="btn btn-primary">Follow Us</a>
                </div>
            </div>
        </div>


    </section><!-- End .shop-top -->

    <div class="clearfix"></div>

    <section class="slider-wrap">
        <div class="slider-inner-1">
            <h3>As a result of our ministry, people have decided to say "yes" to Jesus, grow in their faith, be more intentional in their parenting, better understand the Bible, and grow closer to God in prayer.</h3>
        </div>
        <div class="slider-inner-2">
            <img src="/images/slider/corner-dots.png" class="corner-dots" />
            <img src="/images/slider/triangle.png" class="left-triangle" />

        <div class="flexslider2">
            <ul class="slides">
                <li>
                    <a href="https://christianityengaged.org/videos/Top-10-Reasons-to-Believe-in-Jesus">
                        <img src="/images/slider/img1.png" />
                    </a>
                </li>
                <li>
                    <a href="https://christianityengaged.org/videos/bible-overview">
                        <img src="/images/slider/img2.png" />
                    </a>
                </li>
                <li>
                    <a href="https://christianityengaged.org/videos/5FingerPrayer">
                        <img src="/images/slider/img3.png" />
                    </a>
                </li>
                <li>
                    <a href="https://christianityengaged.org/videos/have-your-children-left-the-faith">
                        <img src="/images/slider/img4.png" />
                    </a>
                </li>
                <li>
                    <a href="https://christianityengaged.org/videos/evil-and-suffering">
                        <img src="/images/slider/img5.png" />
                    </a>
                </li>
                <li>
                    <a href="https://christianityengaged.org/videos/bible-overview">
                        <img src="/images/slider/img6.png" />
                    </a>
                </li>
                <li>
                    <a href="https://christianityengaged.org/videos/bible-overview">
                        <img src="/images/slider/img7.png" />
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </section><!-- End slider wrap -->

    @include('web.section-support')

    @include('web.section-donate')
     
    @include('web.featured_product') 

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

@include('web.section-social')


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