@props([
    'featuredproducts' => $featuredproducts,
])

<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">Featured products</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        @foreach($featuredproducts as $featured_product)
        <div class="item item-carousel">
            <div class="products">
                <div class="product">
                    <div class="product-image">
                        <div class="image"> <a href="detail.html"><img
                                    src="{{ $featured_product->product_thumbnail_url }}" alt=""></a>
                        </div>
                        <!-- /.image -->
                        @if($featured_product->discount_price !== null)
                        <div class="tag sale">
                            <span>{{ round(($featured_product->discount_price/$featured_product->price)*100) }}%</span>
                        </div>
                        @else
                        @if($featured_product->hot_deals == 1)
                        <div class="tag hot"><span>hot</span></div>
                        @else
                        <div class="tag new"><span>new</span></div>
                        @endif
                        @endif
                    </div>
                    <!-- /.product-image -->

                    <div class="product-info text-left">
                        <h3 class="name"><a href="detail.html">{{ $featured_product->name }}</a>
                        </h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                        <div class="product-price"> <span class="price">
                                ${{ $featured_product->discount_price !== null ? ($featured_product->price - $featured_product->discount_price) : $featured_product->price  ?? $featured_product->price }}
                            </span>
                            @if($featured_product->discount_price !== null)
                            <span class="price-before-discount">$ {{ $featured_product->price }}</span>
                            @endif </div>
                        <!-- /.product-price -->

                    </div>
                    <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <button data-toggle="tooltip" class="btn btn-primary icon"
                                        type="button" title="Add Cart"> <i
                                            class="fa fa-shopping-cart"></i> </button>
                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                        cart</button>
                                </li>
                                <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart"
                                        href="detail.html" title="Wishlist"> <i
                                            class="icon fa fa-heart"></i>
                                    </a> </li>
                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart"
                                        href="detail.html" title="Compare"> <i class="fa fa-signal"
                                            aria-hidden="true"></i> </a> </li>
                            </ul>
                        </div>
                        <!-- /.action -->
                    </div>
                    <!-- /.cart -->
                </div>
                <!-- /.product -->

            </div>
            <!-- /.products -->
        </div>
        <!-- /.item -->
        @endforeach
    </div>
    <!-- /.home-owl-carousel -->
</section>