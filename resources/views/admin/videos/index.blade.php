@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="w-100 text-end">
                        <a href="{{ route('video.create') }}" class="btn btn-success">
                            Add New Video
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
                                <th>Thumbnail</th>
                                <th>Video</th>
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
                                        <img src="{{url('public/upload/'.$item['image'])}}" width="100" />
                                    </td>
                                    <td>
                                        <iframe src="{{ $item['slug'] }}&fs=0&controls=0&modestbranding=1"></iframe>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <form id="deleteForm" action="{{ route('video.destroy', $item['id']) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('video.edit', $item['id']) }}" class="btn btn-primary btn-sm">
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
