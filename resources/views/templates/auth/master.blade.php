
<!DOCTYPE html>
<html

    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="themes/back_end/"
    data-template="horizontal-menu-template-no-customizer">
@include('templates.auth.layout.head')
<body>

@yield('content')


@include('templates.auth.layout.script')
@stack('js')
</body>
</html>
