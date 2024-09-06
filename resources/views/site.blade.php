<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema Genérico</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/sass/site.scss', 'resources/js/app.js'])
</head>

<body>
    @include('partials.navbar')
    <!-- Main Section -->
    @if (isset($mainText) && !empty($mainText))
        <header class="bg-primary text-white text-center py-5">
            <div class="container">
                <h1>{{ $mainText->title }}</h1>
                <p class="lead">{{ $mainText->text }}</p>
            </div>
        </header>
    @else
    @endif

    @if (isset($about) && !empty($about))
        <section class="py-5" style="background-color: #f8f9fa;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <img src="{{ 'storage/' . $about->image }}" class="img-fluid rounded shadow" width="250"
                            alt="{{ $about->name }}">
                    </div>
                    <div class="col-md-6">
                        <h2 class="display-4 font-weight-bold mb-3" style="color: #343a40;">{{ $about->title }}</h2>
                        <p class="lead text-muted">{{ $about->description }}</p>
                    </div>
                </div>
            </div>
        </section>
    @else
    @endif

    <div class="main-content container">
        <section id="services" class="bg-light py-5">

            <!-- Div Services -->
            <!-- <div class="container">
                <h2 class="text-center">Services</h2>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="bi bi-laptop fs-1 text-primary"></i>
                                <h5 class="card-title mt-3">Desenvolvimento Web</h5>
                                <p class="card-text">Creating responsive and dynamic websites to suit your needs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="bi bi-phone fs-1 text-primary"></i>
                                <h5 class="card-title mt-3">Aplicativos</h5>
                                <p class="card-text">Developing user-friendly mobile applications for Android and iOS.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="bi bi-bar-chart fs-1 text-primary"></i>
                                <h5 class="card-title mt-3">Otimização</h5>
                                <p class="card-text">Improving your website's visibility and search engine ranking.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="container">
                @if (isset($carousels) && $carousels->isNotEmpty())
                    <!-- Carousel Section -->
                    <div class="container carousel-container">
                        <div class="d-flex justify-content-center my-5">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true"
                                style="max-width: 800px;">
                                <div class="carousel-indicators">
                                    @foreach ($carousels as $index => $carousel)
                                        <button style="background-color: #333;" type="button"
                                            data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $index }}"
                                            class="{{ $index === 0 ? 'active' : '' }}"
                                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-label="Slide {{ $index + 1 }}">
                                        </button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($carousels as $index => $carousel)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $carousel->image) }}"
                                                class="d-block w-100 h-40 mb-4" alt="...">

                                            @if ($carousel->title || $carousel->description || $carousel->url_link || $carousel->name_link)
                                                <div class="carousel-caption d-md-block">
                                                    <h5>{{ $carousel->title }}</h5>
                                                    <p>{{ $carousel->description }}</p>
                                                    <a href="{{ $carousel->url_link }}"
                                                        target="_blank">{{ $carousel->name_link }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if (isset($siteblogs) && $siteblogs->isNotEmpty())
                <div class="container blog-section text-center">
                    <h2>Blog</h2>
                    <div class="row justify-content-center">
                        @foreach ($siteblogs as $item)
                            <div class="col-md-4 d-flex align-items-stretch">
                                <div class="card blog-card mb-4">
                                    <img class="card-img-top" alt="thumbnail-blog"
                                        src="{{ asset('storage/' . $item->images[0]->image_path) }}">
                                    <div class="card-body">
                                        <p class="card-text">{{ $item->title }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('site.blog.post', $item->id) }}"
                                                    class="btn btn-sm btn-outline-primary">View</a>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
            @endif
    </div>

    <div class="site-information">
        <div class="container">
            <div class="row">
                <div class="col-sm text-start">
                    <p><strong>Páginas</strong></p>
                    <nav>
                        <ul>
                            <li><a href="/">Início</a></li>
                            <li><a href="{{ route('about') }}">Sobre</a></li>
                            <li><a href="/contato">Contato</a></li>
                            <li><a href="/blog">Blog</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                @if (isset($contact) && $contact)
                    <div class="col-sm text-center">
                        <p><strong>Contato</strong></p>
                        <nav>
                            <ul>
                                <li><i class="bi bi-telephone"></i>&nbsp;{{ $contact->phone }}</li>
                                <li><i class="bi bi-envelope"></i>&nbsp;{{ $contact->email }}</li>
                                <li><i
                                        class="bi bi-building"></i></i>&nbsp;{{ $contact->city }}/{{ $contact->state }}
                                </li>
                                <li><i class="bi bi-geo-alt-fill"></i>&nbsp;{{ $contact->address }}</li>
                                <li>CEP&nbsp;{{ $contact->zipcode }}</li>
                            </ul>
                        </nav>
                    </div>
                @else
                @endif

                @if (isset($socialmedias) && $socialmedias->isNotEmpty())
                    <div class="col-sm text-end">
                        <p><strong>Siga-nos</strong></p>
                        <nav>
                            <ul>
                                @foreach ($socialmedias as $media)
                                    <li>
                                        <a target="_blank" href="{{ $media->url }}">
                                            <i class="{{ $media->icon }}"></i> {{ $media->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
</body>

</html>
