@extends('layouts.app_admin')
@section('content')
    <users-index-component
        url-create-user="{{ route('users.create') }}">
    </users-index-component>
@endsection
