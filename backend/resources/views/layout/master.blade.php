<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="backend\resources\css\master.css">
    <link rel="stylesheet" href="backend\resources\css\.css">
    <title>@yield('title')</title>
    <style>

        body{box-sizing: border-box; margin: 0; padding: 0; height: 100%; min-height: 100vh; width: 100%;}
        nav{height: 10vh; width: 100%; background-color: greenyellow;
            display:flex; list-style: none; overflow: hidden;}
        #menu{display: flex; width: 100%; list-style-type: none;  text-align: center;}
        #menu li{text-decoration: none; width: 25%;}
        #menu li a{text-decoration: none; font-weight: bold;}

        aside{width: 25%; height: 90vh; float: left; background-color: lightskyblue; }
        main{width: 75%; height: 90vh; float: left; background-color: salmon;}

    </style>
</head>
<body>
    <nav>
        <ul id="menu">
            <li><a>eata</a></li>
            <li><a>質問</a></li>
            <li><a>記事</a></li>
            <li><a>アカウント</a></li>
        </ul>
    </nav>
    <aside>
        @yield('side')
    </aside>
    <main>
        @yield('main')
    </main>
</body>
</html>