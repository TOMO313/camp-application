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
        <div class = "bg-[url('https://cdn.funq.jp/contents/uploads/2022/08/07104247/iStock-1248250514.jpg')] bg-cover bg-fixed text-white italic font-bold"> 
            <div class = "grid justify-items-center">
                <h1 class = "italic text-2xl font-black border-b-2 border-b-yellow-500 my-4">シーズン別キャンプ場リサーチ!</h1>
             <p class = "italic font-bold text-xl">今の季節にあったキャンプを味わえるキャンプ場を紹介!</p>
            <p class = "italic font-bold text-xl">利用スタイルによっても絞り込めるためシーズンと利用スタイル両方を視野に入れて検索できるサイトです!</p>
            </div>
         <div class = "grid grid-cols-2 gap-4 text-xl ml-72">
              <div class = "h-12">
                <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full shadow-lg duration-300" href="/seasons/1">
                     春におすすめ
            　  </a>
              </div>
              <div class = "h-12 mr-52">  
                <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full shadow-lg duration-300" href="/seasons/2">
                     夏におすすめ
             </a>
            　</div>
              <div class = "h-12"> 
                <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full shadow-lg duration-300" href="/seasons/3">
                     秋におすすめ
             </a>
            　</div>
              <div class = "h-12 mr-52">  
                <a class = "bg-blue-500 hover:bg-yellow-500 p-3 rounded-full shadow-lg duration-300" href="/seasons/4">
                     冬におすすめ
             </a>
            　</div>
            </div>
         <div class="grid justify-items-center space-y-2">
              <a class = "my-2 p-3 rounded-md bg-blue-500 hover:bg-yellow-500 shadow-lg font-bold text-xl duration-300" href='/posts/create'>キャンプ場投稿</a>
            　<p class = "font-bold text-xl">自分のお気に入りのキャンプ場を投稿してみよう！</p>
            </div>
          　<div class = "grid justify-items-center">
          　    <h1 class = "font-bold text-2xl my-4">キャンプ場投稿一覧</h2>
          　    @foreach($posts as $post)
          　    <div class = "font-bold grid justify-items-center backdrop-blur-sm bg-black/30">
          　        <a class = "border-b-2 border-b-yellow-500 text-xl text-blue-500 hover:text-yellow-500" href="/posts/{{$post->id}}">{{$post->camp}}</a>
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
          　<div class = "flex justify-center mt-12 text-xl">
          　    {{$posts->links()}}
          　</div>
          　<div class = calendar>
          　   <a href = "{{ route('calendar.show') }}">カレンダー表示</a>
          　</div>  
        </div>
      </x-app-layout>
    </body>
</html>
