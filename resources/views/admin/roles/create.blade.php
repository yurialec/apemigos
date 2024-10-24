@extends('layouts.app_admin')
@section('content')
    <roles-create-component
        url-index-role="{{ route('roles.index') }}">
    </roles-create-component>
@endsection
