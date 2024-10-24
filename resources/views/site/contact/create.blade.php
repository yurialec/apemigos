@extends('layouts.app_admin')
@section('content')
<site-contact-create-component
    url-index-contact="{{ route('site.contact.index') }}">
</site-contact-create-component>
@endsection