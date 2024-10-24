@extends('layouts.app_admin')
@section('content')
<site-about-index-component
    url-create-about="{{ route('site.about.create') }}">
</site-about-index-component>
@endsection