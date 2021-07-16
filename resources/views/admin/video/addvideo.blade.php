<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Add Video</h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/videos/1')}}"><i class="fa fa-user"></i>Videos</a></li>
        <li class="active">Create</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/videos/add')}}" id="add_video" method="post" enctype= multipart/form-data>
                        {{ csrf_field() }}
                        
                        <!-- <input type="text" id="topic_id" name="topic_id" value="{{(null !== old('topic_id')) ? old('topic_id') : $topicId }}" class="form-control"> -->
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('video_title');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="video_title">Video Title</label>
                                    <input type="text" class="form-control" name="video_title" id="video_title" value="{{ old('video_title') }}" placeholder="Enter Video Title">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="video_title">Video Topic</label>
                                <select class="form-control" id="topic_id" name="topic_id" required>
                                    @foreach($topics as $topic)
                                    <option value="{{$topic->id}}"> {{$topic->video_topic}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>                        
                        
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('video_url');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="video_url">Video URL</label>
                                    <input type="text" class="form-control" name="video_url" id="video_url" value="{{ old('video_url') }}" placeholder="Enter Video URL">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('publish_status');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }                               
                                ?>
                                <div class="form-group {{ $class }}">  
                                    <label for="">Status</label>
                                    <select name="publish_status" class="form-control">
                                    <option value="1"  {{ (null !== old('publish_status')) ? old('publish_status')=="1" ? 'selected='.'"selected"' : '' : '' }} >Active</option>
                                    <option value="0" {{ (null !== old('publish_status')) ? old('publish_status')=="0" ? 'selected='.'"selected"' : '' : '' }} >Inactive</option>
                                </select> @if ($error)
                                    <span class="help-block">
                                    {{ $error }}
                                </span> @endif
                                </div>
                            </div>

                                
                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('seo_slug');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_slug">Video Slug</label>
                                    <input type="text" class="form-control" maxlength="150" name="seo_slug" id="seo_slug" value="{{ old('seo_slug') }}" placeholder="Slug" required="">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <?php
                                $error = $errors->first('seo_keywords');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_keywords">Video Meta Keywords</label>
                                    <textarea id="seo_keywords" name="seo_keywords" class="form-control" placeholder="Keywords" >{{ old('seo_keywords') }}</textarea>

                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <?php
                                $error = $errors->first('seo_title');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_title">Video Meta Title</label>
                                    <textarea class="form-control" name="seo_title" id="seo_title" placeholder="Keywords" rows="4" >{{ old('seo_title') }}</textarea>

                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                              <div class="col-md-6">
                                <?php
                                $error = $errors->first('seo_description');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="seo_description">Video Meta Description</label>
                                    <textarea id="seo_description" name="seo_description" class="form-control" 
                                      placeholder="Seo Meta Description" rows="4" >{{ old('seo_description') }}</textarea>

                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        

                            <div class="col-md-6">
                                <?php
                                $error = $errors->first('video_image');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="video_image">Video Image</label>
                                    <input type="file" name="video_image" id="video_image" class="form-control">
                                    <span>(File must be jpeg,png,jpg,gif,svg, less than 1MB and having resolution 600×338 or higher)</span>
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
                                $error = $errors->first('source_pdf');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="video_image">Source Pdf</label>
                                    <input type="file" name="source_pdf" id="source_pdf" accept="application/pdf" class="form-control">
                                    <span>(File must be pdf, less than 1MB )</span>
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
                                        $error = $errors->first('source');
                                        $class = '';
                                        if ($error) {
                                            $class = 'has-error';
                                        }
                                        ?>
                                        <div class="form-group {{ $class }}">
                                            <label for="source">Source</label>
                                            <textarea id="source"  name="source" rows="10" cols="80">
                                            {{ (null !== old('source')) ? old('source') : '' }}
                                            </textarea>

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
                                        $error = $errors->first('transcript_pdf');
                                        $class = '';
                                        if($error){
                                        $class = 'has-error';    
                                        }

                                        ?>
                                        <div class="form-group {{ $class }}">
                                           <label for="video_image">Transcript Pdf</label>
                                           <input type="file" name="transcript_pdf" id="transcript_pdf" accept="application/pdf" class="form-control">
                                           <span>(File must be pdf, less than 1MB )</span>
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
                                        $error = $errors->first('transcript');
                                        $class = '';
                                        if ($error) {
                                            $class = 'has-error';
                                        }
                                        ?>
                                        <div class="form-group {{ $class }}">
                                            <label for="transcript">Transcript</label>
                                            <textarea id="transcript"  name="transcript" rows="10" cols="80">
                                            {{ (null !== old('transcript')) ? old('transcript') : '' }}
                                            </textarea>

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
                                        $error = $errors->first('video_description');
                                        $class = '';
                                        if ($error) {
                                            $class = 'has-error';
                                        }
                                        ?>
                                        <div class="form-group {{ $class }}">
                                            <label for="video_description">Video Description</label>
                                            <textarea id="video_description"  name="video_description" rows="10" cols="80">
                                            {{ (null !== old('video_description')) ? old('video_description') : '' }}
                                            </textarea>

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
                                $error = $errors->first('video_duration');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="video_duration">Video duration</label>
                                    <input type="text" class="form-control" name="video_duration" id="video_duration" value="{{ old('video_duration') }}" placeholder="Enter Video duration">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="related_videos">Related Videos</label>
                                    <select id="related_videos" name="related_videos[]" multiple class="form-control" >
                                        <?php foreach($videos as $video){ ?>
                                            <option value='<?php echo $video->id ?>'><?php echo $video->video_title ?></option>
                                        <?php } ?>
                                    </select>  
                                </div>
                            </div>                     
                        </div>        
                                               
                        <div class="row">    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_featured"></label>
                                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ (old('is_featured'))?'checked':'' }}>
                                    Set as featured
                                </div>                                
                            </div>  
                        </div>    
                           
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('manage/videos/'.$topicId)}}">Cancel</a>
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
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset ("js/video.js") }}"></script>
<script>
$('#related_videos').multiselect({
    buttonWidth: '100%',   
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true, 
    filterPlaceholder: 'Search Videos',
    numberDisplayed: 3,
    buttonText: function(options, select) {
        if (options.length === 0) {
            return 'Select related video(s)';
        }
        else{
            return options.length+' video(s) selected';
        }
    },
    onChange: function(option, checked) {
        // Get selected options.
        var selectedOptions = jQuery('#related_videos option:selected');

        if (selectedOptions.length >= 3) {
          if (selectedOptions.length > 3) {
            alert('Too many selected (' + selectedOptions.length + ')');
          } else {
            // Disable all other checkboxes.
            var nonSelectedOptions = jQuery('#related_videos option').filter(function() {
              return !jQuery(this).is(':selected');
            });

            nonSelectedOptions.each(function() {
              var input = jQuery('input[value="' + jQuery(this).val() + '"]');
              //console.log(input);
              input.prop('disabled', true);
              input.parent('li').addClass('disabled');
            });
            jQuery('#is_featured').prop('disabled', false);
            jQuery('#topic_id').prop('disabled', false);
          }
        } else {
          // Enable all checkboxes.
          jQuery('#related_videos option').each(function() {
            var input = jQuery('input[value="' + jQuery(this).val() + '"]');
            input.prop('disabled', false);
            input.parent('li').addClass('disabled');
          });
        }
    }
});


<?php $related_videos = json_encode(old('related_videos')); ?>
//Set vals
$("#related_videos").val(<?php echo $related_videos; ?>);
// Then refresh
$("#related_videos").multiselect("refresh");


</script>
