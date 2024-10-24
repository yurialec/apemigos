@extends('layouts.app_admin')
@section('content')
    <roles-edit-component
        role-by-id="{{ json_encode($role) }}"
        url-index-role="{{ route('roles.index') }}">
    </roles-edit-component>
@endsection
