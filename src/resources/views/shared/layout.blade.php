<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Вижте най-актуалните филми на ФИЛМИ.БГ</title>
</head>

<body>
    @include('layouts.navigation')
    <div class="mb-16">
        @yield('content')
    </div>
    @include('shared.partials.footer')

    @vite('resources/js/app.js')
</body>

</html>
