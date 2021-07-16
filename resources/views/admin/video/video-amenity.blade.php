<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h1>Video Heading</h1>    
        </div>  
    </div>
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
                
                <div class="box-body table-responsive padding user_listing">
                    <table class="table table-hover">
                        <tbody>
                            <tr class="disable-sort-item">
                                <th>Heading</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>{{$videoamenity->heading}}</td>
                                <td>{{$videoamenity->short_description}}</td>                                                              
                                <td>
                                    <div class="btn-group">
                                        <a href="{{url('manage/video-amenity/edit/'.$videoamenity->id)}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil"></i></a>
                                    </div>	          	
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
   
            </div>
            <!-- /.box -->
        </div>
    </div>    
</section>