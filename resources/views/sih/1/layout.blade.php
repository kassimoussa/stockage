{{-- @php
    use App\Models\User;
    $user = User::where('id', session('id'))->first();
    if (session('level') != $user->level) {
        session()->forget('level');
        session()->put('level', $user->level);
    }
@endphp --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title> {{ $page }} </title>

    @vite(['resources/js/app.js'])

    @livewireStyles
    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/card-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">


    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @stack('scripts')
    <style>
        body {
            background: #f1f2f5;
        }

        .nav_link:hover {
            color: white !important;
            font-weight: bold;
            font-size: 18px;

        }

        .nav_link {
            color: black !important;
            font-size: 18px;
        }

        .activee {
            color: white !important;
            font-weight: bold;
            font-size: 18px;
        }

        .dropdown-item .activee {}

        .main-c {
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 6rem
        }

        .dropdown-menu li {
            position: relative;
        }

        .dropdown-menu .submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu>li:hover>.submenu {
            display: block;
        }

        a {
            text-decoration: none
        }

        .dataTables_filter {
            margin-top: 10px;
            margin-bottom: 10px;
            float: left;
        }
    </style>
</head>

<body {{-- oncontextmenu='return false' --}} class='snippet-body'>

    <!-- Page Heading -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary main-navigation">
        <div class="container-fluid">
            <a class="navbar-brand  mr-auto mr-lg-3 ml-3 ml-lg-0  " href="/index"><img
                    src="{{ asset('images/djibtelogo.png') }}" alt="Accueil" height="36" title="Accueil"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav_link 
                        @if ($pageSlug == 'stocks') {{ 'activee' }} @endif "
                            href="/stocks" {{-- data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Ajouter un nouveau employé" --}}> <i class="fas fa-warehouse mx-1"></i>
                            STOCKS
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link nav_link 
                        @if ($pageSlug == 'create_employe') {{ 'activee' }} @endif "
                            href="/employes/create" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Ajouter un nouveau employé"> <i class="fas fa-laptop mx-1"></i>
                            ACQUISITION
                        </a>
                    </li>--}}

                    <li class="nav-item">
                        <a class="nav-link nav_link 
                        @if ($pageSlug == 'create_employe') {{ 'activee' }} @endif "
                            href="/employes/create" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Ajouter un nouveau employé"> <i class="fas fa-tools mx-1"></i>
                            INTERVENTION
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav_link 
                        @if ($pageSlug == 'create_employe') {{ 'activee' }} @endif "
                            href="/employes/create" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Ajouter un nouveau employé"> <i class="fas fa-truck mx-1"></i>
                            LIVRAISON
                        </a>
                    </li> 


                    {{--    <div class="nav-item dropdown ">

                        <a class="nav-link nav_link  dropdown-toggle @if ($sup == 'employes') {{ 'activee' }} @endif " id="rapport" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-cogs mx-1"></i> ADMIN</a>

                        <ul class="dropdown-menu dropdown-menu-primary bg-primary text-white" aria-labelledby="rapport">
                            <li>
                                <a class="dropdown-item nav_link @if ($pageSlug == 'index_employe') {{ 'activee' }} @endif" href="/employes">
                                    Listes
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item  nav_link @if ($pageSlug == 'create_employe') {{ 'activee' }} @endif" href="/employes/create">
                                    Ajouter
                                </a>
                            </li>
                        </ul>
                    </div>
 --}}

                </ul>

                <div class="d-flex py-1">
                    <div class="nav-item dropdown dropstart ">

                        <h5 class="nav-link nav_link fw-bold   dropdown-toggle " id="user" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{--  {{ $user->name }} --}} <i class="fas fa-user mx-1"></i> Kassim
                        </h5>

                        <ul class="dropdown-menu dropdown-menu-primary bg-primary" aria-labelledby="user">
                            <li>
                                <a class="dropdown-item   nav_link" href="/logout">
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- Page Content -->
    <!--Container Main start-->

    <div class="main-c  mt-10">
        @yield('content')

    </div>


    @stack('modals')

    @stack('scripts')


    <script>
        window.addEventListener('open-edit-modal', event => {
            $(".modal").modal('show');
        })
        window.addEventListener('close-modal', event => {
            $('.modal').modal('hide');
        });

        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });

        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function() {
            $("#myBtn").click(function() {
                $("#myToast").toast("show");
            });
        });

        $(document).ready(function() {
            $('table.liste').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                /* "scrollY": "600px",
                "scrollCollapse": true, */
                "filter": true,
                "order": [
                    [1, 'asc']
                ],
            });
        });
    </script>


    @livewireScripts
    {{-- <script src="{{ asset('js/alpinejs.min.js') }}"></script> --}}
    @yield('script')
</body>

</html>
