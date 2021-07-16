<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Edit Video Topic</h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/video-topics')}}"><i class="fa fa-user"></i> Video Topics</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/videotopics/edit/'.$topic->id)}}" id="edit_videotopic" method="post">
                        {{ csrf_field() }}
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('video_topic');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                    <div class="form-group {{ $class }}">
                                        <label for="">Video Topic</label>
                                        <input type="text" class="form-control" name="video_topic" id="video_topic" value="{{(null !== old('video_topic')) ? old('video_topic') : $topic->video_topic }}" placeholder="Video Topic" autocomplete="off"> @if ($error)
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
                                    <option value="1"  {{ (null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' : $topic->status == "1" ? 'selected='.'"selected"' : '' }} >Active</option>
                                    <option value="0" {{ (null !== old('status')) ? old('status')=="0" ? 'selected='.'"selected"' : '' : $topic->status == "0" ? 'selected='.'"selected"' : '' }} >Inactive</option>
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
                                <a class="btn btn-danger" href="{{url('/manage/video-topics')}}">Cancel</a>
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
<script src="{{ asset ("js/topic.js") }}"></script>