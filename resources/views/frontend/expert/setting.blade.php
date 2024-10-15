@extends('frontend.user.main')

@section('ucontent')
    <style>
        input {
            background: #fff;
            box-shadow: none !important;

        }

        form label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.6rem
        }

        form input:not(['type="submit"']) {
            max-height: 30px;
            /* line-height: 30px !important; */
            font-size: 13px !important;
            border-radius: 0 !important;
        }
    </style>
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-10 border p-4 box-shadow-3 bg-light rounded-2">
                 @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
                @endif
                {!! Form::open(['url' => route('expert.update'), 'method' => 'PUT', 'autofill' => 'false']) !!}
                <div class="row gy-4">
                    <div class="col-md-6">
                        <label for="">
                            Name
                        </label>
                        {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>
                    <div class="col-md-6">
                        <label for="">
                            Email
                        </label>
                        {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>
                    <div class="col-md-6">
                        <label for="">
                            Mobile
                        </label>
                        {!! Form::tel('mobile', Auth::user()->mobile, [
                            'class' => 'form-control',
                            'minlength' => '10',
                            'maxlength' => '10',
                            'oninput' => "return this.value = this.value.replace(/[^0-9\.]/g,'');",
                            'readonly' => 'readonly'
                        ]) !!}
                    </div>
                    <div class="col-12"></div>
                    <div class="col-md-6">
                        <label for="">
                            Password
                        </label>
                        {!! Form::text('password', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        <label for="">
                            Confirm Password
                        </label>
                        <input id="password" class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="col-md-12">
                        {!! Form::submit('Update', ['class' => 'btn btn-sm px-md-5 py-2 fw-light text-uppercase btn-primary rounded-1']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
