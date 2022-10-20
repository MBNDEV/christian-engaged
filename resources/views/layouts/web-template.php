<!DOCTYPE html>
<html>
    <head>
        <!-- Meta Tags -->
        <title><?= MetaTag::get('title') ?></title>
        <title><?= MetaTag::tag('description') ?></title>
        <title><?= MetaTag::tag('keywords') ?></title>

        <meta name="csrf-token" content="<?= csrf_token() ?>" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="format-decetion" content="telephone=no" />
        <?php
        if (isset($metaShare)) {
            ?>
            <!--            <meta name="twitter:card" content="summary" />
                        <meta name="twitter:site" content="@mukes" />
                        <meta name="twitter:title" content="bla bla" />
                        <meta name="twitter:description" content="bla bla" />
                        <meta name="twitter:image" content="http://www.tapawayapp.com/assets/images/share.png" />
                        <meta name="twitter:url" content="https://tapaway.parseapp.com//share.html" />-->


            <meta property="og:url" content="<?= url()->full() ?>" />
            <meta property="og:type" content="" />
            <meta property="og:title" content="<?= ucfirst(addslashes($video->video_title)) ?>" />
            <meta property="og:description" content="" />
            <meta property="og:image" content="<?= asset('/uploads/videoimages/' . $video->video_image) ?>" />

            <?php
        }
        ?>

        <!--<meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@nytimesbits" />
        <meta name="twitter:creator" content="@nickbilton" />
        <meta property="og:url" content="http://bits.blogs.nytimes.com/2011/12/08/a-twitter-for-my-sister/" />
        <meta property="og:title" content="A Twitter for My Sister" />
        <meta property="og:description" content="In the early days, Twitter grew so quickly that it was almost impossible to add new features because engineers spent their time trying to keep the rocket ship from stalling." />
        <meta property="og:image" content="http://graphics8.nytimes.com/images/2011/12/08/technology/bits-newtwitter/bits-newtwitter-tmagArticle.jpg" />-->


        <link rel="shortcut icon" type="image/png" href="<?= asset('images/favicon.png') ?>">
        <!-- links -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,600i,700" rel="stylesheet">  -->

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="<?= asset('css/style.css?v=4.10') ?>" type="text/css" rel="stylesheet" />
        <link href="<?= asset('css/flexslider.css') ?>" type="text/css" rel="stylesheet" />
        <!-- <link href="{{ asset('css/jquery.bxslider.css') }}" type="text/css" rel="stylesheet" /> -->
        <link href="<?= asset('css/select2.css') ?>" type="text/css" rel="stylesheet" />
        <link href="<?= asset('css/datepicker.css') ?>" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
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
        <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
        <!-- Local Key -->
        
<!--        <script src="https://www.google.com/recaptcha/api.js?render=6Lds7z8aAAAAAOb2iMH-Vj3nBFhKk5LCbhC26-o7"></script>
        
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute("6Lds7z8aAAAAAOb2iMH-Vj3nBFhKk5LCbhC26-o7", {action: 'contact/save'}).then(function (token) {
                    if (token) {
                        //console.log(token);
                        document.getElementById('recaptcha').value = token;
                    }
                });
            });
        </script>-->
        <!-- End -->
      
        <!-- Live Key -->
        <script src="https://www.google.com/recaptcha/api.js?render=6LfBP0EaAAAAAKKc-f-ruMKEwl2lzcvG7UWKWMZH"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('6LfBP0EaAAAAAKKc-f-ruMKEwl2lzcvG7UWKWMZH', {action: 'contact/save'}).then(function (token) {
                    if (token) {
                        //console.log(token);
                        document.getElementById('recaptcha').value = token;
                    }
                });
            });
        </script>
      <!-- End -->

        <script src="https://www.christianityengaged.org/insta_token.js"></script>
<!--<script src="<?= asset('js/instafeed.min.js') ?>"></script>-->
        <script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>

