<!DOCTYPE html>
<html class="h-100" lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Bullish: {{ $title }}</title>
</head>

<body class="d-flex flex-column h-100">
    {{ $slot }}
    <script src="{{ mix('js/app.js') }}"></script>
    @isset($scripts)
        {{ $scripts }}
    @endisset
</body>

</html>
