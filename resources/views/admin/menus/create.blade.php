@extends('layouts.app_admin')
@section('content')
<menus-create-component
    url-index-menu="{{ route('menu.index') }}">
</menus-create-component>
@endsection