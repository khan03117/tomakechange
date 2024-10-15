@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="w-100">
                        <div class="d-flex align-items-center">
                              <span
                            class="badge rounded-0  @if ($url == 'cancel') bg-danger
                        @elseif($url == 'Pending')
                            bg-warning
                        @elseif($url == 'done')
                        bg-success @endif shadow py-2 fs-5">{{ ucwords($url) }}</span>
                            <a href="{{ route('sessions', ['url' => $url, 'id' => 'all']) }}"
                                class="btn rounded-0  {{ $time == 'all' ? 'btn-primary' : ' btn-light' }}">
                                All
                            </a>
                            <a href="{{ route('sessions', ['url' => $url, 'id' => 'today']) }}"
                                class="btn rounded-0  {{ $time == 'today' ? 'btn-primary' : ' btn-light' }}">
                                Today
                            </a>
                            <a href="{{ route('sessions', ['url' => $url, 'id' => 'upcoming']) }}"
                                class="btn rounded-0  {{ $time == 'upcoming' ? 'btn-primary' : ' btn-light' }}">
                                Upcoming
                            </a>
                            <a href="{{ route('sessions', ['url' => $url, 'id' => 'outdated']) }}"
                                class="btn rounded-0 {{ $time == 'outdated' ? 'btn-primary' : ' btn-light' }}">
                                Out Dated
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-end">

                      
                    </div>
                </div>
            </div>
            <form action="" method="get">
                <div class="row mb-4   gx-1 gy-2">
                    <div class="col-md-2">
                        <div class="input-group">
                            <select name="ucolumn" class="border" id="" style="box-shadow: none;outline:none;">
                                <option value="name" @selected($ucolumn == 'name')>Name</option>
                                <option value="email" @selected($ucolumn == 'email')>email</option>
                                <option value="mobile" @selected($ucolumn == 'mobile')>mobile</option>
                            </select>
                            <input type="text" name="user" id="user" value="{{ $uname }}"
                                placeholder="User ?" class="form-control form-control-sm">
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <select name="ecolumn" class="border" id="" style="box-shadow: none;outline:none;">
                                <option value="name" @selected($ecolumn == 'name')>Name</option>
                                <option value="email" @selected($ecolumn == 'email')>email</option>
                                <option value="mobile" @selected($ecolumn == 'mobile')>mobile</option>
                            </select>
                            <input type="text" name="expert" id="expert" value="{{ $ename }}"
                                placeholder="expert Name" class="form-control form-control-sm">

                        </div>
                    </div>
                    <div class="col-md-1">
                        <select name="category_id" id="" class="form-select form-select-sm">
                            <option value="">All</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat['id'] }}" @selected($cat_id == $cat['id'])>{{ $cat['category'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="fdate" id="fdate" value="{{ $fdate }}" placeholder="fdate"
                            class="form-control form-control-sm">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="tdate" id="tdate" value="{{ $tdate }}" placeholder="date"
                            class="form-control form-control-sm">
                    </div>
                    <script>
                        $("#fdate").on('input', function() {
                            $("#tdate").attr('min', $(this).val());
                        })
                    </script>
                    {{-- <div class="col-md-1">
                        <select name="status" id="status" class="form-select form-select-sm">
                            <option value="">---Select---</option>
                            @if ($url != 'cancel')
                                <option value="Pending" @selected($status == 'Pending') @selected($url == 'Pending')>Pending
                                </option>
                                @if ($time != 'upcoming')
                                    <option value="Done" @selected($status == 'Done')>Done</option>
                                @endif
                            @endif
                            <option value="Cancel" @selected($status == 'Cancel') @selected($url == 'cancel')>Cancel
                            </option>
                        </select>
                    </div> --}}
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-success">
                            <i class="fi fi-rs-search"></i>
                        </button>
                        <a class="btn btn-sm btn-info" href="{{ route('sessions', ['url' => 'all', 'id' => 'all']) }}">
                            Reset
                        </a>
                        {{-- <a href="{{ route('export.sessions', ['url' => 'all', 'time' => 'all']) }}"
                            class="btn btn-sm btn-primary">
                            <i class="fi fi-rs-file-excel"></i>
                        </a> --}}
                    </div>
                </div>
            </form>
            <div class="row">

                <div class="col-md-12 table-responsive">
                    <table class="table  table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>User</th>
                                <th>Expert</th>
                                <th>Session</th>
                                <th>Slot</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>
                                        <ul class="mb-0 p-0 list-unstyled">
                                            <li>
                                                <strong>Name </strong> : <span>
                                                    {{ $item['user'] ? $item['user']['name'] : '' }}</span>
                                            </li>
                                            <li>
                                                <strong>Email </strong> : <span>
                                                    {{ $item['user'] ? $item['user']['email'] : '' }}</span>
                                            </li>
                                            <li>
                                                <strong>Mobile </strong> : <span>
                                                    {{ $item['user'] ? $item['user']['mobile'] : '' }}</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="mb-0 list-unstyled">
                                            <li>
                                                Name : {{ ucwords($item['expert']['name']) }}
                                            </li>
                                            <li>
                                                Email : {{ ucwords($item['expert']['email']) }}
                                            </li>
                                            <li>
                                                Mobile : {{ ucwords($item['expert']['mobile']) }}
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                {{ $item['category'] }}
                                            </li>
                                            {{-- <li>
                                                <strong>Sub Cat :</strong>
                                                @if (gettype(json_decode($item['sub_cats'])) == 'array')
                                                    @foreach (json_decode($item['sub_cats']) as $sub)
                                                        {{ $sub->sub_category }} @if (!$loop->last)
                                                            |
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </li>
                                            <li>
                                                <strong>End Cat :</strong>
                                                @if (gettype(json_decode($item['end_cats'])) == 'array')
                                                    @foreach (json_decode($item['end_cats']) as $sub)
                                                        {{ $sub->end_category }} @if (!$loop->last)
                                                            |
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </li> --}}

                                        </ul>
                                    </td>
                                    <td>
                                        @if ($item['slot'])
                                            {{ __('On ') . date('d-M-Y', strtotime($item['slot'])) }}
                                            <p class="mb-0">
                                                {{ date('h:i A', strtotime($item['slot'])) . ' to ' . date('h:i A', strtotime($item['slot_end'])) }}
                                            </p>
                                        @endif
                                    </td>
                                    <td>

                                        <span
                                            class="badge @if ($item['booking_status'] == 'Pending') bg-warning-subtle   text-dark @endif @if ($item['booking_status'] == 'Done') bg-success-subtle text-dark @endif @if ($item['booking_status'] == 'Cancel') bg-danger-subtle text-dark @endif  rounded-1 px-md-4 py-2 ">{{ $item['booking_status'] }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap align-items-center">
                                           
                                     
                                        @if ($item['booking_status'] == 'Pending')
                                        
                                                <div class="dropdown">
                                                  <button class="btn btn-warning btn-sm  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                   Action  <i class=" fas fa-angle-down"></i>
                                                  </button>
                                                  <ul class="dropdown-menu dropdown-menu-white p-0 m-0 p-2">
                                                       @if ($item['slot'])
                                                       <li class="pb-2">
                                                        <a data-bs-toggle="tooltip" title="Reschedule Now"
                                                            href="{{ route('reschedule.admin', base64_encode($item['usid'])) }}"
                                                            class="btn btn-sm d-block w-100  btn-warning text-dark">
                                                            <i class="fi fi-rs-calendar-clock text-dark"></i> ReSchedule
                                                        </a>
                                                         </li>
                                                    @endif
                                                  
                                                    <li class="pb-2"> 
                                                          <a href="{{url('admin/cancel-booking/'.base64_encode($item['cart_id']))}}" target="_blank"  data-bs-toggle="tooltip" title="Cancel Booking"
                                                            onclick="cancel_booking(event)" data-id="{{ $item['usid'] }}"
                                                            class="btn d-block w-100 btn-sm btn-danger">
                                                            <i style="pointer-events: none;"
                                                                class="fa-solid fa-rectangle-xmark"></i>
                                                            Cancel 
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form id="completedform{{$item['usid']}}" method="POST" action="{{route('mark_completed.admin', $item['usid'] )}}">
                                                            @csrf
                                                            <button type="button" onclick="mark_completed({{$item['usid']}})" class="btn btn-sm btn-success w-100">Completed</button>
                                                        </form>
                                                       
                                                        
                                                    </li>
                                                    
                                                  </ul>
                                                </div>
                                        
                                        
                                        
                                             
                                        @endif
                                        
                                        @if ($item['is_refunded'] == '1')
                                          <span class="badge bg-success py-2">Refunded</span>
                                          
                                        @endif
                                        
                                        @if($item['booking_status'] == 'Cancel' && $item['is_refundable'] == '1' && !$item['refund_id'])
                                        <button type="button" onclick="getPaymentDetails('{{ $item['usid'] }}')"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">
                                                Add Refund
                                            </button>
                                        
                                        @endif
                                        <a data-bs-toggle="tooltip" title="Show All Details" class="btn btn-primary btn-sm shadow" href="{{url('admin/session-details/'.base64_encode($item['usid']))}}">
                                            Details
                                        </a>
                                           </div>
                                        

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $items->links() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Refund</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => route('refund.store'), 'method' => 'POST', 'id' => 'refundForm']) !!}
                    <div id="formDataTable"></div>
                    <input type="hidden" name="id" id="usid">
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="submitForm()" class="btn btn-primary">Refund Now</button>
                </div>
            </div>
        </div>
    </div>
     <script>
        const mark_completed = (id) => {
            if(confirm('Are you sure to mark completed')){
                $("#completedform"+id).submit();
            }
        }
    </script>
    <script>
        const getPaymentDetails = (id) => {
            $("#usid").val(id);
            $.post(`${url}/ajax/get_payment_details`, {
                id: id
            }, function(res) {
                $("#formDataTable").html(res);
            });
        }
        const submitForm = () => {
            $("#refundForm").submit();
        }
    </script>
@endsection
