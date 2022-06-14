@extends('frontend.layouts.app')

@section('title')
Wishlist
@endsection
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Wishlist</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">My Wishlist</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlists as $wishlist)
                                <tr>
                                    <td class="col-md-2"><img src="{{ $wishlist->product->product_thumbnail_url }}" alt="imga"></td>
                                    <td class="col-md-7">
                                        <div class="product-name"><a href="{{ route('showProduct', $wishlist->product->slug) }}">{{ $wishlist->product->name }}</a></div>
                                        <div class="rating">
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star non-rate"></i>
                                            <span class="review">( 06 Reviews )</span>
                                        </div>
                                        <div class="price">
                                            ${{ $wishlist->product->discount_price !== null ? ($wishlist->product->price - $wishlist->product->discount_price) : $wishlist->product->price  ?? $wishlist->product->price }}
                                            @if($wishlist->product->discount_price !== null)
                                            <span class="price-before-discount">$
                                                {{ $wishlist->product->price }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <button title="Add Cart"
                                        data-toggle="modal" data-target="#addToCart" onclick="productView({{ $wishlist->product->id }})" id="wlAddCart" class="btn-upper btn btn-primary">Add to cart</button>
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <a href="{{ route('remove.wishlist', $wishlist->id) }}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.layouts.partials.partner-brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
