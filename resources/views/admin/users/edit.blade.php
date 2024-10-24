@extends('layouts.app_admin')
@section('content')
    <users-edit-component
        user-by-id="{{ json_encode($user) }}"
        url-index-user="{{ route('users.index') }}">
    </users-edit-component>
@endsection
