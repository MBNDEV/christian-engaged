<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title or "Dashboard" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
<!--        <li><a href="#"><i class="fa fa-users"></i> User Management</a></li>-->
        <!--        <li class="active">Here</li>-->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="dashboard-donate">
                <div class="heading">
                    <h4> Donations statistics</h4>
                </div>

                <div class="dashboard-content">
                    <div class="date">
                        <p class="gray-text">{{$donation['todayDate']}}</p>
                        <p>Happy {{$day}}</p>
                        <div class="price">
                            <h2>${{$donation['donationsToday']}}</h2>
                        </div>
                        <p>
                             Donations Today
                        </p>
                    </div>
                </div>

                <ul>
                    <li>
                        <h4>${{$donation['donationsCurrentWeek']}} <span>This Week</span></h4>
                    </li>
                    <li>
                        <h4>${{$donation['donationsCurrentMonth']}} <span>This Month</span></h4>
                    </li>
                    <li>
                        <h4>${{$donation['donationslastMonth']}} <span>Last Month</span></h4>
                    </li>
                    <li>
                        <h4>${{$donation['donationsCurrentYear']}} <span>This Year</span></h4>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="dashboard-status">
                <div class="heading">
                    <h4>Orders Status</h4>
                </div>

                <div class="monthsale">
                    <span class="circle"><i class="fa fa-signal"></i></span>
                    <h4>${{$sales['net_sales']}} <span>Net Sales This Month</span></h4>
                </div>

                <ul>
                    <li>
                        <span class="circle"><i class="fa fa-ellipsis-h"></i></span>
                        <h4>{{$sales['pending']}} Order <span>Pending</span></h4>
                    </li>
                    <li>
                        <span class="circle"><i class="fa fa-minus"></i></span>
                        <h4>{{$sales['awating']}} Order <span>Awaiting Shipment</span></h4>
                    </li>
                    <li>
                        <span class="circle"><i class="fa fa-exclamation"></i></span>
                        <h4>{{$sales['on_hold']}} Order <span>On Hold</span></h4>
                    </li>
                    <li>
                        <span class="circle"><i class="fa fa-times"></i></span>
                        <h4>{{$sales['cancelled']}} Order <span>Cancelled</span></h4>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
</section>

