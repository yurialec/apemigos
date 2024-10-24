@extends('layouts.app_admin')
@section('content')
<site-carousel-edit-component
    carousel-by-id="{{ json_encode($carousel) }}"
    url-index-carousel="{{ route('site.carousel.index') }}">
</site-carousel-edit-component>
@endsection