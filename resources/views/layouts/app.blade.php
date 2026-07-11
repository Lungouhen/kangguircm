<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Kanggui RCM'))</title>
    <meta name="description" content="@yield('meta_description', 'Professional Revenue Cycle Management Solutions')">

    @php
        $gtmId = \App\Models\Setting::get('seo.google_tag_manager_id');
        $gaId = \App\Models\Setting::get('seo.google_analytics_id');
        $theme = \App\Models\Theme::active();
    @endphp

    @if($theme?->favicon)
        <link rel="icon" href="{{ asset('storage/' . $theme->favicon) }}">
    @endif

    @if($gtmId)
    <!-- Google Tag Manager -->
    <script type="text/plain" data-cookieconsent="statistics">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ $gtmId }}');</script>
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|instrument-serif:400,700&display=swap" rel="stylesheet" />
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if($theme?->custom_css)
        <style>{!! $theme->custom_css !!}</style>
    @endif

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50" 
      style="--font-heading: '{{ ($theme?->typography['heading'] ?? 'Instrument Serif') }}, serif'; --font-body: '{{ ($theme?->typography['body'] ?? 'Instrument Sans') }}, sans-serif';">
    @if($theme?->colors)
    <style>
        :root {
            --color-primary: {{ $theme->colors['primary'] ?? '#2563EB' }};
            --color-secondary: {{ $theme->colors['secondary'] ?? '#1E40AF' }};
            --color-accent: {{ $theme->colors['accent'] ?? '#F59E0B' }};
        }
    </style>
    @endif
    <!-- Google Tag Manager (noscript) -->
    @if($gtmId)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    <!-- End Google Tag Manager (noscript) -->
    
    <!-- Cookiebot CMP for GDPR/CCPA Compliance -->
    @if($gtmId)
    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="{{ env('COOKIEBOT_CONSENT_ID', '') }}" async="async" type="text/javascript"></script>
    @endif

    <!-- Navigation -->
    @include('partials.navigation')

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Cookie Trimming to Prevent Header Size Issues -->
    @if($gtmId)
    <script type="text/plain" data-cookieconsent="statistics">
    (function() {
        function trimGacUaCookies() {
            var maxCookies = 15;
            var gacCookies = [];
            var cookies = document.cookie.split('; ');
            for (var i in cookies) {
                var parts = cookies[i].split('=');
                var cookieName = parts[0].trim();
                var cookieVal = parts.slice(1).join('=');
                if (cookieName.indexOf('_gac_UA') === 0) {
                    gacCookies.push([cookieName, cookieVal]);
                }
            }
            if (gacCookies.length <= maxCookies) return;
            gacCookies.sort(function(a, b) { return (a[1] > b[1] ? -1 : 1); });
            for (var i in gacCookies) {
                if (i < maxCookies) continue;
                document.cookie = gacCookies[i][0] + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + window.location.host;
            }
        }
        function trimGaSessionCookies() {
            var maxCookies = 15;
            var gaCookies = [];
            var KEEPLIST = ['_ga_ZKBVC1X78F', '_ga_9Z72VQCKY0'];
            var cookies = document.cookie.split('; ');
            for (var i in cookies) {
                var parts = cookies[i].split('=');
                var cookieName = parts[0].trim();
                var cookieVal = parts.slice(1).join('=');
                if (cookieName.indexOf('_ga_') === 0) {
                    if (KEEPLIST.indexOf(cookieName) !== -1) continue;
                    gaCookies.push([cookieName, cookieVal]);
                }
            }
            if (gaCookies.length <= maxCookies) return;
            gaCookies.sort(function(a, b) { return (a[1] > b[1] ? -1 : 1); });
            for (var i in gaCookies) {
                if (i < maxCookies) continue;
                document.cookie = gaCookies[i][0] + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + window.location.host;
            }
        }
        trimGacUaCookies();
        trimGaSessionCookies();
    })();
    </script>
    @endif
    <!-- Google Analytics -->
    @if($gaId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $gaId }}');
    </script>
    @endif

    @if($theme?->custom_js)
        <script>{!! $theme->custom_js !!}</script>
    @endif

    @stack('scripts')
</body>
</html>
