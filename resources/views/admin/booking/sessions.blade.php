@extends('layouts.main')
@section('content')
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="w-100 text-end">
                        <a href="{{ route('bookings') }}" class="btn btn-success">
                            Back
                        </a>
                    </div>
                </div>
                <div class="col-md-12">
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
                            @foreach ($items as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ ucwords($expert['name']) }}</td>
                                    <td>
                                        @if ($item['slot'])
                                            {{ __('On ') . date('d-M-Y', strtotime($item['slot']['slot'])) }}
                                            <p class="mb-0">
                                                {{ date('h:i A', strtotime($item['slot']['slot'])) . ' to ' . date('h:i A', strtotime($item['slot']['slot_end'])) }}
                                            </p>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-warning  text-dark rounded-1 ">{{ $item['status'] }}</span>
                                    </td>
                                    <td>
                                        @if ($item['booking_status'] != 'Cancell')
                                       
                                            @if (strtotime(date('Y-m-d H:i:s')) < strtotime($item['slot']))
                                                <div class="d-flex gap-2 align-items-center">
                                                    @if ($item['slot'])
                                                        <a data-bs-toggle="tooltip" title="Reschedule Now"
                                                            href="{{ route('reschedule.admin', base64_encode($item['id'])) }}"
                                                            class="btn btn-sm  btn-warning text-dark">
                                                            <i class="fi fi-rs-calendar-clock text-dark"></i> ReSchedule
                                                        </a>
                                                    @endif
                                                    <button data-bs-toggle="tooltip" title="Cancel Booking"
                                                        onclick="cancel_booking(event)" data-id="{{ $item['id'] }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i style="pointer-events: none;"
                                                            class="fa-solid fa-rectangle-xmark"></i>
                                                        Cancel
                                                    </button>
                                                    {!! Form::close() !!}
                                                    {!! Form::open([
                                                        'url' => route('cancel_booking.admin', $item['id']),
                                                        'method' => 'PUT',
                                                        'id' => 'cancel_form_hidden' . $item['id'],
                                                    ]) !!}

                                                    {!! Form::close() !!}

                                                </div>
                                            @endif
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
