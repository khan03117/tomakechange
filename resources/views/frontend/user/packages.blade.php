@extends('frontend.user.main')

@section('ucontent')
    <style>
        .table {
            font-size: 14px;
        }

        .table tr th {
            font-weight: 600;
            font-size: 14px;
        }

        .table p {
            font-size: 12px;

        }

        .table .btn {
            font-size: 12px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="w-100 table-response table-responsive bg-white box-shadow-1">
                    <table class="table table-light table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Expert</th>
                                <th>Slot</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $j = 0;
                            @endphp
                            @foreach ($items as $i => $item)
                              
                                @php
                                $j++;
                                @endphp
                                <tr>
                                    <td>{{ $j }}</td>
                                    <td>{{ ucwords($item['expert']['name']) }}</td>
                                    
                                    <td>
                                        @if ($item['slot'])
                                            {{ __('On ') . date('d-M-Y', strtotime($item['slot']['slot'])) }}
                                            <p class="mb-0">
                                                {{ date('h:i A', strtotime($item['slot']['slot'])) . ' to ' . date('h:i A', strtotime($item['slot']['slot_end'])) }}
                                            </p>
                                        @endif
                                    </td>
                                    <td>
                                         @if ($item['slot'])
                                                    @php
                                                        $time = date('Y-m-d H:i:s');
                                                        $start = $item['slot']['slot'];
                                                        $end = $item['slot']['slot_end'];
                                                        $remain = strtotime($start) - strtotime($time);
                                                        $endremain = strtotime($end) - strtotime($time);
                                                        $minutes = $remain / 60;

                                                        $duration = $item['slot']['duration'] / 2;
                                                    @endphp
                                                    @if ($item['status'] == 'Pending' && $endremain < 0)
                                                        <span class="badge bg-danger rounded-1 fw-light">Time Out</span>
                                                    @elseif($item['status'] == 'Done')
                                                       <span class="badge bg-success rounded-1 fw-light">{{ $item['status'] }}</span>
                                                    @else
                                                     <span class="badge bg-warning rounded-1 fw-light">{{ $item['status'] }}</span>
                                                    @endif
                                           
                                         @endif
                                    </td>
                                    <td>
                                        @if ($item['status'] != 'Cancelled')
                                            <div class="d-flex gap-2 align-items-center">

                                                @if ($item['slot'])
                                                    
                                                    @if ($minutes < $duration &&  $endremain > 0 &&  $item['status'] != "Done")
                                                        <form action="{{ url('user/consultation-schedules') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $item['slot']['meet_id'] }}">
                                                            <input type="hidden" name="sid"
                                                                value="{{ $item['slot']['id'] }}">
                                                            <button class="btn btn-sm btn-outline-success">
                                                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Join
                                                            </button>
                                                        </form>
                                                    @elseif($minutes > -30 && $minutes > 11  &&  $item['status'] != "Done")
                                                        <button
                                                            onclick="alert('Sessions starts at {{ date('d-M-Y h:i A', strtotime($item['slot']['slot'])) }}')"
                                                            class="btn btn-sm btn-primary">Join</button>
                                                    @endif
                                                  
                                                    @if ($duration < $minutes && $item['status'] != "Done")
                                                        <a data-bs-toggle="tooltip" title="Reschedule Now"
                                                            href="{{ route('reschedule', base64_encode($item['id'])) }}"
                                                            class="btn btn-outline-warning">
                                                            <i class="fa-regular fa-calendar"></i>
                                                            Reschedule Now
                                                        </a>
                                                    @endif
                                                @endif
                                                @if (!$item['slot'])
                                                    <a data-bs-toggle="tooltip" title="Schedule Now"
                                                        href="{{ route('make_schedule', base64_encode($item['id'])) }}"
                                                        class="btn btn-sm  btn-outline-success">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        Schedule Now
                                                    </a>
                                                   
                                                @endif


                                                {!! Form::close() !!}
                                                {!! Form::open([
                                                    'url' => route('cancel_booking', $item['id']),
                                                    'method' => 'PUT',
                                                    'id' => 'cancel_form_hidden' . $item['id'],
                                                ]) !!}

                                                {!! Form::close() !!}

                                            </div>
                                        @endif
                                    </td>
                                </tr>
                               
                              
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        const cancel_booking = (e) => {
            e.preventDefault();
            let id = e.target.dataset.id;

            swal({
                    title: "Are you sure?",
                    text: "Once cancelled, you will not be able to recover this meeting !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#cancel_form_hidden" + id).submit();
                    } else {
                        swal("Your meeting schedule is safe!");
                    }
                });
        }
    </script>
@endsection
