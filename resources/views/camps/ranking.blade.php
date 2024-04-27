<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>シーズン別キャンプ場リサーチ！</title>
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
         <x-slot name="header">
           <h1>ランキング</h1>
         </x-slot>
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
        </x-app-layout>
    </body>