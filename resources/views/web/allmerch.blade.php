<!-- <section class="category-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="main-menuu">
                    <?php
                    $i = 0;
                    ?>
                    <?php
                    foreach ($categories as $cat) {
                        ?>
                        <?php
                        if ($i == 0) {
                            ?>
                    <li class="<?= ($category == 'feature-products')? 'active': '' ?>">
                                <a href="store">FEATURED PRODUCTS </a>
                            </li>
                            <li class="<?= ($category == 'all')? 'active': '' ?>" >
                                <a href="store?category=all">ALL </a>
                            </li>
                        <?php } ?>

                        <li class="<?= ($category == $cat->slug)? 'active': '' ?>">
                            <a href="store?category=<?= $cat->slug ?>">{{ $cat->product_category }} </a>
                        </li>

                        <?php
                        $i++;
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section> -->
<!-- End category-list -->

<section class="shop-banner">
    <figure>
        <img src="{{ asset('images/shop-banner.jpg') }}" alt="" />
        <figcaption>
            <h1>
                STORE
                <span>
                    <img src="{{ asset('images/symbol.png') }}" alt="" />
                </span>
            </h1>
        </figcaption>
    </figure>
</section><!-- End .shop-banner -->

<div class="clearfix"></div>

<section class="shop-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <div class="table">
                    <div class="table-cell">
                        <h2>
                            Christianity Engaged Merch
                        </h2>
                    </div>
                    <div class="table-cell">
                        <h4>
                            All merchandise sales support the ongoing<span>operations of Christianity Engaged.</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End .shop-top -->

<div class="clearfix"></div>

<section id="product-list" class="product-list">
    <div class="container">
        <div class="row">

            <div class="product-head col-md-12 center">
                <h2>
                    <?= ($categoryName) && !empty($categoryName)? $categoryName : 'Not Found'?>
                </h2>
                <select id="select">
                    <option data-url="{{url('store#product-list')}}" @if ($categoryName == 'Featured Products') selected @endif><a href="store">FEATURED PRODUCTS</a></option>
                    <option data-url="{{url('store?category=all#product-list')}} " @if ($categoryName == 'All Products') selected @endif >ALL Products</option>
                    @foreach ($categories as $category)
                        <option data-url="{{url('store?category='.$category->slug .'#product-list')}}" @if ($categoryName == $category->product_category) selected @endif >{{$category->product_category}}</option>
                    @endforeach
                </select>
            </div>
            <div class="clearfix"></div>
            <ul class="featured-list">
            <?php foreach ($featureproducts as $product) { ?>
                  <li>
                    <figure>
                        <a href="/store/<?php echo $product->seo_slug; ?>">
                            <img src="{{asset('/uploads/productimages/'.$product->product_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
                        </a>
                    </figure>
                    <figcaption>
                        <div class="itemnumber">
                            <span class="sku">
                              {{$product->sku}}
                            </span>
                            <span class="sizee">
                              @if($product->size != '')
                                  {{ucwords($product->size)}}
                              @endif
                            </span>
                        </div>
                        <div class="clearfix"></div>
                        <h4 class="productname">
                            <a href="/store/<?php echo $product->seo_slug; ?>">
                                {{ucfirst($product->product_name)}}
                            </a>
                        </h4>
                        <?php
                        $dataid = "cart[" . $product->sku . "][qty]";
                        ?>
                        <div class="product-status">
                            <ul>
                                <li>
                                    <h4 class="price">$<?php echo $product->price<100?ucfirst($product->price):round($product->price);?></h4>
                                </li>
                                <li>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn-number"  data-type="minus" data-field="">
                                                <span class="decr_list glyphicon glyphicon-minus" data-id="<?= $dataid; ?>" data-menuid="<?= $product->sku; ?>"></span>
                                            </button>
                                        </span>
                                        <input id="cart_qnty" class="form-control input-number" value="1" min="0" max="" name="<?= $dataid; ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" autocomplete="off" type="text" data-id="{{$product->sku}}">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn-number" data-type="plus" data-field="">
                                                <span class="incr_list glyphicon glyphicon-plus" data-id="<?= $dataid; ?>" data-menuid="<?= $product->sku; ?>"></span>
                                            </button>
                                        </span>
                                    </div>

                                    <!--  <div class="qty">
                                         <span class="decr" data-id="<?= $dataid; ?>" data-menuid="<?= $product->id; ?>">-</span>
                                         <input id="cart_qnty" class="" value="1" min="0" max="" name="$dataid" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" autocomplete="off" type="text">
                                         <span class="incr" data-id="<?= $dataid; ?>" data-menuid="<?= $product->id; ?>">+</span>
                                     </div> -->
                                </li>
                                <li>
                                    <a class="add-to-cart add_to_card_list_page{{ $product->sku }}" href="javascript:void(0);" data-id='{{ $product->sku }}' data-productid="{{$product->id}}" data-weight="{{$product->weight}}" data-size='{{$product->size}}' data-price='{{ $product->price}}' data-name='{{ $product->product_name}}' data-count='1' data-imageurl='{{asset('/uploads/productimages/'.$product->product_image) }}'>
                                        <i class="fa fa-shopping-cart"></i> ADD TO CART
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </figcaption>
                  </li>
                <?php
            }
            ?>
          </ul>

        </div>
    </div>
</section><!-- End shop-product -->


<?php /*

  <section class="product-wrap">
  <div class="container">
  <div class="row">
  <div class="col-md-9">
  <h1>Cool <span>Merch</span> you got there. <em></em></h1>
  </div>
  </div>
  </div>

  <div class="container">
  <div class="row">
  <div class="product-listing">
  <ul>
  <?php foreach ($products as $product) { ?>
  <li class="col-md-4 col-sm-6">
  <figure>
  <a href="/merch/<?php echo $product->seo_slug;?>">
  <img src="{{asset('/uploads/productimages/'.$product->product_image) }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
  </a>
  <figcaption>
  <div class="addtocart">
  <div class="table">
  <div class="table-cell">
  <h4>
  {{ucfirst($product->product_name)}}
  </h4>
  </div>
  <div class="table-cell">
  <div class="price">
  <h3>${{ucfirst($product->price)}}</h3>
  </div>
  <div class="cart-button">
  <a class="add-to-cart" href="javascript:void(0);" data-id='{{ $product->id }}' data-price='{{ $product->price}}' data-name='{{ $product->product_name}}' data-imageurl='{{asset('/uploads/productimages/'.$product->product_image) }}'>
  + ADD TO
  </a>
  </div>
  </div>
  </div>
  </div>
  </figcaption>
  </figure>
  </li>
  <?php
  }
  ?>
  </ul>
  </div>
  </div>
  </div>
  </section><!-- End product-wrap -->

 */ ?>

<section class="newsletter-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                    <h3>Stay informed about new videos and exclusive updates.</h3>
                    <h4>Join our newsletter or <a href="javascript:void(0)">subscribe</a> to our YouTube channel. </h4>

                    <ul>
                        <li>
                            <a class="join-btn btn btn-primary" data-toggle="modal" data-target="#newsletter">JOIN</a>
                        </li>
                        <li>
                            <a class="join-btn btn btn-primary" href="https://www.youtube.com/ChristianityEngaged" target="_blank"><img src="/images/yt-w.png" class="sub-img" />SUBSCRIBE</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- End newsletter-wrap -->

<!-- Newsletter Modal -->

<div id="newsletter" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close_newsletter" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Newsletter</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('/subscribe')}}" id="newsletterForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" class="form-control" id="newsletter_email" name="email" required placeholder="Enter Your Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="newsletter_confirm_email" onpaste="return false;" required name="" placeholder="Confirm Email">
                    </div>
                    <!-- Gaurav Added for recaptcha on 09/01/2019 -->
                 <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    
                      {!! app('captcha')->display() !!}
                      @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                      @endif
                       <span class="error hide" id="g-recaptcha-response_error">
                       recaptcha
                    </span>
                    
                   
                </div>
<!-- Ends  -->
                    <div class="clearfix">
                        <button type="submit" id="newsletter_subscribe" class="btn btn-primary">Submit</button>
                        <br>
                        <div id="newsletter_message" class="success-msg text-center"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- End .newsletter -->

<script>
    $('#select').on('change', function(e){
         var url = $(this).children("option:selected").attr('data-url');
         window.location.href = url;
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#newsletter_subscribe').click(function(){
          if(!validateStep()){
            return false;            
          }
      });

        function validateStep() {
            
            var response = grecaptcha.getResponse();

            var valid = true;
        
            if(response.length == 0)
            {
              $('#g-recaptcha-response_error').html('Recaptcha required.');
              $('#g-recaptcha-response_error').removeClass('hide');
              valid = false;
            }
           
           
            return valid;
        }

    });
</script>

