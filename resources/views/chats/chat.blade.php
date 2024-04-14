<x-app-layout>
    <x-slot name="header">
        <h2>Chat</h2>
    </x-slot>
    
    <div>
        <div>
            <div>
                <div>
                    <form method="post" onsubmit="onsubmit_Form(); return false;">
                        メッセージ：<input type="text" id="input_message" autocomplete="off"/>
                        <input type="hidden" id="chat_id" name="chat_id" value="{{$chat->id}}"/>
                        <button type="submit">送信</button>
                    </form>
                    
                    <ul class="list_disc" id="list_message">
                        @foreach($messages as $message)
                        <li>
                            <strong>{{$message->user->name}}：</strong>
                            <div>{{$message->body}}</div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        const elementInputMessage = document.getElementById("input_message");
        const chatId = document.getElementById("chat_id").value;
        
        function onsubmit_Form()
        {
            let strMessage = elementInputMessage.value;
            if(!strMessage)
            {
                return;
            }
            params = {
                'message':strMessage,
                'chat_id':chatId
            };
            axios
            .post('/chat', params)
            .then(response=>{
                console.log(response);
                console.log(chatId)
            })
            .catch(error=>{
                console.log(error.response)
            });
            
            elementInputMessage.value="";
        }
        window.addEventListenner("DOMContentLoaded", ()=>{
            const elementListMessage = document.getElementById("list_message");
            
            window.Echo.private('chat').listen('MessageSent', (e)=>{
                console.log(e);
                
                if(e.chat.chat_id === chatId){
                    let strUserName = e.chat.userName;
                    let strMessage = e.chat.body;
                    
                    let elementLi = document.createElement("li");
                    let elementUserName = document.createElement("strong");
                    let elementMessage = document.createElement("div");
                    elementUserName.textContent = strUserName;
                    elementMessage = strMessage;
                    elementLi.append(elementUserName);
                    elementLi.append(elementMessage);
                    elementListMessage.prepend(elementLi);
                }
            })
        })
    </script>
</x-app-layout>
