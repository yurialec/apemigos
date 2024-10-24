@extends('layouts.app_admin')
@section('content')
<site-contact-edit-component
    contact-by-id="{{ json_encode($contact) }}"
    url-index-contact="{{ route('site.contact.index') }}">
</site-contact-edit-component>
@endsection