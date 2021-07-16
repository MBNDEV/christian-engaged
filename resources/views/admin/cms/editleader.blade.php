<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Edit Leader</h1>    
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/cms/update-leader/'.$leader->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="profilepicStatus" id="profilepicStatus" value="0">
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
                                    <input type="text" class="form-control" name="name" id="name"  value="{{(null !== old('name')) ? old('name') : $leader->name }}" placeholder="Enter Name">
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
                                    <input type="text" class="form-control" name="designation" id="designation"  value="{{(null !== old('designation')) ? old('designation') : $leader->designation }}" placeholder="Enter designation">
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
                                    <label for="short_description">Short description</label>
                                    <input type="text" class="form-control" name="short_description" id="short_description"
                                     value="{{(null !== old('short_description')) ? old('short_description') : $leader->short_description }}" placeholder="Enter short description">
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
                                    <label for="">Publish Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1" {{(null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' : $leader->status == "1" ? 'selected='.'"selected"' : '' }} >Active</option>
                                        <option value="2" {{(null !== old('status')) ? old('status')=="2" ? 'selected='.'"selected"' : '' : $leader->status == "2" ? 'selected='.'"selected"' : '' }} >Inactive</option>
                                    </select>
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
                                    <label for="profile_pic">Product Image</label>
                                    <input type="file" class="form-control" name="profile_pic" disabled id="profile_pic" value="{{(null !== old('profile_pic')) ? old('profile_pic') : $leader->profile_pic }}">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                                <div class="profile_pic_div" id="profile_pic_div">
                                    <img id="profile_image" src="{{asset('/uploads/leadership/'.$leader->profile_pic) }}" width="100">
                                    <button id="removeprofileImage" type="button" title="Remove Image" class="remove">×</button>
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
<script src="{{asset('js/leaders.js')}}"></script>