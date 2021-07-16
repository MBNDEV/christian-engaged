<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ "Christianity Engaged" }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="shortcut icon" type="image/png" href="{{ asset("/bower_components/admin-lte/dist/img/favicon.png")}}">

        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/iCheck/square/blue.css")}}" type="text/css" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
       
        <link href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}" rel="stylesheet">

        <script src="{{ asset("/bower_components/jquery/dist/jquery.min.js") }}"></script>
        <script src="{{ asset("js/jquery-ui.min.js") }}"></script>
        <!-- FastClick -->
        <script src="{{ asset("/bower_components/fastclick/lib/fastclick.js") }}"></script>
        <script src="{{ asset("/bower_components/admin-lte/dist/js/adminlte.min.js") }}"></script>
        <script src="{{ asset("/bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>

        
        <script src="{{ asset("/bower_components/admin-lte/dist/js/select2.min.js") }}"></script>
        <script src="{{ asset ("/bower_components/admin-lte/dist/js/demo.js") }}"></script>

        <script src="{{ asset ("/bower_components/admin-lte/plugins/iCheck/icheck.min.js") }}"></script>
        <script src="{{ asset ("/bower_components/ckeditor/ckeditor.js") }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">            
            $.ajaxSetup({
                 headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
           });
           var APP_URL = {!! json_encode(url('/')) !!};
        </script>


    </head>
    <body class="skin-blue hold-transition skin-blue sidebar-mini">

        
        <div class="wrapper">

            <!-- Header -->
            @include('admin.header')

            <!-- Sidebar -->
            @include('admin.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <?= $content ?>
                <!--@yield('content')-->
            </div><!-- /.content-wrapper -->

            <!-- Footer -->
            @include('admin.footer')

        </div><!-- ./wrapper -->

<div class="loader_box">
    <div class="loader">Loading...</div>
</div>

