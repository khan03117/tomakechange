@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <form action="" class="col-md-12" method="get">
                <div class="row ">
                    <div class="col-md-2">
                        <label for="">
                            Month
                        </label>
                        <input type="month" class="w-100" value="{{$month}}" name="month" id="month">
                    </div>
                    <div class="col-md-2">
                        <label for="" class="w-100">&nbsp;</label>
                        <input type="submit" value="Search" class="btn btn-primary btn-sm">
                        <a href="{{ url('admin/expert-statics') }}" class="btn btn-success btn-sm">Reset</a>
                    </div>
                </div>
            </form>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="w-100 table-responsive">
                    <table class="table table-sm table-bordered table-light ">
                        <thead>
                            <tr>
                                <th>Sr NO</th>
                                <th>Category</th>
                                <th>All Sessions</th>
                                <th>Completed Sessions</th>

                                <th>Cancelled Sessions</th>
                                <th>Fees Collection</th>
                            </tr>
                        </thead>
                        @php
                            
                        $al = $completed =     $all == '0' ? '1' : $all;
                        $sum  = array_sum($amount) >  0 ? array_sum($amount) :  1;
                        @endphp
                        @foreach ($items as $i => $item)
                            @foreach([1,2] as $j)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item['category'] }} @if($j == 2) (%age) @endif </td>
                                <td>{{ $j == 1 ? $item['sessions_count'] : ($item['sessions_count']*100)/$al }}</td>
                                <td>{{$j == 1 ? $item['completed_sessions_count'] : ($item['completed_sessions_count']*100)/$completed }}</td>
                                <td>{{ $j == 1 ? $item['cancelled_sessions_count'] :  ($item['cancelled_sessions_count']*100)/$cancelled}}</td>
                                <td>{{ $j == 1 ? $item['fee_collection_sum_base_amount'] : $item['fee_collection_sum_base_amount']*100/$sum}}</td>

                            </tr>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
