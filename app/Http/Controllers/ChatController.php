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
       
       if(!$chat){
           $chat = new Room();
           $chat->owner_id = $myUserId;
           $chat->guest_id = $otherUserId;
           $chat->save();
       }
       
       $messages = Message::where('chat_id', $chat->id)->orderBy('updated_at', 'DESC')->get();
       
       return view('chats/chat')->with(['chat'=>$chat, 'messages'=>$messages]);
   }
   
   public function sendMessage(Message $message, Request $request){
       $user=auth()->user();
       $strUserId=$user->id;
       $strUsername=$user->name;
       
       $strMessage=$request->input('message');
       
       $chat=new Chat;
       $chat->body=$strMessage;
       $chat->chat_id=$request->input('chat_id');
       $chat->userName=$strUsername;
       
       MessageSent::dispatch($chat);
       
       $message->user_id=$strUserId;
       $message->body=$strMessage;
       $message->chat_id=$request->input('chat_id');
       $message->save();
       
       return response()->json(['message'=>'Message sent successfully']);
   }
}