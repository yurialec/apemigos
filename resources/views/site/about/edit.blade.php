@extends('layouts.app_admin')
@section('content')
<site-about-edit-component
    about-by-id="{{ json_encode($about) }}"
    url-index-about="{{ route('site.about.index') }}">
</site-about-edit-component>
@endsection