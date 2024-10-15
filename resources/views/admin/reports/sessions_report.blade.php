@extends('layouts.main')
@section('content')
    <div class="container-fluid">
	    <div class="row mb-4">
	        <div class="col-md-9">
	            <form action="" method="GET" class="w-100">
	                <div class="row w-100">
	                    <div class="col-md-4">
	                        <label for="">From Date</label>
	                        <input type="date" class="form-control" value="{{$fdate}}" name="fdate" max="{{date('Y-m-d')}}" />
	                    </div>
	                    <div class="col-md-4">
	                        <label for="">To Date</label>
	                        <input type="date" class="form-control" value="{{$tdate}}" name="tdate" max="{{date('Y-m-d')}}" />
	                    </div>
	                    <div class="col-md-4">
	                       <button class="btn btn-success">Filter</button>
	                       <a href="{{route('session_reports')}}" class="btn btn-primary">Rest Filter</a>
	                      
	                    </div>
	                </div>
	            </form>
	            
	        </div>
	        <div class="col-md-3">
	             <form action="{{route('sessions_report_exports')}}" method='POST'>
	                           @csrf
    	                        <input type="hidden" class="form-control" value="{{$fdate}}" name="fdate" max="{{date('Y-m-d')}}" />
    	                        <input type="hidden" class="form-control" value="{{$tdate}}" name="tdate" max="{{date('Y-m-d')}}" />
    	                        <button class="btn btn-primary btn-sm">Export</button>
	                       </form>
	        </div>
	    </div>
       
        <div class="row">
            <div class="col-md-12">
                <div class="w-100 table-responsive">
                    <table class="table table-sm table-bordered table-light " id="exportTable">
                        <thead>
                            <tr>
                                <th>Sr NO</th>
                                <th>Expert</th>
                                <th>Session Category</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Pending Sessions</th>
                                <th>Closed Sessions</th>
                                <th>Cancelled Sessions</th>
                                <th>Base Fee</th>
                                <th>Coordinate Fee</th>
                                <th>Discount</th>
                                <th>Total Paid</th>
                                <th>Bank Ref No</th>
                                <th>Tracking ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $i => $item)
                                <tr>
                                    <td>
                                        {{$i + 1}}
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            <li class="text-nowrap">
                                                Name : {{$item->expert->name}}
                                            </li>
                                           <li class="text-nowrap">
                                                Email : {{$item->expert->email}}
                                            </li>
                                            <li class="text-nowrap">
                                                Mobile : {{$item->expert->mobile}}
                                            </li>
                                        </ul>
                                        
                                    </td>
                                    <td>
                                        {{$item->expert->designation == '1' ? 'Counselling' : "Coaching"}}
                                    </td>
                                    <td>
                                        {{$item->created_at}}
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            <li class="text-nowrap">
                                                Name : {{$item->user->name}}
                                            </li>
                                           <li class="text-nowrap">
                                                Email : {{$item->user->email}}
                                            </li>
                                            <li class="text-nowrap">
                                                Mobile : {{$item->user->mobile}}
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        {{$item->all_pending_slot_sessions_count}}
                                    </td>
                                    <td>
                                      {{$item->closed_sessions_count}}
                                    </td>
                                    <td>
                                        {{$item->cancelled_sessions_count}}
                                    </td>
                                    <td>
                                        {{$item->cart_payment?->base_amount}}
                                    </td>
                                    <td>
                                        {{$item->cart_payment->conven_fee}}
                                    </td>
                                    <td>
                                       {{$item->cart_payment->dis_package}}
                                    </td>
                                    <td>
                                        {{json_decode($item->cca_response)[0]->amount}}
                                    </td>
                                    <td>
                                        {{json_decode($item->cca_response)[0]->bank_ref_no}}
                                    </td>
                                    <td>
                                        {{json_decode($item->cca_response)[0]->tracking_id}}
                                    </td>
                                </tr>
                            
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    
   
@endsection
