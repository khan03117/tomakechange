@extends('frontend.main')
@section('content')
    <section class="space joinSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-warning">
                        Dear Reader,
                    </h4>
                </div>
                <div class="col-md-12">
                    <div class="w-100 mb-4 text-primary">


                        <p>
                            You may join this platform, if you are a Counsellor, Psychologist, Therapist, Psychiatrist, Life
                            Coach, Relationship Coach,
                            Wellness Coach, Mindfulness Coach, Meditation Instructor, Yoga Guru, Health Trainer, Healer,
                            Astrologer, Reiki, Tarrot
                            Card reader or any other who provides services for mental, emotional and physical well-being.


                        </p>
                        <p>

                            Coaching for students, academic or sports Teacher, language Teachers, into conducting vocational
                            classes, music Teacher
                            Or from any other field who provides services to students, professionals, home makers, then you
                            all are welcome to
                            Join this platform to extend your services.
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5 class="">
                        Thank You
                    </h5>
                    <div class="w-100 my-4">
                        <a href="{{ url('signup') }}" class="btn btn-warning rounded-pill px-md-5">
                            Apply Now
                        </a>
                    </div>
                    <div class="w-100">
                        <p class="text-primary">
                            If you have any questions, then please feel free to speak with us.
                            Call us up at <a class="text-primary fw-bold" href="tel:+91-8368-623-753">+91-8368-623-753</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
