@extends('layouts.app')


@section('title')
    <title>CvSU Institutional Development Office</title>
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
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('homepage') }}">Home
                      </a>
                  </li> 
                  <li class="nav-item active">
                      <a class="nav-link" href="{{ route('about') }}">About Us
                        <span class="sr-only">(current)</span>
                      </a>
                  </li>
                
                  @if (Auth::check())
                      @if (Auth::user()->role == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                        </li>
                      @endif
                  @endif

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
              <h2>INSTITUTIONAL DEVELOPMENT OFFICE</h2>
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
            <h2>Vision, Mission and Quality Policy</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-content">
            <img src="{{ asset('img/accrevisit.jpg') }}" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-content">
            <h4>Vision</h4>
            <p style="border: none;">The premier university in historic Cavite recognized for excellence in the development of globally competitive and morally upright individuals
            </p>
          </div>
          <div class="left-content">
            <h4>Mission</h4>
            <p style="border: none;">Cavite State University shall provide excellent, equitable and relevant educational opportunities in the arts, sciences and technology through quality instruction and responsive research and development activities. It shall produce professional, skilled and morally upright individuals for global competitiveness.</p>
          </div>
          <div class="left-content">
            <h4>Quality Policy</h4>
            <p style="border: none;">We Commit to the highest standards of education, value our stakeholders, Strive for continual improvement of our products and services, and Uphold the University’s tenets of Truth, Excellence, and Service to produce globally competitive and morally upright individuals.</p>
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