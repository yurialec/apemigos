@extends('layouts.app_admin')
@section('content')
<site-socialmedia-create-component
    url-index-social-media="{{ route('site.socialmedia.index') }}">
</site-socialmedia-create-component>
@endsection