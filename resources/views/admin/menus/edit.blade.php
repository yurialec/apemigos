@extends('layouts.app_admin')
@section('content')

    <menus-edit-component
        menu-by-id="{{ json_encode($menu) }}"
        url-index-menu="{{ route('menu.index') }}">
    </menus-edit-component>
@endsection
