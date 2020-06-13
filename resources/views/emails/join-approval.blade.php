@component('mail::message')
Hello **{{$name}}**,
Your request for joining "{{$programme->title}}" has been approved!

You can view programme activities and timeline of events on your dashboard
@component('mail::button', ['url' => $link])
Go to your dashboard
@endcomponent
Cheers!
LiftHub.
@endcomponent
