<?php

namespace App\Http\Controllers;
use App\Event;
use Session;
use App\Programme;

class EventsController extends Controller {


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'programmeId' => 'exists:programmes,id'
        ]);

        $programme = Programme::find($request->programmeId);
       $programme->events()->create([
            'title' => $request->title,
            'details' => $request->details,
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
        ]);

        Session::flash('success','Event is added to calender');
        return redirect()->back();
    }

    public function addEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'programmeId' => 'exists:programmes,id',
            'useFeedback' => 'required',
        ]);

        $programme = Programme::find($request->programmeId);
        $programme->events()->create([
            'title' => $request->title,
            'details' => $request->details,
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
            'use_feedback' => $request->useFeedback == true ? 1 : 0,
            'question' => $request->question ?? 'null',
            'feedback_type' => $request->feedbackType ?? 'null'
        ]);

        return response()->json(['status' => 'success']);
    }

    public function updateEvent(Request $request)
    {
        $request->validate([
            'eventId' => 'exists:events,id',
        ]);

        $event = Event::find($request->eventId);
        $event->title = $request->title;
        $event->details = $request->details;
        $event->start_date = $request->startdate;
        $event->end_date = $request->enddate;
        $event->use_feedback = $request->useFeedback;
        $event->question = $request->question;
        $event->feedback_type = $request->feedbackType;

        $event->save();

        return response()->json(['status' => 'success']);
    }

    public function deleteEvent(Request $request)
    {
        $id = $request->id;
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(['status'=> 'deleted'], 200);
    }

}
