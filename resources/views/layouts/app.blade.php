<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">

</head>
<body>
    <div id="app">
        
            <!-- ***** Preloader Start ***** -->
            <div id="preloader">
                <div class="jumper">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>  
            <!-- ***** Preloader End ***** -->

            <!-- Header -->
            <header class="">
                <nav class="navbar navbar-expand-lg">
                    <div class="container">
                    <a class="navbar-brand" href="index.html"><h2>CvSU <em>IDO</em></h2></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html">Home
                            <span class="sr-only">(current)</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About Us</a>
                        </li>
                        {{-- @if (auth()->user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="admin/dashboard">Dashboard</a>
                            </li>
                        @endif --}}
                        @auth
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" id="myform">
                                    @csrf
                                    <a class="nav-link" onclick="document.getElementById('myform').submit();">Logout</a>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @endauth

                        </ul>
                    </div>
                    </div>
                </nav>
            </header>

        
            <main>
                @yield('banner')

                @yield('showcase')

                @yield('campuses')

                @yield('documents')
            </main>

            <footer>
                <div class="container">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="inner-content">
                        <p>Copyright &copy; 2020 CVSU - IDO
                        
                    
                        </div>
                    </div>
                    </div>
                </div>
            </footer>

    </div>

        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        {{-- <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
         --}}
        
            <!-- Additional Scripts -->
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/owl.js') }}"></script>
        <script src="{{ asset('js/slick.js') }}"></script>
        <script src="{{ asset('js/isotope.js') }}"></script>
        <script src="{{ asset('js/accordions.js') }}"></script>
        
        
        <script language = "text/Javascript"> 
            cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
            function clearField(t){                   //declaring the array outside of the
            if(! cleared[t.id]){                      // function makes it static and global
                cleared[t.id] = 1;  // you could use true and false, but that's more typing
                t.value='';         // with more chance of typos
                t.style.color='#fff';
                }
            }
        </script>
        
        
</body>
</html>
