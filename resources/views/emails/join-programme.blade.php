@component('mail::message')
Hello **{{$name}}**,
Your request for joining "{{$programme->title}}" has been recieved!

You will receive a confirmation email soon
@component('mail::button', ['url' => $link])
Go to your dashboard
@endcomponent
Sincerely,
LiftHub.
@endcomponent
