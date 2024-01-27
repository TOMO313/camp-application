<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Chat;
use App\Models\Room;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;


class ChatController extends Controller
{
   public function openChat(User $user){
       $myUserId = auth()->user()->id;
       $otherUserId = $user->id;
       
       $chat = Room::where(function($query) use ($myUserId, $otherUserId){
           $query->where('owner_id', $myUserId)
                 ->where('guest_id', $otherUserId);
       })->orWhere(function($query) use ($myUserId, $otherUserId){
           $query->where('owner_id', $otherUserId)
                 ->where('guest_id', $myUserId);
       })->first();
   }
}
