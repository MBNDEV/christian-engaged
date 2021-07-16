<div class="pagination">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li>
                        <a href="<?=url('/store?category=all')?>">STORE</a>
                    </li>
                    <li>
                        <a href="<?=url('/store?category='.$products[0]->cataogySlug) ?> "><?= strtolower($products[0]->cataogyName)?></a>
                    </li>
                    <li>
                        <?= strtolower($products[0]->product_name)?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- End pagination -->

<section class="product-detail">
    <div class="container">
        <?php
        $product = $products[0];
        $dataid = "cart[" . $product->sku . "][qty]";
        ?>
        <div class="row">
            <div class="col-md-5 col-sm-5">
                <div class="product-image">
                    <figure>

                        <img id="mainimg" style="max-width:100%;" src="{{asset('/uploads/productimages/'.$product->product_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">

                    </figure>
                </div>
                @if(file_exists(public_path('/uploads/productimages/thumbs/thumb-'.$product->product_image1)) || file_exists(public_path('/uploads/productimages/thumbs/thumb-'.$product->product_image2)) )
                <div class="col-md-3 col-sm-3 col-xs-4">
                    <figure>
                        <!-- <img src="{{ asset('images/product-2.jpg') }}" alt="" /> -->

                        <img class="selectimg" style="width: 100px;height: 100px;cursor: pointer;" src="{{asset('/uploads/productimages/thumbs/thumb-'.$product->product_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">

                    </figure>
                </div>
                @endif
                @if(file_exists(public_path('/uploads/productimages/thumbs/thumb-'.$product->product_image1)))
                <div class="col-md-3 col-sm-3 col-xs-4">
                    <figure>
                        <!-- <img src="{{ asset('images/product-2.jpg') }}" alt="" /> -->

                        <img  class="selectimg" style="width: 100px;height: 100px;cursor: pointer;" src="{{asset('/uploads/productimages/thumbs/thumb-'.$product->product_image1) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">

                    </figure>
                </div>
                @endif
                @if(file_exists(public_path('/uploads/productimages/thumbs/thumb-'.$product->product_image2)))
                <div class="col-md-3 col-sm-3 col-xs-4">
                    <figure>
                        <!-- <img src="{{ asset('images/product-2.jpg') }}" alt="" /> -->

                        <img  class="selectimg" style="width: 100px;height: 100px;cursor: pointer;" src="{{asset('/uploads/productimages/thumbs/thumb-'.$product->product_image2) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">

                    </figure>
                </div>
                @endif

                <div class="clearfix"></div>
            </div>
            <div class="col-md-7 col-sm-7">
                
                <div class="product-des">
                    <h1 class="productname">
                        {{ucfirst($product->product_name)}}
                    </h1>
                    <h2 class="price">
                        $<?php echo $product->price<100?ucfirst($product->price):round($product->price);?>
                    </h2>

                    <div class="types">

                        <div class="qty">
                            <!-- <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-left-minus btn-number"  data-type="minus" data-field="">
                                      <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-right-plus btn-number" data-type="plus" data-field="">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div> -->
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-left-minus btn-number"  data-type="minus" data-field="">
                                        <span class="decr_list glyphicon glyphicon-minus" id="minus" data-id="<?= $dataid; ?>" data-menuid="<?= $product->sku; ?>"></span>
                                    </button>
                                </span>
                                <input id="cart_qnty" class="form-control input-number" value="1" min="0" max="" name="<?= $dataid; ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" autocomplete="off" type="text" data-id="{{$product->sku}}">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-right-plus btn-number" data-type="plus" data-field="">
                                        <span class="incr_list glyphicon glyphicon-plus" id="plus" data-id="<?= $dataid; ?>" data-menuid="<?= $product->sku; ?>"></span>
                                    </button>
                                </span>
                            </div>

                        </div>

                        <div class="sku" id="sku">
                           <strong>SKU</strong> {{$product->sku}}
                        </div>

                        <?php
                        if (count($sizeList)) {
                            ?>
                            <div class="sizes">
                                <label>
                                    Size
                                </label>
                                <select class="size" id="sizelist">
                                    <?php
                                        foreach ($sizeList as $key => $value) {
                                            echo '<option value="'.$value['sku'].'##'.$value['size'].'##'.$value['weight'].'">'.ucwords($value['size']).'</option>';
                                        }
                                    ?>
                                </select>
                                <!-- <input class="size form-control" type="text" value="<?= $product->size ?>" readonly="readonly" /> -->

                            </div>
                            <?php
                        }
                        ?>

                        


                    </div>
                    <div class="clearfix"></div>

                    <div class="cart-button">
                        <h3>
                            <a  id="addcart" class="add-to-cart green-btn add_to_card_list_page{{ $product->sku }}" href="javascript:void(0);" data-id='{{ $product->sku }}' data-price='{{ $product->price}}' data-name='{{ $product->product_name}}' data-count='1'  data-size='{{$product->size}}' data-weight="{{$product->weight}}" data-productid="{{$product->id}}" data-imageurl='{{asset('/uploads/productimages/'.$product->product_image) }}'>
                                <span class="cart-icon"></span> +Add To Cart
                            </a>
                        </h3>
                    </div>
                    <p class="text">
                        <?= $product->product_description; ?>
                    </p>
                    <!-- <ul class="list">
                        <li>
                            3D embroidered CE logo 
                        </li>
                        <li>
                            Green under bill with green stitching 
                        </li>
                        <li>
                            Embroidered New Era side logo
                        </li>
                        <li>
                            80% acrylic, 20% wool crown
                        </li>
                        <li>
                            100% polyester visor
                        </li>
                    </ul> -->

                    <ul class="social-sharing">
                        <li>
                            <a data-network="facebook"  class="st-custom-button share-facebook" data-title="facebook"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a data-network="twitter" class="st-custom-button" data-title="twitter"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/accounts/login/" target="_blank"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a data-network="linkedin" class="st-custom-button" data-title="linkedin" ><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>


