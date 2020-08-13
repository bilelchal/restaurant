<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- X-CSRF-TOKEN au niveau blade payements.index -->

    @yield('extra-meta')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Script extra concernat la strip js de payement -->
    @yield('extra-script')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Librairie jQuery -->
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>

    <!-- JavaScript de l'application -->
    <script src="{{ asset('js/utilities.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
     
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/css/normalize-3.0.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css/font-awesome-4.3.0.min.css') }}">


    <!-- Feuilles de styles de l'application -->
    <link rel="stylesheet" href="{{ asset('css/css/3wa-resto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css/ui-button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css/ui-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css/ui-table.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

   
</head>
<body>
<header>
<div>
    <a href="{{ url('/') }}"><img src="{{ asset('images/logo.gif') }}" height="63" width="57" alt="3WA Restaurant">Restaurant - Made In America !</a>

</div>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                       
                    </ul>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="button button-primary" href="{{ route('login') }}">{{ __('connexion') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item ml-2">
                                    <a class="button button-primary" href="{{ route('register') }}">{{ __('creer un compte') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="nav-link active" href="{{ url('booking/create') }}">Booking</a>

                                    @can('create','App\User')

                                    <a class="nav-link active" href="{{ url('admin/show') }}">AdminUser</a>

                                    <a class="nav-link active" href="{{ url('order/show') }}">Liste de commande</a>

                                    <a class="nav-link active" href="{{ url('meals') }}">Commander</a>
                                    
                                     @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
</header>


        <main class="py-4">
            <a href="{{ route('cart.index') }}">Panier <span class="badge-dark" >{{ Cart::count() }}</span></a>
            @yield('content')
        </main>
    </div>
    <!-- Pied de page commun -->
<footer>
    <ul class="link-list">
        <li><img src="{{ asset('images/payment/visa.png') }}" alt="Visa"></li>
        <li><img src="{{ asset('images/payment/mastercard.png') }}" alt="MasterCard"></li>
        <li><img src="{{ asset('images/payment/paypal.png') }}" alt="PayPal"></li>
    </ul>
    <small>Réalisé avec <i class="fa fa-heart"></i> &nbsp; par les élèves de la 3W Academy</small>
</footer>
<!-- Code principal JavaScript de l'application -->
<script src="{{asset('js/main.js') }}"></script>
<!-- extra js pour la parti payement avec strip-->
@yield('extra-js')

</body>
</html>
