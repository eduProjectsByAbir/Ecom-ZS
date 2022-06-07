@props([
    'hotproducts' => $hotproducts,
])

<div class="best-deal wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Hot Deals</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
            @foreach ($hotproducts as $hot_product)
            <div class="item">
                <div class="products best-product">
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a href="details.html"> <img
                                                    src="{{ $hot_product->product_thumbnail_url }}"
                                                    alt=""> </a> </div>
                                        <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col2 col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a href="#">{{ $hot_product->name }}</a></h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="product-price"> <span class="price"> ${{ $hot_product->discount_price !== null ? ($hot_product->price - $hot_product->discount_price) : $hot_product->price  ?? $hot_product->price }} </span>
                                            @if($hot_product->discount_price !== null)
                                            <span class="price-before-discount">$ {{ $hot_product->price }}</span>
                                            @endif </div>
                                        <!-- /.product-price -->

                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.product-micro-row -->
                        </div>
                        <!-- /.product-micro -->

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- /.sidebar-widget-body -->
</div>