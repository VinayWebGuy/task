<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>
    <header>
        <a href="{{ url('/') }}" class="logo">Task</div>

            <div class="menu">
                <a class="@yield('home')" href="{{ url('/') }}">Home</a>
                <a class="@yield('temp-data')" href="{{ url('/temp-data') }}">Temporary Data</a>
                <a class="@yield('permanent-data')" href="{{ url('/permanent-data') }}">Permanent Data</a>
            </div>
    </header>

    <main>
