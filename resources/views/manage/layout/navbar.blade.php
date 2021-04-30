<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark pl-0 pr-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex">
                <!-- Search form -->
                <a class="btn btn-default" href="{{route('manager.index')}}">
                    Home
                </a>
            </div>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark mr-lg-3 icon-notifications" data-unread-notifications="true" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small font-weight-bold">
                                        @if (Session::has('user'))
                                        <?php
                                            $user = Session::get('user');
                                            echo $user[0][0]->nom ." ".$user[0][0]->prenom
                                        ?>
                                        @endif
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                        <a class="dropdown-item font-weight-bold" href="{{route('logout')}}"><span class="fas fa-sign-out-alt text-danger"></span>Déconnexion</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
