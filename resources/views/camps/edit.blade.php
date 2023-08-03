<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">

        <title>キャンプ場投稿編集｜シーズン別キャンプ場リサーチ！</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
         @vite('resources/css/app.css')

    </head>
    <body class = "bg-black text-white italic font-bold grid justify-items-center">
       <h1 class = "text-2xl my-4">キャンプ場編集</h1>
      　<form action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
      　    @csrf
      　    @method('PUT')
      　  <div class = "grid justify-items-center space-y-4">
          　   <div class = "text-xl mt-0">
          　     <h2>投稿者名</h2>
          　     <h2>{{$post->user->name}}</h2>
          　   </div>
          　   <div class = "grid justify-items-center">
          　     <h2 class = "text-xl text-blue-500">キャンプ場名</h2>
          　     <input class = "border rounded text-black" type = "text" name = "post[camp]" placeholder = "～キャンプ場" value = "{{$post->camp}}"/>
          　     <p class = "camp_error" style = "color:red">{{$errors->first('post.camp')}}</p>
          　   </div>
          　   <div class = "grid justify-items-center">
          　     <h2 class = "text-xl text-green-500">概要</h2>
          　     <textarea class = "resize border rounded text-black" name = "post[body]" placeholder = "基本情報・特徴・魅力など">{{$post->body}}</textarea>
          　     <p class = "body_error" style = "color:red">{{$errors->first('post.body')}}</p>
          　   </div>
          　   <div class = "grid justify-items-center">
          　       <h2 class = "text-xl text-red-500">シーズン</h2>
          　       <select class = "text-black" name="post[season_id]">
          　           @foreach($seasons as $season)
          　           <option class = "text-black" value="{{$season->id}}">{{$season->season}}</option>
          　           @endforeach
          　       </select>
          　   </div>
          　   <div class = "grid justify-items-center">
          　       <h2 class = "text-xl text-yellow-500">利用スタイル</h2>
          　       <select class = "text-black" name = "post[style_id]">
          　           @foreach($styles as $style)
          　           <option class = "text-black" value = "{{$style->id}}">{{$style->name}}</option>
          　           @endforeach
          　       </select>
          　   </div>
          　   <div class = "text-xl grid justify-items-center ml-44">
          　       <input type="file" multiple name="image[]"/> 
          　   </div>
          　   <div class = "text-xl">
          　     <input class = "rounded-md bg-blue-500 hover:bg-yellow-500 p-1 duration-300" type="submit" value="再投稿"/>
          　   </div>
          　</form>
          　<div class = "text-xl">
          　    <a class = "rounded-full bg-blue-500 hover:bg-yellow-500 p-1 duration-300" href="/posts/{{$post->id}}">戻る</a>
          　</div>
          </div>
    </body>
</html>
