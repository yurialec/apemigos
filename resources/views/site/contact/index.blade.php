@extends('layouts.app_admin')
@section('content')
<site-contact-index-component
    url-create-contact="{{ route('site.contact.create') }}">
</site-contact-index-component>
@endsection