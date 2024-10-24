@extends('layouts.app_admin')
@section('content')
<site-logo-index-component
    url-create-logo="{{ route('site.logo.create') }}">>
</site-logo-index-component>
@endsection