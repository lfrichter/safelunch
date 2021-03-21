<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <meta name="description" content="@yield('meta_description', config('app.name'))">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
        <style>

        </style>
        @stack('after-styles')
    </head>
    <body>
        <div id="app" class="flex-center position-ref full-height">
            <div class="top-right links">
                {{-- @auth
                    @if ($logged_in_user->isUser())
                        <a href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a>
                    @endif

                    <a href="{{ route('frontend.user.account') }}">@lang('Account')</a>
                @else
                    <a href="{{ route('frontend.auth.login') }}">@lang('Login')</a>

                    @if (config('boilerplate.access.user.registration'))
                        <a href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
                    @endif
                @endauth --}}
            </div><!--top-right-->

            <div class="content">
                @include('includes.partials.messages')

                <div class="m-b-md">
                    {{-- <authority-component route="{{ route('search') }}" /> --}}

                    <div class="container">
                        <div class="row justify-content-center p-5">

                            <div class="row">
                                <div class="col-md-12 mb-2 p-0">

                                    {{-- <form action="{{ route('establishments.search') }}" method="get" id="search-form"> --}}
                                        {{-- @csrf --}}

                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-search-icon" id="filter-icon"><a href=""><i class="fa fa-search"></i></a></span>
                                            </div>
                                            <input type="search" id="search" name="search" placeholder="Type city or region and press enter to find safe food" value="{{ $search }}" class="form-control input-search">


                                        </div>

                                    {{-- </form> --}}

                                    <hr>
                                    {{-- <div id="demo_info" class="box"></div> --}}


                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            {{ $establishments->links() }}
                                        </div>
                                    </div> --}}

                                    <table id="establishments" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>id</th>
                                                <th>Location</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Address</th>
                                                <th>Postcode</th>
                                                <th class="text-center">Rating</th>
                                            </tr>
                                        </thead>
                                        {{--  <tbody>
                                            @foreach ($establishments as $establishment)
                                            <tr>
                                                <td>{{ $establishment->name }}</td>
                                                <td>{{ $establishment->business_name }}</td>
                                                <td>{{ $establishment->business_type }}</td>
                                                <td>{{ $establishment->address_line_1 }}, {{ $establishment->address_line_2 }}, {{ $establishment->address_line_3 }}</td>
                                                <td>{{ $establishment->postcode }}</td>
                                                <td class="text-center">{{ $establishment->rating_value }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>  --}}
                                    </table>

                                </div>
                            </div>

                            {{-- <establishments-component :establishments="establishments"/> --}}
                        </div>
                    </div>


                </div>

            </div><!--content-->
        </div><!--app-->

        <input type="hidden" id="route" value="{{ route('api.establishments.search') }}">

        @stack('before-scripts')
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script>
            //const searchForm = document.getElementById('search-form');
            //const searchInput  = searchForm.querySelector('input[name=search]');
            //searchInput.addEventListener('keyup', processSearchForm);
            //function processSearchForm(e) {
            //    e.preventDefault();
                //e.code;
            //}
            // name="_token"

            $(document).ready(function() {
                var table = $('#establishments').DataTable({
                        ajax: {
                            "url": $('#route').val(),
                            "dataSrc": ""
                        },
                        //$('#route').val() + '?search=' + $('#search').val(),
                        //    "dataSrc":'',
                        "columns": [
                            { "data": "id" },
                            { "data": "authority_id" },
                            { "data": "name" },
                            { "data": "business_name" },
                            { "data": "business_type" },
                            { "data": "full_address" },
                            { "data": "postcode" },
                            { "data": "rating_value" }
                        ],
                        "bProcessing": true,
                        'language': {
                            'loadingRecords': '&nbsp;',
                            'processing': 'Loading...'
                        },
                        "columnDefs": [
                            { "visible": false, "targets": 0 },
                            { "visible": false, "targets": 1 },
                        ]

                      });

                updateRoute = function() {
                    table.ajax.url($('#route').val() + '/' + $('#search').val());
                }

                $('#search').on('keyup', function(){
                    if($(this).val().length >= 3){
                       updateRoute();
                       table.ajax.reload();
                    }
                });
            } );
        </script>
        @stack('after-scripts')
    </body>
</html>
