<div class="col-md-2 sidebar-mail sidebar-header" id="sidebar">
    <!-- Page Content  -->
    {{-- <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
            </div>
        </nav>
    </div> --}}
    
    @if( Auth::user()->is_admin==1)
    <a href="{{route('compose')}}" class="btn btn-primary btn-block mt-2">Compose</a>
    @endif

    <div class="box box-solid mt-2">
        <nav class="navbar-nav box-body no-padding">
            <ul class="nav flex-column">
            <li class="pt-2 pb-2 nav-item"><a href="{{route('inbox')}}" class="nav-link"><i class="fa fa-inbox"></i> Inbox</a></li>
            <li class="pt-2 pb-2"><a href="{{route('sentmaillist')}}"><i class="fa fa-envelope"></i>Sentmail</a></li>
            </ul>
        </nav>
    <!-- /.box-body -->
    </div>
</div>
<!-- /.col -->