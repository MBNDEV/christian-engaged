<?php $section1Amenities = json_decode($section1->amenity_details);  ?>
<section class="banner">
    <figure>
        <img src="{{ asset('images/about-2.png') }} " alt="Video">
        <figcaption>
            <div class="content">
                <h1>
                    <?php echo ($section1Amenities) ? $section1Amenities->heading:'--'; ?>
                </h1>
                <!-- <h3>
                    <?php //echo ($section1Amenities) ? $section1Amenities->short_description:'--'; ?>
                </h3> -->
                
            <img src="{{ asset('images/symbol.png') }}" width="104" height="104" class="hero-logo" /> 
            </div>
        </figcaption>
    </figure>
</section><!-- End banner -->

<section class="intro-wrap">
    <div class="table">
        <div class="table-cell">
            <h2>
                Introducing Christianity Engaged
            </h2>
            <h3>
                This one-minute video shares our mission and the focus of our Christian video and social media ministries.
            </h3>
            <div class="donate-btn">
                <a class="btn btn-info" href="{{url('/videos/Our-Vision')}}">WATCH NOW</a>
            </div>
        </div>
        <div class="table-cell">
<!--            <a href="{{url('/videos/Our-Vision')}}" class="youtube-link-dark" youtubeid="zG9x6M1cXhI">
                <img src="{{ asset('images/vision-img.jpg') }}">
            </a>-->
            <a href="{{url('/videos/Our-Vision')}}" class="youtube-link-dark" youtubeid="zG9x6M1cXhI">
                <img src="{{ asset('images/Introducing_Online_Generation_to_Christ.jpg') }}">
            </a>
        </div>
    </div>
</section><!-- End intro-wrap -->

<?php $section2Amenities = json_decode($section2->amenity_details);  ?>
<section class="worldchange-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>
                    <?php echo ($section2Amenities) ? $section2Amenities->title:'--'; ?>
                </h2>
                <h3>
                <?php echo ($section2Amenities) ? $section2Amenities->description:'--'; ?>
                </h3>
            </div>
        </div>
    </div>
</section><!-- End worldchange-wrap -->


<?php $section3Amenities = json_decode($section3->amenity_details);  ?>


<section class="global-wrap">
    <div class="table">
        <div class="table-cell">
            <img src="{{ asset('images/globe-2.png') }}">
        </div>
        <div class="table-cell">
            <div class="content">
                <h2>
                    <?php echo ($section3Amenities) ? $section3Amenities->heading:'--'; ?>
                </h2>
                <h3>
                    <?php echo ($section3Amenities) ? $section3Amenities->description:'--'; ?>
                </h3>
                <a href="{{url('/donate/')}}" class="btn btn-default">HOW TO HELP</a>
            </div>
        </div>
    </div>
</section><!-- End global-wrap -->


<?php if($leaders->count()){ ?>
<section class="leadership-wrap">
    <h2>
        <span>Leadership</span>
    </h2>
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm-12 col-md-10 col-md-offset-1"> -->
            <div class="col-sm-12">
                
                <ul>
                    <?php
                        foreach ($leaders as $leader) { ?>
                            <li>
                                <figure>
                                    <img src="{{ asset('uploads/leadership/'.$leader->profile_pic) }}" alt="Video">
                                    <figcaption>
                                        <h2>
                                            <?php echo ucfirst($leader->name); ?>
                                        </h2>
                                        <h4>
                                            <?php echo ucfirst($leader->designation); ?>
                                        </h4>
                                        <div class="content">
                                            <p>
                                               <?php echo ucfirst($leader->short_description); ?>
                                            </p>
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>
</section><!-- End leadership-wrap -->



<?php } ?>

<style>
.mission-wrap {
    background: #fff!important;
}
</style>
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
    

<!-- Newsletter Modal -->

<!-- <link href="{{ asset('css/jquery.rollingslider.css') }}" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{{ asset("js/jquery.rollingslider.js") }}"></script>
<script>
    $('#demo').RollingSlider({
        showArea:"#example",
        prev:"#jprev",
        next:"#jnext",
        moveSpeed:300,
        autoPlay:false
    });
</script> -->


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

@include('web.section-social')

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