@extends('frontend.user.main')

@section('ucontent')
    <style>
        .plan_box {
            border-radius: 1rem;
            background: #fdb99a77;
            box-shadow: 0 2px 3px #ccc;
            padding: 1.4rem;
            box-shadow: inset -5px -2px 10px #ffa87c;
        }

        .plan_box .plan_header {
            margin-bottom: 2.4rem;
        }

        .plan_box .plan_body {
            margin-bottom: 2.4rem;
        }

        .plan_box .plan_footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .plan_box .plan_footer ul li {
            padding: 10px 0;
            font-size: 14px;
            letter-spacing: 1px;

        }

        .plan_box .plan_footer ul li:not(:last-of-type) {
            border-bottom: 1px solid #ccc;
        }

        .plan_title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .plan_sort_desc {
            font-size: 12px;
        }

        .plan_body h2 {
            font-size: 25px;
            margin-bottom: 1.8rem;
            display: inline-block;
            font-weight: 700;
        }

        .popularplan {
            transform: scale(1.1)
        }

        .popularTag {
            font-size: 12px;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
    <div class="container">

        <div class="row g-5">
            @foreach ($plans as $item)
                <div class="col-md-4">
                    <div class="w-100 plan_box @if ($item->is_popular == '1') popularplan @endif ">
                        <div class="plan_header  position-relative">
                            <h4 class="plan_title">{{ $item->title }}</h4>
                            <p class="plan_sort_desc">{{ $item->sub_title }}</p>
                            @if ($item->is_popular)
                                <span class="popularTag badge bg-warning text-white rounded-pill">Popular</span>
                            @endif
                        </div>
                        <div class="plan_body">
                            <h2>
                                ₹ {{ $item->amount }}
                            </h2>
                            <div class="w-100 px-5">
                                <form action="{{ route('purchase_plan') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="plan_id" value="{{ $item->id }}">
                                    <button
                                        class="btn @if ($item->is_popular == '1') btn-warning @else btn-outline-warning @endif rounded-pill btn-sm w-100 text-uppercase">Get
                                        Started</button>
                                </form>

                            </div>
                        </div>
                        <div class="plan_footer">
                            {!! $item->description !!}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
