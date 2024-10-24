@extends('layouts.app_admin')
@section('content')
<site-carousel-create-component
    url-index-carousel="{{ route('site.carousel.index') }}">
</site-carousel-create-component>
@endsection