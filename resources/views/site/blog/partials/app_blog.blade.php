<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SistemaGenerico - Blog</title>
    <link rel="icon" type="image/x-icon" href="" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    @vite(['resources/sass/blog.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- Navigation-->

    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ url('/') }}">Site</a>
            <!-- <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="post.html">Sample Post</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.html">Contact</a></li>
                </ul>
            </div> -->
        </div>
    </nav>

    @if (Route::getCurrentRoute()->uri == 'blog')
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('{{ asset('storage/blog/bg/home-bg.jpg') }}')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Blog Simples</h1>
                            <span class="subheading">Seja bem-vindo</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content-->

        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            @if (isset($socialmedias) && $socialmedias)
                                @foreach ($socialmedias as $media)
                                    <li class="list-inline-item">
                                        <a target="_blank" href="{{ $media->url }}">
                                            <span class="fa-stack fa-lg">
                                                <i class="{{ $media->icon }}"></i>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                            @endif
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Sistema Genérico 2024
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    @else
    @endif
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
