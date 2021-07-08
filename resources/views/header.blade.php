<header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="{{ asset('asset/lte/images/logo_thaitea.png')}}" width="150px" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="{{ asset('asset/lte/images/logo_thaitea.png')}}" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">

                    <div class="user-area dropdown float-right">
                            
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('asset/lte/images/admin.jpg')}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            @if(\Session::has('nama'))
                                @if(\Session::has('id'))
                                    <a class="nav-link" href="../profile/{{ Session::get('id') }}"><i class="fa fa-user"></i>{{ Session::get('nama') }}</a>
                                @endif
                            @endif
                            <a class="nav-link" href="../logout"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>