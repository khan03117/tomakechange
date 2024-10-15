@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .event-count {
            width: 10px;
            height: 10px;
            line-height: 10px;
            text-align: center;
            border-radius: 50%;
            font-size: 10px;
        }
    </style>
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    {!! Form::open(['url' => route('reschedule.update.admin', $user_session['id']), 'method' => 'PUT', 'id' => 'form']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="" class="visually-hidden" id="calnd">
                            <img style="display: none;" id="refesh2"
                                src="https://media.tenor.com/t5DMW5PI8mgAAAAi/loading-green-loading.gif" alt=""
                                class="img-fluid mx-auto" width="100">
                        </div>
                        <div class="col-md-6">
                            <label for="">
                                Select Slot
                            </label>
                            <input type="text" name="date" id="pdate" class="visually-hidden">
                            <input type="hidden" name="user_id" value="{{ $user_session['user_id'] }}">
                            <div class="w-100" id="slots"></div>
                            <img style="display: none;" id="refesh"
                                src="https://media.tenor.com/t5DMW5PI8mgAAAAi/loading-green-loading.gif" alt=""
                                class="img-fluid mx-auto" width="100">
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type='button' onclick="submitReschedule(event)" class="btn btn-success">Reschedule</button>
                            
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                             Add Slot For Expert
                            </button>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4">
                    <div class="w-100 card card-body">
                        <table class="mb-0 table table-bordered">
                            <tr>
                                <td colspan="2" class="bg-success text-white">User Details</td>
                            </tr>
                            <tr>
                                <th>Name :</th>
                                <td> {{$user['name']}}</td>
                            </tr>
                            <tr>
                                <th>Email :</th>
                                <td> {{$user['email']}}</td>
                            </tr>
                            <tr>
                                <th>Mobile :</th>
                                <td> {{$user['mobile']}}</td>
                            </tr>
                           
                        </table>
                        <div class="card-footer">
                            <a  class="btn btn-success rounded-pill w-100" href="{{url('admin/sessions/all/all')}}">Back</a>
                        </div>
                    </div>
                    
                  
                        <div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Slot</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <div id="msg"></div>
                                    
                                    <form action="" id="addSlot" method="POST">
                                        @csrf
                                        <input type="hidden" name="expert_id" id="expert_id" value="{{$expert->id}}" />
                                        <div class="form-group mb-4">
                                            <label for="">Enter Date</label>
                                            <input type="date" min="{{date('Y-m-d')}}" name="slot_date" id="slot_date" class="form-control" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="">Enter Start Time</label>
                                            <select name="slot_time" id="slot_time" class="form-select">
                                                <option value="">---Select---</option>
                                                @foreach($intervals as $intv)
                                                    <option value="{{$intv}}">{{$intv}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="">Select Interval</label>
                                            <select class="form-select" name="end_time" id="end_time" >
                                                <option value="">--Select---</option>
                                                <option value="30">30 Minutes</option>
                                                <option value="60">60 Minutes</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="">Action</label>
                                            <input type="submit"  class="btn btn-primary w-100" />
                                        </div>
                                    </form>
                              </div>
                            </div>
                          </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    $("#addSlot").on('submit', function(e){
        e.preventDefault();
        let date = $("#slot_date").val();
        let expert_id = $("#expert_id").val();
        let slot_time = $("#slot_time").val();
        let end_time = $("#end_time").val();
        $.post("{{route('slot.create')}}", {
           expert_id : expert_id, slot_date : date, slot_time: slot_time, end_time : end_time
        }, function(res){
           if(res == "1"){
               const output = `<div class="alert alert-success">Slot Added Successfully</>`
                 $("#msg").html(output)
            $("#addSlot").trigger('reset');
              
           }else{
               const output = `<div class="alert alert-danger">Please check your details</>`
                 $("#msg").html(output)
                
           }
          
        })
    })
    $("#slot_time").on('change', function(e){
        const value   = $(this).val();
        const startTime = new Date("2000-01-01T" + value + ":00"); // Convert selected time to Date object
    const endTime = new Date(startTime.getTime() + 60 * 60000); // Add 60 minutes to the selected time
    const max = endTime.toTimeString().slice(0, 5); // Convert endTime back to string in HH:mm format
        $("#end_time").attr('max', max);
        $("#end_time").removeAttr('disabled');
    });
    const submitReschedule = (e) => {
        $("#form").submit();
        e.target.remove();
    }
        const myInput = document.querySelector("#calnd");
        const fp = flatpickr(myInput); // flatpickr
        flatpickr(myInput, {
            inline: !0,
            defaultDate: new Date,

            onChange: function(date, dateStr, instance) {
                $("#slots").html('');
                $("#refesh").show();
                $.post(`${url}/ajax/get_slot`, {
                    searchby : "admin",
                    date: dateStr,
                    eid: {{ $expert['id'] }},
                    duration: "{{ $slot['duration'] }}"
                }, function(res) {

                    setTimeout(() => {
                        $("#refesh").hide();
                        $("#slots").html(res);
                    }, 1200);

                    $("#pdate").val(dateStr);
                    $("#app_date").val(dateStr);
                })
            },

        });
    </script>
@endsection
