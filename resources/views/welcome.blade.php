<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />

</head>

<body class="antialiased">
    <div id="app">
        <example-component></example-component>
    </div>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>