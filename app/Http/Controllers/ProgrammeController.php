<?php

namespace App\Http\Controllers;
use Session;
use App\Programme;
use Illuminate\Http\Request;
use App\Event;
use Auth;
use App\WaitingList;
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
            'featured' =>'image'
        ]);
        $programme = new Programme();

        $programme->title = $request->title;
        $programme->description = $request->desc;
        $programme->duration = $request->duration;
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
    public function update(Request $request, Programme $programme)
    {
        //
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
        if (Auth::check()) {
            $whitelist = WaitingList::whereUserId(Auth::user()->id)
                                        ->whereIn('programme_id',[$programme->id])->first();

          if ($whitelist != null) {
            $requested = true ;
            $whitelist->status ==  'approved' ? $confirmed = true: $confirmed = false ;
          }
        }
        return view('programme-details', compact('programme', 'requested', 'confirmed'));
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

    public function userCalendar(Request $request)
    {
        $programme = Programme::findOrFail($request->id);
        $events = $programme->events()->get();
        return view('users.user-calendar', compact('events'));
    }
}
