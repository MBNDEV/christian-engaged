<!-- Content Header (Page header) -->
<section class="content-header">
    <h3>
        About Us
    </h3>
    <ol class="breadcrumb">
        <li><a href="{{url('manage/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li class="active">About Us</li>
    </ol>
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
                    <h5>Banner Section</h5>
                    <?php $section1Amenities = json_decode($section1->amenity_details);  ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="35%">Heading</th>
                                <th width="60%">Short Description</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo ($section1Amenities) ? $section1Amenities->heading:'--'; ?>
                                </td>
                                <td>
                                    <?php echo ($section1Amenities) ? $section1Amenities->short_description:'--'; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/cms/edit/about-us/1')}}" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box-body">
                    <h5>Video Section</h5>
                    <?php $section2Amenities = json_decode($section2->amenity_details);  ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="35%">Youtube Url</th>
                                <th width="60%">Title</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo ($section2Amenities) ? $section2Amenities->youtube_url:'--'; ?>
                                </td>
                                <td>
                                    <?php echo ($section2Amenities) ? $section2Amenities->title:'--'; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/cms/edit/about-us/2')}}" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo ($section2Amenities) ? $section2Amenities->description:'--'; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box-body">
                    <h5>Section 3</h5>
                    <?php $section3Amenities = json_decode($section3->amenity_details);  ?>

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="35%">Heading</th>
                                <th width="60%">Description</th>
                                <th width="5%">Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo ($section3Amenities) ? $section3Amenities->heading:'--'; ?>
                                </td>
                                <td>
                                    <?php echo ($section3Amenities) ? $section3Amenities->description:'--'; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/cms/edit/about-us/3')}}" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <form action="{{url('manage/cms/save-about-meta')}}" enctype= multipart/form-data method="post">
                        {{ csrf_field() }}

                         <div class="col-md-4">
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

                            <div class="col-md-8">
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

                            <div class="col-md-4">
                                <?php
                                $error = $errors->first('page_title');
                                $class = '';
                                if($error){
                                $class = 'has-error';
                                }

                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="page_title">Meta Title</label>
                                    <input type="text" class="form-control" name="page_title" id="page_title" value="<?php echo $metadata['page_title']; ?>" >
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-8">
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
                            <div class="clearfix"></div>
                        <div class="box-body">
                            <div class="text-right paddingb10">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
