@extends('layouts.app')

@section('title')
    <title>Login - CvSU - UNIVAC</title>
@endsection

@section('header')
    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
          <div class="container">
              <a class="navbar-brand" href="{{ route('homepage') }}"><h2>CvSU <em>IDO</em></h2></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav ml-auto">
                  <li class="nav-item ">
                      <a class="nav-link" href="{{ route('homepage') }}">Home
                      </a>
                  </li> 
                  <li class="nav-item ">
                      <a class="nav-link" href="{{ route('about') }}">About Us
                        
                      </a>
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
                      <li class="nav-item active">
                          <a class="nav-link" href="{{ route('login') }}">Login
                            <span class="sr-only">(current)</span></a>
                      </li>
                  @endauth

                  </ul>
              </div>
          </div>
      </nav>
  </header>
@endsection

@section('banner')
    <div class="login">
        <div class="container">
            <div class="login-card text-center">
                <div class="title">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                    <h5 class="py-3">CAVITE STATE UNIVERSITY</h4>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                        
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                        value="{{ old('password') }}" required autocomplete="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <input type="submit" value="LOGIN" class="btn btn-success">
                </form>
            

            
            </div>
        </div>
    </div>
@endsection

<style>
   
    .login-card {
        width: 500px;
        -webkit-box-shadow: -5px 9px 25px -8px rgba(0,0,0,0.73);
        -moz-box-shadow: -5px 9px 25px -8px rgba(0,0,0,0.73);
        box-shadow: -5px 9px 25px -8px rgba(0,0,0,0.73);
        padding: 0px 0px 20px 0px;
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -40%);
    }

    .login-card .title{
        background: #f9f9f9;
        padding: 10px 0;
    }

    .login-card .title img{
        width: 80px;
    }

    .login-card .title h5{
        font-weight: bold;
        color: rgb(104, 103, 103);
    }

    .login-card form {
        margin: 20px 0;
        
    }
    .login-card .form-control{
        width: 300px;
        margin-left: 100px;
    }

    .login-card .btn-success{
       background: #34ee3d;
       width: 200px;
       border: none;    
       padding: 10px 0;
       margin: 20px 0;
    }

    footer {
        position: absolute;
        width: 100%;
        top: 100%;
        transform: translateY(-80%);
    }
</style>

@section('footer')
    <footer >
        <div class="container">
            <div class="row">
            <div class="col-md-12 text-center">
                <div class="inner-content">
                <p>Copyright &copy; 2020 CVSU - IDO
                </div>
            </div>
            </div>
        </div>
    </footer>
@endsection