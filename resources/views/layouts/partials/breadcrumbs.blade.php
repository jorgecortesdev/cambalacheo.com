@if ($breadcrumbs)
    <ul class="hidden-xs breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            <li><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></li>
        @endforeach
    </ul>
@endif