<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">

        <title>シーズン別キャンプ場リサーチ！</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    
    <body class="antialiased">
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
      　 <div class="footer">
      　    <a href="/seasons/{{$season->id}}">戻る</a>
         </div>
    </body>
</html>