@extends('frontend.main')
@section('content')
    <style>
        .moving-text-container {
            white-space: nowrap;
        }

        .moving-text {
            animation: moveLeft 30s linear infinite;
            color: #077773;
            width: 100%;
            text-align: center;
        }

        .testimonial-item {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            /* or specify a height value like 300px */
            padding: 20px;
            /* adjust padding as needed */
            text-align: center;
            /* centers the text horizontally within the container */
        }

        .text-white {
            margin: 0;
        }

        @keyframes moveLeft {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }
    </style>
    <section class="pb-md-0 pb-5">
        <div class="container space">
            <div class="row align-items-start">
                <div class="col-md-12">
                    <h1 class="text-warning">
                        <small> Counselling and Coaching platform for mental & emotional
                            well-being
                        </small>
                    </h1>
                    <p class="main-para text-primary">Edha is a professional services platform</p>
                </div>
                <div class="col-md-6">
                    <div class="w-100">


                        <div class="">
                            @include('frontend.questions')
                        </div>

                    </div>

                </div>
                <div class="col-md-6 mb-md-0 mb-4">
                    <div class="w-100  home-content px-4" dta-aos="flip-left">
                        <h4 class="text-warning">
                            Our Service Offerings include :
                        </h4>
                        <ul class="text-start offeringsul">
                            <li>
                                <strong> Counselling : </strong> through experienced Psychologists, Therapists, Counsellors
                            </li>
                            <li>
                                <strong> Coaching :</strong> through certified Life Coaches, Performance or Relationship
                                Coaches, Leaders &
                                Experts from respective fields
                            </li>
                            <li>
                                <strong> Others :</strong> Academic Coaching, Tuitions, Music Classes, Spirituality,
                                Meditation, Yoga,
                                Mindfulness, Hypnotherapy, Healing, Astrology, Tarot Card reading, Fitness by Experts, and
                                others
                            </li>
                            <li>
                                Receive free call from Professionals and seek services.

                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-md-12 text-center mx-3 mt-5">
                    <h4 class="text-warning">
                        Why choose edha ?
                    </h4>
                    <h5 class="main-para text-primary">One of Bharat’s largest professional services platform</h5>
                    <div class="text-primary d-flex gap-2 flex-wrap justify-content-center featuresspan position-relative">
                        <span>
                            CONNECT WITH PROFESSIONALS
                        </span>
                        <span>
                            EASY TO CONNECT
                        </span>
                        <span>
                            BEST PSYCHOLOGISTS
                        </span>
                        <span>
                            BEST EXPERTS
                        </span>
                        <span>
                            BEST SUPPORT TEAM
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('frontend.how_it_works')
    <section class="space">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="text-warning">Edha : Key benefits</h3>
                    </div>
                </div>
            </div>
            <div class="row" dta-aos="fade-up">
                <div class="col-md-6">
                    <div class="w-100 keybenefit">
                        <ul>
                            <li>
                                Share your requirements
                            </li>
                            <li>
                                Ask for a Call back from Experts
                            </li>
                            <li>
                                Choose your preferred language for Therapy or professional consultation
                            </li>
                            <li>
                                Best therapy by Psychologists, Therapists, Counsellors
                            </li>
                            <li>
                                Experienced PAN India Counsellors, Psychologists & Therapists
                            </li>
                            <li>
                                Professionals from varied fields to consult with
                            </li>
                            <li>
                                Quick Support Team for any assistance
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="https://youtu.be/QmnqWw2LHgM" target="_blank">
                                <div
                                    class="w-100 youtubevideo position-relative box-shadow-2 rounded-3 overflow-hidden h-100">
                                    <img src="{{ url('public') }}/assets/img/online_session.jpeg" alt="book_session"
                                        class="img-fuid w-100 h-100 ">
                                    <div class="playBtn">
                                        <i class="fa-regular fa-circle-play"></i>
                                    </div>
                                </div>
                            </a>
                            <h4 class="text-warning pt-3 text-center">Video : About Mental Health</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="text-warning">
                            about edha
                        </h3>
                    </div>
                    <p class="text-primary">
                        India’s professional service platform from Experts, for mental and emotional well-being.
                        Platform to connect with Professionals from varied fields for better experiences of life.
                        Discover a bouquet of support services through <a class="text-decoration-underline text-primary"
                            href="{{ url('/') }}">Edha</a> .
                    </p>
                    <p class="text-primary">
                        Platform offers, Mental Health Counseling, Stress Management, Anxiety Relief, Depression Support,
                        and Relationship counseling as provided by top Psychologists, Therapists, Counsellors. Our Experts
                        facilitate and guide you with empathy and care in your tough times or life challenges, guiding you
                        through, work with you with proven techniques to make you feel better and for better experiences of
                        life.
                    </p>
                    <p class="text-primary">
                        Trust Edha for a holistic well-being.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="space">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="text-warning">
                            Our Offerings
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between flex-wrap ">
                        <div class="offerbox">
                            <div class="w-100 h-100 text-center">
                                <div class="circle bg-primary p-3 rounded-circle bg-primary">
                                    <img src="{{ url('public') }}/assets/img/adv-1.svg" alt="Mental Health Therapist"
                                        class="img-fluid">
                                </div>
                                <div class="w-100">
                                    <h4 class="mb-0 text-primary">
                                        Counselling
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="offerbox">
                            <div class="w-100 h-100 text-center">
                                <div class="circle bg-primary p-3 rounded-circle bg-primary">
                                    <img src="{{ url('public') }}/assets/img/adv-2.svg" alt="" class="img-fluid">
                                </div>
                                <div class="w-100">
                                    <h4 class="mb-0 text-primary">
                                        Coaching
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="offerbox">
                            <div class="w-100 h-100 text-center">
                                <div class="circle bg-primary p-3 rounded-circle bg-primary">
                                    <img src="{{ url('public') }}/assets/img/adv-3.svg" alt="" class="img-fluid">
                                </div>
                                <div class="w-100">
                                    <h4 class="mb-0 text-primary">
                                        Others
                                    </h4>
                                </div>

                            </div>
                        </div>
                        <div class="offerbox">
                            <div class="w-100 h-100 text-center">
                                <div class="circle bg-primary p-3 rounded-circle bg-primary">
                                    <img src="{{ url('public') }}/assets/img/adv-4.svg" alt="" class="img-fluid">
                                </div>
                                <div class="w-100">
                                    <h4 class="mb-0 text-primary">
                                        Expert Talks
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space services">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="text-warning">
                            There are ways to overcome situations
                        </h3>
                        <p class="text-primary">
                            With our experienced professionals, we put in our best, to make you, feel good.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row" dta-aos="fade-up">
                <div class="col-md-6 order-md-1 order-2">
                    <div class="w-100 h-100 py-5">
                        <h4>
                            Counselling
                        </h4>
                        <p>
                            Our competent Counsellors and Therapists are experienced professionals who assist and facilitate
                            to resolution of personal, social, or psychological problems and difficulties, through
                            appropriate methodologies. This is done by building trust with our Clients, listening to them,
                            and paying attention to what they think and feel in the most suitable environment,
                            confidentially, and with the most appropriate professional ethics. You may get in touch with
                            Psychologists near me and Mental Health Therapist.
                        </p>
                        <p>
                            Would you like to <a href="{{ url('find-expert') }}" class="text-warning">
                                connect and speak
                            </a> with one of them, today ?
                        </p>
                    </div>
                </div>
                <div class="col-md-6 order-md-2 order-1">
                    <div class="w-100 h-100 imagebox">
                        <img src="{{ url('public') }}/assets/img/service-1.svg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row" dta-aos="fade-up">
                <div class="col-md-6 order-md-1 order-1">
                    <div class="w-100 h-100 imagebox">
                        <img src="{{ url('public') }}/assets/img/service-2.svg" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 order-md-2 order-2">
                    <div class="w-100 h-100">
                        <h4>
                            Coaching
                        </h4>
                        <p>
                            A Coach facilitates an individual to unlock their potential thus enabling them to meet their
                            personal or professional goals, by themselves. You have all the answers and capabilities, all
                            within; a Coach assists you in making the best of yourself, to be there. Our Coaches facilitate
                            you to look within and assist you in tapping into and giving direction to your perspectives and
                            your way of thinking and subsequent action. Do you have personal or professional goals and wish
                            to realize them?
                            If yes, then please <a href="{{ url('find-expert') }}" class="text-warning">connect and speak
                            </a> with one of <a href="{{ url('find-expert') }}" class="text-warning">our Coaches </a>,
                            today.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="text-warning">
                            edha offers online counseling services for
                        </h3>
                    </div>
                </div>
                <div class="card-group">
                    <div class="col-md-3 px-2 py-2">
                        <div class="card h-100">
                            <img src="{{ url('public') }}/assets/img/anger.jpeg" alt="" class="img-fluid"
                                style="width:100%; height: 175px;object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-warning text-center">Anger</h5>
                                <p class="card-text">You do not produce anger, you become angry. You seem to have lost
                                    control over yourself, when in anger. This can be managed well through online
                                    counseling. Book an appointment with a Psychologist.</p>
                            </div>
                            <div class="card-footer"style="background-color: #077773">
                                <a href="{{ url('counselling/anger') }}" class="text-white">Learn More ... </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 px-2 py-2">
                        <div class="card h-100">
                            <img src="{{ url('public') }}/assets/img/stress.jpeg" alt="" class="img-fluid"
                                style="width:100%; height: 175px;object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-warning text-center">Stress</h5>
                                <p class="card-text">Not everybody gets stressed in the same manner. It is all about how
                                    you have started to look at people and situations. An in-depth understanding and shift
                                    in perception can do wonders here. Talk to a Psychologist. </p>
                            </div>
                            <div class="card-footer"style="background-color: #077773">
                                <a href="{{ url('counselling/stress-anxiety-depression') }}" class="text-white">Learn
                                    More ... </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 px-2 py-2">
                        <div class="card h-100">
                            <img src="{{ url('public') }}/assets/img/anxiety.jpeg" alt="" class="img-fluid">
                            <div class="card-body">
                                <h5 class="card-title text-warning text-center">Anxiety / Depression</h5>
                                <p class="card-text">You may become anxious in situations or otherwise. Are you feeling low
                                    in energy, feel sad and this has been happening for a longer duration of time then you
                                    should speak with a Psychologist for depression counseling. </p>
                            </div>
                            <div class="card-footer"style="background-color: #077773">
                                <a href="{{ url('counselling/stress-anxiety-depression') }}" class="text-white">Learn
                                    More ... </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 px-2 py-2">
                        <div class="card h-100">
                            <img src="{{ url('public') }}/assets/img/relationship.jpeg" alt=""
                                class="img-fluid">
                            <div class="card-body">
                                <h5 class="card-title text-warning text-center">Relationship</h5>
                                <p class="card-text">The key to a healthy relationship is trust, communication, respect,
                                    attention, care, and affection. If you see a miss and you have not been able to handle
                                    it by yourself, then please talk to a Therapist for relationship counseling. </p>
                            </div>
                            <div class="card-footer"style="background-color: #077773">
                                <a href="{{ url('counselling/relationship') }}" class="text-white">Learn More ... </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="w-100 d-block my-3" align = "center">
                    <a href="{{ url('find-expert') }}"
                        class="btn btn-1 text-warning border-warning rounded-pill px-md-5 position-relative">
                        Book Appointment Now <img src="{{ url('public') }}/assets/img/bnt-arrow.svg" alt=""
                            class="img-fluid">

                    </a>
                </div>
            </div>
            <div class="card-group">
                <div class="col-md-3 px-2 py-2">
                    <div class="card h-100">
                        <img src="{{ url('public') }}/assets/img/marriage.jpeg" alt="" class="img-fluid">
                        <div class="card-body">
                            <h5 class="card-title text-warning text-center">Marriage</h5>
                            <p class="card-text">It is all about how two people from different backgrounds come together to
                                stay together. It is the responsibility of both, to make it work. Feel free to speak with a
                                Counsellor for marriage counseling in private. </p>
                        </div>
                        <div class="card-footer"style="background-color: #077773">
                            <a href="{{ url('counselling/marriage') }}" class="text-white">Learn More ... </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 px-2 py-2">
                    <div class="card h-100">
                        <img src="{{ url('public') }}/assets/img/trauma.jpeg" alt="" class="img-fluid">
                        <div class="card-body">
                            <h5 class="card-title text-warning text-center">Trauma</h5>
                            <p class="card-text">It is an emotional response after an unfortunate event. If you are feeling
                                uncomfortable and encountering flashbacks, unpredictable emotions, and other symptoms. Book
                                online counseling for mental health. </p>
                        </div>
                        <div class="card-footer"style="background-color: #077773">
                            <a href="{{ url('counselling/trauma') }}" class="text-white">Learn More ... </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 px-2 py-2">
                    <div class="card h-100">
                        <img src="{{ url('public') }}/assets/img/loss.jpeg" alt="" class="img-fluid">
                        <div class="card-body">
                            <h5 class="card-title text-warning text-center">Loss</h5>
                            <p class="card-text">Gain and loss are a part of life. It could be losing a near or dear one or
                                material loss. If you are finding it difficult to cope with this, please go for an online
                                counseling session with a Psychologist.</p>
                        </div>
                        <div class="card-footer"style="background-color: #077773">
                            <a href="{{ url('counselling/relationship') }}" class="text-white">Learn More ... </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 px-2 py-2">
                    <div class="card h-100">
                        <img src="{{ url('public') }}/assets/img/grief.jpeg" alt="" class="img-fluid">
                        <div class="card-body">
                            <h5 class="card-title text-warning text-center">Grief</h5>
                            <p class="card-text">It is experienced due to significant loss, usually the death of a loved
                                one. Grief includes physiological distress, anxiety, confusion, and apprehension about the
                                future and puts you down. Counselors help you feel better.</p>
                        </div>
                        <div class="card-footer"style="background-color: #077773">
                            <a href="{{ url('counselling/stress-anxiety-depression') }}" class="text-white">Learn More
                                ... </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="w-100 d-block my-3 mb-5" align = "center">
                    <a href="{{ url('find-expert') }}"
                        class="btn btn-1 text-warning border-warning rounded-pill px-md-5 position-relative">
                        Book Appointment Now <img src="{{ url('public') }}/assets/img/bnt-arrow.svg" alt=""
                            class="img-fluid">

                    </a>
                </div>
            </div>
        </div>
        </div>
        <!--<div class="row" dta-aos="fade-up">-->
        <!--    <div class="col-md-6 order-md-1 order-2">-->
        <!--        <div class="w-100 h-100">-->
        <!--            <h4>-->
        <!--                Relaxation Techniques-->
        <!--            </h4>-->
        <!--            <p>-->
        <!--               At times, stress makes you anxious, tensed, or maybe worried, consider meditation. A simple and inexpensive method to restore peace, within. Meditation helps you restore your calm and inner peace, within. Our relaxation techniques or meditation, by our experts, puts you in a deep state of relaxation and a tranquil mind. This helps you settle your internal jumbled thoughts, a cause of overthinking and stress. Thus, meditation has the potential to enhance your physical and emotional well-being.-->
        <!--            </p>-->
        <!--            <p>-->
        <!--                Do you wish to <a href="{{ url('find-expert') }}" class="text-warning">book an-->
        <!--                    online session</a> with one of <a href="{{ url('find-expert') }}"-->
        <!--                    class="text-warning">our experts</a> , now ?-->
        <!--            </p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-md-6 order-md-2 order-1">-->
        <!--        <div class="w-100 h-100 imagebox">-->
        <!--            <img src="{{ url('public') }}/assets/img/service-3.svg" alt="" class="img-fluid">-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="row" dta-aos="fade-up">-->
        <!--    <div class="col-md-6">-->
        <!--        <div class="w-100 h-100 imagebox">-->
        <!--            <img src="{{ url('public') }}/assets/img/service-4.svg" alt="" class="img-fluid">-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-md-6">-->
        <!--        <div class="w-100 h-100">-->
        <!--            <h4>-->
        <!--                Employee Engagement Program-->
        <!--            </h4>-->
        <!--            <p>-->
        <!--               As an Organization, Institution, or Group, you may already have various Training or leadership programs, in-house, to equip your Team Members and Management Team, with the competence and skill sets, to be able to deliver purposefully and effectively. However, at times, it is prudent to have your Teams undergo talks around psychological and behavioral aspects of life. This instills them with a new way of thinking and participating in life. Please feel free to reach out to us for any of your Counselling, Coaching, or related sessions or talks in your Organization-->
        <!--            </p>-->
        <!--            <p>-->
        <!--                Kindly drop in an email at <span class="text-warning">-->
        <!--                    <a href="mailto:ask@edha.life" class="text-warning">-->
        <!--                        ask@edha.life-->
        <!--                    </a>-->
        <!--                </span> and we shall be glad to revert.-->
        <!--            </p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="row position-relative" dta-aos="fade-up">-->

        <!--    <div class="col-md-6 order-md-1 order-2">-->
        <!--        <div class="w-100 h-100">-->
        <!--            <h4>-->
        <!--                Expert Talk  Inspirational Talks-->
        <!--            </h4>-->
        <!--            <p>-->
        <!--                Inspiration is a change in thinking and is intrinsic. Motivation is a change in action, what you do when inspired. At times, one requires little timely inspiration, to keep going. That little nudge or push and the magic begins.-->
        <!--            </p>-->
        <!--            <p>-->
        <!--                If you as an Institution, Organization or any group feels we can add value, then please feel free to  drop in an-->
        <!--                email at <a href="mailto:ask@edha.life" class="text-warning">ask@edha.life</a> and-->
        <!--                we shall get back to you at as possible.-->
        <!--            </p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-md-6 order-md-2 order-1">-->
        <!--        <div class="w-100 h-100 position-relative imagebox">-->
        <!--            <img src="{{ url('public') }}/assets/img/speaker.jpg" alt="" class="img-fluid rounded-2">-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        </div>
    </section>
    <section class="space counselling-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title pb-4">
                        <h3>
                            When would you require Counselling ?
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-8 mb-md-0 mb-4 order-md-1 order-2">
                    <div class="w-100">
                        <p dta-aos="fade-up">
                            In the journey of life, you come across multiple situations, voluntarily or unknowingly. Certain
                            situations or incidences may put you in an uncomfortable state and you do not know how to deal
                            with them effectively or what could be the most appropriate response, so you may consult a
                            Therapist near you.
                        </p>
                        <p dta-aos="fade-up">
                            edha is a mental health platform, designed to facilitate mental and emotional well-being. At
                            Edha, we offer online Counselling and therapy for anxiety, stress, depression, ADHD, OCD, PTSD,
                            relationship concerns, marriage-related, lifestyle, parenting, motherhood, and other concerns
                            through Counsellors, Psychologists, Therapists, and experts from the field.
                        </p>
                        <p dta-aos="fade-up">
                            Certain incidents leave some mental scars and memories and you may find it difficult to come out
                            of it, by yourself that is also when and where you require Counselling, through experienced
                            experts from the field, who help you come out of it, through effective interventions and
                            therapies. Connect with us for post-traumatic stress disorder.
                        </p>
                        <p dta-aos="fade-up">
                            A few of the below signs, if these exist, then you may perhaps consult Psychologists,
                            Counsellors, or Therapists. These symptoms could be, loss of motivation in life, in doing
                            everyday tasks, loss of sleep or appetite, too frequent mood swings, grief or loss of near or
                            dear ones, relationship issues, if you have gone through any physical, mental, or emotional
                            trauma in the past, unable to Concentrate in studies or work, if you use any unhealthy coping
                            methods such as smoke, alcohol to manage stress or anxiety or any other state wherein it appears
                            you have either lost control over self or unable To manage self, the way you used to; then that
                            is the time to consult an expert.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-md-0 mb-4 order-md-2 order-1">
                    <div class="w-100 px-md-4">
                        <img src="{{ url('public') }}/assets/img/service-6.svg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space counselling overflow-hidden">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-8 mb-md-0 mb-4">
                    <div class="w-100">
                        <div class="section-title text-white">
                            <h3>
                                Counselling helps,
                                when you think, <br> you have
                            </h3>
                        </div>
                        <ul class="mb-0 text-white counselling-reasons">
                            <li>
                                Stress or Anxiety
                            </li>
                            <li>
                                Sleep or appetite related concerns
                            </li>
                            <li>
                                Undergoing depression
                            </li>
                            <li>
                                Start to have frequent or perpetual negative thoughts
                            </li>
                            <li>
                                Confidence, self esteem and self worth appears to go down
                            </li>
                            <li>
                                Develop body image issues
                            </li>
                            <li>
                                Start to have panic attacks
                            </li>
                            <li>
                                Have relationship issues, family issues, issues with in-laws
                            </li>
                            <li>
                                Adolescence related
                            </li>
                            <li>
                                Love or marriage related concerns
                            </li>
                            <li>
                                Unable to manage work and work pressure
                            </li>
                            <li>
                                Grief or loss of someone
                            </li>
                            <li>
                                Learning disability
                            </li>
                            <li>
                                Adolescence related concerns
                            </li>
                            <li>
                                ADHD, OCD
                            </li>
                            <li>
                                Anger issues
                            </li>
                            <li>
                                Parenting concerns
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-4 mb-md-0 mb-4">
                    <div class="counselling-figure">
                        <img src="https://img.freepik.com/premium-photo/vertical-full-length-portrait-smiling-contemporary-businessman-talking-african-american-colleague-while-using-computer-white-office-copy-space_236854-29592.jpg"
                            alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="section-title   text-center">
                        <h3>
                            Subscribe
                        </h3>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3">
                    <div class="w-100 text-center">
                        <h4>

                            Get the best blog stories into your inbox.
                        </h4>
                        <form action="{{ url('subscribe') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="email" name="email" id="email" class="form-control">
                                <button class="btn btn-primary">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space features-section">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="w-100">
                        <div class="section-title text-center text-white">
                            <h3>
                                edha believes in service through
                            </h3>
                        </div>


                    </div>
                    <div class="w-100 d-flex flex-column gap-3">
                        <div class="row" dta-aos="fade-up">
                            <div class="col-md-1 col-2">
                                <div class="circle rounded-circle bg-warning">
                                    <img src="{{ url('public') }}/assets/img/icon-1.svg" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-11 col-9">
                                <div class="w-100">
                                    <h5>
                                        Client First
                                    </h5>
                                    <p class="mb-0">
                                        edha is for you and to serve you in the best possible manner.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row" dta-aos="fade-up">
                            <div class="col-md-1 col-2">
                                <div class="circle rounded-circle bg-warning">
                                    <img src="{{ url('public') }}/assets/img/icon-2.svg" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-11 col-9">
                                <div class="w-100">
                                    <h5>
                                        Experts from their Field
                                    </h5>
                                    <p class="mb-0">
                                        edha support is rendered by experienced experts from the field, who are
                                        able to assist you with
                                        your areas of concern, with ease.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row" dta-aos="fade-up">
                            <div class="col-md-1 col-2">
                                <div class="circle rounded-circle bg-warning">
                                    <img src="{{ url('public') }}/assets/img/icon-3.svg" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-11 col-9">
                                <div class="w-100">
                                    <h5>
                                        Ease of mode of Counselling
                                    </h5>
                                    <p class="mb-0">
                                        edha platform has been designed to get you Counselling, Coaching and other
                                        services through online video and audio mode. We shall also be starting face to
                                        face counselling shortly, in a few Cities in India.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row" dta-aos="fade-up">
                            <div class="col-md-1 col-2">
                                <div class="circle rounded-circle bg-warning">
                                    <img src="{{ url('public') }}/assets/img/icon-4.svg" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-11 col-9">
                                <div class="w-100">
                                    <h5>
                                        Complete Confidentiality
                                    </h5>
                                    <p class="mb-0">
                                        Your one on one sessions are exclusive with your Counsellor only and alone. No
                                        one from Organization or otherwisewould get to know about your discussion with
                                        your Counsellor, ever. These are all confidential and are not recorded for any
                                        reason, whatsoever. Complete privacy is maintained when your sessions are on, in
                                        any mode.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row" dta-aos="fade-up">
                            <div class="col-md-1 col-2">
                                <div class="circle rounded-circle bg-warning">
                                    <img src="{{ url('public') }}/assets/img/icon-5.svg" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-11 col-9">
                                <div class="w-100">
                                    <h5>
                                        Our Culture
                                    </h5>
                                    <p class="mb-0">
                                        Respect for all, kindness, integrity, values and principles, work ethics and an
                                        open mind to listen, understand and assist Our Clients, is our way of working at
                                        edha.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <section class="space">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="w-100 section-title text-center" dta-aos="fade-up">
                        <h3 class="text-warning">
                            Articles
                        </h3>
                    </div>
                </div>
                @php
                    $find = [
                        '<p>',
                        '</p>',
                        '<strong>',
                        '</strong>',
                        '<b>',
                        '</b>',
                        '<h1>',
                        '</h1>',
                        '<h2>',
                        '</h2>',
                        '<h3>',
                        '</h3>',
                        '<h4>',
                        '</h4>',
                    ];
                    $rep = ['', '', '', '', '', '', '', '', '', '', '', '', '', ''];

                @endphp
                @foreach ($blogs as $item)
                    <div class="col-md-4 mb-4">
                        <a href="{{ url('article/' . $item['url']) }}" class="text-decoration-none text-secondary">


                            <div class="w-100 blogbox h-100 bg-white shadow" dta-aos="fade-up">
                                <figure class="w-100 d-block">
                                    <img src="{{ url('public') }}/assets/img/{{ $item['image'] }}" alt=""
                                        class="img-fluid w-100">
                                </figure>
                                <div class="w-100 py-2 px-3">
                                    <div class="w-100 mb-4">
                                        <span class="badge px-md-4 py-md-2 rounded-pill bg-warning text-white">
                                            {{ date('d-M-Y', strtotime($item['created_at'])) }}
                                        </span>
                                    </div>
                                    <h4>
                                        {{ $item['title'] }}
                                    </h4>
                                    <div class="w-100">
                                        <p>
                                            {{ str_replace($find, $rep, substr($item['description'], '0', '100')) }}
                                            ...<button class="btn  p-0 text-warning">Read More</button>
                                        </p>

                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
            <div class="row mt-3" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="w-100 text-center">
                        <a href="{{ url('blogs') }}"
                            class="btn btn-outline-warning  btn-all  position-relative px-md-5 rounded-pill">
                            <span>
                                View All
                            </span>
                            <span class="btnicon text-white">
                                &#10230;
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space features-section">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-md-12">
                    <div class="w-100 section-title text-center">
                        <h3 class="text-warning">Testimonial</h3>
                    </div>
                </div>
                <div class="owl-carousel">
                    <div class="testimonial-item">
                        <p class="text-white"><sup><i class="fa fa-quote-left"
                                    style="font-size:20px;color:#f67c33"></i></sup>&nbsp;Dr. George is an amazing
                            therapist. He helped me through my issues with great guidance and his calm demeanor throughout
                            the sessions allow me to open up naturally and have a deep and meaningful conversation with him,
                            which is accelerating my road to recovery.&nbsp;<sub><i class="fa fa-quote-right"
                                    style="font-size:20px;color:#f67c33"></i></sub></p>
                    </div>
                    <div class="testimonial-item vertical-center">
                        <p class="text-white"><sup><i class="fa fa-quote-left"
                                    style="font-size:20px;color:#f67c33"></i></sup>&nbsp;I was under severe depression and
                            desperately wanted counselling. Psychologist at edha really helped me.&nbsp;<sub><i
                                    class="fa fa-quote-right" style="font-size:20px;color:#f67c33"></i></sub></p>
                    </div>
                    <div class="testimonial-item">
                        <p class="text-white"><sup><i class="fa fa-quote-left"
                                    style="font-size:20px;color:#f67c33"></i></sup>&nbsp;I took counseling from a female
                            Therapist and she was very good. I was also given assessment and it was of great
                            help.&nbsp;<sub><i class="fa fa-quote-right" style="font-size:20px;color:#f67c33"></i></sub>
                        </p>
                    </div>
                    <div class="testimonial-item">
                        <p class="text-white"><sup><i class="fa fa-quote-left"
                                    style="font-size:20px;color:#f67c33"></i></sup>&nbsp;I have OCD and immediately wanted
                            to speak with someone. The session was of immense immediate relief.&nbsp;<sub><i
                                    class="fa fa-quote-right" style="font-size:20px;color:#f67c33"></i></sub></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space bg-light">
        <div class="container">
            <div class="row justify-content-center" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="w-100 section-title text-center">
                        <h3 class="text-warning">
                            Videos
                        </h3>
                    </div>
                </div>
                @foreach ($videos as $item)
                    <div class="col-md-4 mb-4">
                        <a href="{{ $item['url'] }}" target="_blank">
                            <div
                                class="w-100 youtubevideo position-relative box-shadow-2 rounded-3 overflow-hidden h-100 ">
                                <img src="{{ url('public/upload/' . $item['image']) }}" alt=""
                                    class="img-fuid w-100 h-100 cover">
                                <div class="playBtn">
                                    <i class="fa-regular fa-circle-play"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach



            </div>
            <div class="row mt-3" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="w-100 text-center">
                        <a href="{{ url('videos') }}"
                            class="btn btn-outline-warning  btn-all  position-relative px-md-5 rounded-pill">
                            <span>
                                View All
                            </span>
                            <span class="btnicon text-white">
                                &#10230;
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space bg-primary">
        <div class="container">
            <div class="row" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="section-title  text-white text-center">
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
                                            class="accordion-button collapsed d-flex align-items-center justify-content-between"
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
                                        <div class="accordion-body">
                                            {!! $item['explain'] !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3" dta-aos="fade-up">
                <div class="col-md-12">
                    <div class="w-100 text-center">
                        <a href="{{ route('faq.findex') }}"
                            class="btn btn-outline-warning text-white btn-all  position-relative px-md-5 rounded-pill">
                            <span>
                                View All
                            </span>
                            <span class="btnicon">
                                &#10230;
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 4,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 2000,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 4
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        });
    </script>
@endsection
@section('meta')
    <meta name="title" content="Online Counseling for Mental Health | Therapist & Psychologist">
    <meta name="keywords"
        content="Counsellors, Psychologists, and Therapists for anxiety, stress, depression, PTSD, relationship concerns, marriage-related, lifestyle, parenting, motherhood-related, Mental Health Therapist  ">
    <meta name="description"
        content="Explore the ease and accessibility of online mental health counseling services. Connect with a mental health therapist for professional guidance and support.">
@endsection
