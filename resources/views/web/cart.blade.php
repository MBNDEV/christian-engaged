<script type="text/javascript">
    var shipping_cost_list = <?php echo json_encode($shipping)?>;
</script>
<section class="cartwrapper">
    <div class="container">


        <div class="row">
            <div class="col-md-12">
                <h2>
                    Your Cart
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <form class="cart-form" id="cart-form" action="#" method="post">

                <div class="product-cart">
                    <div class="table-responsive">
                        <table class="shop_table table table-bordered" id="shop_table" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="product-thumb">Product</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-size sizeshowtable">Size</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-qty">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            <div class="cart_totals">
                <h4>Cart total</h4>
                <table class="shop_table table table-bordered" cellspacing="0">
                    <tbody>
                        <tr class="order-total">
                            <td>Subtotal</td>
                            <td data-title="Total">
                                <span class="total-amount">
                                    $0.00
                                </span>
                            </td>
                        </tr>
                        <tr class="shipping-total">
                            <td>Shipping</td>
                            <td data-title="TotalShipping">
                                <span class="total-shipping-amount">
                                    $0.00
                                </span>
                            </td>
                        </tr>
                        <tr class="grand-total">
                            <td>Total</td>
                            <td data-title="GrandTotal">
                                <span class="grand-total-amount">
                                    $0.00
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="wc-proceed-to-checkout">

                    <a href="{{url('/store?category=all')}}" class="shopping-btn"><span><i class="fa fa-angle-left"></i> </span>Continue Shopping</a>
                    <a href="{{url('/checkout')}}" class="green-btn pull-right" data-text="Proceed to checkout">
                        Proceed to checkout
                    </a>
                </div>
            </div>	
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
cartItems();
</script>

