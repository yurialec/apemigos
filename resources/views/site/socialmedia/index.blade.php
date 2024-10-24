@extends('layouts.app_admin')
@section('content')
<site-socialmedia-index-component
    url-create-social-media="{{ route('site.socialmedia.create') }}">
</site-socialmedia-index-component>
@endsection