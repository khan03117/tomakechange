@extends('layouts.main')
@section('content')
    <section>
        <form action="{{ route('endcategory.store') }}" method="post">
            @csrf

            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">
                            Select Category
                        </label>
                        <select onchange="get_sub_category(event)" name="category_id" id="category_id" class="form-select">
                            <option value="">---Select---</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item['id'] }}">{{ $item['category'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">
                            Select Sub Category
                        </label>
                        <select name="sub_category_id" id="sub_category" class="form-select">
                            <option value="">---Select---</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item['id'] }}">{{ $item['category'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">
                          Enter  End Category
                        </label>
                        <input type="text" name="end_category" id="end_category" value="{{ old('end_category') }}"
                            class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="w-100 d-block">&nbsp;</label>
                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
