<section class="product-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <h1>Cool <span>Merch</span> you got there. <em></em></h1>
                <h3>All merchandise  sales support the ongoing operations of Christianity Engaged.</h3>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow top">
                    <img src="{{ asset('images/shadow-top.png') }}">
                </div>
                <div class="flexslider carousel">
                    <ul class="slides">
                        <?php foreach ($products as $product) { ?>
                            <li>
                                <figure>
                                    <a href="/store/<?php echo $product['slug']; ?>">
                                        <img src="{{ $product['images'][0]['src'] }}" alt="No Image Found" onerror="this.src='{{asset("/images/no_image.png") }}'">
                                    </a>
                                    <figcaption>
                                        <div class="addtocart">
                                            <div class="table">
                                                <div class="table-cell">
                                                    <h4>
                                                        {{ucfirst($product['name'])}}
                                                    </h4>
                                                </div>
                                                <div class="table-cell">
                                                    <div class="price">
                                                        <h3>$<?php echo $product->price < 100 ? ucfirst($product->price) : round($product->price); ?></h3>
                                                    </div>
                                                    <div class="cart-button">
                                                        <a class="add-to-cart" href="javascript:void(0);" data-id='{{ $product["sku"] }}' data-price='{{ $product["price"]}}'  data-productid="{{$product['id']}}" data-weight="{{$product['weight']}}" data-size='{{$product["size"]}}' data-name='{{ $product["name"]}}' data-imageurl="{{ $product['images'][0]['src'] }}">
                                                            + ADD TO
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="itemnumber">
                                                <span class="sku">
                                                    {{$product['sku']}}
                                                </span>
                                                <span class="sizee">
                                                    @if($product["size"] != '')
                                                    {{ucwords($product["size"])}}
                                                    @endif
                                                </span>
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
                <div class="shadow bottom">
                    <img src="{{ asset('images/shadow-bottom.png') }}">
                </div>
            </div>
            <div class="col-md-12 center">
                <a href="/<?php echo $merchPageSlug[0]; ?>" class="btn btn-primary merch-btn">ALL MERCH</a>
            </div>
        </div>
    </div>
</section><!-- End product-wrap -->