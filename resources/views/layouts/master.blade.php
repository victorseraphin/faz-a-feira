<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <app-component></app-component>
    </div>



    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://unpkg.com/vuejs-paginate@latest"></script>
</body>

</html>
