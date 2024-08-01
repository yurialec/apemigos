@extends('layouts.app_admin')
@section('content')
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <permissions-index-component
        url-create-permission="{{ route('permissions.create') }}">
    </permissions-index-component>
@endsection