<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Edit Video Amenity</h1>    
</section>

@if (count($errors) > 0)
        <div class="alert alert-danger">
            
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/video-amenity/edit/'.$videoamenity->id)}}" method="post">
                        {{ csrf_field() }}
                        
                        <div class="row">
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
                                    <input type="text" maxlength="150" class="form-control" name="heading" id="heading" value="{{(null !== old('heading')) ? old('heading') : $videoamenity->heading }}" autocomplete="off"> 
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
                                $error = $errors->first('short_description');
                                $class = '';
                                if($error){
                                    $class = 'has-error';    
                                }
                               
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="short_description">Description</label>
                                    <input type="text" maxlength="500" class="form-control" name="short_description" id="short_description" value="{{(null !== old('short_description')) ? old('short_description') : $videoamenity->short_description }}" autocomplete="off"> 
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
                                <a class="btn btn-danger" href="{{url('/manage/video-amenity')}}">Cancel</a>
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