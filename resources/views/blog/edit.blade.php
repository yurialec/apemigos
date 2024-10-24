@extends('layouts.app_admin')
@section('content')
<blog-edit-component
    blog-by-id="{{ json_encode($blog) }}"
    url-index-blog="{{ route('blog.index') }}">
</blog-edit-component>
@endsection