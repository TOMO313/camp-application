<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">

        <title>キャンプ場投稿編集｜シーズン別キャンプ場リサーチ！</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
       <h1>キャンプ場投稿編集画面</h1>
      　<form action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
      　    @csrf
      　    @method('PUT')
      　   <div class="user">
      　     <h2>投稿者名</h2>
      　     <h2>{{$post->user->name}}</h2>
      　   </div>
      　   <div class="camp">
      　     <h2>キャンプ場名</h2>
      　     <input type="text" name="post[camp]" placeholder="～キャンプ場" value="{{$post->camp}}"/>
      　     <p class"camp_error" style="color:red">{{$errors->first('post.camp')}}</p>
      　   </div>
      　   <div class="body">
      　     <h2>概要</h2>
      　     <textarea name="post[body]" placeholder="基本情報・特徴・魅力など">{{$post->body}}</textarea>
      　     <p class="body_error" style="color:red">{{$errors->first('post.body')}}</p>
      　   </div>
      　   <div class="season">
      　       <h2>シーズン</h2>
      　       <select name="post[season_id]">
      　           @foreach($seasons as $season)
      　           <option value="{{$season->id}}">{{$season->season}}</option>
      　           @endforeach
      　       </select>
      　   </div>
      　   <div class = "style">
      　       <h2>利用スタイル</h2>
      　       <select name = "post[style_id]">
      　           @foreach($styles as $style)
      　           <option value = "{{$style->id}}">{{$style->name}}</option>
      　           @endforeach
      　       </select>
      　   </div>
      　   <div class="image">
      　       <input type="file" multiple name="image[]"/> 
      　   </div>
      　   <input type="submit" value="再投稿"/>
      　</form>
      　<div class="footer">
      　    <a href="/posts/{{$post->id}}">戻る</a>
      　</div>
    </body>
</html>
