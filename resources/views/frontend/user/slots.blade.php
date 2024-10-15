@extends('frontend.user.main')

@section('ucontent')
    <style>
        table tr th {
            font-weight: 600;
        }

        table tr th,
        table tr td,
        table tr td .btn {
            font-size: 12px;
            border-radius: 3px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="w-100 table-response bg-white box-shadow-1">
                    <table class="table mb-0 table-sm table-bordered ">
                        <thead>
                            <tr>
                                <th>
                                    Sr No
                                </th>
                                <th>
                                    Expert
                                </th>
                                <th>
                                    Appointment Date
                                </th>
                                <th>
                                    Start Time
                                </th>
                                <th>
                                    End Time
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slots as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item['expert']['name'] }}
                                    </td>
                                    <td>
                                        {{ date('d-M-Y', strtotime($item['slot'])) }}
                                    </td>
                                    <td>
                                        {{ date('h:i A', strtotime($item['slot'])) }}
                                    </td>
                                    <td>
                                        {{ date('h:i A', strtotime($item['slot_end'])) }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <form action="" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item['meet_id'] }}">
                                                <input type="hidden" name="sid" value="{{ $item['id'] }}">
                                                <button class="btn btn-outline-success">
                                                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Join
                                                </button>
                                            </form>
                                            <a href="{{ route('reschedule', base64_encode($item['id'])) }}"
                                                class="btn btn-outline-warning">
                                                <i class="fa-regular fa-calendar"></i> Re-schedule
                                            </a>

                                            <button onclick="cancel_booking(event)" data-id="{{ $item['id'] }}"
                                                class="btn btn-sm btn-danger"><i class="fa-solid fa-rectangle-xmark"></i>
                                                Cancel</button>
                                            {!! Form::close() !!}
                                            {!! Form::open([
                                                'url' => route('cancel_booking', $item['id']),
                                                'method' => 'PUT',
                                                'id' => 'cancel_form_hidden' . $item['id'],
                                            ]) !!}

                                            {!! Form::close() !!}

                                        </div>

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
            let id = parseFloat($(this).data('id'));
            swal({
                    title: "Are you sure?",
                    text: "Once cancelled, you will not be able to recover this meeting !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(`#cancel_form_hidden${302}`).submit();
                    } else {
                        swal("Your meeting schedule is safe!");
                    }
                });
        }
        // $("#cancel_form").on('submit', function(e) {
        //     e.preventDefault();
        //     swal({
        //             title: "Are you sure?",
        //             text: "Once cancelled, you will not be able to recover this meeting !",
        //             icon: "warning",
        //             buttons: true,
        //             dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //             if (willDelete) {

        //             } else {
        //                 swal("Your meeting schedule is safe!");
        //             }
        //         });
        //     // if (confirm('Are you sure ?')) {
        //     //     $("#cancel_form").submit();
        //     // }
        // });
    </script>
@endsection
