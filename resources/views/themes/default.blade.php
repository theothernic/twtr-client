<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @foreach($page->meta as $name => $content)

    @unless(empty($content))
        <meta name="{{ $name }}" content="{{ $content }}" />
    @endunless

    @endforeach

    <title>{{ $page->title ?? 'Hello there.' }} -- {{ config('app.name') }}</title>

    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    @vite(['resources/css/app.css'])

</head>
<body>


<div class="ctr flex centered">
    <aside id="sidebar" class="flex-one">


        <div class="brand">
            <h1><a href="{{ route('home') }}">{{ config('app.name') }}</a></h1>
        </div>

        <div class="description">
            <h3>What's this about?</h3>
            <p>
                This is an archive of tweets just in case the birdsite crashes
                permanently. It has rudimentary functionality, and is always in
                a state of flux, just as its author (hasn't) intended.
            </p>

        </div>

        {{--<div class="search">
            <h3>Search</h3>

            <div class="control flex">
                <input type="text" id="txtSearchEntry" />
                <button>Search</button>
            </div>


        </div>--}}
    </aside>

    <main id="content" class="flex-two">
        @yield('content')
    </main>
</div>


</body>
</html>
