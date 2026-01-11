<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('FiszIt!') }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#9ce4ff] bg-[linear-gradient(27deg,rgba(156, 228, 255, 1) 0%, rgba(255, 255, 255, 1) 100%)] text-[#1b1b18] flex p-6 lg:p-8 items-center justify-center min-h-screen flex-col">

    <div class="bg-[#ffffff] rounded-lg shadow-2xl p-8 h-[70vh] lg:flex lg:flex-row justify-center items-center max-w-[800px] max-h-[600px]">
        <div class="h-[30%] flex items-center justify-center mb-4">
            <x-application-logo class="w-[220px] md:w-[300px] lg:w-[430px] " />
        </div>
        <div class=" flex flex-col items-center justify-evenly h-[70%]">
            <div class="w-[50%]">
                <img src="{{ asset('storage/images/hello.gif') }}" alt="hello typing gif ">
            </div>
            <div class=" flex flex-col justify-center items-center gap-4">
                <a href="{{ route('login') }}" class="welcome-btn sm:text-[1.2em] md:text-[1.4em] lg:text-[1.4em]">Zaloguj się</a>
                <span class="text-[#bbb] lg:text-[1.4em]">lub</span>
                <a href="{{ route('register') }}" class="welcome-btn sm:text-[1.2em] md:text-[1.4em] lg:text-[1.4em]">Zarejestruj się</a>
            </div>
        </div>
    </div>

    @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>