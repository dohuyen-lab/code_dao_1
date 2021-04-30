<nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="user-avatar lg-avatar mr-4">
                    <img src="" class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h6">Hi, Jane</h2>
                    <a href="../../pages/examples/sign-in.html" class="btn btn-secondary text-dark btn-xs"><span class="mr-2"><span class="fas fa-sign-out-alt"></span></span>Sign Out</a>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse"
                   data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
                   aria-label="Toggle navigation"></a>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
          <span class="nav-link  collapsed  d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#submenu-app">
            <span>
              User Management
            </span>
            <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
          </span>
                <div class="multi-level collapse " role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item "><a class="nav-link" href="{{route('getListStudent')}}"><span>Students</span></a></li>
                        <li class="nav-item "><a class="nav-link" href="{{route('getListTeacher')}}"><span>Teachers</span></a></li>
                        <li class="nav-item "><a class="nav-link" href="{{route('manager.register')}}"><span>Create user account</span></a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item  active ">
                <a href="{{route('getTeacherCalendar')}}" class="nav-link">
                    <span>Course Management</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
