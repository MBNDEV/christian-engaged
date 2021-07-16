  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
         <img src="{{ asset("/bower_components/admin-lte/dist/img/user.jpg") }}" class="img-circle" alt="User Image"/>
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
        </div>
      </div>
      <!-- search form -->
<!--      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

      <li class="dashboard" id="dashboard"><a href="{{url('manage/dashboard')}}"><i class="fa fa-users"></i> <span>Dashboard</span></a></li>

<!--        <li class="active users"><a href="{{url('manage/users')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        -->
      <!--   <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>CMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="cms" id="cms" ><a href="{{url('manage/cms')}}"><i class="fa fa-files-o"></i> <span>CMS</span></a></li>
            <li id="leaders"><a href="{{url('manage/cms/leaders')}}"><i class="fa fa-files-o"></i>Leaders</a></li>
            <li id="about-us"><a href="{{url('manage/cms/about-us')}}"><i class="fa fa-files-o"></i>About Us Page</a></li>
          </ul>
        </li>  -->

       <li class="treeview menu-open">
          <a href="#">
            <i class="fa fa-share"></i> <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li id="homepage"><a href="{{url('manage/cms/edit/2')}}"><i class="fa fa-files-o"></i> Home Page</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-files-o"></i> About Us
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="about-us"><a href="{{url('manage/cms/about-us')}}"><i class="fa fa-files-o"></i>About Us Page</a></li>
                <li id="leaders"><a href="{{url('manage/cms/leaders')}}"><i class="fa fa-files-o"></i> Leadership</a></li>
              </ul>
            </li>
            <li id="video-library"><a href="{{url('manage/cms/edit/3')}}"><i class="fa fa-files-o"></i>Videos</a></li>
            <li id="donation"><a href="{{url('manage/cms/edit/4')}}"><i class="fa fa-files-o"></i> Donate</a></li>
            <li id="merch"><a href="{{url('manage/cms/edit/5')}}"><i class="fa fa-files-o"></i> Store</a></li>
                    <li id="tou"><a href="{{url('manage/cms/edit/6')}}"><i class="fa fa-files-o"></i> Terms of Use</a></li>
            <li id="policy"><a href="{{url('manage/cms/edit/7')}}"><i class="fa fa-files-o"></i> Privacy Policy</a></li>
            <li id="statement"><a href="{{url('manage/cms/edit/10')}}"><i class="fa fa-files-o"></i> Statement of Faith</a></li>
             <li id="contactus"><a href="{{url('manage/contact_us/edit')}}"><i class="fa fa-files-o"></i>Contact Us</a></li>
          </ul>
        </li>



       <!--        <li class="settings" ><a href="{{url('manage/settings')}}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>-->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-video-camera"></i> <span>Videos Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="video-topics"><a href="{{url('manage/video-topics')}}"><i class="fa fa-circle-o"></i>Video Topics</a></li>
            <li id="1"><a href="{{url('manage/videos/')}}"><i class="fa fa-circle-o"></i>Videos</a></li>
            <li id="1"><a href="{{url('manage/videossocials/')}}"><i class="fa fa-circle-o"></i>Socials Videos</a></li>
            <li id="featured-videos"><a href="{{url('manage/featured-videos')}}"><i class="fa fa-circle-o"></i>Featured Videos</a></li>
            <li id="video-amenity"><a href="{{url('manage/video-amenity')}}"><i class="fa fa-circle-o"></i>Video Heading</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>E-Commerce</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="product-categories"><a href="{{url('manage/product-categories')}}"><i class="fa fa-circle-o"></i>Product Categories</a></li>
            <li id="products"><a href="{{url('manage/products')}}"><i class="fa fa-circle-o"></i>Products</a></li>
            <li id="products"><a href="{{url('manage/featured-products')}}"><i class="fa fa-circle-o"></i>Featured Products</a></li>
            <li id="orders"><a href="{{url('manage/orders')}}"><i class="fa fa-circle-o"></i>Orders</a></li>
            <li id="setting"><a href="{{url('manage/setting')}}"><i class="fa fa-circle-o"></i>Shipping</a></li>
          </ul>
        </li>

        <li class="templates" id="newsletter" ><a href="{{url('manage/newsletter/listing')}}"><i class="fa fa-envelope-o"></i> <span>Newsletters</span></a></li>
        <li class="manage-message" id="message" ><a href="{{url('manage/message')}}"><i class="fa fa-paragraph"></i> <span>Message Management</span></a></li>
        <li class="templates" id="templates" ><a href="{{url('manage/templates')}}"><i class="fa fa-envelope-o"></i> <span>Template Management</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope-o"></i> <span>Donations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="donation-goals">
                <a href="{{url('manage/donation-goals')}}">
                    <i class="fa fa-circle-o"></i>Donation Goals
                </a>
            </li>
            <li id="donations">
                <a href="{{url('manage/donations')}}">
                    <i class="fa fa-circle-o"></i>Donation History
                </a>
            </li>
          </ul>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


