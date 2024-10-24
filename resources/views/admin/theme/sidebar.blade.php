<sidebar-component
    logo="{{App\Models\Site\SiteLogo::first()->image ?? ''}}"
    url-home="{{ route('home') }}">
</sidebar-component>
