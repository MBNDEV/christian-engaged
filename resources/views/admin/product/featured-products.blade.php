<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h1>Featured Products</h1>    
        </div>  
    </div>  
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">                            
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        @if($products->count())
                            <button class="btn btn-primary margin-left-10" id='enable-featured-sort' data-text="Enable Sorting">Enable Sorting</button>
                            <button class="btn btn-danger margin-left-10 hide" id='cancel-featured' data-text="Cancel">Cancel</button>
                            <button data-url="{{url('manage/featured-products/sort')}}" class="btn btn-primary hide" data-text="Save Sorting" id='save-featured'>Save Sorting</button>
                        @endif
                    </div>
                </div>
                <!-- /.box-header -->
                
                <!-- <div class=""> -->
                <div class="photoGrid product-list clearfix">
                    @foreach ($products as $product)
                        <div style="width: 162px; height: 152px;    margin-bottom: 30px;" class="item" id="<?=$product->id?>">
                            <figure class="effect-lily">
                                <a href="javascript:void(0);" title="{{ucfirst($product->product_name)}}">
                                    <img width="100px" src="{{asset('/uploads/productimages/thumbs/thumb-'.$product->product_image) }}" alt="No Image Found" onerror="this.src='{{url('/images/no_image.png')}}'">
                                </a>                        
                            </figure>
                            <date>{{$product->created_at}}</date>
                        </div>
                    @endforeach
                </div>
                 
                
            </div>
            <!-- /.box -->
        </div>
    </div>
    
</section>

<script >
    $(document).ready(function(){

            var fixHelper = function (e, ui) {
                ui.children().each(function () {
                    $(this).width($(this).width());
                });
                return ui;
            };
            
            $('tbody').sortable({
                helper: fixHelper,
                start: function (event, ui) {
                    ui.item.css('background-color', '#fafafa');
                },
                stop: function (event, ui) {
                    // ui.item.addClass("ui-state-highlight");
                    ui.item.css('background-color', '#fff');
                },
                cancel: ".disable-sort-item"
            });
            
            $('div.product-list').sortable({
                helper: fixHelper,
                start: function (event, ui) {
                    ui.item.css('background-color', '#fafafa');
                },
                stop: function (event, ui) {
                    // ui.item.addClass("ui-state-highlight");
                    ui.item.css('background-color', '#fff');
                }
            });

            $('div.product-list').sortable("disable");
            $('tbody').sortable("disable");

            $("#enable-featured-sort").click(function (e) {
                e.preventDefault();
                $('#cancel-featured').removeClass('hide');
                $('#save-featured').removeClass('hide');
                $("#enable-featured-sort").addClass('hide');
                $('div.product-list').sortable("enable");
            });
            
            $("#cancel-featured").click(function (e) {
                e.preventDefault();
                $('#cancel-featured').addClass('hide');
                $('#save-featured').addClass('hide');
                $("#enable-featured-sort").removeClass('hide');
                $('div.product-list').sortable("disable");
            });
            
            $(document).on('click', '#save-featured', function (e) {
                var url = $(this).data('url');
                var arr = [];
                $("div.product-list div").each(function () {
                    arr.push(this.id);
                });
                
                $('#save-featured').html('Saving....');
                $('#save-featured').attr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: '/manage/featured-products/sort',
                    dataType: "json",
                    data: {productList: arr},
                    success: function (data) {
                        
                        if (data.success) {
                            alertify.success('Sorting order saved successfully');
                            document.location.reload();
                        }

                    },
                    error: function (error) {
                        alertify.error('There is some issue please sort after some times.'); 
                        $('#save-featured').html('Save Sorting');
                        $('#save-featured').removeAttr('disabled');
                    }
                });
            });

    });


</script>