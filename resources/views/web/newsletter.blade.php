<header id="header" class="header about-us innernav">
   
        <div class="container-fluid">
            <div class="row">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{ asset('images/logos.svg') }}" alt="" /></a>
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
                            <!-- <li>
                                <a href="{{url('store')}}">
                                    Store
                                </a>
                            </li> -->
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
                            <!-- <li class="cart-btn">
                                <a href="{{url('/cart')}}" id='cartDetail'>
                                    Cart <em data-count='0'>0</em>
                                    <span class="cart-icon">&nbsp;</span>
                                </a>
                            </li> -->
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </header>
    <div class="body-content">
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
                            <a class="join-btn btn btn-primary" href="https://www.youtube.com/ChristianityEngaged" target="_blank">Subscribe</a>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#newsletter').modal('show'); 
    })
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