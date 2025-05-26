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
        <link rel="stylesheet" href="{{ asset('assets/css/bootsrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap_limitless.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('assets/css/layout.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('assets/css/components.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{asset('assets/css/colors.min.css') }}"  type="text/css">
        <!-- /Global styling -->

        @yield('css')
        <style>
            .all{
                margin-left: 2rem;
                margin-right: 2rem;
                margin-bottom: 2rem;
            }
        </style>
    </head>
    <body>

        

        @yield('content')


        <!-- Global js -->
        <script src="{{asset('global_assets/js/main/jquery.min.js') }}"></script>
        <script src="{{asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
        <script src="{{asset('global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
        <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.mask.js') }}"></script>
        <script src="{{asset('assets/js/custom.js') }}"></script>
        <!-- /Global js -->

        @yield('js')
        
    </body>
</html>