<!--        <script type="text/javascript">
            var link = '';
            var image = '';
            var feed = new Instafeed({
//                get: 'user',
//                tagName: 'awesome',
//                clientId: 'a28e93450a3442549a29206725b2bcbd',
//                userId: '8256860537',
                accessToken: '8256860537.1677ed0.77a8517d70a64e4983d0332fe521f288',
//                resolution: 'low_resolution',
                template:'<li><img src="{{image}}"  alt="" /></li>',
//                sort: 'most-recent',
//                limit: 8
//                links: false
            });
//            if ($('#instafeed').length) {
//                feed.run();
//            }
            feed.run();
        </script>-->



        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var APP_URL = <?= json_encode(url('/')) ?>

            var js_arr = '<?= JSON_encode($message); ?>';
// console.log(js_arr);

        </script>
        <script src="<?= asset("js/cart.js") ?>"></script>
        <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5b3f160347b80c0011966637' async='async'></script>

        <style type="text/css">

            .ElementsApp, .ElementsApp .InputElement{
                color:#005ca3 !important;
            }
            .recapclass{border:1px solid red;width: 307px;}
        </style>

        <?php if ($_SERVER['SERVER_NAME'] == "christianityengaged.org" || $_SERVER['SERVER_NAME'] == "www.christianityengaged.org") { ?>

            <script id="mcjs">!function (c, h, i, m, p) {
                    m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m, p)
                }(document, "script", "https://chimpstatic.com/mcjs-connected/js/users/f451fac7a36dba9bcc3d52921/5e6049e3d79568c5035f5b44c.js");</script>
            <!-- Global site tag (gtag.js) - Google Analytics -->

            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126620514-1"></script>

            <script>

                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }

                gtag('js', new Date());

                gtag('config', 'UA-126620514-1');

            </script>


            <!-- Facebook Pixel Code -->

            <script>

                !function (f, b, e, v, n, t, s)


                {
                    if (f.fbq)
                        return;
                    n = f.fbq = function () {
                        n.callMethod ?
                                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };


                    if (!f._fbq)
                        f._fbq = n;
                    n.push = n;
                    n.loaded = !0;
                    n.version = '2.0';


                    n.queue = [];
                    t = b.createElement(e);
                    t.async = !0;


                    t.src = v;
                    s = b.getElementsByTagName(e)[0];


                    s.parentNode.insertBefore(t, s)
                }(window, document, 'script',
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
        <!-- Global site tag (gtag.js) - Google Ads: 769682949 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-769682949"></script> <script> window.dataLayer = window.dataLayer || [];
                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', 'AW-769682949');</script>
    <?php } ?>

</head>

<body>

    <!-- header -->
    <?php include(base_path('resources/views/web/header.blade.php')); ?>

    <div class="body-content innerbody">
        <?= $content ?>
    </div>
    <?php include(base_path('resources/views/web/footer.blade.php')); ?>

    <script src="<?= asset('js/jquery-ui.min.js') ?>"></script>

    <script src="<?= asset('js/bootstrap-datepicker.js') ?>"></script>
    <script type="text/javascript" src="<?= asset("js/wow.min.js") ?>"></script>
    <script type="text/javascript" src="<?= asset("js/bootstrap.min.js") ?>"></script>

    <script type="text/javascript" src="<?= asset("js/select2.min.js") ?>"></script>
    <script type="text/javascript" src="<?= asset("js/custom.js?v=1.0") ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/jquery.flexslider-min.js"></script>





    <script type="text/javascript">
            var link = '     ';
            var image = '';
            var token = '{{ env("INSTA_TOKEN") }}';
            console.log('this');
            console.log(image);
            var feed = new Instafeed({
                accessToken: token,
                template: '<li><img  src="!!image!!" alt="" /></li>',
                limit: 12,
                templateBoundaries: ["!!", "!!"],
//                transform: function(item) { 
//                    console.log(item.image);
//                    return item;
//                }
//                resolution: 'standard_resolution'
            });
            feed.run();
            $(window).on("load", function () {
                //var instaffedHeight = $("#instafeed li").width();
                var imgheight = $("#instafeed li img").width();
               
                //$("#instafeed li").css("height", instaffedHeight);
                $("#instafeed li img").css("height", imgheight);
            });

            $(window).resize(function () {
                var instaffedHeight = $("#instafeed li").width();
                $("#instafeed li").css("height", instaffedHeight);
            });

    </script>


</body>
</html>