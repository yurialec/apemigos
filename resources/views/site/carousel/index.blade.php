@extends('layouts.app_admin')
@section('content')
<site-carousel-index-component
    url-create-carousel="{{ route('site.carousel.create') }}">
</site-carousel-index-component>
@endsection