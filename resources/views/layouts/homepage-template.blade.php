<!DOCTYPE html>
<html>
    <head>

        <!-- Meta Tags -->
        <title>{{ MetaTag::get('title') }}</title>

        {!! MetaTag::tag('description') !!}
        {!! MetaTag::tag('keywords') !!}
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="format-decetion" content="telephone=no" />
        <!-- links -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap" rel="stylesheet">


        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="{{ asset('css/style.css?v=3.3') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/flexslider.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset("/bower_components/admin-lte/dist/css/select2.css")}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
        
        <link rel="stylesheet" href="{{ asset('css/grt-youtube-popup.css') }}">
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--about-us.html-->

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!--[if lte IE 7]> <html class="ie7"> <![endif]-->
        <!--[if IE 8]>     <html class="ie8"> <![endif]-->
        <!--[if IE 9]>     <html class="ie9"> <![endif]-->
        <!--[if !IE]><!-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/jquery.flexslider-min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

   var js_arr = '<?php echo JSON_encode($message);?>';
   //console.log(js_arr);

            var APP_URL = {!! json_encode(url('/')) !!}

            

            $(window).load(function() {
            $('.flexslider2').flexslider({
                animation: "slide"
            });
            });
        </script>

    </head>

    <body>

        <div class="mainpage">
            <!-- header -->

            <!-- Main content -->
            <?= $content ?>
            <!-- Footer -->
            @include('web.footer')

        </div>

        <script type="text/javascript" src="{{ asset("js/wow.min.js") }}"></script>
        <script type="text/javascript" src="{{ asset("js/bootstrap.min.js") }}"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js'></script>
        <script src='{{ asset("js/fluid.jquery.js") }}'></script>
        <script type="text/javascript" src="{{ asset("js/custom.js") }}"></script>
        <!-- <script type="text/javascript" src="{{ asset("js/jquery.photogrid.js") }}"></script>         -->

        <script src="{{ asset("js/grt-youtube-popup.js") }}"></script>
        <script>
            $(".youtube-link-dark").grtyoutube({
                autoPlay:false,
                theme: "dark"
            });
        </script>


        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
        <script src="{{ asset("/bower_components/admin-lte/dist/js/select2.min.js") }}"></script>
        <script src="{{ asset ("js/cart.js") }}"></script>

        

        <?php    if($_SERVER['SERVER_NAME'] == "christianityengaged.org" || $_SERVER['SERVER_NAME'] == "www.christianityengaged.org") {    ?>

            <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/f451fac7a36dba9bcc3d52921/5e6049e3d79568c5035f5b44c.js");</script>
            <!-- Global site tag (gtag.js) - Google Analytics -->

            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126620514-1"></script>

            <script>

              window.dataLayer = window.dataLayer || [];

              function gtag(){dataLayer.push(arguments);}

              gtag('js', new Date());

              gtag('config', 'UA-126620514-1');

            </script>


            <!-- Facebook Pixel Code -->

        <script>

        !function(f,b,e,v,n,t,s)


        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?


        n.callMethod.apply(n,arguments):n.queue.push(arguments)};


        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';


        n.queue=[];t=b.createElement(e);t.async=!0;


        t.src=v;s=b.getElementsByTagName(e)[0];


        s.parentNode.insertBefore(t,s)}(window,document,'script',


        'https://connect.facebook.net/en_US/fbevents.js');


        fbq('init', '533708393797945');


        fbq('track', 'PageView');

        </script>

        <noscript>

        <img height="1" width="1"

        src="https://www.facebook.com/tr?id=533708393797945&ev=PageView

        &noscript=1"/>

        </noscript>

<!-- End Facebook Pixel Code -->
            <!-- Global site tag (gtag.js) - Google Ads: 769682949 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-769682949"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-769682949'); </script>
        <?php } ?>


    </body>
</html>
