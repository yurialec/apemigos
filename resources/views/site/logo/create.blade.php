@extends('layouts.app_admin')
@section('content')
<site-logo-create-component
    url-index-logo="{{ route('site.logo.index') }}">
</site-logo-create-component>
@endsection