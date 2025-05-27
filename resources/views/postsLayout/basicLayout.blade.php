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

        <link rel="stylesheet" href="{{ asset('global_assets\css\bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{asset('global_assets\css\bootstrap_limitless.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('global_assets\csslayout.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('global_assets\css\components.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('global_assets\css\colors.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('global_assets\css\icons\icomoon\styles.min.css') }}" type="text/css">
        <!-- /Global styling -->

        <!-- Global js -->
        <script src="{{asset('global_assets\js\main\jquery.min.js') }}"></script>
        <script src="{{asset('global_assets\js\main\bootstrap.bundle.min.js') }}"></script>
        <script src="{{asset('global_assets\js\plugins\loaders\blockui.min.js') }}"></script>
        <script src="{{asset('global_assets\js\plugins\forms\selects\select2.min.js')}}"></script>
        <script src="{{asset('assets\js\jquery.mask.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets\js\custom.js') }}"></script>
        <!-- /Global js -->

        @yield('css')
        <style>
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

            .dropdown-menu{
                z-index: 999999 !important;
                position: absolute !important;
            }
        </style>
    </head>
    <body>

        @include('postsLayout.navbar')

        @include('postsLayout.sidebar')

        @yield('content')




        @yield('js')
        
    </body>
</html>