@extends('layouts.app')

@include('partials.navbar')

<div class="main-content container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        @if (isset($about->image))
        <div class="col-md-4 text-center mb-4 mb-md-0">
            <img src="{{ '/storage/' . $about->image }}" class="img-fluid" alt="About Image">
        </div>
        @endif

        <div class="col-md-4 text-center">
            @if (isset($about->title))
            <h1>{{ $about->title }}</h1>
            @endif

            @if (isset($about->description))
            <h3>{{ $about->description }}</h3>
            @endif
        </div>
    </div>
</div>

@include('partials.footer')