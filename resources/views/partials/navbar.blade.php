<header id="header" class="header d-flex align-items-center sticky-top" style="background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
        <a class="navbar-brand" href="{{ url('/') }}">
            @if (isset(App\Models\Site\SiteLogo::first()->image))
                <img style="display: flex;justify-content: center; align-items: center; width: auto; height: 60px"
                    src="{{ '/storage/' . App\Models\Site\SiteLogo::first()->image }}">
            @else
                Home
            @endif
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('about') }}">Sobre</a></li>
                <li><a href="{{ route('contact') }}">Contato</a></li>
                <li><a href="{{ route('site.blog.index') }}">Blog</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
        const body = document.querySelector('body');

        mobileNavToggle.addEventListener('click', function () {
            body.classList.toggle('mobile-nav-active');
        });
    });
</script>