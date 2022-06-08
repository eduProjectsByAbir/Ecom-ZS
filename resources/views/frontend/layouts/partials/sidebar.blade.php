<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
    <!-- ================================== TOP NAVIGATION ================================== -->
    <x-frontend.category-side-bar :categories=$categories />
    <!-- /.side-menu -->
    <!-- ================================== TOP NAVIGATION : END ================================== -->

    <!-- ============================================== HOT DEALS ============================================== -->
    <x-frontend.sidebar.hotdeals :hotproducts=$hotproducts />
    <!-- ============================================== HOT DEALS: END ============================================== -->
    
    <!-- ============================================== SPECIAL OFFER ============================================== -->
    <x-frontend.sidebar.specialoffer :specialoffers=$specialoffers />
    <!-- /.sidebar-widget -->
    <!-- ============================================== SPECIAL OFFER : END ============================================== -->
    <!-- ============================================== PRODUCT TAGS ============================================== -->
    <div class="sidebar-widget product-tag wow fadeInUp">
        <h3 class="section-title">Product tags</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a
                    class="item active" title="Vest" href="category.html">Vest</a> <a class="item"
                    title="Smartphone" href="category.html">Smartphone</a> <a class="item" title="Furniture"
                    href="category.html">Furniture</a> <a class="item" title="T-shirt"
                    href="category.html">T-shirt</a> <a class="item" title="Sweatpants"
                    href="category.html">Sweatpants</a> <a class="item" title="Sneaker"
                    href="category.html">Sneaker</a> <a class="item" title="Toys"
                    href="category.html">Toys</a> <a class="item" title="Rose" href="category.html">Rose</a>
            </div>
            <!-- /.tag-list -->
        </div>
        <!-- /.sidebar-widget-body -->
    </div>
    <!-- /.sidebar-widget -->
    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
    <!-- ============================================== SPECIAL DEALS ============================================== -->
    <x-frontend.sidebar.specialdeals :specialdeals=$specialdeals />
    <!-- /.sidebar-widget -->
    <!-- ============================================== SPECIAL DEALS : END ============================================== -->
    <!-- ============================================== NEWSLETTER ============================================== -->
    <x-frontend.sidebar.newsletter />
    <!-- ============================================== NEWSLETTER: END ============================================== -->

    <!-- ============================================== Testimonials============================================== -->
    <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
        <div id="advertisement" class="advertisement">
            <div class="item">
                <div class="avatar"><img src="{{ asset('frontend') }}/images/testimonials/member1.png"
                        alt="Image"></div>
                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                <div class="clients_author">John Doe <span>Abc Company</span> </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.item -->

            <div class="item">
                <div class="avatar"><img src="{{ asset('frontend') }}/images/testimonials/member3.png"
                        alt="Image"></div>
                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port
                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
            </div>
            <!-- /.item -->

            <div class="item">
                <div class="avatar"><img src="{{ asset('frontend') }}/images/testimonials/member2.png"
                        alt="Image"></div>
                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.item -->

        </div>
        <!-- /.owl-carousel -->
    </div>

    <!-- ============================================== Testimonials: END ============================================== -->
</div>