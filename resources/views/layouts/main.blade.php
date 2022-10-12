<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}

    @if(!isset($pagedata))

    <title>Toyota Hilux Dealer & Exporter in Thailand | SG Asia Cars</title>
    @endif

    @stack("title")
    @if (!isset($pagedata))
    <meta name="description" content="Discover the exclusive Toyota Hilux Dealer & Exporter with wide range of new & used Toyota Hilux 2022 models with a combination of elegance, style & performance.">
    @endif
    <meta name="robots" content="noindex,nofollow" />
    @stack('meta')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/screens.css') }}">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    <link rel="stylesheet" href="https://use.typekit.net/bta8esl.css">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> --}}
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        /* *:not(h1,h2,h3,h4,h5,h6,a){
            font-family: 'Poppins', sans-serif;
        }
        h1,h2,h3,h4,h5,h6,a{
            font-family: muli, sans-serif;
            font-weight: 400;
            font-style: normal;
        } */

        *{
            font-family: muli, sans-serif;
            /* font-weight: 400; */
            font-style: normal;
        }
    </style>
    {{-- toastr css --}}
    @toastr_css
    @stack('style')

    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-L3E34Y5TJN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-L3E34Y5TJN');
      </script> --}}

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/61ee7bc79bd1f31184d8f40b/1fq5p71f0';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</head>
{{-- <body> --}}
    <body id="pbody">
        Verification: 7e9fa5ac18bd5237
    <div id="app">
        <div id="top-bar">
            {{-- topbar here --}}
            @include('includes.top-bar')
        </div>
        <div id="top-header">
            {{-- top header here --}}
            @include('includes.top-header')
        </div>
        <div id="nav-bar">
            {{-- navbar here --}}
            @include('includes.navbar')
        </div>

        <div id="main-page" class="body-wrapper">
            <div id="main-page-content">
                {{-- page actual content here --}}
                @yield('content')
            </div>
        </div>

        <footer>
            @include('includes.footer')
        </footer>

        @yield('modal')
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function(){
            @foreach ($errors->all() as $error)
                toastr.error("{{$error}}");
            @endforeach
        });
    </script>
    @stack('js')
</body>
</html>
