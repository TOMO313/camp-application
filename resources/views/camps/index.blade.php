<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">

        <title>シーズン別キャンプ場リサーチ！</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
        <h1>シーズン別キャンプ場リサーチ!</h1>
    　　<p>今の季節にあったキャンプを味わえるキャンプ場を紹介!</p>
        <a href='/posts/create'>キャンプ場投稿</a>
      　<p>自分のお気に入りのキャンプ場を投稿してみよう！</p>
      　<div class="posts">
      　    <h2>キャンプ場投稿一覧</h2>
      　    @foreach($posts as $post)
      　    <div class="post">
      　        <h2>キャンプ場名</h2>
      　        <a href="/posts/{{$post->id}}">{{$post->camp}}</a>
      　        <h2>概要</h2>
      　        <p>{{$post->body}}</p>
      　    </div>
      　    @endforeach
      　</div>
    </body>
</html>
