<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">

        <title>シーズン別キャンプ場リサーチ！</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')

    </head>
    
    <body class = "bg-[url('https://cdn.funq.jp/contents/uploads/2022/08/07104247/iStock-1248250514.jpg')] bg-cover bg-fixed italic font-bold text-white">
        <div class = "grid justify-items-center">
            <h2 class = "text-2xl my-4">キャンプ場投稿一覧</h2>
           <h2 class = "text-xl my-4"> 利用スタイルで絞り込み!</h2>
           <div class = "grid grid-cols-3 gap-4 my-5">
                <div>
                 <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full shadow-lg duration-300" href = "/seasons/{{$season->id}}/1">家族向け</a>
                </div>
                <div class = "grid justify-items-center">
                 <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full shadow-lg duration-300" href = "/seasons/{{$season->id}}/2">ソロ</a>
                </div>
                <div>
                 <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full shadow-lg duration-300" href = "/seasons/{{$season->id}}/3">手ぶら</a>
                </div>
            </div>
            @foreach($posts as $post)
            <div class="grid justify-items-center backdrop-blur-sm bg-black/30 mt-5 space-y-4">
                <a class = "border-b-2 border-b-yellow-500 text-xl text-blue-500 hover:text-yellow-50" href="/posts/{{$post->id}}">{{$post->camp}}</a>
                <p class = "text-sm">投稿者名:{{$post->user->name}}</p>
                <h2 class = "float-none text-xl text-green-500">概要</h2>
                <p class = "text-xl mx-60">{{$post->body}}</p>
                <h2 class = "text-xl text-red-500">シーズン</h2>
                <p class = "text-xl">{{$post->season->season}}</p>
                <h2 class = "text-xl text-yellow-500">利用スタイル</h2>
                <p class = "text-xl">{{$post->style->name}}</p> 
            </div>
            @endforeach
        </div>
        <div>
            {{$posts->links()}}
        </div>
        <div class = "grid justify-items-center text-xl my-5">
            <a class = "rounded-full bg-blue-500 hover:bg-yellow-500 p-1 duration-300" href="/">戻る</a>
        </div>
    </body>
</html>