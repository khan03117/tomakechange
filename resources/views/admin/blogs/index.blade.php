@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="w-100 text-end">
                        <a href="{{ route('blog.create') }}" class="btn btn-success">
                            Add New BLog
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-bordered table-hover table-rep-plugin">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item['title'] }}
                                    </td>
                                    <td>
                                        {!! Str::substr($item['description'], 0, 200) !!}
                                    </td>
                                    <td>
                                        {{ date('d-M-Y h:i A', strtotime($item['created_at'])) }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <form id="deleteForm" action="{{ route('blog.destroy', $item['id']) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('blog.edit', $item['id']) }}" class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $("#deleteForm").on('submit', function(e) {
                            e.preventDefault();
                            if (confirm('Are you sure ?')) {
                                $("#deleteForm").submit();
                            }
                        })
                    </script>
                </div>
            </div>
        </div>
    </section>
@endsection
