@extends('layouts.main')
@section('content')
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-7">
                    <div class="card card-body">
                        <table class="table table-sm table-bordered table-warning">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                     <th>Is Slot Choosen</th>
                                    <th>Session Date & Time</th>
                                    <th>Duration</th>
                                    <th>Session Status</th>
                                   
                                    <th>Created At</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessions as $j => $s)
                                    <tr>
                                        <td>{{$j + 1}}</td>
                                        <td>
                                            {!!$s['slot'] ? '<span class="badge bg-success">Yes </span>' : '<span class="badge bg-warning">No</span>'!!}
                                        </td>
                                        <td>@if($s['slot']) {{date('d-M-Y h:i A', strtotime($s['slot']['slot']))}} @endif</td>
                                        <td>@if($s['slot']) {{$s['slot']['duration'].__(' Minutes')}} @endif</td>
                                        <td>
                                            {!! $s['slot'] ? $s['status'] : ''!!}
                                        </td>
                                        <td>
                                            {{date('d-M-Y', strtotime($s['created_at']))}}
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card card-body">
                        <table class="table table-sm table-bordered table-warning">
                             @foreach(json_decode(json_encode($user)) as $key => $v)
                            @if(!in_array($loop->iteration, [0,1,2,6,7,8,9]) )
                            <tr>
                                
                                <td>
                                  {!!Form::label($key)!!}
                                </td>
                                <td>
                                    @if($key == 'created_at' || $key == 'updated_at')
                                     {{date('d-M-Y', strtotime($v))}}
                                    @else
                                        {{$v}}
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table
                    </div>
                </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-body shadow">
                        {!!Form::open(['url' => route('cancel_booking.store', $id), 'method' => 'POST'])!!}
                        <table class="table table-sm table-bordered table-warning">
                            @foreach(json_decode(json_encode($cartpayment)) as $key => $v)
                            @if($loop->iteration > 6)
                            <tr>
                                
                                <td>
                                  {!!Form::label($key)!!}
                                </td>
                                <td>
                                    @if($key == 'created_at' || $key == 'updated_at')
                                     {{date('d-M-Y', strtotime($v))}}
                                    @else
                                        {{$v}}
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach 
                            <tr>
                                <td>
                                    Enter Refunded Amount
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="amount" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Enter Remark
                                </td>
                                <td>
                                    <textarea type="text" class="form-control" name="remark" ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="btn btn-success w-100" />
                                </td>
                            </tr>
                        </table>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
