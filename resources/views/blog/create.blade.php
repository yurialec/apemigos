@extends('layouts.app_admin')
@section('content')
<blog-create-component
    url-index-blog="{{ route('blog.index') }}">
</blog-create-component>
@endsection