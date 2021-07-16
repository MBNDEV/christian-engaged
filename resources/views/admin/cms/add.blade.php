<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title or "Add CMS Page" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('manage/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li><a href="{{url('manage/cms')}}"><i class="fa fa-files-o"></i> cms</a></li>
        <li class="active">Add</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/cms/save')}}" id="add_page" method="post">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('page_title');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Page Title</label>
                                    
                                    <input type="text" class="form-control" name="page_title" id="page_title" value="{{ (null !== old('page_title')) ? old('page_title') : ''  }}" placeholder="Enter page title">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('page_url');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Page Url(  {{url('/')}}/  )</label>
                                    <input type="text" class="form-control" name="page_url" id="page_url" value="{{ (null !== old('page_url')) ? old('page_url') : ''  }}" placeholder="Enter page url">
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('meta_title');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Page Meta Title</label>
                                    <textarea class="form-control" name="meta_title" id="meta_title" placeholder="Enter page meta title">{{ (null !== old('meta_title')) ? old('meta_title') : ''  }}</textarea>
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('meta_keyword');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Page Meta Keyword</label>
                                    <textarea class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Enter page meta keyword">{{ (null !== old('meta_keyword')) ? old('meta_keyword') : ''  }}</textarea>
                                  
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('meta_description');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Page Meta Description</label>
                                     <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Enter page meta description">{{ (null !== old('meta_description')) ? old('meta_description') : ''  }}</textarea>
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('status');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" >
                                        <option value="1"  {{ (null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' :  '' }} >Active</option>
                                        <option value="0" {{ (null !== old('status')) ? old('status')=="0" ? 'selected='.'"selected"' : '' : '' }} >Inactive</option>
                                    </select>
                                    
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                        </div>
                            
                    </div>
                        
                        <div class="row">
                            
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('page_content');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="page_content">Page Content </label>
                                    <textarea id="editor1"  name="page_content" rows="10" cols="80">
                                            {{ (null !== old('page_content')) ? old('page_content') : '' }}
                                    </textarea>
                                    
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                        </div>
                            
                    </div>
                        
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{url('manage/cms')}}" class="btn btn-danger">Cancel</a>
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
<script src="{{ asset ("js/cms.js") }}"></script>