<script type="text/javascript">
$(window).load(function() {
    $('.treeview').click(function(){
        $('.treeview').removeClass('active');
    });
    var pageurl=window.location.pathname.split("/").pop();
    if(pageurl== 'videos' || window.location.pathname.toLowerCase().indexOf("manage/videos/") >= 0){
       pageurl ="1";
    }

    if (window.location.pathname.toLowerCase().indexOf("product/edit/") >= 0){
      pageurl ="products";
    }
     if (window.location.pathname.toLowerCase().indexOf("productcategory/edit/") >= 0){
      pageurl ="product-categories";
    }
    if (window.location.pathname.toLowerCase().indexOf("videotopics/edit/") >= 0){
      pageurl ="video-topics";
    }
    if (window.location.pathname.toLowerCase().indexOf("videos/edit/") >= 0){
      pageurl ="1";
    }
    if (window.location.pathname.toLowerCase().indexOf("video-amenity/edit") >= 0){
      pageurl ="video-amenity";
    }
  if (window.location.pathname.toLowerCase().indexOf("cms/edit/about-us/") >= 0){
      pageurl ="about-us";
    }
    if (window.location.pathname.toLowerCase().indexOf("manage/cms/edit-leader/") >= 0){
      pageurl ="leaders";
    }
    if (window.location.pathname.toLowerCase().indexOf("manage/templates/edit/") >= 0){
      pageurl ="templates";
    }
    if (window.location.pathname.toLowerCase().indexOf("manage/videotopics/add") >= 0){
      pageurl ="video-topics";
    }
    if (window.location.pathname.toLowerCase().indexOf("manage/productcategory/add") >= 0){
      pageurl ="product-categories";
    }
    if (window.location.pathname.toLowerCase().indexOf("manage/product/add") >= 0){
      pageurl ="products";
    }
     if (window.location.pathname.toLowerCase().indexOf("manage/newsletter/listing/") >= 0){
      pageurl ="newsletter";
    }
    if (window.location.pathname.toLowerCase().indexOf("manage/message/create") >= 0){
      pageurl ="message";
    }
    if (window.location.pathname.toLowerCase().indexOf("manage/message/edit/") >= 0){
      pageurl ="message";
    }
    if (window.location.pathname.toLowerCase().indexOf("manage/donation-goals/editgoal") >= 0){
      pageurl ="donation-goals";
    }
     if (window.location.pathname.toLowerCase().indexOf("manage/donation-goals/addgoal") >= 0){
      pageurl ="donation-goals";
    }  if (window.location.pathname.toLowerCase().indexOf("manage/dashboard") >= 0){
      pageurl ="dashboard";
    }




    if (window.location.pathname.toLowerCase().indexOf("cms/edit/") >= 0){

          if(pageurl== 2){
             pageurl ="homepage";
          }
          if(pageurl == 3){
             pageurl ="videos";
          }
          if(pageurl == 4){
             pageurl ="donation";
          }
          if(pageurl == 5){
             pageurl ="store";
          }
          if(pageurl == 6){
             pageurl ="tou";
          }
          if(pageurl == 7){
             pageurl ="policy";
          }
          if(pageurl == 9){
             pageurl ="cart";
          }

  }

    if(pageurl == 'templates'){
       pageurl ="templates";
    }
    if(pageurl == 'edit'){
       pageurl ="contactus";
    }if('newsletter/'+pageurl == 'newsletter/listing'){
       pageurl ="newsletter";
    } if(pageurl == 'message'){
       pageurl ="message";
    }


    console.log(pageurl);
    $(".sidebar-menu li").removeClass('menu-open active');
    $(".sidebar-menu li ul li").removeClass('active');
    $( "#"+pageurl ).parent().parent().addClass( "menu-open active");
    $( "#"+pageurl ).parent().parent().parent().addClass( "menu-open active");
    $( "#"+pageurl).parents('li').addClass('active');
    $( "#"+pageurl ).addClass( "active");
});
</script>
