<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">

        <title>シーズン別キャンプ場リサーチ！</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    
    <body class="antialiased">
      <x-app-layout>
         <x-slot name="header">
           <h1>ログインユーザー：{{ Auth::user()->name }}</h1>
         </x-slot>
        <div>
            <div class = "grid justify-items-center">
                <h1 class = "italic text-2xl font-black">シーズン別キャンプ場リサーチ!</h1>
            　　<p class = "italic">今の季節にあったキャンプを味わえるキャンプ場を紹介!</p>
            　　<p class = "italic">利用スタイルによっても絞り込めるためシーズンと利用スタイル両方を視野に入れて検索できるサイトです!</p>
            </div>
        　　<div class = "flex flex-wrap space-y-4 text-xl">
        　　      <div>
            　　    <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full font-bold transition duration-3 text-white" href="/seasons/1">
            　　        春におすすめ
            　　    </a>
            　　</div>
            　　<div>
            　　    <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full font-bold transition duration-3 text-white" href="/seasons/2">
            　　        夏におすすめ
            　　  </a>
            　　</div>
            　　<div>
            　　    <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full font-bold transition duration-3 text-white" href="/seasons/3">
            　　        秋におすすめ
            　　  </a>
            　　</div>
            　　<div>
            　　    <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full font-bold transition duration-3 text-white" href="/seasons/4">
            　　        冬におすすめ
            　　  </a>
            　　</div>
        　　</div>
        　　<div class="grid justify-items-center space-y-2">
              <a class="my-2 px-4 py-2 border-2 border-blue-500 rounded-md bg-gradient-to-b from-blue-600 to-blue-400 text-white shadow-lg font-bold" href='/posts/create'>
                  キャンプ場投稿
              </a>
            　<p>自分のお気に入りのキャンプ場を投稿してみよう！</p>
            </div>
          　<div class="posts">
          　    <h2>キャンプ場投稿一覧</h2>
          　    @foreach($posts as $post)
          　    <div class="post">
          　        <h2>投稿者名</h2>
          　        <p>{{$post->user->name}}</p>
          　        <h2>キャンプ場名</h2>
          　        <a href="/posts/{{$post->id}}">{{$post->camp}}</a>
          　        <h2>概要</h2>
          　        <p>{{$post->body}}</p>
          　        <h2>シーズン</h2>
          　        <p>{{$post->season->season}}</p>
          　        <h2>利用スタイル</h2>
          　        <p>{{$post->style->name}}</p>
          　    </div>
          　    @endforeach
          　</div>
          　<div class="paginate">
          　    {{$posts->links()}}
          　</div>
        </div>
        
      </x-app-layout>
    </body>
</html>
