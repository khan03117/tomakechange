@extends('frontend.user.main')

@section('ucontent')
    <style>
        .fc .fc-col-header-cell-cushion {
            display: inline-block;
            padding: 2px 4px;
            text-decoration: none;
            color: #f67c33;
            font-size: 12px;
            font-weight: 500;
        }

        .fc-direction-ltr .fc-timegrid-slot-label-frame {
            text-align: left;
        }

        .fc .fc-timegrid-axis-cushion,
        .fc .fc-timegrid-slot-label-cushion {
            font-size: 12px;
        }

        .fc .fc-button-primary {
            background: #077773;
        }
        .cursor{
            cursor:pointer;
        }
        .t-12{
            font-size:12px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/moment@6.1.9/index.global.min.js'></script>
    <section class="w-100 h-100 bg-light py-3 box-shadow-3 rounded">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-12">
                    <h4 class="mb-4 text-center" style="font-size:14px;">
                       Hi,  you may block mix of 30 Mts and 60 Mts slots for all days to attract potential Clients, for their preference of duration.
                    </h4>
                    <div class="w-100 table-responsive">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="myModel" class="customModel" style="display: none;">
        <div class="modelBody">
            <div class="w-100 gridcenter">
                <div class="btn btn-close closeBtn"></div>

                <form id="slotForm" data-action="{{ route('slot.store') }}" method="post" class="w-100">
                    @csrf
                    <div class="row">
                        <!--<div class="col-md-6">-->
                        <!--    <div class="form-group mb-3">-->
                        <!--        {!! Form::label('', 'Enter Date Time') !!}-->
                        <!--        {!! Form::text('slot', old('slot'), ['class' => 'form-control', 'id' => 'slot']) !!}-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                {!! Form::label('', 'Enter Date ') !!}
                                {!! Form::text('slot_date', old('slot'), ['class' => 'form-control', 'id' => 'slot_date', 'readonly'=> 'readonly']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                {!! Form::label('', 'Enter Time ') !!}
                                {!! Form::time('slot_time', old('slot'), ['class' => 'form-control', 'id' => 'slot_time']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">
                                Select Duration
                            </label>
                            <div class="d-flex align-items-center gap-3">
                                <label for="min60" class="d-inline-flex align-items-center">
                                    <input type="radio" name="end_time" id="min60" class="rounded-circle"
                                        value="60" checked>
                                    <span>
                                        60 Minutes
                                    </span>
                                </label>
                                <label for="min30" class="d-inline-flex align-items-center">
                                    <input type="radio" name="end_time" class="rounded-circle" id="min30"
                                        value="30">
                                    <span>
                                        30 Minutes
                                    </span>
                                </label>

                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <input type="submit" value="Add Slot" class="btn btn-primary rounded-0 shadow">
                    </div>
                </form>

            </div>

        </div>
    </div>
    <div id="myModel2" class="customModel" style="display: none;">
        <div class="modelBody">
            <div class="w-100 gridcenter">
                <div class="btn btn-close closeBtn" id=""></div>

                <form action="{{ url('expert/slot-delete') }}" id="deleteSlotForm" method="post">
                    @csrf
                    <p>
                        Do you want to delete this event ?
                    </p>
                    <input type="hidden" name="event_id" id="event_id">
                    <button class="btn btn-danger rounded-0 t-12">
                        Delete This Event
                    </button>
                </form>

            </div>

        </div>
    </div>
    <div id="myModel3" class="customModel" style="display: none;">
        <div class="modelBody">
            <div class="w-100 gridcenter">
                <div class="btn btn-close closeBtn" id=""></div>
                <div class="w-100 " id="userdata"></div>


            </div>

        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            $(".closeBtn").on('click', function() {
                $(this).parent().parent().parent().fadeOut();
                $(".customModel").hide();
            });

            let events = [];
            const options = {
               timeZone: 'local',
                initialView: 'timeGridWeek',
                displayEventTime: true,
                selectable: true,
                titleFormat : {year: 'numeric', month: 'short', day: 'numeric'},
                dayHeaderFormat : { weekday: 'short', month: 'short', day: 'numeric', omitCommas: true },
                scrollTime: '10:00',
                slotMinTime: "10:00",
                slotMaxTime: "22:00",
                allDaySlot: false,
                eventClassNames : "cursor",

                eventClick: function(info) {
                    console.log(info)
                    let id = info.event._def.publicId;
                    if (info.event._def.title == 'Open') {
                        $("#event_id").val(id);
                        $("#myModel2").show();
                    }else{
                        $.post(`${url}/ajax/get_client_details`, { id : id}, function(res){
                            console.log(res);
                            let elm = '<table class="table table-sm table-bordered t-12">';
                            Object.entries(res).forEach((item,i) => {
                                let [key, value] = item;
                               let ky = key;
                                let val = '';
                                if(key == 'sub_cats'){
                                    elms = JSON.parse(value);
                                   elms.forEach((it, a) => {
                                       val += it.sub_category
                                   })
                                   ky = 'Primary  Concern';
                                }

                                if(key == 'end_cats'){
                                    elms = JSON.parse(value);
                                   elms.forEach((it, a) => {
                                       val += it.end_category
                                   })
                                    ky = 'Secondary  Concern';
                                }
                                elm += `<tr><th>${ky.toUpperCase()}</th><td>${ key != 'sub_cats' && key != 'end_cats' ? value : val}</td></tr>`
                            });
                            elm += '</table>';
                            $("#userdata").html(elm);
                            $("#myModel3").show();

                        })
                    }



                },

                dateClick: function(info) {

                    $("#slot").val(info.dateStr);
                    let date = moment(info.dateStr).format('DD-MM-YYYY');
                    let time = moment(info.dateStr).format('HH:mm')
                    $("#slot_date").val(date);
                    $("#slot_time").val(time);
                    console.log(time);
                    $("#myModel").show();
                },

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },

                // events: events,
                events: events,
                height: 'auto',



            };


            const getEvents = () => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post(`${url}/ajax/get_events`, function(res) {
                    events = [];
                    arr = JSON.parse(res);
                    arr.forEach(element => {
                        events.push(element);
                    });
                    options.events = events;
                    make_calender();
                });
            }


            getEvents();


            var calendarE2 = document.getElementById('calendar');
            var calendar1 = new FullCalendar.Calendar(calendarE2, options);

            const make_calender = () => {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, options);

                calendar.render();
                calendar.refetchEvents()
            }

            const refresh_getEvents = () => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post(`${url}/ajax/get_events`, function(res) {
                    events = [];
                    arr = JSON.parse(res);
                    arr.forEach(element => {
                        events.push(element);
                    });
                    options.events = events;
                    calendar1.setOption('events', events);
                    make_calender();
                });
            }

            $("#slotForm").on('submit', function(e) {
                e.preventDefault();
                // let slot = $("#slot").val();
                var form = $(this);
                var data = new FormData(form[0]);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `${url}/ajax/slot/create`,
                    method: "POST",
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        $(".customModel").hide();
                        refresh_getEvents();
                    },
                })
            })
            $("#deleteSlotForm").on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var data = new FormData(form[0]);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `${url}/expert/slot-delete`,
                    method: "POST",
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        $(".customModel").hide();
                        refresh_getEvents();
                    },
                })
            })
        });
    </script>
@endsection
