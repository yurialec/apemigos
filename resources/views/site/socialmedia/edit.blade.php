@extends('layouts.app_admin')
@section('content')
<site-socialmedia-edit-component
    social-media-by-id="{{ json_encode($socialmedia) }}"
    url-index-social-media="{{ route('site.socialmedia.index') }}">
</site-socialmedia-edit-component>
@endsection