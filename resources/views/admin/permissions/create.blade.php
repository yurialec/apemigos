@extends('layouts.app_admin')
@section('content')
    <permissions-create-component
        url-index-permission="{{ route('permissions.index') }}">
    </permissions-create-component>
@endsection
