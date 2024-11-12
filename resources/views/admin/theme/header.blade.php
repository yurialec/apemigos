<header-component
    url-sair="{{ route('logout') }}"
    url-profile="{{route('profile.view')}}"
    logo="{{App\Models\Site\SiteLogo::first()->image ?? ''}}"
    url-home="{{ route('home') }}">
</header-component>
