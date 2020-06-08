@extends("layouts.users.dashboard")
@section('head')
<link href={{asset('/packages/core/main.css')}} rel='stylesheet' />
<link href={{asset('/packages/daygrid/main.css')}} rel='stylesheet' />
<link href={{asset('/packages/timegrid/main.css')}} rel='stylesheet' />
<link href={{asset('/packages/list/main.css')}} rel='stylesheet' />
<script src={{asset('/packages/core/main.js')}}></script>
<script src={{asset('/packages/interaction/main.js')}}></script>
<script src={{asset('/packages/daygrid/main.js')}}></script>
<script src={{asset('/packages/timegrid/main.js')}}></script>
<script src={{asset('/packages/list/main.js')}}></script>
<script>
    function getEventList(item){
        var event = {
            title: item.title,
            end: item.end_date,
            start: item.start_date,
            details: item.details
        }
        return event;
    }
document.addEventListener('DOMContentLoaded', function() {
        // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
    modal.style.display = "none";
    }
    var modal = document.getElementById("myModal");
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
    var calendarEl = document.getElementById('calendar');
    let events = {!! json_encode($events->toArray(), JSON_HEX_TAG) !!};

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      height: 'parent',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      defaultView: 'dayGridMonth',
      defaultDate: new Date(),
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: events.map(getEventList),
      eventClick: function(info) {
        var modal = document.getElementById("myModal");
        var title = document.getElementById("title");
        var details = document.getElementById("details");
        title.innerHTML = info.event.title;
        details.innerHTML = info.event._def.extendedProps.details;
        modal.style.display = "block";

        // change the border color just for fun
        info.el.style.borderColor = 'red';
    }
    });

    calendar.render();
  });

</script>

  <style>

#calendar-container {
    position: fixed;
    overflow-x:scroll;
    overflow-y: scroll;
    top: 70px;
    left: 0;
    right: 0px;
    bottom: 0;
  }

  .fc-header-toolbar {
    /*
    the calendar will be butting up against the edges,
    but let's scoot in the header's buttons
    */
    padding-top: 1em;
    padding-left: 1em;
    padding-right: 1em;
  }
  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto; /* 15% from the top and centered */
  padding: 20px;
  text-align: center;
  border: 1px solid #888;
  border-radius: 30px;
  height: 50%;
  width: 40%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
  </style>
@endsection

@section('content')
<div class="bg-gray-100  px-2 pb-16 h-full">
    <!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p class="font-bold" id="title"></p>
      <p id="details"></p>
    </div>

  </div>
    <div id='calendar-container'>
        <div id='calendar'></div>
    </div>
</div>
@endsection
