@extends('layouts.app_admin')
@section('content')
<users-create-component
    url-index-user="{{ route('users.index') }}">
</users-create-component>
@endsection