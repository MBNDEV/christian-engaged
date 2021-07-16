<div class="ajax-loader-wrapper">
  <div class="loader-block">
    <img src="{{ asset("/img/ajax-loader.svg") }}" alt="">
    <p>Loading...</p>
  </div>
</div>

<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{url('manage/dashboard')}}" class="logo">
        <span class="logo-mini"><img src="{{ asset("/bower_components/admin-lte/dist/img/logo-symbol.png")}}" alt="Christianity Engaged" /></span>
        <span class="logo-lg"><img src="{{ asset("/bower_components/admin-lte/dist/img/logo-small.png")}}" alt="Christianity Engaged" /> </span>
    </a>
            
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset("/bower_components/admin-lte/dist/img/user.jpg") }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">Admin</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset("/bower_components/admin-lte/dist/img/user.jpg") }}" class="img-circle" alt="User Image" />
                            <p>Admin</p>
                        </li>
                        <li class="user-footer text-center">
                            <a href="{{url('manage/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>