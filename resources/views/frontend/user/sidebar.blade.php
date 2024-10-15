<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background: #077773;
    }

    .nav-pills .nav-link {
        font-size: 14px;
        font-weight: 400;
        display: flex;
        gap: 10px;
        color: #077773;
    }

    .nav-pills li {
        padding-bottom: 10px;
    }

    .dashboard-title {
        font-size: 14px;
    }
</style>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-thin-straight/css/uicons-thin-straight.css'>
<div class="d-flex rounded flex-column flex-shrink-0 p-3 bg-light box-shadow-3" >

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('user.dashboard') }}"
                class="nav-link @if (Route::currentRouteName() == 'user.dashboard') active box-shadow-3 @endif" aria-current="page">
                <i class="fi fi-ts-house-chimney"></i>
                Dashboard
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('consultation.schedules') }}"
                class="nav-link @if (Route::currentRouteName() == 'consultation.schedules') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Consultation Schedules
            </a>
        </li> --}}
        <li>
            <a href="{{ route('mypackages') }}"
                class="nav-link @if (Route::currentRouteName() == 'mypackages') active box-shadow-3 @endif ">
                <i class="fi fi-ts-bars-sort"></i>
                My Sessions
            </a>
        </li>
        <li>
            <a href="{{ route('mypayments') }}"
                class="nav-link @if (Route::currentRouteName() == 'mypayments') active box-shadow-3 @endif ">
                <i class="fi fi-ts-bars-sort"></i>
                Payments
            </a>
        </li>
        <li>
            <a href="{{ url('chat') }}"
                class="nav-link @if (Route::currentRouteName() == 'chat') active box-shadow-3 @endif ">
                <i class="fi fi-ts-bars-sort"></i>
                Chat With Experts
            </a>
        </li>


    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
            id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            {{-- <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                class="rounded-circle me-2"> --}}
            <strong> {{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="{{ route('setting') }}">Settings</a></li>
            <li>
                {!! Form::open(['route' => 'logout', 'method' => 'POST']) !!}
                <button class="dropdown-item">Sign out</button>
                {!! Form::close() !!}

            </li>
        </ul>
    </div>
</div>
