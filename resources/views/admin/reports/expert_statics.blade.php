@extends('layouts.main')
@section('content')
    <div class="container-fluid">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

        <div class="row mb-3">
            <form action="" class="col-md-12" method="get">
                <div class="row ">


                    <div class="col-md-2">
                        <label for="">
                            Category
                        </label>
                        <select class="form-control" onchange="getExpert(event)" name="cateogry">
                            <option value="">---Select---</option>
                            @foreach($cats as $cat)
                            <option value="{{$cat['id']}}" @selected($cid == $cat['id'])>{{$cat['category']}}</option>
                            
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">
                            Expert
                        </label>
                        <select class="form-control" name="expert" id="expert">
                             <option value="">---Select---</option>
                               @foreach($experts as $cat)
                            <option value="{{$cat['id']}}" @selected($eid == $cat['id'])>{{$cat['name']}}</option>
                            
                            @endforeach
                        </select>
                    </div>
                    <script>
                        const getExpert = (e) => {
                            let id = e.target.value;
                            $.post(`${url}/ajax/getexpert_by_category`, {id : id}, function(res){
                                $("#expert").html(res);
                            })
                        }
                    </script>
                    <div class="col-md-2">
                        <label for="">
                            Month
                        </label>
                        <input type="month" class="w-100 form-control" value="{{$mid}}" name="month"  id="month">
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
                    <table class="table table-sm table-bordered table-light " id="exportTable">
                        <thead>
                            <tr>
                                <th>Sr NO</th>
                                <th>Expert</th>
                                <th>Session Category</th>
                                <th>Open Sesssion</th>
                                <th>Closed Sessions</th>
                                <th>Cancelled Sessions</th>
                                <th>Rescheduled Sessions</th>
                                <th>Video Sessions Completed</th>
                                <th>Audio Sessions Completed</th>
                                <th>Single Package Count</th>
                                <th>Multi Package Count</th>
                            </tr>
                        </thead>
                        @php
                         $arr1 = [];
                            $arr2 = [];
                            $arr3 = [];
                            $arr4 = [];
                            $arr5 = [];
                            $arr6 = [];
                            $arr7 = [];
                            $arr8 = [];
                        @endphp
                        @foreach ($items as $i => $item)
                            @php
                           
                            array_push($arr1, $item['open_sessions_count']);
                            array_push($arr2, $item['closed_sessions_count']);
                            array_push($arr3, $item['cancelled_sessions_count']);
                            array_push($arr4, $item['rescheduled_sessions_count']);
                            array_push($arr5, $item['video_package_count']);
                            array_push($arr6, $item['audio_package_count']);
                            array_push($arr7, $item['single_package_count']);
                            array_push($arr8, $item['multi_package_count']);
                           
                            @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['category'] }}</td>
                                <td>{{ $item['open_sessions_count'] }}</td>
                                <td>{{ $item['closed_sessions_count'] }}</td>
                                <td>{{ $item['cancelled_sessions_count'] }}</td>
                                <td>{{ $item['rescheduled_sessions_count'] }}</td>
                                <td>{{ $item['video_package_count'] }}</td>
                                <td>{{ $item['audio_package_count'] }}</td>
                                <td>{{ $item['single_package_count'] }}</td>
                                <td>{{ $item['multi_package_count'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                                <td>
                                    
                                </td>
                                <td>
                                    Total
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    {{array_sum($arr1)}}
                                </td>
                                <td>
                                    {{array_sum($arr2)}}
                                </td>
                                <td>
                                    {{array_sum($arr3)}}
                                </td>
                                <td>
                                    {{array_sum($arr4)}}
                                </td>
                                <td>
                                    {{array_sum($arr5)}}
                                </td>
                                <td>
                                    {{array_sum($arr6)}}
                                </td>
                                <td>
                                    {{array_sum($arr7)}}
                                </td>
                                <td>
                                    {{array_sum($arr8)}}
                                </td>
                            
                        </tr>
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
