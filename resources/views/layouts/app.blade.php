<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #e5e5e5;
        }

        /* NAVBAR */
        .navbar {
            background: #5b6ad0;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
        }

        .logo {
            font-weight: bold;
            font-size: 24px;
        }

        .search-box {
            width: 50%;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 8px 35px 8px 15px;
            border-radius: 20px;
            border: none;
            outline: none;
        }

        .search-box span {
            position: absolute;
            right: 12px;
            top: 7px;
        }

        /* BUTTON */
        .nav-btn {
            display: flex;
            gap: 10px;
        }

        .nav-btn a {
            background: white;
            color: black;
            padding: 6px 14px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav-btn a:hover {
            background: #ddd;
        }

        /* BANNER */
        .banner {
            height: 180px;
            background: #cfcfcf;
            position: relative;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 50px;
            cursor: pointer;
        }

        .left {
            left: 20px;
        }

        .right {
            right: 20px;
        }

        /* CONTENT */
        .container {
            width: 90%;
            margin: auto;
            padding: 20px 0;
        }

        h1 {
            margin-bottom: 20px;
        }

        /* CARD */
        .jadwal {
            background: #5b6ad0;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background: white;
            width: 180px;
            border-radius: 10px;
            text-align: center;
            padding: 15px;
        }

        .card img {
            width: 80px;
            margin: 10px 0;
        }

        .harga {
            color: red;
            font-weight: bold;
        }

        /* TENTANG */
        .tentang {
            width: 250px;
            background: #d9d9d9;
            margin: 30px auto;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">

        <div class="logo">
            Mari Lelang
        </div>

        <div class="search-box">
            <input type="text" placeholder="Search">
            <span>🔍</span>
        </div>

        <div class="nav-btn">

            <a href="{{ route('login') }}">
                Login
            </a>

            <a href="{{ route('register') }}">
                Register
            </a>

        </div>

    </div>

    <!-- Content -->
    <main>
        {{ $slot }}
    </main>

</body>

</html>