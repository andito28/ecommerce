
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <link rel="apple-touch-icon" href="{{asset('material/assets/images/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('material/assets/images/favicon.ico')}}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('material/global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('material/global/css/bootstrap-extend.min.css')}}">
    <link rel="stylesheet" href="{{asset('material/assets/css/site.min.css')}}">
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
       <!-- jQuery -->
       <script src="//code.jquery.com/jquery.js"></script>
       <!-- DataTables -->
       <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>





    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('material/global/fonts/material-design/material-design.min.css')}}">
    <link rel="stylesheet" href="{{asset('material/global/fonts/brand-icons/brand-icons.min.css')}}">

    <!--[if lt IE 9]>
    <script src="global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="global/vendor/media-match/media.match.min.js"></script>
    <script src="global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{asset('material/global/vendor/breakpoints/breakpoints.js')}}"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition dashboard">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

      <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
          data-toggle="menubar">
          <span class="sr-only">Toggle navigation</span>
          <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <img class="navbar-brand-logo" src="{{asset('material/assets/images/logo.png')}}" title="Remark">
          <span class="navbar-brand-text hidden-xs-down"> My Ecommerce</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
          data-toggle="collapse">
          <span class="sr-only">Toggle Search</span>
          <i class="icon md-search" aria-hidden="true"></i>
        </button>
      </div>

      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-float" id="toggleMenubar">
              <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
              </a>
            </li>

            <li class="nav-item hidden-float">
              <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                role="button">
                <span class="sr-only">Toggle Search</span>
              </a>
            </li>
          </ul>
          <!-- End Navbar Toolbar -->

          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="{{asset('material/global/portraits/5.jpg')}}" alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="icon md-notifications" aria-hidden="true"></i>
                <span class="badge badge-pill badge-danger up">5</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header">
                  <h5>NOTIFICATIONS</h5>
                  <span class="badge badge-round badge-danger">New 5</span>
                </div>


                <div class="dropdown-menu-footer">
                  <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                    <i class="icon md-settings" aria-hidden="true"></i>
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    All notifications
                  </a>
                </div>
              </div>
            </li>

          </ul>
          <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
          <form role="search">
            <div class="form-group">
              <div class="input-search">
                <i class="input-search-icon md-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="site-search" placeholder="Search...">
                <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                  data-toggle="collapse" aria-label="Close"></button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Site Navbar Seach -->
      </div>
    </nav>    <div class="site-menubar">
      <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-category"></li>
              <li class="site-menu-item">
                <a class="animsition-link" href="{{route('dashboard')}}">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                    </a>
              </li>
              <li class="site-menu-item has-sub">
                <a href="{{route('product')}}">
                        <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                        <span class="site-menu-title">Product</span>
                </a>
              </li>

              <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon md-google-pages" aria-hidden="true"></i>
                        <span class="site-menu-title">Categori</span>
                        {{-- <span class="site-menu-arrow"></span>

                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                              <a class="animsition-link" href="layouts/menu-collapsed.html">
                                <span class="site-menu-title">Menu Collapsed</span>
                              </a>
                            </li>
                        </ul> --}}
                </a>
              </li>

             </ul>
              </li>
            </ul>
         </div>
        </div>
      </div>
    </div>


    <!-- Page -->
    <div class="page">
      <div class="page-content container-fluid">
        <div class="row">
                @yield('content')
        </div>
      </div>
    </div>
    <!-- End Page -->


    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© 2018 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
      <div class="site-footer-right">
        Crafted with <i class="red-600 icon md-favorite"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
      </div>
    </footer>
    <!-- Core  -->
    <script src="{{asset('material/global/vendor/babel-external-helpers/babel-external-helpers.js')}}"></script>
    {{-- <script src="{{asset('material/global/vendor/jquery/jquery.js')}}"></script> --}}
    <script src="{{asset('material/global/vendor/popper-js/umd/popper.min.js')}}"></script>
    <script src="{{asset('material/global/vendor/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('material/global/vendor/animsition/animsition.js')}}"></script>
    <script src="{{asset('material/global/vendor/mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('material/global/vendor/asscrollbar/jquery-asScrollbar.js')}}"></script>
    <script src="{{asset('material/global/vendor/asscrollable/jquery-asScrollable.js')}}"></script>
    <script src="{{asset('material/global/vendor/ashoverscroll/jquery-asHoverScroll.js')}}"></script>
    <script src="{{asset('material/global/vendor/waves/waves.js')}}"></script>

    <!-- Plugins -->


    <!-- Scripts -->
    <script src="{{asset('material/global/js/Component.js')}}"></script>
    <script src="{{asset('material/global/js/Plugin.js')}}"></script>
    <script src="{{asset('material/global/js/Base.js')}}"></script>
    <script src="{{asset('material/global/js/Config.js')}}"></script>

    <script src="{{asset('material/assets/js/Section/Menubar.js')}}"></script>
    <script src="{{asset('material/assets/js/Section/GridMenu.js')}}"></script>
    <script src="{{asset('material/assets/js/Section/Sidebar.js')}}"></script>
    <script src="{{asset('material/assets/js/Section/PageAside.js')}}"></script>
    <script src="{{asset('material/assets/js/Plugin/menu.js')}}"></script>

    <script src="{{asset('material/global/js/config/colors.js')}}"></script>
    <script src="{{asset('material/assets/js/config/tour.js')}}"></script>
    <script>Config.set('assets', 'assets');</script>

    <!-- Page -->
    <script src="{{asset('material/assets/js/Site.js')}}"></script>
    <script src="{{asset('material/assets/examples/js/dashboard/v1.js')}}"></script>

  </body>
</html>
