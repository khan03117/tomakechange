@extends('layouts.main')
@section('content')
    <section>
        <form action="{{ route('conven_fee.store') }}" method="post">
            @csrf
            <div class="container">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <label for="">
                            No of Sessions
                        </label>
                        <input type="number" name="quantity" id="quantity" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="">
                            Select Duration
                        </label>
                        <select name="duration" id="duration" class="form-select">
                            <option value="">---Select---</option>
                            <option value="00:30:00">30 Minutes</option>
                            <option value="01:00:00">60 Minutes</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">
                            Select Mode
                        </label>
                        <select name="mode" id="mode" class="form-select">
                            <option value="">---Select---</option>
                            <option value="Audio">Audio</option>
                            <option value="Video">Video</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">
                            Rate
                        </label>
                        <input type="text" name="rate" id="rate" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="">
                            Fixed Fee
                        </label>
                        <input type="text" name="fixed_fee" id="fixed_fee" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
