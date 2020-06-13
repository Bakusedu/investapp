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
}
