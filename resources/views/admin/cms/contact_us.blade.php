<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Contact Us</h1>   
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <div class="box-body">
                 
                    <form action="{{url('manage/cms/save-contactus')}}" enctype= multipart/form-data method="post">
                        {{ csrf_field() }}

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('page_title');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="address">Page Title</label>
                                    <input type="text" class="form-control" name="page_title" id="page_title" value="<?php echo $metadata->page_title ?>" placeholder="Enter Page Title">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('address');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="address">Header 1</label>
                                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $contact_us->address ?>" placeholder="Enter Header 1">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('address_line_2');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="address_line_2">Header 2</label>
                                    <input type="text" class="form-control" name="address_line_2" id="address_line_2" value="<?php echo $contact_us->address_line_2; ?>" placeholder="Enter Header 2">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        
                            <!--  <div class="col-md-6">
                                <?php
                                $error = $errors->first('mobile');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="mobile">Mobile</label>
                                    <input type="number" class="form-control" name="mobile" id="mobile" value="<?php echo $contact_us['mobile']; ?>" placeholder="Enter Mobile">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> 
                        
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('landline_phone');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="landline_phone">Landline</label>
                                    <input type="text" class="form-control" name="landline_phone" id="landline_phone" value="<?php echo $contact_us['landline_phone']; ?>" placeholder="Enter Landline">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> 

                             <div class="col-md-6">
                                <?php
                                $error = $errors->first('email');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $contact_us['email']; ?>" >
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('page_url');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="page_url">Page Url</label>
                                    <input type="text" class="form-control" name="page_url" id="page_url" value="<?php echo $metadata['page_url']; ?>" >
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('meta_keyword');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="<?php echo $metadata['meta_keyword']; ?>" >
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>  
                                   
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('meta_description');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" class="form-control" name="meta_description" id="meta_description" value="<?php echo $metadata['meta_description']; ?>" >
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>  
                                                   
                        
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('/manage/dashboard')}}">Cancel</a>
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