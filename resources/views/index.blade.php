
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}"> --}}

    <title>Titre</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    @vite(['resources/js/app.js'])

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ asset('js/select2.min.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0; // remove the gap so it doesn't close
        }
        .dataTables_filter {
            margin-top : 10px;
            margin-bottom : 10px;
            float: left;
        }
    </style>
</head>

<body {{-- oncontextmenu='return false' --}} class='snippet-body'>

    <body class="body-pd" id="body-pd">

        <!-- Page Heading -->
        <header class="headercust" id="headercust">
            <div class="header_toggle">
                <i class="fas fa-bars" id="header-toggle"></i>
            </div>
            <div class="titre float-start me-auto ">
                <h3 style="font-weight: bold;">BIENVENUE </h3>
            </div>
            <div class="navbar-nav float-end ">
                <h5 class="fw-bold text-primary">Kassim </h5>
            </div>
        </header>
        <!-- Page Sidebar -->

        <div class="l-navbar" id="nav-bar">
            <nav class="nav nav_">

                <div class="nav_list">
                    <a href="/index"
                        class="nav_link mb-5 mt-3 activee ">
                        <i class='fas fa-home nav_icon ' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Accueil"></i>
                        <span class="nav_name">Accueil</span>
                    </a>

                    <a href="/stocks" class="nav_link  ">
                        <i class='fas fa-warehouse nav_icon' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Stock"></i>
                        <span class="nav_name">Stock</span>
                    </a>

                    <a href="/acquisition"
                        class="nav_link ">
                        <i class='fas fa-laptop nav_icon' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Acquisition"></i>
                        <span class="nav_name">Acquisition</span>
                    </a>

                    <a href="{{ url('/intervention') }}"
                        class="nav_link ">
                        <i class='fas fa-tools nav_icon' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Intervention"></i>
                        <span class="nav_name">Intervention</span>
                    </a>

                    <a href="{{ url('/livraison') }}"
                        class="nav_link ">
                        <i class='fas fa-truck nav_icon fa-2x' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Livraison"></i>
                        <span class="nav_name">Livraison</span>
                    </a>

                    <a href="{{ url('/admin/listuser') }}"
                        class="nav_link ">
                        <i class='fas fa-user-cog nav_icon fa-2x' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Administration"></i>
                        <span class="nav_name">Administration</span>
                    </a>
                </div>
                <div>
                    <a href="/profile" class="nav_link ">
                        <i class='fas fa-user  nav_icon' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Profile"></i>
                        <span class="nav_name">Profile</span>
                    </a>

                    <a href="/logout" class="nav_link">
                        <i class='fas fa-sign-out-alt  nav_icon' data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Déconnexion"></i>
                        <span class="nav_name">Déconnexion</span>
                    </a>
                </div>

            </nav>
        </div>

        <!-- Page Content -->
        <!--Container Main start-->

        <div class="container-fluid  ">
            @yield('content')
        </div>

        @stack('modals')

        @stack('scripts')

        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
        <script>

            $(document).ready(function() {
                $('table.liste').DataTable({
                    "paging": false,
                    "info": false,
                    "searching": true,
                    /* "scrollY": "600px",
                    "scrollCollapse": true, */
                    "filter": true,
                });
            });

        </script>
    </body>

</html>
