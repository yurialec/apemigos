@extends('layouts.app_admin')
@section('content')
<blog-index-component
    url-create-blog="{{ route('blog.create') }}">
</blog-index-component>
@endsection