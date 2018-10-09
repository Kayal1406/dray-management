<!--header css-->
<nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="http://static1.squarespace.com/static/5693040d1c1210fdda3bfe69/t/56ace0354d088eb3998c608b/1524776404667/?format=1500w" class="img-fluid"/>
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
                @if(Request::url()==url('/home'))
                <li class="mr-3">
                    <button type="submit" data-toggle="modal" class="btn btn-outline-light" data-target="#uploadshipmodel"> <i class="fas fa-file-upload"></i>&nbsp;Upload</button>
                </li>
                {{-- <li>
                    <a data-toggle="modal" class="nav-link" data-target="#uploadshipmodel"><i class="fas fa-user-plus"></i>

&nbsp;Create</a>
                </li> --}}
                <li class="nav-item dropdown">
                        <a id="navbarDropdownmail" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Mailbox
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('inbox') }}">
                                <i class="fa fa-inbox"></i>&nbsp;Inbox
                            </a>
                            <a class="dropdown-item" href="{{ url('sentmaillist') }}">
                                <i class="fa fa-envelope"></i>&nbsp;Sentmail
                            </a>
                            <!--Check for Admin Users-->
                                @if( Auth::user()->is_admin==1)
                                    <a class="dropdown-item" href="{{ url('compose') }}">
                                    <i class="fas fa-envelope-open"></i>&nbsp;Compose Mail
                                    </a>
                                @endif
                        </div> 
                    </li>
                    @endif                
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user"></i>&nbsp;
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>&nbsp;
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div> 
                    </li>
            </ul>
        </div>
    </div>
</nav>