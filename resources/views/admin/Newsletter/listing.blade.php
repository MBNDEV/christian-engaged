<!-- Content Header (Page header) -->
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<?php  if(!empty($datas)){ ?>
    <div class="alert alert-success">
        {{ $datas }}
    </div>
     <?php } ?>
<section class="content-header">
    <div class="row">

        <div class="col-md-12">
            <ul class="newsletter-listing">
                <li>
                    <h1>Newsletters</h1>
                </li>
                <form action="/manage/newsletter/listing" method="POST" id="export" name="export" >
                    {{ csrf_field() }}
                    <?php 

                    if(!isset($status)){
                    $status =0; }
                    ?>
                    <li>
                        <select id="newsStatus" name="status" class="form-input filter">
                            <option @if($status ==0) selected @endif value="0">Select Status</option>
                            <option @if($status ==1) selected @endif value="1">Subscribed</option>
                            <option @if($status ==2) selected @endif value="2">Unsubscribe</option>                 
                         </select>
                    </li>
                    <li>
                        <label>From:</label> 
                        <input type="text" class="form-control inline" value="@if(isset($fromDate)){{$fromDate}}@endif" name="fromDate" id="fromDate">
                    </li>
                    <li>
                        <label>To:</label> 
                        <input type="text" class="form-control inline" value="@if(isset($toDate)){{$toDate}}@endif" name="toDate" id="toDate">
                    </li>
                    <li>
                        <button class="btn btn-primary sort-row large-btn" data-text="Sort">Submit</button>
                    </li>
                </form>
                
                <form action="/manage/export" method="post" id="export" class="export"> 
                    {{ csrf_field() }}
                    <input type="hidden" value="@if(isset($fromDate)){{$fromDate}}@endif" id="fromDate" name="fromDate" >
                    <input type="hidden" value="@if(isset($toDate)){{$toDate}}@endif" id="toDate" name="toDate" >
                    <input type="hidden" value="<?php echo $status ?>" id="status" name="status" >
                    <li class="last">
                        <button class="btn btn-primary sort-row large-btn" data-text="Export">Export</button>
                    </li>
                  
                </form>
                 <!-- <li class="last" style="padding-left: 10px;">
                   <button class="btn btn-primary  large-btn" data-toggle="modal" data-target="#myModal">Next to Export</button>
                </li> -->
            </ul>
        </div>
        
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
               
                <div class="box-body table-responsive padding user_listing">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>S.No</th>
                                <th>Email</th>
 				<th>Date</th>
                                <th>Status</th>
                            </tr>

                            <?php
                            $i = 1; 
                             if($page){
                                  $i =  env('RECORDS_PER_PAGE', 10) *  ($page-1) + 1;
                             }                            
                            ?>                           
                            @foreach ($newsletters as $newsletter)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$newsletter->email}}</td>
				    <td>{{$newsletter->created_at}}</td>
                                    @if ($newsletter->status == 1)
                                        <td><span class="label label-success">Subscribed</span></td>
                                    @else
                                        <td><span class="label label-warning">Unsubscribed</span></td>
                                    @endif                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer clearfix">                  
                    <ul class="pagination pagination-sm no-margin pull-right">                      
                      {{ $newsletters->links('vendor.pagination.bootstrap-4') }} 
                    </ul>
                </div>                
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>    
</section>
<script type="text/javascript" src="{{ URL::to('js/newsletter.js') }}"></script>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Newsletter</h4>
        </div>
        <div class="modal-body">
          <form action="/manage/exportnews" method="post"> 
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" class="form-control" id="newsletter_email" name="email" required="" placeholder="Enter Your Email">
                    </div>
                    <div class="clearfix">
                        <button type="submit" id="newsletter_subscribe" class="join-btn">Submit</button>
                        <br>
                        <div id="newsletter_message" class="success-msg text-center"></div>
                    </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  