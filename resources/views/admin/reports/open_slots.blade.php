@extends('layouts.main')
@section('content')
    <div class="container-fluid">
	    <div class="row mb-4">
	        <div class="col-md-12">
	            <form action="" method="GET">
	                <div class="row">
	                    <div class="col-md-3">
	                        <label for="">From Date</label>
	                        <input type="date" name="fdate" class="form-control" value="{{$fdate}}" />
	                    </div>
	                    <div class="col-md-3">
	                        <label for="">To Date</label>
	                        <input type="date" name="tdate"  class="form-control" value="{{$tdate}}" />
	                    </div>
	                    <div class="col-md-3">
	                        <label class="d-block w-100" for="">&nbsp;</label>
	                        <button class="btn btn-sm btn-primary w-100">Submit</button>
	                    </div>
	                </div>
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
                                <th>Category</th>
                                <th>Open Slots</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $i => $item)
                                <tr>
                                    <td>
                                        {{$i + 1}}
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            <li class="text-nowrap">
                                                Name : {{$item->expert?->name}}
                                            </li>
                                           <li class="text-nowrap">
                                                Email : {{$item->expert?->email}}
                                            </li>
                                           
                                        </ul>
                                        
                                    </td>
                                    <td>
                                       
                                        {{$item->expert?->designation == '1' ? 'Counselling' : 'Coaching'}}
                                    </td>
                                    <td>
                                        {{$item->open_slots}}
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
	    $('#exportTable').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			 'excel'
		],
		searching:false
	} );
	</script>
    
   
@endsection

@section('script')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
	
@endsection
