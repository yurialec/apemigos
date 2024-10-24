@extends('layouts.app_admin')
@section('content')
<site-logo-edit-component
    logo-by-id="{{ json_encode($logo) }}"
    url-index-logo="{{ route('site.logo.index') }}">
</site-logo-edit-component>
@endsection