@extends('layouts.app_admin')
@section('content')
<site-main-text-create-component
    url-index-main-text="{{ route('site.maintext.index') }}">
</site-main-text-create-component>
@endsection