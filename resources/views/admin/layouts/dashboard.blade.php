<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CTF') }}</title>
    <!-- Fonts -->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('assets/css/themes/layout/aside/darkafa4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/themes/layout/brand/darkafa4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/themes/layout/header/menu/lightafa4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/themes/layout/header/base/lightafa4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/themes/layout/header/base/lightafa4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundleafa4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundleafa4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/global/plugins.bundleafa4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundleafa4.css')}}" rel="stylesheet"
          type="text/css"/>
    <!--end::Layout Themes-->
    <!-- Scripts -->
    <script>var KTAppSettings = {
            "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>

    <script src="{{asset('assets/plugins/global/plugins.bundleafa4.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundleafa4.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundleafa4.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundleafa4.js')}}"></script>
    <script src="{{asset('assets/js/pages/widgetsafa4.js')}}"></script>
{{--    <script src="{{asset("js/jquery.2.1.3.js")}}"></script>--}}
{{--    <script src="{{asset("js/jquery.3.5.1.js")}}"></script>--}}
</head>


<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable">
@include('admin.includes.sidebar')
<div class="container">
    @yield('content')
</div>

{{--@include('include.admin.footer')--}}

</body>

</html>
