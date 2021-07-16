<?php $section1Amenities = json_decode($section1->amenity_details);  ?>
<section class="banner">
    <figure>
        <img src="{{ asset('images/aboutbanner.jpg') }} " alt="Video">
        <figcaption>
            <div class="content">
                <h1>
                    <?php echo ($section1Amenities) ? $section1Amenities->heading:'--'; ?>
                </h1>
                <h4>
                    <?php echo ($section1Amenities) ? $section1Amenities->short_description:'--'; ?>
                </h4>
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
            <h4>
                Meet the people involved and see how we are introducing an online generation to Jesus through the power of video and other online media.
            </h4>
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
                <?php echo ($section2Amenities) ? $section2Amenities->description:'--'; ?>
            </div>
        </div>
    </div>
</section><!-- End worldchange-wrap -->

<?php $section3Amenities = json_decode($section3->amenity_details);  ?>



<?php if($leaders->count()){ ?>
<section class="leadership-wrap">
    <h2>
        <span>Leadership</span>
    </h2>
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm-12 col-md-10 col-md-offset-1"> -->
            <div class="col-sm-12">

            <!-- <div id="demo" class="demo">
				<ul class="slide-wrap" id="example">
					<li class="pos1">
						<div class="inner">
							<a href="#">
								<img src="https://unsplash.it/300/390?image=944"/>
								<div class="pic-tit">
                                    <h2>
                                        1 David Erhart
                                    </h2>
                                    <h4>
                                        Founder & CEO
                                    </h4>
                                    <div class="text">
                                        <p>
                                            "For God so loved the world that he gave his one and only Son, 
                                            that whoever believes in him shall not perish, but have eternal life." 
                                        </p>
                                        <p>
                                            John 3:16
                                        </p>
                                    </div>                                    
                                </div>
							</a>
						</div>
					</li>
					<li class="pos2">
						<div class="inner">
							<a href="#">
								<img src="https://unsplash.it/300/390?image=943"/>
								<div class="pic-tit">
                                    <h2>
                                        2 David Erhart
                                    </h2>
                                    <h4>
                                        Founder & CEO
                                    </h4>
                                    <div class="text">
                                        <p>
                                            "For God so loved the world that he gave his one and only Son, 
                                            that whoever believes in him shall not perish, but have eternal life." 
                                        </p>
                                        <p>
                                            John 3:16
                                        </p>
                                    </div>                                    
                                </div>
							</a>
						</div>
					</li>
					<li class="pos3">
						<div class="inner">
							<a href="#">
								<img src="https://unsplash.it/300/390?image=942"/>
								<div class="pic-tit">
                                    <h2>
                                        3 David Erhart
                                    </h2>
                                    <h4>
                                        Founder & CEO
                                    </h4>
                                    <div class="text">
                                        <p>
                                            "For God so loved the world that he gave his one and only Son, 
                                            that whoever believes in him shall not perish, but have eternal life." 
                                        </p>
                                        <p>
                                            John 3:16
                                        </p>
                                    </div>                                    
                                </div>
							</a>
						</div>
					</li>
					<li class="pos4">
						<div class="inner">
							<a href="#">
								<img src="https://unsplash.it/300/390?image=941"/>
								<div class="pic-tit">
                                    <h2>
                                        4 David Erhart
                                    </h2>
                                    <h4>
                                        Founder & CEO
                                    </h4>
                                    <div class="text">
                                        <p>
                                            "For God so loved the world that he gave his one and only Son, 
                                            that whoever believes in him shall not perish, but have eternal life." 
                                        </p>
                                        <p>
                                            John 3:16
                                        </p>
                                    </div>                                    
                                </div>
							</a>
						</div>
					</li>
					<li class="pos5">
						<div class="inner">
							<a href="#">
								<img src="https://unsplash.it/300/390?image=940"/>
								<div class="pic-tit">
                                    <h2>
                                        5 David Erhart
                                    </h2>
                                    <h4>
                                        Founder & CEO
                                    </h4>
                                    <div class="text">
                                        <p>
                                            "For God so loved the world that he gave his one and only Son, 
                                            that whoever believes in him shall not perish, but have eternal life." 
                                        </p>
                                        <p>
                                            John 3:16
                                        </p>
                                    </div>                                    
                                </div>
							</a>
						</div>
					</li>
					<li>
						<div class="inner">
							<a href="#">
								<img data-src="https://unsplash.it/300/390?image=840"/>
								<div class="pic-tit">
                                    <h2>
                                        6 David Erhart
                                    </h2>
                                    <h4>
                                        Founder & CEO
                                    </h4>
                                    <div class="text">
                                        <p>
                                            "For God so loved the world that he gave his one and only Son, 
                                            that whoever believes in him shall not perish, but have eternal life." 
                                        </p>
                                        <p>
                                            John 3:16
                                        </p>
                                    </div>                                    
                                </div>
							</a>
						</div>
					</li>
					
				</ul>
				<i class="arrow prev" id="jprev">&lt;</i>
				<i class="arrow next" id="jnext">&gt;</i>
			</div> -->
                
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


<section class="global-wrap" style="margin-bottom: 55px;">
    <div class="table">
        <div class="table-cell">
            <img src="{{ asset('images/global-bg.jpg') }}">
        </div>
        <div class="table-cell">
            <div class="content">
                <h2>
                    <?php echo ($section3Amenities) ? $section3Amenities->heading:'--'; ?>
                </h2>
                <p>
                    <?php echo ($section3Amenities) ? $section3Amenities->description:'--'; ?>
                </p>
                <a href="{{url('/donate/')}}" class="btn btn-default">HOW TO HELP</a>
            </div>
        </div>
    </div>
</section><!-- End global-wrap -->


<!-- Gaurav Added on 11/11/2019 -->
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
            <a class="animate-fade  bounce-in delay-200 po-bounce-in photoGrid clearfix" id="play" href="{{url($video1->video_url)}}">
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

@include('web.product_wraper') 

<?php } ?>
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