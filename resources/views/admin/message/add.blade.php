<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title or "Create New Message" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="{{url('manage/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li><a href="{{url('manage/message')}}"><i class="fa fa-paragraph"></i> Message</a></li>
        <li class="active">Create</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/message/save')}}" id="add_page" method="post">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $error = $errors->first('name');
                                $class = '';
                                if ($error) {
                                    $class = 'has-error';
                                }
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ (null !== old('name')) ? old('name') : ''  }}" placeholder="Enter message name">
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
                                $error = $errors->first('value');
                                $class = '';
                                if ($error) {
                                    $class = 'has-error';
                                }
                                ?>
                                <div class="form-group {{ $class }}">
                                    <label for="">Message</label>
                                    <input type="text" class="form-control" name="value" id="value" value="{{ (null !== old('value')) ? old('value') : ''  }}" placeholder="Enter message">
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
                        <a href="{{url('manage/message')}}" class="btn btn-danger">Cancel</a>
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
