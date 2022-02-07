<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Stock</title>
  <link rel="icon" href="{{ asset('assets') }}/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets') }}/css/styles.min.css?v=1.2.0" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
          <img src="{{ asset('assets') }}/img/brand/logo-purple.png" class="navbar-brand-img" alt="Logo">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            {{-- Check if the logged user is an admin. The isAdmin directive 
              is a custome blade directive the we defined in AppService Provider --}}
            @isAdmin(session('Role_id'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt text-primary"></i>
                    <span class="nav-link-text">Dashboard</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('invoices') }}">
                    <i class="fas fa-file-invoice text-orange"></i>
                    <span class="nav-link-text">Invoices</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('suppliers') }}">
                    <i class="fas fa-users text-yellow"></i>
                    <span class="nav-link-text">Suppliers</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('employees') }}">
                    <i class="ni ni-badge text-info"></i>
                    <span class="nav-link-text">Employees</span>
                  </a>
                </li>
            @endisAdmin
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('shipments') }}">
                    <i class="ni ni-delivery-fast text-default"></i>
                    <span class="nav-link-text">Shipments</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('products') }}">
                    <i class="fas fa-boxes text-purple"></i>
                    <span class="nav-link-text">Products</span>
                  </a>
                </li>
          </ul>
          <!-- Separator -->
          <hr class="my-3">
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="mailto:mohsin.baadi99@gmail.com" target="_blank">
                <i class="ni ni-support-16"></i>
                <span class="nav-link-text">Support</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" target="_blank">
                <i class="ni ni-chart-pie-35"></i>
                <span class="nav-link-text">Plugins</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}">
                <i class="ni ni-user-run"></i>
                <span class="nav-link-text">Log out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto " style="margin-left:auto;">
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                <!-- List group -->
                <div class="list-group list-group-flush">
                  <span class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="badge badge-dot mr-4">
                          <i class="bg-warning"></i>
                          <span class="status">Product A is low in stock.<a class="text-blue" href="{{ route('shipments.add') }}"> Order it</a></span>
                        </span>
                      </div>
                    </div>
                  </span>
                  <span class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="badge badge-dot mr-4">
                          <i class="bg-success"></i>
                          <span class="status">Shipment #1000 has been arrived</span>
                        </span>
                      </div>
                    </div>
                  </span>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-single-02"></i>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <a href="{{ route('profile') }}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Activity</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Support</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--Content -->
    @yield('content')
    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center mr-0">
          <div class="col-lg-12">
            <div class="copyright text-center text-muted">
              &copy; {{ date('Y') }} <span class="font-weight-bold ml-1">Stock</span>
            </div>
          </div>
        </div>
    </footer>
    </div>
  </div>
  <!-- Scripts -->
  <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>
  <script src="{{ asset('assets') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/chart.js/dist/Chart.extension.js"></script>
  <script src="{{ asset('assets') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ asset('assets') }}/js/scripts.min.js?v=1.2.0"></script>
</body>

</html>