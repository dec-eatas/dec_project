<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="backend\resources\css\master.css">
    <title>@yield('title')</title>
    <style>

        body{
            height:100%;min-height:100vh;width:100%;background:whitesmoke;}
        button{
            background-color:transparent;border:none;
            cursor:pointer;outline:none;padding:0;appearance:none;}
        button:hover{color:grey}
        button:active{background-color:lightgray; color:white;}
        aside::-webkit-scrollbar,main::-webkit-scrollbar{display:none;}
        a,a:visited{text-decoration:none;outline:none;}
        a:hover{border-bottom:lightgrey solid;border-width:0.5px;}
        input{border:solid gray;border-width: 0.5px;}
        *{box-sizing:border-box;margin:0;padding:0;color:#3D3D3D;}
        nav{height:10vh;width:100%;background-color:#222;
            display:flex;list-style:none;overflow:hidden;}
        #menu{display:flex;width:100%;height:100%;list-style-type:none;
            text-align:center;align-items: center;}
        #menu li{text-decoration:none;width:25%;}
        #menu li a{text-decoration:none;font-weight:bold;color:white;}
        #menu li a:hover{border-width:medium;}
        aside{width:25%;height:90vh;float:left;padding:1ex;overflow:auto;-ms-overflow-style:none;
        scrollbar-width:none;}
        main{width:75%;height:90vh;float:left;padding:1ex;overflow:auto;}
   
    </style>
</head>
<body>
    <nav>
        <ul id="menu">
            <!-- （ updated 動作確認してからpushしてもらえるとありがたい）route関数使った形に変えてたみたいだけど、web.phpの方でrouteの名前の追加がされてなかったから今後注意で！ -->
            <li><a href="{{ route('eataslab') }}">e+lab</a></li>
            <li><a href="/question">Q & A</a></li>
            <li><a href="/article">Article</a></li>
            <li><a href="/account">Account</a></li>
            <!-- //knowledge sharing// groupにはroute名つけれないみたい！遷移先prefixに行けるように「/」の形にするのが適切なのかな。 -->
        </ul>
    </nav>
    <aside>
        <a href="/question/create" class="text-sm text-gray-700 dark:text-gray-500 underline">質問作成</a>
        @yield('side')
        @yield('create_answer')

    </aside>
    <main>
        @yield('main')
    </main>
</body>
</html>