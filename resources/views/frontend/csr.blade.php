@extends('frontend.main')
@section('content')
    <style>
        .object-cover{
            object-fit:cover;
        }
    </style>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-0">
                    <img src="{{ url('public/assets/img/csr-baner.jpg') }}" alt="" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </section>
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title">
                    <h3 class="text-warning">
                       edha Foundation
                    </h3>
                </div>
                <div class="col-md-12">
                    <div class="w-100 mb-4 text-">
                        <p>
                            At edha, we stand for the cause and wherever there is a requirement, we pitch in to add
                            value in the lives of our fellow citizen, through workshops or one-on-one Counselling sessions
                            or inspirational talks, basis availability of our Experts.


                        </p>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="w-100">
                        <p class="text-">
                            Please feel free to get in touch with us and let us see how can we be of some value add.
                            Do drop in a mail at <a class="text-warning text-decoration-none fw-bold"
                                href="mailto:ask@edha.life">ask@edha.life</a> and we shall get back to you at an
                            earliest

                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="space">
        <div class="container">
              <div class="row">
                  @foreach($items as $item)
            <div class="col-md-4 mb-4">
                <figure class="w-100 mb-0 h-100">
                    <img src="{{$item->image}}" class="img-fluid  h-100 object-cover" /> 
                </figure>
            </div>
            @endforeach
          
            
        </div>
        </div>
    </section>
@endsection
