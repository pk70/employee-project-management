@auth
<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">

    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge" id="totalUnreadNotificationsNumber">{{ \App\Models\ProjectAssign::where('assigned_user_id',Auth::user()->id)->count() }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"><label id="totalUnreadNotifications"> </label> Notifications</span>
          <div id="notificationList">
{{--
           @foreach ($data as $items )
           <p class="text-sm">You have assigned project [{{ $items->name }}] by admin.</p>
           @endforeach --}}
          </div>
        <div class="dropdown-divider"></div>
        {{-- <a href="" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
      </div>
    </li>

  </ul>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="badge badge-info">{{ Auth::user()->name }}</span>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </li>

            </ul>

        </div>
    </nav>

@endauth
