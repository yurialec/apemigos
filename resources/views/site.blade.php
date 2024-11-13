@include('layouts.app')
@include('partials.navbar')

<div class="main-content container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

        <!-- About Section -->
        @if (isset($about) && !empty($about))
            <section id="about" class="about section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>Sobre Nós</h2>
                </div>
                <div class="container">
                    <div class="row gy-3">
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ 'storage/' . $about->image }}" alt="{{ $about->name }}" width="350"
                                class="img-fluid">
                        </div>

                        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="about-content ps-0 ps-lg-3">
                                <h3>{{ $about->title }}</h3>
                                <p>{{ $about->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Carousel Section -->
        @if (isset($carousels) && $carousels->isNotEmpty())
            <section class="empresa">
                <div class="container carousel-container">
                    <div class="d-flex justify-content-center my-5">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true"
                            style="max-width: 800px;">
                            <div class="carousel-indicators">
                                @foreach ($carousels as $index => $carousel)
                                    <button style="background-color: #333; width: 14px; height: 14px; border-radius: 100%;"
                                        type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}">
                                    </button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($carousels as $index => $carousel)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $carousel->image) }}" style="width: 550px;"
                                            class="d-block h-40 mb-4" alt="...">
                                        @if ($carousel->title || $carousel->description || $carousel->url_link || $carousel->name_link)
                                            <div class="carousel-caption d-md-block"
                                                style="background-color: #333; border-radius: 10px; opacity: 0.7;">
                                                <h5 style="color: #fff;">{{ $carousel->title }}</h5>
                                                <p>{{ $carousel->description }}</p>
                                                <a style="color: #fff;" href="{{ $carousel->url_link }}"
                                                    target="_blank">{{ $carousel->name_link }}</a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                                <span style="background-color: #333; border-radius: 100%;"
                                    class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                                <span style="background-color: #333; border-radius: 100%;"
                                    class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Blog Section -->
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
        @endif
    </div>
</div>

@include('partials.footer.index')