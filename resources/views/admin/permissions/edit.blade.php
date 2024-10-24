@extends('layouts.app_admin')
@section('content')
    <permissions-edit-component
        permission-by-id="{{ json_encode($permission) }}"
        url-index-permissions="{{ route('permissions.index') }}">
    </permissions-edit-component>
@endsection
