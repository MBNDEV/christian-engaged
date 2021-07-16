<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Add Donation Goal</h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/donation-goals')}}"><i class="fa fa-user"></i> Donation Goals</a></li>
        <li class="active">Create</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/donation-goals/addgoal')}}" id="add_goal" method="post" enctype="multipart/form-data" >
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
                                    <input type="text" class="form-control" maxlength="100" name="title" id="title" value="{{ old('title') }}" placeholder="Enter Title">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
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
                                    <input type="text" class="form-control" name="goal_amount" id="goal_amount" value="{{ old('goal_amount') }}" placeholder="Enter Goal Amount">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
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
                                    <input type="file" class="form-control" name="background_image" id="background_image" value="{{ old('background_image') }}" placeholder="Enter Background Image">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
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
                                    <option value="1"  {{ (null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' : '' }} >Active</option>
                                    <option value="2" {{ (null !== old('status')) ? old('status')=="2" ? 'selected='.'"selected"' : '' : '' }} >Inactive</option>
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
                                <a class="btn btn-danger" href="{{url('manage/donation-goals')}}">Cancel</a>
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