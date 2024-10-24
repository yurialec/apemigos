@extends('layouts.app_admin')
@section('content')
    <menus-index-component
        url-create-menu="{{ route('menu.create') }}">
    </menus-index-component>
@endsection
