<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @foreach($categories as $category)
            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle"
                data-toggle="dropdown"><i class="icon fa fa-shopping-bag"
                    aria-hidden="true"></i>{{ $category->name }}</a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            @foreach($category->subcategories as $subcategory)
                            <div class="col-sm-12 col-md-3">
                                <h2 class="title">{{ $subcategory->name }}</h2>
                                <ul class="links list-unstyled">
                                    @foreach ($subcategory->subSubcategories as $subSubcategory)
                                    <li><a href="#">{{ $subSubcategory->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                            <!-- /.col -->
                            {{-- <div class="dropdown-banner-holder"> <a href="#"><img alt="" src="{{ $category->image_url }}" /></a> </div> --}}
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
            </li>
            @endforeach
            <!-- /.menu-item -->
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>