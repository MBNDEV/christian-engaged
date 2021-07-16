<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title or "Edit Template" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('templates')}}"><i class="fa fa-files-o"></i> Template Management</a></li>
        <li class="active">Edit template</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/templates/update/'.$template->id)}}" id="edit-template" method="post">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('subject');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Subject</label>
                                    <input type="text" class="form-control" name="subject" id="subject" value="{{ (null !== old('subject')) ? old('subject') : $template->subject  }}" placeholder="Enter subject">
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
                                $error = $errors->first('publish_status');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Status</label>
                                    <select name="publish_status" class="form-control" >
                                        <option value="1"  {{ (null !== old('publish_status')) ? old('publish_status')=="1" ? 'selected='.'"selected"' : '' : $template->publish_status == "1" ? 'selected='.'"selected"' : '' }} >Active</option>
                                        <option value="0" {{ (null !== old('publish_status')) ? old('publish_status')=="0" ? 'selected='.'"selected"' : '' : $template->publish_status == "0" ? 'selected='.'"selected"' : '' }} >Inactive</option>
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
                                $error = $errors->first('message');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Page Content ( Donot remove the strings mentioned within <?= "{{}}" ?> )</label>
                                    <textarea id="editor_eml_temp" name="message" rows="10" cols="80">
                                            {{ (null !== old('message')) ? old('message') : $template->message  }}
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
                                <a href="{{url('manage/templates')}}" class="btn btn-danger">Cancel</a>
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
<script src="{{ asset ("js/template.js") }}"></script>