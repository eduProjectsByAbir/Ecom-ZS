@props([
'tags' => $tags,
])

@if(count($tags) !== 0)
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @foreach ($tags as $tag)
            <a class="item {{ request('tags') == $tag ? 'active' : '' }}" title="{{ $tag }}" href="{{ route('showProducts', 'tags='.$tag) }}">{{ $tag }}</a>
            @endforeach
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
@endif