@extends('layouts.app')
@include('partials.navbar')
<div class="main-content container">
    <div class="row justify-content-center align-items-center" style="min-height: 73vh;">
        @if (isset($contact) && $contact)
            <div class="main-content container">
                <div class="container text-center col-sm-4 div-contact-page">
                    <p><i class="bi bi-telephone"></i>&nbsp;{{$contact->phone}}</p>
                    <p><i class="bi bi-envelope"></i>&nbsp;{{$contact->email}}</p>
                    <p><i class="bi bi-building"></i></i>&nbsp;{{$contact->city}}/{{$contact->state}}</p>
                    <p><i class="bi bi-geo-alt-fill"></i>&nbsp;{{$contact->address}}</p>
                    <p>CEP&nbsp;{{$contact->zipcode}}</p>
                </div>
            </div>
        @else

        @endif
    </div>
</div>

@include('partials.footer')