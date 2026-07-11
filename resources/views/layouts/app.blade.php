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
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
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

    <!-- Navigation -->
    @include('partials.navigation')

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

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
