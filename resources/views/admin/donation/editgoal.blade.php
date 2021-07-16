<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Edit Donation Goal</h1>
       

    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/donation-goals')}}"><i class="fa fa-user"></i> Donation Goals</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if($errors->any())
        <div class="alert alert-error">{{$errors->first()}}</div>
           @endif
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/donation-goals/editgoal/'.$goal->id)}}" id="edit_goal" method="post" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('title');
                                $class = '';
                                if($error){
                                    $class = 'has-error';    
                                }                               
                                ?>
                                    <div class="form-group {{ $class }}">
                                        <label for="title">Goal Title</label>
                                        <input type="text" class="form-control"  maxlength="100"  name="title" id="title" value="{{(null !== old('title')) ? old('title') : $goal->title }}" placeholder="Video Topic" autocomplete="off"> @if ($error)
                                        <span class="help-block">
                                        {{ $error }}
                                    </span> @endif
                                    </div>
                            </div>                            
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('goal_amount');
                                $class = '';
                                if($error){
                                    $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="goal_amount">Goal Amount</label>
                                    <input type="text" class="form-control" name="goal_amount" id="goal_amount" value="{{(null !== old('goal_amount')) ? old('goal_amount') : $goal->goal_amount }}" placeholder="Goal Amount" autocomplete="off"> @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span> @endif
                                </div>
                            </div>                                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('background_image');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="background_image">Background Image</label>
                                    <input type="file" class="form-control" name="background_image" disabled id="background_image" value="{{(null !== old('background_image')) ? old('background_image') : $goal->background_image }}" placeholder="Enter Background Image">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                                <input type="hidden" name="backgroundImageStatus" value="0" class="form-control" id="backgroundImageStatus">
                                <div class="profileImage" id="backg_img_div">
                                  <img id="backg_img" src="{{asset('/uploads/donation_goal_images/'.$goal->background_image) }}" width="100">
                                  <button id="remove_background_image" type="button" title="Remove Background Picture" class="remove">×</button>
                               </div>
                            </div> 
                            
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('status');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }                               
                                ?>
                                <div class="form-group {{ $class }}">  
                                    <label for="">Status</label> 
                                    <select name="status" class="form-control">
                                    <option value="1"  {{ (null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' : $goal->status == "1" ? 'selected='.'"selected"' : '' }} >Active</option>
                                    <option value="2" {{ (null !== old('status')) ? old('status')=="2" ? 'selected='.'"selected"' : '' : $goal->status == "2" ? 'selected='.'"selected"' : '' }} >Inactive</option>
                                </select> @if ($error)
                                    <span class="help-block">
                                    {{ $error }}
                                </span> @endif
                                </div>
                            </div>                             
                        </div>
                                               
                        
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('/manage/donation-goals')}}">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<script src="{{ asset ("js/donation.js") }}"></script>