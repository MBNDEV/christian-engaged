<section class="shop-banner">
    <figure>
        <img src="{{ asset('images/social.png') }}" alt="" />
        <figcaption>
            <h1>
                Connect with us!
            </h1>
        </figcaption>
    </figure>
</section><!-- End .shop-banner -->

<div class="clearfix"></div>

<section class="shop-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <div class="table">
                    <div class="table-cell">
                        <ul>
                            <li><a href="https://www.youtube.com/ChristianityEngaged" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="https://www.instagram.com/christianity.engaged" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.facebook.com/ChristianityEngaged" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/christianity-engaged" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://twitter.com/CEvideos" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                    <div class="table-cell">
                        <h4>
                            Connect with us on social media for updates on videos, encouraging Bible verses, challenging thoughts 
                            and more. Also, subscribe to our YouTube channel and click the bell icon to be notified when we release 
                            new videos. 
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End .shop-top -->


<div class="clearfix"></div>

<section class="shop-instagram">
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
            <!--            <li>
                            <img src="{{ asset('images/global-bg.jpg') }}" alt="" />
                        </li>
                        <li>
                            <img src="{{ asset('images/global-bg.jpg') }}" alt="" />
                        </li>
                        <li>
                            <img src="{{ asset('images/global-bg.jpg') }}" alt="" />
                        </li>
                        <li>
                            <img src="{{ asset('images/global-bg.jpg') }}" alt="" />
                        </li>
                        <li>
                            <img src="{{ asset('images/global-bg.jpg') }}" alt="" />
                        </li>
                        <li>
                            <img src="{{ asset('images/global-bg.jpg') }}" alt="" />
                        </li>
                        <li>
                            <img src="{{ asset('images/global-bg.jpg') }}" alt="" />
                        </li>
                        <li>
                            <img src="{{ asset('images/global-bg.jpg') }}" alt="" />
                        </li>-->
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

<section class="helpfund-wrap">
        <figure>
            <?php foreach ($resultsocial as $video1) { ?>
            <a class="animate-fade  bounce-in delay-200 po-bounce-in photoGrid clearfix" id="play" target="blank" href="{{url($video1->video_url)}}">
                    <!-- <img src="{{asset('/uploads/videoimages/'.$video1->video_image) }} " class="img-responsive" width="100%" height="100%" alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'"> -->
                    <img src="{{asset('/images/donate-bg-2.png') }} " class="img-responsive" width="100%" height="100%" alt="Video" onerror="this.src='{{asset("/images/no_image.png") }}'">
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

@include('web.product_wraper') 


<div class="clearfix"></div>

<script src="{{ asset ("js/homepage.js") }}"></script>



<section class="newsletter-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2">
            <h3>We invite you join our newsletter to be notified when we release new videos.</h3>
                    <h4>You can also <a href="javascript:void(0)">subscribe</a> and click the bell notification on YouTube.</h4>

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

<section class="social-media">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <div class="social-inner">
                    <div class="line-h">
                        <span>
                            <ul>
                                <li><a href="https://www.youtube.com/ChristianityEngaged" target="_blank"><div class="yt-img"></div></a></li>
                                <li><a href="https://www.facebook.com/ChristianityEngaged" target="_blank"><div class="fb-img"></div></a></li>
                                <li><a href="https://twitter.com/CEvideos" target="_blank"><div class="tw-img"></div></a></li>
                                <li><a href="https://www.linkedin.com/company/christianity-engaged" target="_blank"><div class="linkedin-img"></div></a></li>
                                <li><a href="https://www.instagram.com/christianity.engaged" target="_blank"><div class="ig-img"></div></a></li>
                            </ul>
                        </span>
                    </div>
                    
                    <h3>When you like our videos and share them with your friends, you help us reach more people all over the world with a powerful message of hope. In addition to our videos, if you would like more encouraging content throughout the week, follow us on social media.</h3>
                </div>
                </div>
            </div>
        </div>
    </section>


<script type="text/javascript">
$(document).ready(function () {
    $('#newsletter_subscribe').click(function () {
        if (!validateStep()) {
            return false;
        }
    });

    function validateStep() {

        var response = grecaptcha.getResponse();

        var valid = true;

        if (response.length == 0)
        {
            $('#g-recaptcha-response_error').html('Recaptcha required.');
            $('#g-recaptcha-response_error').removeClass('hide');
            valid = false;
        }


        return valid;
    }

});


</script>