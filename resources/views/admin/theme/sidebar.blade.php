<sidebar-component
    user-name="{{ auth()->user()->name }}"
    role="{{auth()->user()->role->name}}">
</sidebar-component>