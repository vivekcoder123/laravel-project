<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Assignment</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    @yield('extra_css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('homepage') }}">
                    Homepage
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{route('homepage')}}" class="dropdown-item">Homepage</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="{{url('/admin')}}" style="white-space:nowrap;"> 
          Admin Panel @if(Auth::user()) ( {{ Auth::user()->role }} ) @endif
        </a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>

      <div class="sidebar-menu">
        <ul>
          <li>
            <a href="{{route('admin.mainStatus')}}">Main Status</a>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <span>Posts</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{route('admin.posts.create')}}">Create New Post
                  </a>
                </li>
                <li>
                  <a href="{{route('admin.posts.index')}}">View All Posts</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <span>Users</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{route('admin.users.create')}}">Create New User
                  </a>
                </li>
                <li>
                  <a href="{{route('admin.users.index')}}">View All Users</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">Licenses</a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{route('admin.licenses.create')}}">License Input Page
                  </a>
                </li>
                <li>
                  <a href="{{route('admin.licenses.index')}}">View All Licenses</a>
                </li>
                <li>
                  <a href="{{route('admin.licenses.graph')}}">Licenses Graph</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">Site Credentials</a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="{{route('admin.site-credentials.create')}}">Create Site Credentials
                  </a>
                </li>
                <li>
                  <a href="{{route('admin.site-credentials.index')}}">View All Site Credentials</a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a href="{{route('admin.errors')}}">Errors</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="page-content">
    <div class="container-fluid">
      @yield('content')
      </div>
  </main>
</div>
    </div>
</body>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

    jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});
   
});
</script>
@yield('extra_js')
</html>