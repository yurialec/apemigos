@extends('layouts.app_admin')
@section('content')
<site-main-text-index-component
    url-create-main-text="{{ route('site.maintext.create') }}">>
</site-main-text-index-component>
@endsection