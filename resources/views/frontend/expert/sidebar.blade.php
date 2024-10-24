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
<div class="d-flex rounded flex-column flex-shrink-0 p-3 bg-light box-shadow-3" style="max-width: 280px;">

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('expert/dashboard') }}" class="nav-link @if (Request::path() == 'expert/dashboard') active @endif"
                aria-current="page">
                <i class="fi fi-ts-house-chimney"></i>
                Dashboard
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('calendar') }}"
                class="nav-link @if (Route::currentRouteName() == 'calendar') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Calendar
            </a>
        </li> --}}
        <li>
            <a href="{{ route('leads') }}"
                class="nav-link @if (Route::currentRouteName() == 'leads') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Leads
            </a>
        </li>

        <li>
            <a href="{{ route('myleads') }}"
                class="nav-link @if (Route::currentRouteName() == 'myleads') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Purchased Leads
            </a>
        </li>
        <li>
            <a href="{{ route('expert_wallet') }}"
                class="nav-link @if (Route::currentRouteName() == 'expert_wallet') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Transactions
            </a>
        </li>
        <li>
            <a href="{{ route('plans') }}"
                class="nav-link @if (Route::currentRouteName() == 'plans') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Plans
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ url('expert/schedules/all/all') }}"
                class="nav-link @if (Route::currentRouteName() == 'schedules') active @endif" aria-current="page">
                <i class="fi fi-ts-hourglass-start"></i>
                Consultation Schedules
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="{{ url('chat') }}" class="nav-link @if (Route::currentRouteName() == 'chat') active @endif"
                aria-current="page">
                <i class="fi fi-ts-hourglass-start"></i>
                Chat with Clients
            </a>
        </li> --}}

        <li>
            <a href="{{ route('expert_photos') }}"
                class="nav-link @if (Route::currentRouteName() == 'expert_photos') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Photos
            </a>
        </li>
        <li>
            <a href="{{ route('expert_reviews') }}"
                class="nav-link @if (Route::currentRouteName() == 'expert_reviews') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Reviews
            </a>
        </li>
        <li>
            <a href="{{ route('expert_profile') }}"
                class="nav-link @if (Route::currentRouteName() == 'expert_profile') active box-shadow-3 @endif ">
                <i class="fi fi-ts-calendar-clock"></i>
                Public Profile
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('expert_edit') }}" class="nav-link @if (Route::currentRouteName() == 'expert_edit') active @endif"
                aria-current="page">
                <i class="fi fi-ts-user-pen"></i>
                Edit Profile
            </a>
        </li>



    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
            id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            {{-- <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                class="rounded-circle me-2"> --}}
            <strong>{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">

            <li><a class="dropdown-item" href="{{ route('setting.expert') }}">Settings</a></li>


            <li>
                {!! Form::open(['route' => 'logout', 'method' => 'POST']) !!}
                <button class="dropdown-item">Sign out</button>
                {!! Form::close() !!}

            </li>
        </ul>
    </div>
</div>
