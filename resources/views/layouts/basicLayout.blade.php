<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>
            @hasSection('title')
                {{ config('app.name') }} - @yield('title')
            @else
                {{ config('app.name') }}
            @endif
        </title>

        <!-- Global styling -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link rel="stylesheet" href="{{ asset('global_assets\css\bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{asset('global_assets\css\bootstrap_limitless.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('global_assets\csslayout.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('global_assets\css\components.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('global_assets\css\colors.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('global_assets\css\icons\icomoon\styles.min.css') }}" type="text/css">
        <!-- /Global styling -->

        <!-- Global js -->
        <script src="{{asset('global_assets/js/main/jquery.min.js') }}"></script>
        <script src="{{asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
        <script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{asset('global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
        <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.mask.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets/js/custom.js') }}"></script>
        <!-- /Global js -->

        @yield('css')
        <style>
            html, body {
                margin: 0;
                padding: 0;
                height: 100%;
                overflow-x: hidden; /* Prevents double scrollbars */
                overflow-y: auto;
            }

            .all{
                margin-left: 2rem;
                margin-right: 2rem;
                margin-bottom: 2rem;
            }

            .test-bold{
                font-weight: bold;
            }

            a:hover {
                opacity: 0.7;
                cursor: pointer;
            }

            .navbar {
                position: fixed;
                width: 100%;
            }

            .sidebar:not(:hover) ~.flex-grow-1 .main-content {
                margin-left: 70px;
                transition: margin-left 0.3s ease;
            }

            .sidebar:hover ~.flex-grow-1 .main-content {
                margin-left: 140px;
                transition: margin-left 0.3s ease;
            }

            .card {
                min-width: 250px; /* Prevent cards from becoming too narrow */
                margin: 0 auto; /* Center cards in their columns */
            }

            .main-content{
                margin-top: 72px;
                padding-top: 5px;
            }
        </style>
        @include('layouts.sidebarcss')
    </head>
    <body>
        <div class="wrapper d-flex">
            @unless(request()->is('login'))
                <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
                    @include('layouts.sidebar')
                </div>
            @endunless

            <div class="flex-grow-1">
                @include('layouts.navbar')

                <div class="main-content">
                    @yield('content')
                </div>
            </div>
                

        </div>

        @yield('js')
        
    </body>
</html>