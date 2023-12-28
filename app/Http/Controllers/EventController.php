<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function show(){
        return view("calendars/calendar");
    }
    
    public function create(Request $request, Event $event){
        $request->validate([
            'event_title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'event_color' => 'required',
        ]);
        
        $event->event_title = $request->input('event_title');
        $event->event_body = $request->input('event_body');
        $event->start_date = $request->input('start_date');
        $event->end_date = date("Y-m-d", strtotime("{$request->input('end_date')} +1 day"));
        $event->event_color = $request->input('event_color');
        $event->event_border_color = $request->input('event_color');
        $event->save();
        
        return redirect(route("calendar.show"));
    }
    public function get(Request $request, Event $event){
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            ]);
            $start_date = date('Y-m-d', $request->input('start_date')/1000);
            $end_date = date('Y-m-d', $request->input('end_date')/1000);
            return $event->query()
            ->select(
                'id',
                'event_title as title',
                'event_body as description',
                'start_date as start',
                'end_date as end',
                'event_color as backgroundColor',
                'event_border_color as borderColor',
            )
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date)
            ->get();
    }
    public function update(Request $request, Event $event){
        $input = new Event();
        $input->event_title = $request->input('event_title');
        $input->event_body = $request->input('event_body');
        $input->start_date = $request->input('start_date');
        $input->end_date = date("Y-m-d", strtotime("{$request->input('end_date')}+1 day"));
        $input->event_color = $request->input('event_color');
        $input->event_border_color = $request->input('event_color');
        $event->find($request->input('id'))->fill($input->attributesToArray())->save();
        return redirect(route("calendar.show"));
    }
    public function delete(Request $request, Event $event){
        $event->find($request->input('id'))->delete();
        return redirect(route("calendar.show"));
    }
}
