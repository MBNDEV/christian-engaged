<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Add Leader</h1>   
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/cms/save-leader')}}" enctype= multipart/form-data method="post">
                        {{ csrf_field() }}

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('name');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Name">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('designation');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" name="designation" id="designation" value="{{ old('designation') }}" placeholder="Enter designation">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        
                             <div class="col-md-6">
                                <?php
                                $error = $errors->first('short_description');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="short_description">Short Description</label>
                                    <input type="text" class="form-control" name="short_description" id="short_description" value="{{ old('short_description') }}" placeholder="Enter Description">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> 
                        
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('profile_pic');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="profile_pic">Profile Picture</label>
                                    <input type="file" class="form-control" name="profile_pic" id="profile_pic" value="{{ old('profile_pic') }}" >
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
                                    <label for="status">Publish Status</label>
                                    <select name="status" class="form-control">   
                                    <option value="1"  {{ (null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' : '' }} >Active</option>
                                    <option value="2" {{ (null !== old('status')) ? old('status')=="2" ? 'selected='.'"selected"' : '' : '' }} >Inactive</option>
                                </select> @if ($error)
                                    <span class="help-block">
                                    {{ $error }}
                                </span> @endif
                                </div>
                            </div>                            
                        
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('manage/cms/leaders')}}">Cancel</a>
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