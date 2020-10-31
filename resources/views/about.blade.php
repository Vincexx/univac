@extends('layouts.app')


@section('title')
    <title>CvSU Internal Development Office</title>
@endsection

@section('header')
    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
          <div class="container">
              <a class="navbar-brand" href="/"><h2>CvSU <em>IDO</em></h2></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="/">Home
                      </a>
                  </li> 
                  <li class="nav-item active">
                      <a class="nav-link" href="{{ route('about') }}">About Us
                        <span class="sr-only">(current)</span>
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
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">Login</a>
                      </li>
                  @endauth

                  </ul>
              </div>
          </div>
      </nav>
  </header>
@endsection

@section('banner')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text" style="padding: 0">
      <div class="owl-banner owl-carousel">
      <div class="banner-item-01">
          <div class="overlay">
            <div class="text-content">
              <h4>about us</h4>
              <h2>INSTITUTION DEVELOPMENT OFFICE</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
@endsection

@section('showcase')
<div class="best-features about-features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Our Background</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-image">
          <img src="{{ asset('img/accrevisit.jpg') }}" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-content">
            <h4>Who we are &amp; What we do?</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat. Lorem ipsum dolor sit amet, consectetur adipisicing elit.<br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis.</p>
            <ul class="social-icons">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('footer')
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
@endsection