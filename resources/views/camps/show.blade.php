<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>キャンプ場詳細｜シーズン別キャンプ場リサーチ！</title>
        
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    </head>
    <body class="antialiased">
       <h1>キャンプ場詳細画面</h1>
       　  <div class="user">
       　    <h2>投稿者名</h2>
       　    <h2>{{$post->user->name}}</h2>
       　  </div>
      　   <div class="camp">
      　     <h2>キャンプ場名</h2>
      　 　  <h2>{{$post->camp}}</h2>
      　   </div>
      　   <div class="body">
      　       <h2>概要</h2>
      　       <h2>{{$post->body}}</h2>
      　   </div>
      　   <div class="season">
      　       <h2>シーズン</h2>
      　       <h2>{{$post->season->season}}</h2>
      　   </div>
      　   @auth
      　   @if (!$post->isLikedBy(Auth::user(), $post))
           <span class="likes">
             <p>良いねなし</p>
             <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
           <span class="like-counter">{{$post->likes_count}}</span>
           </span><!-- /.likes -->
          @else
           <span class="likes">
             <p>良いねあり</p>
             <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
           <span class="like-counter">{{$post->likes_count}}</span>
           </span><!-- /.likes -->
          @endif
      　   @endauth
      　   <form action="/comments/{{$post->id}}" method="POST">
      　    @csrf
      　    <div class="comment">
      　       <textarea name="comment" placeholder="コメント" >{{old('comment.body')}}</textarea>
      　    </div>
      　    <input type="submit" value="コメントする"/>
      　   </form>
      　   @foreach($post->comments as $comment)
      　   <div class="comment">
      　       <h1>{{$comment->user->name}}</h1>
      　       <p>{{$comment->body}}</p>
      　   </div>
      　   @endforeach
      　   @if (auth()->id() == $post->user_id)
      　   <div class="edit">
      　       <a href="/posts/{{$post->id}}/edit">編集</a>
      　   </div>
      　   @endif
      　   @if (auth()->id() == $post->user_id)
      　   <form action="/posts/{{$post->id}}" id="form_{{$post->id}}" method="POST">
      　       @csrf
      　       @method('DELETE')
　　　　　<button type="button" onclick="deletePost({{$post->id}})">削除</button>
      　   </form>
      　   @endif
      　<div class="footer">
      　    <a href="/">戻る</a>
      　</div>
    </body>
</html>
<script>
    function deletePost(id){
        'use strict'
        if(confirm('削除すると復元できません。\n本当に削除しますか？')){
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>
