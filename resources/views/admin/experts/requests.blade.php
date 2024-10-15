@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-sm table-bordered  table-rep-plugin table-success">
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="bg-success text-white">Sr</th>
                                <th class="bg-success text-white">User</th>
                                <th class="bg-success text-white">Resume</th>
                                <th class="bg-success text-white">Address</th>
                                <th class="bg-success text-white">Aadhar</th>
                                <th class="bg-success text-white">Details</th>
                                <th class="bg-success text-white">Post Application</th>

                                <th class="bg-success text-white">Mail Sent</th>
                                <th class="bg-success text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="row">
                                            {{-- <div class="col-3">
                                                <img src="{{ url('public/upload/' . $item['profile_img']) }}" width="50"
                                                    alt="" class="img-fluid">
                                            </div> --}}
                                            <div class="col-12">
                                                <p class="mb-0">
                                                    <strong>
                                                        Name :
                                                    </strong>
                                                    {{ $item['first_name'] . ' ' . $item['last_name'] }}
                                                </p>
                                                <p class="mb-0">
                                                    <strong>
                                                        Email :
                                                    </strong>
                                                    {{ $item['email'] }}
                                                </p>
                                                <p class="mb-0">
                                                    <strong>
                                                        Mobile :
                                                    </strong>
                                                    {{ $item['mobile'] }}
                                                </p>
                                            </div>
                                        </div>

                                    </td>


                                    <td>
                                        <a download href="{{ url('public/upload/' . $item['resume']) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fi fi-ts-file-pdf fs-4"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $item['city'] . ' ' . $item['state'].' '.$item['pincode'] }}
                                    </td>
                                    <td>
                                        <div class="mb-2">
                                            <a target="_blank" href="{{url('public/upload/'.$item['aadhar_back_img'])}}" class="d-block w-100 aimg">
                                                <img width="100" src="{{url('public/upload/'.$item['aadhar_back_img'])}}" class="img-fluid" />
                                            </a>
                                            
                                        </div>
                                        <div class="">
                                            <a target="_blank" href="{{url('public/upload/'.$item['aadhar_image'])}}" class="d-block w-100 aimg">
                                            <img width="100" src="{{url('public/upload/'.$item['aadhar_image'])}}" class="img-fluid" />
                                             </a>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            <strong>
                                                Qualification :
                                            </strong>
                                            {{ $item['qualification'] }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>
                                                Stream :
                                            </strong>
                                            {{ $item['stream'] }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>
                                                Experience :
                                            </strong>
                                            {{ $item['experience'] }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>
                                                Time To Join :
                                            </strong>
                                            {{ $item['notice_period'] }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>
                                                Frequency :
                                            </strong>
                                            {{ $item['frequency'] }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>
                                                Hours :
                                            </strong>
                                            {{ $item['per_day_hour'] }}
                                        </p>


                                    </td>
                                    <td>
                                        <ul class="mb-0">
                                            <li>
                                             <b>Service Offer : </b>   {{ $item['category']['title'] }}
                                            </li>
                                            <li>
                                             <b>Role : </b>     {{ $item['post_detail'] ? $item['post_detail']['post'] : $item['custom_post'] }}
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        @if ($item['offer_sent'] == 0)
                                            <span class="badge bg-warning">NO</span>
                                        @endif
                                        @if ($item['offer_sent'] == 1)
                                            <span class="badge bg-success">Yes</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            @if ($item['is_created'] == '0')
                                                <a onclick="setItemId('{{ $item['id'] }}')" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop" class="btn btn-success btn-sm">
                                                    <i class="fi fi-ts-user-pen"></i>
                                                </a>
                                                <a onclick="setItemId('{{ $item['id'] }}')" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop2" class="btn btn-sm btn-danger">
                                                    <i class="fi fi-ts-vote-nay"></i>
                                                </a>
                                            @endif

                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Accept Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => route('join_request.accept'), 'id' => 'acceptForm', 'method' => 'POST']) !!}
                    {!! Form::hidden('id', null, ['id' => 'join_id', 'class' => 'join_id']) !!}
                    <div class="input-group  gap-2 align-items-center">
                        <input type="checkbox" name="read" id="readed">
                        <label for="readed" class="mb-0">
                            I have read all details & confirm authenticity .
                        </label>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="submitForm('acceptForm')" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Reject Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => route('join_request.reject'), 'id' => 'rejectForm', 'method' => 'POST']) !!}
                    {!! Form::hidden('id', null, ['id' => 'join_id1', 'class' => 'join_id']) !!}
                    <div class="form-group mb-2">
                        <label for="">
                            Enter Reason for Reject
                        </label>
                        <textarea name="reason" id="reason" cols="20" rows="10" class="form-control"></textarea>
                    </div>


                    <div class="input-group  gap-2 align-items-center">
                        <input type="checkbox" name="read" id="readed1">
                        <label for="readed1" class="mb-0">
                            I have read all details & confirm authenticity .
                        </label>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="submitForm('rejectForm')" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const setItemId = (id) => {
            $(".join_id").val(id);
        }
        const submitForm = (id) => {
            $("#" + id).submit();
        }
    </script>
@endsection
