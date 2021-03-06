<!DOCTYPE html>
<html>
<head>
		@include('head')
</head>
<body class="blue">
	<div class="navbar-fixed">
	   <nav>
	    <div class="nav-wrapper">
	      <a href="#" class="brand-logo center">@yield('pageTitle')</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a href="/main"><i class="material-icons left">search</i>Search</a></li>
	        @if(!(Auth::guest()))
	        <li><a href="/insert"><i class="material-icons left">add</i>Add Table</a></li>
	        @endif
	        
	        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            {{-- <li><a href="{{ url('/register') }}">Register</a></li> --}}
                        @else
                            <li>
                                <a href="#">
                                    {{ Auth::user()->name }} 
                                </a>
                            </li>
                               
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                             </li>
              @endif

	      </ul>
	        @yield('navExtensions')
	    </div>
	  </nav>
  </div>

	<div id="loader-wrapper">
			<div id="loader"></div>

			<div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

		</div>

<div class="container">
		@yield('content')
		@yield('pageHeader')

		<div id="formCard" class="row" style="margin-top: 10vh">
			<div class="card-panel hoverable gray text-black  col s12 ">
				@yield('form')
			</div>
		</div>
		<div class="row">
			<div id="board" class="card col s12 " style="font-size: 30px">
			<div id="loadResults" class="col s12" style="display: none; text-align: center;margin-top: 20%"><img src="/38.gif" ></div>
				@yield('board')
 			</div>
		</div>

		
</div>
	<script type="text/javascript" src="{{ asset('js/mainViewFunctions.js') }}"></script>	




</body>
</html>

