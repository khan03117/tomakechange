@extends('frontend.main')
@section('content')
    <section class="space">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="section-title  text-warning text-center">
                        <h3>
                            Frequently Asked Questions
                        </h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="w-100 faqs">
                        <div class="accordion" id="accordionExample">
                            @foreach ($faqs as $j => $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button
                                            class="accordion-button shadow-none border border-success collapsed d-flex align-items-center justify-content-between"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne{{ $j }}" aria-expanded="true"
                                            aria-controls="collapseOne{{ $j }}">
                                            <span>
                                                {{ $item['faq'] }}
                                            </span>
                                            <span class="plus accourdicon">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                            <span class="minus accourdicon">
                                                <i class="fa-solid fa-minus"></i>
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne{{ $j }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body border border-success">
                                            {!! $item['explain'] !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
