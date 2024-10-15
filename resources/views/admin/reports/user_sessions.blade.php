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
	                       <a href="{{route('user_sessions')}}" class="btn btn-primary">Rest Filter</a>
	                      
	                    </div>
	                </div>
	            </form>
	            
	        </div>
	        <div class="col-md-3">
	             <form action="{{route('user_sessions_exports')}}" method='POST'>
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
                                <th>Mode</th>
                                <th>Duration</th>
                                <th>Date</th>
                                <th>Client</th>
                               
                                <th>Base Fee</th>
                                <th>Coordinate Fee</th>
                                <th>Discount</th>
                                <th>Total Paid</th>
                                <th>Bank Ref No</th>
                                <th>Tracking ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $j => $item)
                            
                                <tr>
                                    <td>
                                        {{$j + 1}}
                                    </td>
                                    <td>
                                        {{$item->expert->name}}
                                    </td>
                                    <td>
                                        {{$item->category_id == '1' ? 'Counselling' : 'Coaching'}}
                                    </td>
                                    <td>
                                        {{$item->mode}}
                                    </td>
                                    <td>
                                       
                                        {{(strtotime($item->slot->slot_end) - strtotime($item->slot->slot) )/60}} min
                                    </td>
                                    <td>
                                        {{$item->apt_date}}
                                    </td>
                                    <td>
                                        {{$item->user->name}}
                                    </td>
                                   
                                    <td>
                                        {{$item->cart->base_amount/$item->cart->packages->quantity}}
                                    </td>
                                    <td>
                                        {{$item->cart->conven_fee/$item->cart->packages->quantity}}
                                    </td>
                                    <td>
                                       {{$item->cart->dis_package/$item->cart->packages->quantity}}
                                    </td>
                                    <td>
                                        {{json_decode($item->cart->cca_response)[0]->amount/$item->cart->packages->quantity}}
                                    </td>
                                    <td>
                                        {{json_decode($item->cart->cca_response)[0]->bank_ref_no}}
                                    </td>
                                    <td>
                                        {{json_decode($item->cart->cca_response)[0]->tracking_id}}
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
