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
                                <a href="{{ route('showProducts', 'subcategory='.$subcategory->id) }}"><h2 class="title active-success">{{ $subcategory->name }}</h2></a>
                                <ul class="links list-unstyled">
                                    @foreach ($subcategory->subSubcategories as $subSubcategory)
                                    <li><a href="{{ route('showProducts', 'subsubcat='.$subSubcategory->id) }}">{{ $subSubcategory->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                            <!-- /.col -->
                            <div class="banner-image"> <a href="{{ route('showProducts', 'category='.$category->id) }}"><img alt="" width="100px" height="100px" src="{{ $category->image_url }}" /></a> </div>
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