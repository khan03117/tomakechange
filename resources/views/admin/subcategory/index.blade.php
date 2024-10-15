@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                {{-- <form action="{{ route('subcategory.store') }}" method="post" class="col-md-12 p-2 shadow-primary">
                    <div class="row">
                        <div class="col-md-4">

                            @csrf
                            <div class="form-group mb-3">
                                <label for="">
                                    Select Category
                                </label>
                                <select name="category_id" id="" class="form-select">
                                    <option value="" selected disabled>---Select---</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['category'] }}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">
                                    Enter Sub Category
                                </label>
                                <input type="text" value="{{ old('sub_category') }}" name="sub_category"
                                    id="sub_category" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="form-label d-block">
                                    &nbsp;
                                </label>
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form> --}}
                <div class="col-md-12 mt-4">
                    <div class="w-100 table-responsive">
                        <table class="table  bg-white shadow table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        Sr No.
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Subcategory
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item['category'] }}
                                    </td>
                                    <td>
                                        {{ $item['sub_category'] }}
                                    </td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
