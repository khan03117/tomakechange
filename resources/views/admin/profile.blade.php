@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
               <div class="col-md-8">
                   {!!Form::open(['url' => route('profile_update_admin'), 'method' => 'PUT'])!!}
                   <div class="w-100 card card-body">
                       <div class="row">
                           <div class="col-md-6">
                               <label for="">
                                   Name
                               </label>
                               <div class="form-control">{{Auth::user()->name}}</div>
                           </div>
                           <div class="col-md-6">
                               <label for="">
                                   UserName
                               </label>
                               <input type="text" readonly class="form-control" name="email" value="{{Auth::user()->email}}">
                           </div>
                          
                           <div class="col-md-6">
                               <label for="">
                                   Change Password
                               </label>
                               <input type="text" class="form-control" name="password" />
                           </div>
                           <div class="col-md-12 mt-2">
                               <input type="submit" class="btn btn-success" >
                           </div>
                           
                       </div>
                   </div>
                   {!!Form::close()!!}
               </div>
            </div>
        </div>
    </section>
@endsection
