<div id="hero">
    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
        @foreach($sliders as $slider)
        <div class="item" style="background-image: url({{ $slider->image_url }});">
            <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">
                    @if($slider->subtitle !== null)
                    <div class="slider-header fadeInDown-1">{{ $slider->subtitle }}</div>
                    @endif
                    @if($slider->title !== null)
                    <div class="big-text fadeInDown-1"> {{ $slider->title }} </div>
                    @endif
                    @if($slider->description !== null)
                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->description }}</span> </div>
                    @endif
                    @if($slider->button_link !== null)
                    <div class="button-holder fadeInDown-3"> <a href="{{ $slider->button_link }}"
                            class="btn-lg btn btn-uppercase btn-primary shop-now-button">{{ $slider->button_text }}</a> </div>
                    @endif
                </div>
                <!-- /.caption -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.item -->
        @endforeach
    </div>
    <!-- /.owl-carousel -->
</div>