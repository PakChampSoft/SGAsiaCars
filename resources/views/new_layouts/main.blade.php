<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    @if (!isset($pagedata))
        <title>Toyota Hilux Dealer & Exporter in Thailand | SG Asia Cars</title>
    @endif
    @stack("title")

    @if (!isset($pagedata))
        <meta name="description"
            content="Discover the exclusive Toyota Hilux Dealer & Exporter with wide range of new & used Toyota Hilux 2022 models with a combination of elegance, style & performance.">
    @endif
    @stack('meta')
    <meta name="yandex-verification" content="7e9fa5ac18bd5237" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style-starter.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-price-range.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" />

    {{-- SEO --}}
    <link rel="alternate" href="https://www.sgasiacars.com" hreflang="en" />
    <style>
        * {
            font-family: 'Mulish', sans-serif;
            /*font-weight: 400;*/
            font-style: normal;

        }

    </style>

    {{-- @toastr_css --}}

    {{-- INECTION OF STYLES --}}
    @stack('style')

    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/61ee7bc79bd1f31184d8f40b/1fq5p71f0';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script> --}}
    <!--End of Tawk.to Script-->
    {{-- SEO --}}
    <!-- Global site tag (gtag.js) - Google Ads -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10905671364"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-10905671364');
    </script>

</head>

<body>
    <div class="app">
      <div style="display: none;">Verification: 7e9fa5ac18bd5237</div>

        {{-- TOP BAR --}}
        @include('new_includes.top-bar')
        {{-- // TOP BAR --}}

        <!-- //header -->
        <!-- search section -->
        @include('new_includes.search-bar')
        <!-- //search section -->

        {{-- NAV BAR --}}
        @include('new_includes.nav-bar')
        <!-- // NAV BAR -->

        <!-- MAIN SECTION -->
        @yield('content')
        <!-- // MAIN SECTION -->

        <!-- FOOTER SECTION -->
        @include('new_includes.footer')
        <!-- // FOOTER SECTION -->

        {{-- Model For Request for Quote --}}
        @yield('modal')
        {{-- // Model For Request for Quote --}}

    </div>

    @stack('whatsappbtn')
    {{-- <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script> <!-- Common jquery plugin --> --}}
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <!--bootstrap-->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-price-range.js') }}"></script>
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    {{-- TOASTER --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // toastr.success("sdf");
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach

            @if (Session::has('message'))
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                toastr.success("{{ session('message') }}");
            @endif
        });
    </script>

    {{-- TAWKTO CHAT PLUGIN --}}
    {{ \TawkTo::widgetCode() }}

    {{-- INECTION OF JAVASCRIPT --}}
    @stack('js')
</body>

</html>
