@extends('frontend.main')
@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-0">
                    <img src="{{ url('public/assets/img/eep.png') }}" alt="" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </section>
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-12 section-title">
                    </div> -->
                    <div class="col-md-6 text-primary">
                    <h3 class="text-warning section-title">
                       Mental Health Assessments
                    </h3>
                    
                        <p>
                        Looking out for mental and emotional insight, we conduct assessments for the same.
                         Please fill up the form and we shall reach out to you. 
                        </p>
                        <p>
                            Please feel free to reach out to us for any of your Counselling, Coaching or related
                            sessions or talk in your Organization.
                        </p>
                    
                        <p>
                            Kindly drop in a mail at <a class="text-warning text-decoration-none fw-bold"
                                href="tel:ask@edha.life">ask@edha.life</a> and we shall get back to you at an
                            earliest
    
                        </p>
                </div>

                <div class="col-md-6">
                <div class="w-100 px-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title text-center" style="background: #077773;padding: 10px;border-radius: 8px">

                                <h5 class="hippa-logo text-white pt-2 ">For Assessments</h5>
                            </div>

                            <form method="post" action="">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="name" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile" required>
                                </div>

                                <div class="mb-3">
                                    <label for="concern" class="form-label">Concern</label>
                                    <textarea class="form-control" id="concern" name="concern" rows="3"
                                        required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary ">Contact Us</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </div>
    </section>
@endsection
@section('meta')
    <meta name="title" content="edha : Platform for professional and personal growth">
    <meta name="description" content="We conduct workshops for employees of Organizations, Institutions, and other groups for a healthier mind and body.  If you as an Organization, wish to conduct any workshop for your employees, then please get in touch with us at edha.  ">
@endsection
