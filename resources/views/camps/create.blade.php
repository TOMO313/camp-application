<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">

        <title>シーズン別キャンプ場リサーチ！</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
       <h1>キャンプ場投稿作成</h1>
      　<form action="/posts" method="POST">
      　    @csrf
      　   <div class="user">
      　       <h2>投稿者名</h2>
      　   </div>  
      　   <div class="camp">
      　     <h2>キャンプ場名</h2>
      　     <input type="text" name="post[camp]" placeholder="～キャンプ場"/>
      　   </div>
      　   <div class="body">
      　       <h2>概要</h2>
      　       <textarea name="post[body]" placeholder="基本情報・特徴・魅力など"></textarea>
      　   </div>
      　   <div class="season">
      　       <h2>シーズン</h2>
      　       <select name="post[season_id]">
      　           @foreach($seasons as $season)
      　           <option value="{{$season->id}}">{{$season->season}}</option>
      　           @endforeach
      　       </select>
      　   </div>
      　   <input type="submit" value="投稿"/>
      　</form>
      　<div class="footer">
      　    <a href="/">戻る</a>
      　</div>
    </body>
</html>
