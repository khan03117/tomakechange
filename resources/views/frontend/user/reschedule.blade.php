@extends('frontend.user.main')

@section('ucontent')
    <style>
        .form-label{
            font-size:14px;
            font-weight:600;
            color:#000;
        }
        .datebox {
            font-size:12px;
            font-weight:300;
        }
    </style>
    <div class="container">
        @if($is_allow)
        {!! Form::open(['url' => route($url, $user_session['id']), 'method' => 'POST', 'id' => 'resform']) !!}

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-9">
                        <div class="w-100 mb-3">
                        <label for="" class="form-label">
                            Select Date 
                        </label>
                        @include('frontend.calendar-slider')
                    </div>
                    </div>
                    <div class="col-md-3">
                         <div class="w-100">
                         <label for="" class="form-label">
                        Select Slot
                        </label>
                        <div id="refesh" style="display: none;">
                            <img src="https://i.stack.imgur.com/NMgnW.gif" alt="" class="img-fluid">
                        </div>
                        <div id="slots">
                        </div>
                    </div>
                    </div>
                </div>
               
            </div>
            <!--<div class="col-md-4">-->
            <!--   <div class="w-100">-->
            <!--       <table class="table table-bordered t-14 table-sm">-->
            <!--           <tr>-->
            <!--               <th>Expert</th>-->
            <!--               <td>-->
            <!--                   {{$expert['name']}}-->
            <!--               </td>-->
            <!--           </tr>-->
            <!--       </table>-->
            <!--   </div>-->
            <!--</div>-->
           
        </div>
        {!! Form::close() !!}
        <div class="row">
             <div class="col-md-12 mt-4">
                <input type="submit" onclick="submitForm(event)" value="Update Now" class="btn btn-success px-md-4">
            </div>
        </div>
        @endif
        @if(!$is_allow)
            <div class="alert alert-danger">
                <p class="mb-0">
                    Reschedule can be done only 4 hours before the call start.
                </p>
            </div>
        @endif
    </div>
    <script>
    
        let durt = "";

        const getPackages = (event, duration) => {
            $("#slots").html('Please Select Date first !');
            $(".calendar-day-hove").removeClass('bg-warning text-white');
            const id = event.target.value;
            durt = id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(`${url}/ajax/get_packages`, {
                id: id,
                eid: {{ $expert['id'] }}
            }, function(res) {
                $("#packages").html(res);
                $("#pduration").val(duration + ' Minutes');
            });
        }
    </script>
    <script>
        const getSlotCount = (date, id) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(`${url}/ajax/get_slot_count`, {
                date: date,
                eid: id
            }, function(res) {

                return res;
            })

        }
       
        $(document).on('click', '.calendar-day-hover', function() {
            $("#slots").html('');
            $("#refesh").show();
            let duration = $(".duration:checked").val();

            let isrun = false;

            $(".calendar-day-hover").removeClass('bg-warning text-white rounded-1 ');
            $(this).addClass('bg-warning text-white rounded-1');
            let date = $(this).find('input[type="radio"]').val();
            $.post(`${url}/ajax/get_slot`, {
                date: date,
                eid: {{ $expert['id'] }},
                duration: "{{ $slot['duration'] }}"
            }, function(res) {
                setTimeout(() => {
                    $("#refesh").hide();
                    $("#slots").html(res);
                }, 1200);
                $("#pdate").val(date);
                $("#app_date").val(date);
            })



        });
        const submitForm = (e) => {
            e.target.remove();
            $("#resform").submit();
        }
    </script>
@endsection
