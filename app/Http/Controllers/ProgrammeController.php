<?php

namespace App\Http\Controllers;
use Session;
use App\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Event;
use Auth;
use App\WaitingList;
use Carbon\Carbon;
use App\Speaker;
class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::all();
        $pending = WaitingList::whereStatus('pending')->count();
        $waiting = WaitingList::latest()->paginate(10);
        return view('admin.programmes.index', compact('programmes','waiting', 'pending'));
    }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'desc' => 'required',
            'title' => 'required',
            'duration' => 'required',
            'featured' =>'image',
            'type' =>'required',
            'amount' => 'numeric',
            'venue' => 'required',
            'highlight*' => 'required|array',
            'attendee' => 'required|numeric',
            'startdate' => 'required'
        ]);
        $programme = new Programme();

        $programme->title = $request->title;
        $programme->overview = $request->desc;
        $programme->duration = $request->duration;
        $programme->key_features = json_encode($request->highlight);
        $programme->fee = $request->amount;
        $programme->venue = $request->venue;
        $programme->startdate = $request->startdate;
        $programme->attendee = $request->attendee;
        $programme->type = $request->type;
        $programme->status = 'pending';
        $programme->createdBy = Auth::user()->id;
        $programme->enddate = Carbon::parse($request->startdate)->addDays($request->duration);
        $programme->featured = $request->featured->store('programmes');
        $programme->save();
        Session::flash('success', 'Programme creted successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        //
    }

    public function approve(Request $request)
    {
        $waiting = WaitingList::findOrFail($request->id);
        $waiting->status = 'approved';
        $waiting->save();
        $programme = Programme::findOrFail($waiting->programme_id);
        $programme->users()->attach($waiting->user_id);
        Session::flash('success', 'Approved Successfully');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'programmeId' => 'required',
            'desc' => 'required',
            'title' => 'required',
            'duration' => 'required',
            'type' =>'required',
            'amount' => 'numeric',
            'venue' => 'required',
            'highlight1' => 'required',
            'highlight2' => 'required',
            'highlight3' => 'required',
            'highlight4' => 'required',
            'highlight5' => 'required',
            'attendee' => 'required|numeric',
            'startdate' => 'required'
        ]);
        $data = [];
         array_push($data,
         $request->highlight1,
         $request->highlight2,
         $request->highlight3,
         $request->highlight4,
         $request->highlight5);

        $programme = Programme::findOrFail($request->programmeId);

        if ($request->hasFile('featured')) {
            $programme->featured = $request->featured->store('programmes');
        }
        $programme->title = $request->title;
        $programme->overview = $request->desc;
        $programme->duration = $request->duration;
        $programme->key_features = json_encode($data);
        $programme->fee = $request->amount;
        $programme->venue = $request->venue;
        $programme->startdate = $request->startdate;
        $programme->attendee = $request->attendee;
        $programme->type = $request->type;
        $programme->enddate = Carbon::parse($request->startdate)->addDays($request->duration);
        if ($programme->createdBy == Auth::user()->id) {
            $programme->save();
        }
        return response()->json($programme, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        //
    }

    public function joinPage()
    {
        $programmes = Programme::paginate(6);
        return view('programme', compact('programmes'));
    }

    public function details(Request $request)
    {
        $programme = Programme::findOrFail($request->id);
        $requested = false;
        $confirmed = false;
        $features = json_decode($programme->key_features);
        if (Auth::check()) {
            $whitelist = WaitingList::whereUserId(Auth::user()->id)
                                        ->whereIn('programme_id',[$programme->id])->first();

          if ($whitelist != null) {
            $requested = true ;
            $whitelist->status ==  'approved' ? $confirmed = true: $confirmed = false ;
          }
        }
        return view('programme-details', compact('programme', 'requested', 'confirmed','features'));
    }

    public function sendRequest(Request $request)
    {
        $user = Auth::user();
        $programme = Programme::findOrFail($request->id);
        WaitingList::create([
            'username' => $user->first_name.' '.$user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'programme_title' => $programme->title,
            'user_id' => $user->id,
            'programme_id' => $programme->id
        ]);

        return redirect()->back();
    }

    public function viewCalender(Request $request)
    {
        $programme = Programme::findOrFail($request->id);
        $events = $programme->events()->get();

        return view('admin.programmes.calendar', compact('events'));
    }

    public function userCalendar($id)
    {
        $programme = Programme::findOrFail($id);
        $events = $programme->events()->get();
        return view('users.user-calendar', compact('events'));
    }

    public function programmeDetails(Request $request)
    {
        $programme = Programme::whereId($request->id)->with('speakers')->with('users')->with('creator')->first();
        $requested = false;
        $confirmed = false;
        $features = json_decode($programme->key_features);
        if (Auth::check()) {
            $whitelist = WaitingList::whereUserId(Auth::user()->id)
                                        ->whereIn('programme_id',[$programme->id])->first();

          if ($whitelist != null) {
            $requested = true ;
            $whitelist->status ==  'approved' ? $confirmed = true: $confirmed = false ;
          }
        }
        return response()->json(['programme'=>$programme,
        'requested' =>$requested,
        'confirmed' =>$confirmed,
        'keyFeatures' => $features,
        'events' => $programme->events()->get()
    ], 200);
    }

    public function save(Request $request)
    {
        $request->validate([
            'desc' => 'required',
            'title' => 'required',
            'duration' => 'required',
            'featured' =>'image',
            'type' =>'required',
            'amount' => 'numeric',
            'venue' => 'required',
            'highlight1' => 'required',
            'highlight2' => 'required',
            'highlight3' => 'required',
            'highlight4' => 'required',
            'highlight5' => 'required',
            'attendee' => 'required|numeric',
            'startdate' => 'required'
        ]);
        $data = [];
         array_push($data,
         $request->highlight1,
         $request->highlight2,
         $request->highlight3,
         $request->highlight4,
         $request->highlight5);

         $programme = new Programme();

        $programme->title = $request->title;
        $programme->overview = $request->desc;
        $programme->duration = $request->duration;
        $programme->key_features = json_encode($data);
        $programme->fee = $request->amount;
        $programme->venue = $request->venue;
        $programme->startdate = $request->startdate;
        $programme->attendee = $request->attendee;
        $programme->type = $request->type;
        $programme->status = 'pending';
        $programme->createdBy = Auth::user()->id;
        $programme->enddate = Carbon::parse($request->startdate)->addDays($request->duration);
        $programme->featured = $request->featured->store('programmes');
        $programme->save();
        Session::flash('success', 'Programme created successfully');
        return response()->json($programme, 200);
    }

    public function addSpeaker(Request $request)
    {
        $request->validate([
            'programmeId' => 'exists:programmes,id',
            'name' => 'required',
            'title' => 'required',
            'organization' => 'required',
            'image' => 'required|image',
        ]);
        $programme = Programme::findOrFail($request->programmeId);

     $speaker =   $programme->speakers()->create([
            'programme_id' => $request->programmeId,
            'name' => $request->name,
            'title' => $request->title,
            'organization' => $request->organization,
            'image' => $request->image->store('speakers'),
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'email' => $request->email,
            'linkedIn' => $request->linkedin,
            'invite_id' => Str::of('speaker IV'.$programme->title)->slug('-').'-'.Str::uuid()
        ]);
           $base = url('/').'/invite/'.$speaker->invite_id;
           return response()->json(['status'=> 'success', 'programme' => $programme, 'invite_link'=>$base], 200);
        }


        public function updateSpeaker(Request $request)
        {
            $request->validate([
                'speakerId' => 'exists:speakers,id',
                'name' => 'required',
                'title' => 'required',
                'organization' => 'required',
            ]);
            $speaker = Speaker::findOrFail($request->speakerId);
            if ($request->hasFile('image')) {
                $speaker->image = $request->image->store('speakers');
            }
            $speaker->name = $request->name;
            $speaker->title = $request->title;
            $speaker->organization = $request->organization;
            $speaker->facebook = $request->facebook;
            $speaker->twitter = $request->twitter;
            $speaker->email = $request->email;
           $speaker->linkedIn = $request->linkedin;
            $speaker->save();

               return response()->json(['status'=> 'success'], 200);
        }

        public function joinRequest(Request $request)
        {
            $user = Auth::user();
            $programme = Programme::findOrFail($request->id);
            WaitingList::create([
                'username' => $user->first_name.' '.$user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'programme_title' => $programme->title,
                'user_id' => $user->id,
                'programme_id' => $programme->id
            ]);
           return response()->json(['status'=>'success'], 200);
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
            'use_feedback' => $request->useFeedback,
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

    public function waitingApproval(Request $request)
    {
        //Todo: Check if the current user is the owner of event befor approval
        $waiting = WaitingList::findOrFail($request->id);
        $waiting->status = 'approved';
        $waiting->save();
        $programme = Programme::findOrFail($waiting->programme_id);
        $programme->users()->attach($waiting->user_id);

        return response()->json(['status'=>'success'], 200);
    }
}
