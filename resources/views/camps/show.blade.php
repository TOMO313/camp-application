<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">

        <title>キャンプ場詳細｜シーズン別キャンプ場リサーチ！</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

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
      　   <div class="edit">
      　       <a href="/posts/{{$post->id}}/edit">編集</a>
      　   </div>
      　   <form action="/posts/{{$post->id}}" id="form_{{$post->id}}" method="POST">
      　       @csrf
      　       @method('DELETE')
　　　　　<button type="button" onclick="deletePost({{$post->id}})">削除</button>
      　   </form>
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
