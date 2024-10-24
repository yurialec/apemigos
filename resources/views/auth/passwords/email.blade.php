@include('layouts.app')
@include('partials.navbar')

<div class="main-content container" style="margin-bottom: 347px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        Resetar Senha
                    </div>

                    <div class="card-body p-4">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row mb-3">
                                <input id="email" type="email" placeholder="Endereço de E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="row mb-3 mt-5">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Enviar Link
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')