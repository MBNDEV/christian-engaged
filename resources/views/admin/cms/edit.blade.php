<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title or "Edit Page" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('manage/cms')}}"><i class="fa fa-files-o"></i> cms</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                  @endif
                    <form action="{{url('manage/cms/update/'.$cms->id)}}" id="edit_page" method="post">
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
                                    <label for="">Meta Title</label>
                                    <input type="text" class="form-control" name="page_title" id="page_title" value="{{ (null !== old('page_title')) ? old('page_title') : $cms->page_title  }}" placeholder="Enter page Title">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>

                        <?php
                        $page_ids=[6,7,10];
                        if (in_array($cms->id, $page_ids)) {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('page_heading');
                                $class = '';
                                if($error){
                                $class = 'has-error';
                                }

                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Page Heading</label>
                                    <input type="text" class="form-control" name="page_heading" id="page_heading" value="{{ (null !== old('page_heading')) ? old('page_heading') : $cms->page_heading  }}" placeholder="Enter page Heading">
                                    @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if($cms->id != 2){
                        ?>
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
                                    <label for="">Page Url (  {{url('/')}}/  )</label>
                                    <input type="text" class="form-control" name="page_url" id="last_name" value="{{ (null !== old('page_url')) ? old('page_url') : $cms->page_url  }}" placeholder="Enter page Url">
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <?php
                        }else{
                            ?>
                        <input type="hidden" class="form-control" name="page_url" id="last_name" value="{{ (null !== old('page_url')) ? old('page_url') : $cms->page_url  }}" placeholder="Enter page Url">
                             <?php
                        }
                        ?>



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
                                    <textarea class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Enter page meta keyword">{{ (null !== old('meta_keyword')) ? old('meta_keyword') : $cms->meta_keyword  }}</textarea>

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
                                     <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Enter page meta description">{{ (null !== old('meta_description')) ? old('meta_description') : $cms->meta_description  }}</textarea>
                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <?php
                        $page_ids=[2,3,4,5];
                        if (!in_array($cms->id, $page_ids)) {


                        ?>
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
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" >
                                        <option value="1"  {{ (null !== old('status')) ? old('status')=="1" ? 'selected='.'"selected"' : '' : $cms->publish_status == "1" ? 'selected='.'"selected"' : '' }} >Active</option>
                                        <option value="2" {{ (null !== old('status')) ? old('status')=="2" ? 'selected='.'"selected"' : '' : $cms->publish_status == "2" ? 'selected='.'"selected"' : '' }} >Inactive</option>
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
                                    <label for="">Page Content</label>
                                    <textarea id="editor1" name="page_content" rows="10" cols="80">
                                            {{ (null !== old('page_content')) ? old('page_content') : $cms->page_content  }}
                                    </textarea>

                                     @if ($error)
                                    <span class="help-block">
                                        {{ $error }}
                                    </span>
                                    @endif
                                </div>
                        </div>

                    </div>
                        <?php
                    }

                        ?>
                        <?php

 $page_ids=[2,3,4,5];
                        if (in_array($cms->id, $page_ids)) {
?>
                        <input type="hidden" name="status" value="1">

                          <input type="hidden" name="page_content" value="test">
<?php
                        }
                        ?>

                        </div>

                        <div class="box-body">
                            <div class="text-right paddingb10">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{url('manage/dashboard')}}" class="btn btn-danger">Cancel</a>
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