<?php
if (count($recomendedProduct) > 0) {
    ?>
    <section class="product-list" style="margin-bottom: 40px; ">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h2>
                        Recommended
                    </h2>
                </div>
                <div class="clearfix"></div>
                <ul class="featured-list">
                <?php foreach ($recomendedProduct as $product) { ?>
                    <li>
                        
                        <figure>
                            <a href="/store/<?php echo $product->seo_slug; ?>">
                                <img src="{{asset('/uploads/productimages/'.$product->product_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
                            </a>
                        </figure>
                        <figcaption>
                            <div class="itemnumber">
                                <?= $product->sku; ?>
                            </div>
                            <h4 class="productname">
                                <a href="/store/<?php echo $product->seo_slug; ?>">
                                    {{ucfirst($product->product_name)}}
                                </a>
                            </h4>
                            <?php
                            $dataid = "cart[" . $product->id . "][rec_qty]";
                            ?>
                            <div class="product-status">
                                <ul>
                                    <li>
                                        <h4 class="price">
                                          $<?php echo $product->price<100?ucfirst($product->price):round($product->price);?>
                                        </h4>
                                    </li>
                                    <li>
                                        <!-- <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn-number"  data-type="minus" data-field="">
                                                  <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn-number" data-type="plus" data-field="">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div> -->

                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn-number"  data-type="minus" data-field="">
                                                    <span class="decr_rec glyphicon glyphicon-minus" data-id="<?= $dataid; ?>" data-menuid="<?= $product->sku; ?>"></span>
                                                </button>
                                            </span>
                                            <input id="cart_qnty_rec" class="form-control input-number" value="1" min="0" max="" name="<?= $dataid; ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" autocomplete="off" type="text" data-id="{{$product->sku}}">
                                            <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn-number" data-type="plus" data-field="">
                                                    <span class="incr_rec glyphicon glyphicon-plus" data-id="<?= $dataid; ?>" data-menuid="<?= $product->sku; ?>"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </li>
                                    <li>
<!--                                         <a class="add-to-cart add_to_card_rec_page{{ $product->id }}" href="javascript:void(0);" data-id='{{ $product->id }}' data-price='{{ $product->price}}' data-name='{{ $product->product_name}}' data-count='1' data-imageurl='{{asset('/uploads/productimages/'.$product->product_image) }}'>
                                            <i class="fa fa-shopping-cart"></i> ADD TO CART
                                        </a>
 -->
                                         <a class="add-to-cart add_to_card_rec_page{{ $product->sku }}" href="javascript:void(0);" data-id='{{ $product->sku }}' data-size='{{$product->size}}' data-weight="{{$product->weight}}" data-productid="{{$product->id}}" data-price='{{ $product->price}}' data-name='{{ $product->product_name}}' data-count='1' data-imageurl='{{asset('/uploads/productimages/'.$product->product_image) }}'>
                                            <i class="fa fa-shopping-cart"></i> ADD TO CART
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </figcaption>
                        <div class="clearfix"></div>
                    </li><!-- End col-md-3 -->
                    <?php
                }
                ?>
                </ul>
            </div>
        </div>
    </section><!-- End shop-product -->
    <?php
}
?>





<script type="text/javascript">
    /*$(document).ready(function(){
     var quantitiy=0;
     $('.quantity-right-plus').click(function(e){
     // Stop acting like a button
     e.preventDefault();
     // Get the field name
     var quantity = parseInt($('#quantity').val());
     // If is not undefined
     $('#quantity').val(quantity + 1);
     // Increment
     });
     
     $('.quantity-left-minus').click(function(e){
     // Stop acting like a button
     e.preventDefault();
     // Get the field name
     var quantity = parseInt($('#quantity').val());
     // If is not undefined
     // Increment
     if(quantity>0){
     $('#quantity').val(quantity - 1);
     }
     });
     });*/
     $(document).ready(function(){
        $('.selectimg').click(function(){
            var img = $(this).attr("src");
            img = img.replace('thumbs/thumb-','');
            $("#mainimg").attr('src',img);
        });
        $('#sizelist').on('change',function(){
            var val = $(this).val();
            var data = val.split('##');
            $("#addcart").attr('data-id',data[0]);
            $("#addcart").attr('data-size',data[1]);
            $("#addcart").attr('data-weight',data[2]);
            // $("#addcart").removeClass();
            // $("#addcart").addClass("add-to-cart");
            // $("#addcart").addClass("green-btn");
            
            // $("#addcart").addClass("add_to_card_rec_page"+data[0]);

            // $("#minus").attr("data-id","cart["+data[0]+"][qty]");
            // $("#minus").attr("data-menuid",data[0]);

            // $("#plus").attr("data-id","cart["+data[0]+"][qty]");
            // $("#plus").attr("data-menuid",data[0]);

            // $("#cart_qnty").attr("data-id","cart["+data[0]+"][qty]");
            // $("#cart_qnty").attr("data-menuid",data[0]);

            $("#sku").html("<strong>SKU</strong> "+data[0]);
        });
     });
</script>