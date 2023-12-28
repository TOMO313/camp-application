import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

function formatDate(date,pos){
    var dt = new Date(date);
    if(pos==="end"){
        dt.setDate(dt.getDate() - 1);
    }
    return dt.getFullYear() + '-' +('0' + (dt.getMonth()+1)).slice(-2)+ '-' +('0'+ dt.getDate()).slice(-2);
}

var calendarEl = document.getElementById("calendar");

if(calendarEl !== null){
    let calendar = new Calendar(calendarEl,{
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin],
        initialView: "dayGridMonth",
        customButtons: {
            eventAddButton: {
                text: '予定を追加',
                click: function(){
                    document.getElementById('new-id').value = "";
                    document.getElementById('new-event_title').value = "";
                    document.getElementById('new-start_date').value = "";
                    document.getElementById('new-end_date').value = "";
                    document.getElementById('new-event_body').value = "";
                    document.getElementById('new-event_color').value = "blue";
                    document.getElementById('modal-add').style.display = 'flex';
                }
            }
        },
        headerToolbar: {
            start: "prev,next today",
            center: "title",
            end: "eventAddButton dayGridMonth,timeGridWeek",
        },
        height: "auto",
        selectable: true,
        select: function (info){
            document.getElementById("new-id").value = "";
            document.getElementById("new-event_title").value = "";
            document.getElementById("new-start_date").value = formatDate(info.start);
            document.getElementById("new-end_date").value = formatDate(info.end, "end");
            document.getElementById("new-event_body").value = "";
            document.getElementById("new-event_color").value = "blue";
            document.getElementById('modal-add').style.display = 'flex';
        },
        events: function (info, successCallback, failureCallback){
            axios
            .post("calendar/get",{
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
            })
            .then((response)=>{
                successCallback(response.data);
            })
            .catch((error)=>{
                alert("登録に失敗しました。");
            });
        },
        eventClick: function(info){
            document.getElementById("id").value = info.event.id;
            document.getElementById("delete-id").value = info.event.id;
            document.getElementById("event_title").value = info.event.title;
            document.getElementById("start_date").value = formatDate(info.event.start);
            document.getElementById("end_date").value = formatDate(info.event.end, "end");
            document.getElementById("event_body").value = info.event.extendedProps.description;
            document.getElementById("event_color").value = info.event.backgroundColor;
            document.getElementById("modal-update").style.display = 'flex';
        },
    });
    calendar.render();
}
    window.closeAddModal = function(){
        document.getElementById('modal-add').style.display = 'none';
    };
    window.closeUpdateModal =function(){
        document.getElementById('modal-update').style.display = 'none';
    };
    window.deleteEvent = function(){
        'use strict';
        if(confirm('削除すると復元できません。\n本当に削除しますか？')){
            document.getElementById('delete-form').submit();
        }
    };