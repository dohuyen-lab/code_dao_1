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
            <li class="nav-item  active ">
                <a href="" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-hand-holding-usd"></span></span>
                    <span>Tài khoản</span>
                </a>
            </li>
            <li class="nav-item">
          <span class="nav-link  collapsed  d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#submenu-app">
            <span>
              <span class="sidebar-icon"><span class="fas fa-table"></span></span>
              Bài đăng
            </span>
            <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
          </span>
                <div class="multi-level collapse " role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item "><a class="nav-link" href=""><span>Danh sách bài đăng</span></a></li>
                        <li class="nav-item "><a class="nav-link" href=""><span>Thêm bài đăng</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a href="" class="nav-link">
                    <span class="sidebar-icon"><span class="far fa-envelope"></span></span>
                    <span>Yêu cầu</span>
                </a>
            </li>

            <li class="nav-item">
          <span class="nav-link  collapsed  d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#submenu-pages">
            <span>
              <span class="sidebar-icon"><span class="far fa-file-alt"></span></span>
              Giao dịch
            </span>
            <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
          </span>
                <div class="multi-level collapse " role="list" id="submenu-pages" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item"><a class="nav-link" href=""><span>Quản lý ví</span></a></li>
                        <li class="nav-item"><a class="nav-link" href=""><span>Giao dịch chờ xử lí</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{"><span>Lịch sử giao dịch</span></a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
