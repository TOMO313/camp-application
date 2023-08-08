<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="initial-scale=1.0">
        <script src="https://maps.google.com/maps/api/js?key={{config('services.Google.token')}}&language=ja"></script>
        <title>キャンプ場詳細｜シーズン別キャンプ場リサーチ！</title>
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <style>
            #google_map {
                height: 100%;
            }
        
            .map {
                height: 300px;
                width: 1200px;
                margin: 30px;
            }
        </style>
    </head>
    <body class = "bg-black text-white italic font-bold">
        <div class = "grid justify-items-center">
            <h1 class = "text-2xl my-4">キャンプ場詳細</h1>
            <div class = "grid justify-items-center my-4">
                <h2 class = "text-xl text-blue-500 border-b-2 border-b-yellow-500">{{$post->camp}}</h2>
                <p class = "text-sm">投稿者名:{{$post->user->name}}</p>
            </div>
                 @auth
                  @if (!$post->isLikedBy(Auth::user(), $post))
                   <span class="likes">
                     <p>良いねなし</p>
                     <i class="fas fa-heart like-toggle transition ease-in-out hover:-translate-y-1 hover:scale-110 duration-300" data-post-id="{{ $post->id }}"></i>
                     <span class="like-counter">{{$post->likes_count}}</span>
                   </span><!-- /.likes -->
                 @else
                   <span class="likes">
                     <p>良いねあり</p>
                     <i class="fas fa-heart heart like-toggle liked ease-in-out hover:-translate-y-1 hover:scale-110 duration-300" data-post-id="{{ $post->id }}"></i>
                     <span class="like-counter">{{$post->likes_count}}</span>
                   </span><!-- /.likes -->
                 @endif
                  @endauth
        </div>
        <div class = "grid grid-cols-3 gap-4 mt-4">
              @foreach($post->images as $image)
              <div class = "w-auto h-auto">
                  <img src="{{$image->image_url}}" alt = "画像が読み込めません。"/>
              </div>
              @endforeach
        </div>
        
        <div class = "grid justify-items-center text-xl space-y-2 mt-5">
              <h2 class =  "text-green-500">概要</h2>
              <p class = "mx-60">{{$post->body}}</p>
              <h2 class = "text-red-500">シーズン</h2>
              <p>{{$post->season->season}}</p>
              <h2 class = "text-yellow-500"> 利用スタイル</h2>
              <p>{{$post->style->name}}</p>
        </div>
        <div class = "grid grid-cols-2 gap-4 text-xl relative mx-72 mt-6">
               @if (auth()->id() == $post->user_id)
               <div class = "absolute inset-y-10 left-60">
                  <a class = "rounded-full bg-blue-500 hover:bg-yellow-500 p-1 duration-300" href="/posts/{{$post->id}}/edit">編集</a>
               </div>
               @endif
               @if (auth()->id() == $post->user_id)
              <form action="/posts/{{$post->id}}" id="form_{{$post->id}}" method="POST" enctype = "multipart/form-data">
              @csrf
              @method('DELETE')
              <div class = "absolute inset-y-10 right-60">
                 <button class = "italic rounded-full bg-blue-500 hover:bg-yellow-500 p-1 duration-300" type="button" onclick="deletePost({{$post->id}})">削除</button>
              </div>
              </form>
               @endif
        </div>
           <form action="/comments/{{$post->id}}" method="POST">
            @csrf
            <div class="grid justify-items-center mt-32">
              <textarea  class = "resize border rounded text-black" name="comment" placeholder="コメント" >{{old('comment.body')}}</textarea>
              <input class = "italic p-1 rounded-md bg-blue-500 hover:bg-yellow-500 text-xl duration-300 mt-2" type="submit" value="コメントする"/>
            </div>
           </form>
           <div class = "grid grid-cols-3 gap-4 mx-28 mt-12">
               @foreach($post->comments as $comment)
               <div class = "relative border-2 border-black bg-zinc-400 h-auto w-auto">
                <p class = "break-all text-xl px-3 py-5">{{$comment->body}}</p>
                <p class = "text-sm absolute bottom-1 right-1">ユーザー名:{{$comment->user->name}}</p>
               </div>
               @endforeach
           </div>
        <div class="map">
        <div class = "text-black" id="google_map" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></div>
        <div class="text-xl grid justify-items-center mt-12">
            <a class = "rounded-full bg-blue-500 hover:bg-yellow-500 p-1 duration-300" href="/">戻る</a>
        </div>
        <script>
        const target = document.getElementById('google_map');
        const address = "{{$post->address}}";
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: address }, function (results, status) {
            if (status === 'OK' && results[0]) {
                // Map取得
                const map = new google.maps.Map(target, {
                    zoom: 15,
                    center: results[0].geometry.location,
                    mapTypeId: 'roadmap'
                });

                // Marker取得
                const marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map
                });

                // 情報ウィンドウ設定
                const latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                const info = '<div class="info">' +
                 '<p>' + address + '</p>' +
                    '<p><a href="https://maps.google.co.jp/maps?q=' + latlng + '&iwloc=J" target="_blank" rel="noopener noreferrer">Googleマップで見る</a></p>' +
                    '</div>';
                var infowindow = new google.maps.InfoWindow({
                    content: info
                });

                // 情報ウィンドウ表示
                infowindow.open(map, marker);

                // クリックイベント設定
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
            } else {
                return;
            }
        });
        </script>
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