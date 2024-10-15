@extends('frontend.user.main')

@section('ucontent')
    @foreach ($errors->all() as $item)
        <script>
            toastr.error('{{ $item }}', 'Errpr Occured')
        </script>
    @endforeach
    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}", 'Error')
        </script>
    @endif


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-12 shadow rounded-4 bg-light p-5" >
                <h4 class="mb-4">
                    Request to Close Account
                </h4>
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="">
                            Enter Reason
                        </label>
                        <input type="text" name="reason" class="form-control" required/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">
                            Description
                        </label>
                        <textarea class="form-control" rows="6" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
