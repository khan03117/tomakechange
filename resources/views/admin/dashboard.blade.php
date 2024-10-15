@extends('layouts.main')
@section('content')
    <style>
        .depit .col-md-2 .w-100{
            /*background-color: #55efc4;*/
            /*background-image : linear-gradient(315deg, #55efc4 0%, #000000 74%);*/
            padding:10px;
            color:#000;
            border:1px solid #ccc;
            box-shadow:0 0 10px #ccc;
            height:100%;
            text-align:center;
        }
    </style>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:%20void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <!--package-->
            <div class="col-md-6 d-none table-responsive">
                <table class="table table-sm table-light">
                    <tr>
                        <th>Package Sessions</th>
                        <th>Counsessling</th>
                        <th>Coaching</th>
                        <th>Self Help</th>
                    </tr>
                    <tr>
                        <th>Open Sessions</th>
                        <td>{{ $Pending_sessions_counselling }}</td>
                        <td>{{ $Pending_sessions_coaching }}</td>
                        <td>{{ $Pending_sessions_feels_good }}</td>
                    </tr>
                    <tr>
                        <th>Completed Sessions</th>
                        <td>{{ $Done_sessions_counselling }}</td>
                        <td>{{ $Done_sessions_coaching }}</td>
                        <td>{{ $Done_sessions_feels_good }}</td>
                    </tr>
                    <tr>
                        <th>Cancelled Sessions</th>
                        <td>{{ $Cancelled_sessions_counselling }}</td>
                        <td>{{ $Cancelled_sessions_coaching }}</td>
                        <td>{{ $Cancelled_sessions_feels_good }}</td>
                    </tr>
                </table>
            </div>
            <!--sessions-->
            <div class="col-md-6 table-responsive d-none">
                <table class="table table-sm table-light">
                    <tr>
                        <th>Sessions</th>
                        <th>Counselling</th>
                        <th>Coaching</th>
                        <th>Self Help</th>
                        <th>
                            Total
                        </th>
                    </tr>
                    <tr>
                        <th>Open Sessions</th>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'Pending', 'id' => 'all', 'category_id' => '1']) }}">
                                {{ $Pending_slot_counselling }}
                            </a>

                        </td>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'Pending', 'id' => 'all', 'category_id' => '2']) }}">
                                {{ $Pending_slot_coaching }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'Pending', 'id' => 'all', 'category_id' => '3']) }}">
                                {{ $Pending_slot_feels_good }}
                            </a>
                        </td>
                        <td>
                             {{ $Pending_slot_counselling +  $Pending_slot_coaching + $Pending_slot_feels_good }}
                        </td>
                    </tr>
                    <tr>
                        <th>Completed Sessions</th>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'Done', 'id' => 'all', 'category_id' => '1']) }}">
                                {{ $Done_slot_counselling }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'Done', 'id' => 'all', 'category_id' => '2']) }}">
                                {{ $Done_slot_coaching }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'Done', 'id' => 'all', 'category_id' => '3']) }}">
                                {{ $Done_slot_feels_good }}
                            </a>
                        </td>
                        <td>
                             {{ $Done_slot_counselling +  $Done_slot_coaching + $Done_slot_feels_good }}
                        </td>
                    </tr>
                    <tr>
                        <th>Cancelled Sessions</th>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'cancel', 'id' => 'all', 'category_id' => '1']) }}">
                                {{ $Cancelled_slot_counselling }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'cancel', 'id' => 'all', 'category_id' => '2']) }}">
                                {{ $Cancelled_slot_coaching }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('sessions', ['url' => 'cancel', 'id' => 'all', 'category_id' => '3']) }}">
                                {{ $Cancelled_slot_feels_good }}
                            </a>
                        </td>
                         <td>
                             {{ $Cancelled_slot_counselling +  $Cancelled_slot_coaching + $Cancelled_slot_feels_good }}
                        </td>
                    </tr>
                    
                </table>
            </div>
            
        </div>
        <div class="row mb-4 depit">
            <div class="col-md-2">
                <div class="w-100">
                    Sessions
                </div>
            </div>
            <div class="col-md-2">
                <div class="w-100">
                    Open Sessions
                </div>
            </div>
            <div class="col-md-2">
                <div class="w-100">
                    Completed Sessions
                </div>
            </div>
            <div class="col-md-2">
                <div class="w-100">
                    Cancelled Sessions
                </div>
            </div>
            <div class="col-md-2">
                <div class="w-100">
                    Total Sessions
                </div>
            </div>
        </div>
        @php
        $sall = [];
        $cm_all = [];
        $cm_can = [];
        $all_arr = [];
        @endphp
        @foreach($cats as $cat)
            @php
            array_push($sall,  $cat['sessions_count']);
            array_push($cm_all,  $cat['completed_sessions_count']);
            array_push($cm_can,  $cat['cancelled_sessions_count']);
            
            @endphp
            <div class="row mb-4 depit">
                <div class="col-md-2">
                    <div class="w-100">
                        {{$cat['category']}}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="w-100">
                        {{$cat['sessions_count']}}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="w-100">
                        {{$cat['completed_sessions_count']}}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="w-100">
                        {{$cat['cancelled_sessions_count']}}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="w-100">
                   
                    {{$all = $cat['sessions_count'] + $cat['completed_sessions_count'] + $cat['cancelled_sessions_count']}}
                    @php
                    array_push($all_arr, $all);
                    @endphp
                     </div>
                </div>
                
            </div>
        @endforeach
        <div class="row depit">
            <div class="col-md-2">
                <div class="w-100">
                    Total Count
                </div>
            </div>
            <div class="col-md-2">
                <div class="w-100">
                    {{array_sum($sall)}}
                </div>
            </div>
            <div class="col-md-2">
                <div class="w-100"> 
                    {{array_sum($cm_all)}}
                </div>
            </div>
            <div class="col-md-2">
                <div class="w-100">
                    {{array_sum($cm_can)}}
                </div>
            </div>
            <div class="col-md-2">
                <div class="w-100">
                    {{array_sum($all_arr)}}
                </div>
            </div>
        </div>


    </div>
@endsection
