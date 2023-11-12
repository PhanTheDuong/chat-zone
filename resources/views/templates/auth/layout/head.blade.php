@php
     $pageTitle = (isset($page_title)) ? $page_title : 'Chat Zone';
@endphp

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{'Chat Zone - '.$pageTitle}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('uploads/logo/icon-logo.png')}}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('uploads/favicon/apple-icon-57x57.png')}}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('uploads/favicon/apple-icon-72x72.png')}}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('uploads/favicon/apple-icon-76x76.png')}}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('uploads/favicon/apple-icon-114x114.png')}}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('uploads/favicon/apple-icon-120x120.png')}}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('uploads/favicon/apple-icon-144x144.png')}}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('uploads/favicon/apple-icon-152x152.png')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('uploads/favicon/apple-icon-180x180.png')}}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{{url('template/auth/vendor/fonts/fontawesome.css')}}}" />
    <link rel="stylesheet" href="{{url('template/auth/vendor/fonts/materialdesignicons.css')}}" />
    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{url('template/auth/vendor/libs/node-waves/node-waves.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('template/auth/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{url('template/auth/vendor/css/rtl/theme-default.css')}}" />
    <link rel="stylesheet" href="{{url('template/auth/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('template/auth/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('template/auth/vendor/libs/typeahead-js/typeahead.css')}}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{url('template/auth/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{url('template/auth/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{url('template/auth/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{url('template/auth/js/config.js')}}"></script>


    <link rel="stylesheet" href="{{url('template/auth/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{url('template/auth/vendor/libs/sweetalert2/sweetalert2.css')}}" />
{{--    <link rel="stylesheet" href="{{url('template/auth/vendor/css/pages/app-email.css')}}">--}}

    {{-- Toast  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
</head>
