<footer class="footer light-background" style="background-color: #DCDCDC; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <div class="container footer-top">
        <div class="row">
            <div class="col-sm footer-about">
                <h4>Siga-nos</h4>
                <div class="social-links d-flex mt-4">
                    @foreach ($socialmedias as $media)
                        <a target="_blank" href="{{ $media->url }}">
                            <i class="{{ $media->icon }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="col-sm footer-links">
                <ul>
                    <li><a href="{{ route('index.site') }}">Início</a></li>
                    <li><a href="{{ route('about') }}">Sobre</a></li>
                    <li><a href="{{ route('contact') }}">Contato</a></li>
                    <li><a href="{{ route('site.blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('login') }}">Área Restrita</a></li>
                </ul>
            </div>

            @if (isset($contact) && $contact)
                <div class="col-sm footer-contact">
                    <h4>Contato</h4>
                    <p><strong>Endereço:</strong>{{ $contact->address }}</p>
                    <p><strong>Cidade/Estado:</strong>{{ $contact->city }}/{{ $contact->state }}</p>
                    <p><strong>Cep:</strong>{{ $contact->zipcode }}</p>
                    <p><strong>Telefone:</strong> <span>{{ $contact->phone }}</span></p>
                    <p><strong>Email:</strong> <span>{{ $contact->email }}</span></p>
                </div>
            @endif
        </div>
    </div>
</footer>