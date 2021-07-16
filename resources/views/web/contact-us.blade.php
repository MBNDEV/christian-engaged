<div class="contact-wrap" style="padding: 0px;">

  <section class="banner">
       <figure>        
        <img src="{{ asset('images/contactbanner.jpg') }} " alt="Video">         
        <figcaption>             
          <div class="content">                 
            <h1><?=($contact_us->address!='') ? $contact_us->address: 'Contact Us'?></h1>                 
            <h4><?=($contact_us->address_line_2!='') ? $contact_us->address_line_2: ''?></h4>             
          </div>         
        </figcaption>     
      </figure> 
  </section><!-- End banner -->
  
  <div class="clearfix"></div>

<div class="container">
  <div class="row">

    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
      @if(Session::has('message'))
      <div class="alert alert-success" style="margin-top: 20px; text-align: center;">{{ Session::get('message') }}</div>
      @endif
  <form class="form-horizontal" action="{{url('contact/save')}}" method="POST" name ="contactUs" id="contactUs">
     {{ csrf_field() }}
    
       <?php
          $error = $errors->first('name');
          $class = '';
          if($error){
          $class = 'has-error';    
          }                               
      ?>
    <div class="form-group  {{ $class }}">
      <label class="col-md-4 text-right" for="name">Name:<?php if(isset($data)){echo $data;} ?></label>
      <div class="col-md-8">
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" name="name">
        <span class="error hide" id="name_error">
            Name is required
        </span>
      </div>
    </div>
  
     <?php
          $error = $errors->first('email');
          $class = '';
          if($error){
          $class = 'has-error';    
          }                               
      ?>
    <div class="form-group {{ $class }}">
      <label class="col-md-4 text-right" for="email">Email:</label>
      <div class="col-md-8">
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" name="email">
        <span class="error hide" id="email_error">
            Invalid Email
        </span>
      </div>
    </div>
  
      <?php
          $error = $errors->first('phone');
          $class = '';
          if($error){
          $class = 'has-error';    
          }                               
      ?>
    <div class="form-group {{ $class }}">
      <label class="col-md-4 text-right" for="phone">Phone:</label> 
      <div class="col-md-8">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" name="phone">
        <span class="error hide" id="phone_error">
            Invalid Phone
        </span>
      </div>
    </div>
  
     <?php
          $error = $errors->first('message');
          $class = '';
          if($error){
          $class = 'has-error';    
          }                               
      ?>
    <div class="form-group {{ $class }}">
      <label class="col-md-4 text-right" for="pwd">Message:</label>
      <div class="col-md-8">
        <textarea rows="4" cols="50" class="form-control" id="message" name="message" placeholder="Enter Message" name="message"></textarea>
        <span class="error hide" id="message_error">
            Message is required
        </span>
      </div>
    </div>

<!-- Gaurav Added for recaptcha on 09/01/2019 -->
 <input type="hidden" name="recaptcha" id="recaptcha">
<!--    <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
      <label class="col-md-4 text-right" for="recaptcha"></label>
        <div class="col-md-8 pull-center">
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
       
    </div>-->
<!-- Ends  -->

    <div class="form-group {{ $class }}">
      <div class="col-md-4 text-right">&nbsp;</div>
      <div class="col-md-8">
        <button type="submit" id='submit' class="btn blue-btn">Submit</button>
      </div>
    </div>
  
  </form>
</div>
</div>
</div>


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

<script src="{{ asset ("js/homepage.js") }}"></script>

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
<!--                 <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    
                      {!! app('captcha')->display() !!}
                      @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                      @endif
                       <span class="error hide" id="g-recaptcha-response_error">
                       recaptcha
                    </span>
                    
                   
                </div>-->
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

</div>
<!-- <script type="text/javascript" src="{{ URL::to('js/contact_us.js') }}"></script> -->

<script type="text/javascript">
    $(document).ready(function(){
//      $('#submit').click(function(){
//          if(!validateStep()){
//            return false;            
//          }
//      });

        function clearInfoError() {
            $('#name_error').html('');
            $('#email_error').html('');
            $('#phone_error').html('');
            $('#message_error').html('');
        }
        function allLetter(inputtxt)
        {
            var letters = /^[a-zA-Z-,](\s{0,1}[a-zA-Z-, ])*[^\s]+$/;
            if (inputtxt.match(letters))
            {
                return true;
            } else
            {
                //alert("message");
                return false;
            }
        }
        function validatePhone(phone) {

            var a = phone;
            var filter = /^[0-9-+]+$/;
            if (filter.test(a)) {

                return true;
            } else {

                return false;
            }

        }
        function validateEmail(sEmail) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (filter.test(sEmail)) {
                return true;
            } else {
                return false;
            }

        }


        function validateStep() {
            clearInfoError();

            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var message = $('#message').val();
            var response = grecaptcha.getResponse();

            var valid = true;
            if ($.trim(name).length == 0) {
                $('#name_error').html('Name required.');
                $('#name_error').removeClass('hide');
                valid = false;
            } else {
                if (!allLetter(name)) {
                    $('#name_error').html('Name should be alphabet.');
                    $('#name_error').removeClass('hide');
                    valid = false;
                }
            }

            if ($.trim(phone).length == 0) {
                $('#phone_error').html('Phone number required.');
                $('#phone_error').removeClass('hide');
                valid = false;
            } else {
                if (!validatePhone(phone)) {
                    $('#phone_error').html('Invalid phone number formate.');
                    $('#phone_error').removeClass('hide');
                    valid = false;
                }
            }

            if ($.trim(email).length == 0) {
                $('#email_error').html('Email required.');
                $('#email_error').removeClass('hide');
                valid = false;
            } else {
                if (!validateEmail(email)) {
                    $('#email_error').html('Invalid email.');
                    $('#email_error').removeClass('hide');
                    valid = false;
                }
            }
            if ($.trim(message).length == 0) {
                $('#message_error').html('Message required.');
                $('#message_error').removeClass('hide');
                valid = false;
            } 
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