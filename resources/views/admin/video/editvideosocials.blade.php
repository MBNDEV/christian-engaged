
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h1>Edit Video</h1>    
        </div>  
    </div>
    
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('/manage/videossocials')}}"><i class="fa fa-user"></i>Socials Videos</a></li>
        <li class="active">Edit</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    @foreach($socialvideos as $video)
                    <form action="{{url('manage/videossocials/edit/'.$video->id)}}" id="edit_video5" method="post" enctype= multipart/form-data>
                        {{ csrf_field() }}

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
                                    <input type="text" class="form-control" name="video_title" id="video_title" value="{{(null !== old('video_title')) ? old('video_title') : $video->video_title }}" placeholder="Enter Video Title">
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
                                $error = $errors->first('video_url');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="video_url">Video URL</label>
                                    <input type="text" class="form-control" name="video_url" id="video_url" value="{{(null !== old('video_url')) ? old('video_url') : $video->video_url }}" placeholder="Enter Video URL">
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
                                $error = $errors->first('video_image');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="video_image">Video Image</label>
                                    <input type="file" name="video_image" disabled id="video_image" class="form-control">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>

                             <div class="vedio_image_div" id="vedio_image_div">
                                <img id="propic_img" src="{{asset('/uploads/videoimages/'.$video->video_image) }}" width="100">
                                  <button id="remove_vedio_image" type="button" title="Remove Vedio Picture" class="remove">×</button>
                             </div>
                             <input type="hidden" name="vedioImageStatus" value="0" class="form-control" id="vedioImageStatus">
                            </div>
                        </div>
                        
                                <div class="row">                            
                                    <div class="col-md-6">
                                        <?php
                                        $error = $errors->first('video_description');
                                        $class = '';
                                        if ($error) {
                                            $class = 'has-error';
                                        }
                                        ?>
                                        <div class="form-group {{ $class }}">
                                            <label for="video_description">Video Description</label>
                                            <textarea id="editor1"  name="video_description" rows="10" cols="75">
                                                {{ (null !== old('video_description')) ? old('video_description') : $video->video_description  }}
                                            </textarea>

                                            @if ($error)
                                            <span class="help-block">
                                                {{ $error }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>  
                            
                        
                        @endforeach
                        
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('manage/videossocials/')}}">Cancel</a>
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
<script src="../script/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{ asset ('js/video.js') }}"></script>
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

//Set vals

// Then refresh
$("#related_videos").multiselect("refresh");

  CKEDITOR.replace( 'editor1' );


</script>

