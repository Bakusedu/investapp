<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speaker;
use \Carbon\Carbon;
class SpeakerController extends Controller
{
    public function speakerInvite($inviteId)
    {
       $speaker = Speaker::whereInviteId($inviteId)->first();
       $programme = $speaker->programme()->first();
       $features = json_decode($programme->key_features);
       $status = 'pending';
       $expired = true;
       if ($speaker->status == 'accepted') {
            $status = 'accepted';     }
      if ($speaker->status == 'declined') {
          $status = 'declined';     }

       if (Carbon::now() > Carbon::parse($programme->enddate)) {
          $expired = false;
       }

       return view('confirm-speaker', compact('status','expired','programme','features', 'speaker'));
    }

    public function speakerAccept($id)
    {
        $speaker = Speaker::findOrFail($id);
        $speaker->invite_accepted = 1;
        $speaker->status = 'accepted';
        $speaker->save();
        return redirect()->back();
    }

    public function speakerDecline($id)
    {
        $speaker = Speaker::findOrFail($id);
        $speaker->status = 'declined';
        $speaker->save();
        return redirect()->back();
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

    public function deleteSpeaker(Request $request)
    {
        $id = $request->id;
        $speaker = Speaker::findOrFail($id);
        $speaker->delete();
        return response()->json(['status'=> 'deleted'], 200);
    }
}
