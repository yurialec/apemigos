@extends('layouts.app_admin')
@section('content')
<site-main-text-edit-component
    main-text-by-id="{{ json_encode($mainText) }}"
    url-index-main-text="{{ route('site.maintext.index') }}">
</site-main-text-edit-component>
@endsection