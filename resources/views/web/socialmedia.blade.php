<section class="shop-banner">
    <figure>
        <img src="{{ asset('images/social.png') }}" alt="" />
        <figcaption>
            <h1>
                CONNECT
            </h1>
            
            <img src="{{ asset('images/symbol.png') }}" width="104" height="104" class="hero-logo" /> 
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

<section class="shop-instagram" style="padding: 20px 0 20px 0!important;">
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

@include('web.section-social')
@include('web.section-donate')




<div class="clearfix"></div>

<script src="{{ asset ("js/homepage.js") }}"></script>



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