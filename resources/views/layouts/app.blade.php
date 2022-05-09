<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CTF.MD') }}</title>


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{asset("css/bootstrap.3.4.1.css")}}">
    <script src="{{asset("js/fontawesome.js")}}" crossorigin="anonymous"></script>
    <script src="{{asset("js/jquery.3.5.1.js")}}"></script>
    <script src="{{asset("js/bootstrap.3.4.1.js")}}"></script>

</head>

<style>
    * {
        border: 0;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    :root {
        --bg: #333;
        --checkBg: #333333FF;
        --checkBorder: #c7cad1;
        --fg: #333;
        --fgDim: #5c6270;
        --primary: #255ff4;
        --dur: 0.6s;
        font-size: calc(16px + (24 - 16) * (100vw - 320px) / (1280 - 320));
    }
    body, input {
        color: var(--fg);
        /*font: 1em/1.5 system-ui, -apple-system, sans-serif;*/
    }

    label, input[type=checkbox] {
        cursor: pointer;
    }
    label {
        display: inline-flex;
        align-items: center;
        margin-bottom: 0.75em;
        position: relative;
        -webkit-tap-highlight-color: transparent;
    }
    input[type=checkbox], input[type=checkbox]:before, input[type=checkbox]:after {
        width: 1rem;
        height: 1rem;
    }
    input[type=checkbox], input[type=checkbox]:before {
        background: var(--checkBg);
        border-radius: 0.2em;
        box-shadow: 0 0 0 0.25px var(--checkBorder) inset;
    }
    input[type=checkbox]:before, input[type=checkbox]:after {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
    }
    input[type=checkbox] {
        margin-right: 0.75em;
        -webkit-appearance: none;
        appearance: none;
    }
    input[type=checkbox] + span {
        animation: brighten var(--dur) linear;
    }
    input[type=checkbox]:before {
        animation: unstrike var(--dur) linear;
        content: "";
        transform-origin: 0 50%;
        z-index: 1;
    }
    input[type=checkbox]:after {
        color: var(--primary);
        content: "\2713";
        font-size: 1.5em;
        line-height: 1.8;
        text-align: center;
    }
    input[type=checkbox]:focus {
        outline: transparent;
    }
    /*input[type=checkbox]:focus + span {*/
    /*    text-decoration: underline;*/
    /*}*/
    input[type=checkbox]:checked + span {
        animation-name: dim;
        color: var(--fgDim);
    }
    input[type=checkbox]:checked:before {
        /*animation-name: strike;*/
        background: var(--fgDim);
        border-radius: 0;
        /*box-shadow: 0 0 0 1px var(--fgDim) inset;*/
        transform: translateX(2.25em) scale(1,0.05);
        width: calc(100% - 2.25em);
    }
    input[type=checkbox].pristine:before, input[type=checkbox].pristine + span {
        animation: none;
    }
    /* Dark mode */
    @media (prefers-color-scheme: dark) {
        :root {
            --bg: #333;
            --checkBg: #2e3138;
            --checkBorder: #454954;
            --fg: #e3e4e8;
            --fgDim: #8f95a3;
            --primary: #5583f6;
        }
    }
    /* Animations */
    @keyframes dim {
        from, 83% {
            color: var(--fg);
        }
        to {
            color: var(--fgDim);
        }
    }
    @keyframes brighten {
        from {
            color: var(--fgDim);
        }
        17%, to {
            color: var(--fg);
        }
    }
    /*@keyframes unstrike {*/
    /*    from {*/
    /*        background: var(--fgDim);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fgDim) inset;*/
    /*        transform: translateX(2.25em) scale(1,0.05);*/
    /*        width: calc(100% - 2.25em);*/
    /*    }*/
    /*    14% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(2.25em) scale(1,0.05);*/
    /*        width: calc(100% - 2.25em);*/
    /*    }*/
    /*    29% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(2.75em) scale(1,0.05);*/
    /*        width: calc(100% - 2.25em);*/
    /*    }*/
    /*    43% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(-0.5em) scale(0.75,0.05);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*    57% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(0) scale(1,0.05);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*    71% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0.2em;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(0) scale(1,1.25);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*    86% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0.2em;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(0) scale(1,1);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*    to {*/
    /*        background: var(--checkBg);*/
    /*        border-radius: 0.2em;*/
    /*        box-shadow: 0 0 0 1px var(--checkBorder) inset;*/
    /*        transform: translateX(0) scale(1,1);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*}*/
    /*@keyframes strike {*/
    /*    from {*/
    /*        background: var(--checkBg);*/
    /*        border-radius: 0.2em;*/
    /*        box-shadow: 0 0 0 1px var(--checkBorder) inset;*/
    /*        transform: translateX(0) scale(1,1);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*    17% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0.2em;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(0) scale(1,1);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*    33% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(0) scale(1,0.05);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*    50% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(-0.5em) scale(1,0.05);*/
    /*        width: 1.5em;*/
    /*    }*/
    /*    67% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(2.25em) scale(1.25,0.05);*/
    /*        width: calc(100% - 2.25em);*/
    /*    }*/
    /*    83% {*/
    /*        background: var(--fg);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fg) inset;*/
    /*        transform: translateX(2.25em) scale(1,0.05);*/
    /*        width: calc(100% - 2.25em);*/
    /*    }*/
    /*    to {*/
    /*        background: var(--fgDim);*/
    /*        border-radius: 0;*/
    /*        box-shadow: 0 0 0 1px var(--fgDim) inset;*/
    /*        transform: translateX(2.25em) scale(1,0.05);*/
    /*        width: calc(100% - 2.25em);*/
    /*    }*/
    /*}*/
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: var(--bg);
        /*display: flex;*/
        /*justify-content: center;*/
        /*align-items: center;*/
        font-family: consolas;
    }

    .container {
        width: 80vw;
        position: relative;
        display: flex;
        justify-content: space-between;
    }

    .container .card {
        position: relative;
        cursor: pointer;
        height: 150px;
    }

    .container .card .face {
        width: 300px;
        height: 150px;
        transition: 0.5s;
    }

    .container .card .face.face1 {
        position: relative;
        background: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
        transform: translateY(50px);
    }

    .container .card:hover .face.face1 {
        background: #ab003a;
        transform: translateY(0);
        z-index:555555 !important;
    }

    .container .card .face.face1 .content {
        opacity: 0.2;
        transition: 0.5s;
    }

    .container .card:hover .face.face1 .content {
        opacity: 1;
        z-index:555555 !important;
    }

    .container .card .face.face1 .content img {
        max-width: 100px;
    }

    .container .card .face.face1 .content h3 {
        margin: 10px 0 0;
        padding: 0;
        color: #fff;
        text-align: center;
        font-size: 1.5em;
    }

    .container .card .face.face2 {
        position: relative;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        box-sizing: border-box;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
        transform: translateY(-100px);
    }

    .container .card:hover .face.face2 {
        transform: translateY(0);
        z-index:555555 !important;
    }

    .container .card .face.face2 .content p {
        margin: 0;
        padding: 0;
    }

    /*.container .card .face.face2 .content a {*/
    /*    margin: 15px 0 0;*/
    /*    display: inline-block;*/
    /*    text-decoration: none;*/
    /*    font-weight: 900;*/
    /*    color: #000000;*/
    /*    padding: 5px;*/
    /*    border: 1px solid #070707;*/
    /*}*/

    .container .card .face.face2 .content a:hover {
        background: #333;
        color: #fff;
        tab-index: 12222;
    }
</style>
<body>
@include('includes.navbar')

<div class="container">
    <div class="row">
        @yield('content')
    </div>
</div>

{{--@include('include.footer')--}}
</body>

</html>
