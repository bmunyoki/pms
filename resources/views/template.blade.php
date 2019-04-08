<!doctype html>
<html lang="en">
<head>
    <title>{{ @$title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css"></link>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>

<body class="gray">
    <div id="wrapper">
        <header id="header-container" class="fullwidth dashboard-header not-sticky">
            <div id="header">
                <div class="container">
                    <div class="left-side">
                        <div id="logo">
                            <a href="/dashboard" class="logo" style="color: #fff; line-height: 45px; font-size: 24px;">
                                <img height="70" src="{{ asset('rahaf/logo1.png') }}" alt="Hospital logo">
                            </a>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-side">
                        <div class="header-widget">
                            <div class="header-notifications user-menu">
                                <div class="header-notifications-trigger">
                                    <a href="/dashboard">
                                        <div class="user-avatar status-online">
                                            <img src="{{ asset('img/avatar.png') }}" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="header-notifications-dropdown">
                                    <div class="user-status">
                                        <div class="user-details">
                                            <div class="user-avatar status-online">
                                                <img src="{{ asset('img/avatar.png') }}" alt="">
                                            </div>
                                            <div class="user-name">
                                                {{ @Auth::user()->name }}
                                            </div>
                                        </div>
                                    </div>
                        
                                    <ul class="user-menu-small-nav">
                                        <li>
                                            <a href="/logout">
                                                <i class="icon-material-outline-power-settings-new"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="clearfix"></div>


        <!-- Dashboard Container -->
        <div class="dashboard-container">

            <!-- Dashboard Sidebar -->
            <div class="dashboard-sidebar">
                <div class="dashboard-sidebar-inner" data-simplebar style="background-color: #2b2c2d;">
                    <div class="dashboard-nav-container">
                        <a href="/dashboard" class="dashboard-responsive-nav-trigger">
                            <span class="hamburger hamburger--collapse" >
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </span>
                            <span class="trigger-title">Dashboard Navigation</span>
                        </a>
                        <div class="dashboard-nav">
                            <div class="dashboard-nav-inner">
                                <ul data-submenu-title="">
                                    @if(Auth::user()->type == 'Patient')
                                        <li>
                                            <a href="/patients/appointments">
                                                <i class="icon-material-outline-dashboard"></i>
                                                Appointments
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/doctors/all">
                                                <i class="icon-material-outline-dashboard"></i>
                                                Doctors
                                            </a>
                                        </li>
                                    @elseif(Auth::user()->type == 'Doctor')
                                        <li>
                                            <a href="/doctor/appointments">
                                                <i class="icon-material-outline-dashboard"></i>
                                                Appointments
                                            </a>
                                        </li>
                                    @elseif(Auth::user()->type == 'Lab')
                                        <li>
                                            <a href="/lab/waiting">
                                                <i class="icon-material-outline-dashboard"></i>
                                                Appointments
                                            </a>
                                        </li>
                                    @elseif(Auth::user()->type == 'Admin')
                                        <li>
                                            <a href="/admin/report">
                                                <i class="icon-material-outline-dashboard"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                    @endif
                                </ul>

                                <ul data-submenu-title="Account">
                                    @if(Auth::user()->type == 'Patient')
                                    <li>
                                        <a href="/settings">
                                            <i class="icon-material-outline-settings"></i> 
                                            Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/change-password">
                                            <i class="icon-material-outline-lock"></i> 
                                            Change Password
                                        </a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="/logout">
                                            <i class="icon-material-outline-power-settings-new"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Right Navigation bar -->


            <!-- Content Section -->
            <div class="dashboard-content-container" data-simplebar>
                <div class="dashboard-content-inner" id="app" style="min-height: 500px;">
                    @yield('content')
            
                    <!-- Footer -->
                    <div class="dashboard-footer-spacer"></div>
                        <div class="small-footer margin-top-15">
                            <div class="small-footer-copyrights">
                                © 2019 <strong>PMS</strong>. All Rights Reserved.
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- End Wrapper -->

        <!-- Scripts
        ================================================== -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>

        <script src="{{ asset('js/jquery-migrate-3.0.0.min.js') }}"></script>
        <script src="{{ asset('js/mmenu.min.js') }}"></script>
        <script src="{{ asset('js/tippy.all.min.js') }}"></script>
        <script src="{{ asset('js/simplebar.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-slider.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('js/snackbar.js') }}"></script>
        <script src="{{ asset('js/clipboard.min.js') }}"></script>
        <script src="{{ asset('js/counterup.min.js') }}"></script>
        <script src="{{ asset('js/magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/slick.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        @yield('scripts')

        <!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
        <script>
            $csrf_token = "{{ csrf_token() }}";
            // Snackbar for user status switcher
            $('#snackbar-user-status label').click(function() { 
                Snackbar.show({
                    text: 'Your status has been changed!',
                    pos: 'bottom-center',
                    showAction: false,
                    actionText: "Dismiss",
                    duration: 3000,
                    textColor: '#fff',
                    backgroundColor: '#383838'
                }); 
            }); 
            
            $(document).ready(function(){
                // Refresh page
                $('.reloadPage').click(function(e){
                    e.preventDefault();
                    location.reload();
                });

                $('.table').DataTable({
                    "aoColumnDefs": [{ "bSortable": false}]
                });
            });

        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>