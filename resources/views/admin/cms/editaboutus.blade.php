<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Edit Details</h1>    
</section>
<?php $amenitiyDetails = json_decode($sectionDetails->amenity_details)  ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/cms/edit/about-us/'.$sectionDetails->id)}}" method="post">
                        {{ csrf_field() }}
                        @if($sectionDetails->id==1)
                        <div class="col-md-12">
                            <?php
                                $error = $errors->first('heading');
                                $class = '';
                                if($error){
                                    $class = 'has-error';    
                                }
                            ?>
                            <div class="form-group {{ $class }}">
                                <label for="heading">Heading</label>
                                <input type="text" class="form-control" name="heading" id="heading" value="{{(null !== old('heading')) ? old('heading') : $amenitiyDetails->heading }}" placeholder="Enter heading">
                                @if ($error)
                                <span class="help-block">
                                    {{ $error }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
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
                                value="{{(null !== old('short_description')) ? old('short_description') : $amenitiyDetails->short_description }}" placeholder="Enter short description">
                               @if ($error)
                               <span class="help-block">
                                   {{ $error }}
                               </span>
                               @endif
                           </div>
                       </div> 
                        @elseif($sectionDetails->id==2)
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('youtube_url');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }

                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="youtube_url">Youtube Url</label>
                                    <input type="text" class="form-control" name="youtube_url" id="youtube_url" value="{{(null !== old('youtube_url')) ? old('youtube_url') : $amenitiyDetails->youtube_url }}" placeholder="Enter youtube url">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('title');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }

                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{(null !== old('title')) ? old('title') : $amenitiyDetails->title }}" placeholder="Enter title">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                               <?php
                               $error = $errors->first('description');
                               $class = '';
                               if($error){
                               $class = 'has-error';    
                               }

                               ?>
                               <div class="form-group {{ $class }}">
                                   <label for="description">description</label>
                                   <textarea class="form-control" name="description" id="description">{{(null !== old('description')) ? old('description') : $amenitiyDetails->description }}</textarea>
                                   @if ($error)
                                   <span class="help-block">
                                       {{ $error }}
                                   </span>
                                   @endif
                               </div>
                           </div>
                        @elseif($sectionDetails->id==3)
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('heading');
                                $class = '';
                                if($error){
                                $class = 'has-error';    
                                }

                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="heading">Heading</label>
                                    <input type="text" class="form-control" rows="7" name="heading" id="heading" value="{{(null !== old('heading')) ? old('heading') : $amenitiyDetails->heading }}" placeholder="Enter heading">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                               <?php
                               $error = $errors->first('description');
                               $class = '';
                               if($error){
                               $class = 'has-error';    
                               }

                               ?>
                               <div class="form-group {{ $class }}">
                                   <label for="description">description</label>
                                   <textarea class="form-control" rows="7" name="description" id="description">{{(null !== old('description')) ? old('description') : $amenitiyDetails->description }}</textarea>
                                   @if ($error)
                                   <span class="help-block">
                                       {{ $error }}
                                   </span>
                                   @endif
                               </div>
                           </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-danger" href="{{url('manage/cms/about-us')}}">Cancel</a>
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
<script>
    CKEDITOR.replace('description');
</script>