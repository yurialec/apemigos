@extends('layouts.app_admin')
@section('content')
<site-about-create-component
    url-index-about="{{ route('site.about.index') }}">
</site-about-create-component>
@endsection