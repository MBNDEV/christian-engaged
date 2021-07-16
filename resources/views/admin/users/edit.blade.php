<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Edit User</h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/users')}}"><i class="fa fa-user"></i> User</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/users/edit/'.$user->id)}}" id="edit_user" method="post">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('first_name');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                    <div class="form-group {{ $class }}">
                                        <label for="">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ (null !== old('first_name')) ? old('first_name') : $user->first_name  }}" placeholder="Enter name"> @if ($error)
                                        <span class="help-block">
                                        {{ $error }}
                                    </span> @endif
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('last_name');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                    <div class="form-group {{ $class }}">
                                        <label for="">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ (null !== old('last_name')) ? old('last_name') : $user->last_name  }}" placeholder="Enter Last name" autocomplete="off"> @if ($error)
                                        <span class="help-block">
                                        {{ $error }}
                                    </span> @endif
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('email');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                    <div class="form-group {{ $class }}">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" value="{{(null !== old('email')) ? old('email') : $user->email }}" placeholder="Email" autocomplete="off"> @if ($error)
                                        <span class="help-block">
                                        {{ $error }}
                                    </span> @endif
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
                                    <option value="1"  {{ (null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' : $user->status == "1" ? 'selected='.'"selected"' : '' }} >Active</option>
                                    <option value="0" {{ (null !== old('status')) ? old('status')=="0" ? 'selected='.'"selected"' : '' : $user->status == "0" ? 'selected='.'"selected"' : '' }} >Inactive</option>
                                </select> @if ($error)
                                    <span class="help-block">
                                    {{ $error }}
                                </span> @endif
                                </div>
                            </div>                             
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('password');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" autocomplete="off">
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $class }}">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter Retype password" autocomplete="off">
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('/manage/users')}}">Cancel</a>
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
<script src="{{ asset ("js/user.js") }}"></script>