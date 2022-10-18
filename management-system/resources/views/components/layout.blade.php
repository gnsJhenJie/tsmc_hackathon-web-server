<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>工地安全管理系統-戀愛巴士新竹站</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas/4.0.4/tocas.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tocas/4.0.4/tocas.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
</head>

<body>

    <div class="ts-app-layout is-full is-horizontal">
        @include('components/sidebar')
        <div class="cell is-fluid is-secondary">
            <div class="ts-space is-large"></div>
            <div class="ts-container is-narrow">
                <div class="ts-header is-large is-heavy">@yield('page-header')</div>
                <div class="ts-text is-secondary">@yield('page-header-detail')</div>
                <div class="ts-space is-large"></div>
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>