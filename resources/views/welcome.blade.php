@extends('layouts.app')


@section('title')
    <title>CvSU Institutional  Development Office</title>
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
                  <li class="nav-item active">
                      <a class="nav-link" href="{{ route('homepage') }}">Home
                      <span class="sr-only">(current)</span>
                      </a>
                  </li> 
                  <li class="nav-item">
                  <a class="nav-link" href="{{ route('about') }}">About Us</a>
                  </li>

                  @if (Auth::check())
                      @if (Auth::user()->role == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="admin/dashboard">Dashboard</a>
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
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
      <div class="banner-item-01">
          <div class="overlay">
            <div class="text-content">
              @auth
                <h5 style="color: #34ee3d;">Welcome, {{ Auth::user()->name }} to</p>
              @endauth
              <h2>CAVITE STATE UNIVERSITY</h4>
              <h4>VIRTUAL ACCREDITATION CENTER</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
@endsection

@section('showcase')
  <div class="best-features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>CvSU at A Glance</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-content">
            <h4>ABOUT OUR OFFICE</h4>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vel repudiandae corporis fugit fugiat, doloribus voluptates facilis ab laboriosam nesciunt magni dignissimos voluptatem! Facere asperiores nam voluptas! Officia commodi illo natus!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam necessitatibus perferendis vero maiores pariatur aut reiciendis facere explicabo esse, fuga, voluptatibus natus ipsum nam dicta voluptas quisquam molestias nulla magni.</p>
            <hr>
            <ul class="nav">
              <li><a href="https://www.facebook.com/CaviteStateU" target="__blank"><i class="fa fa-facebook fa-2x mr-3" aria-hidden="true" style="color: #34ee3d;"></i></a></li>
              <li><a href="https://cvsu.edu.ph/" target="__blank"><i class="fa fa-link fa-2x" aria-hidden="true" style="color: #34ee3d;"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-image">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/_4bQ1Z9gUuA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('campuses')
  <div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>VIRTUAL ACCREDITATION ROOMS OF COLLEGES/CAMPUSES</h2>
          </div>
        </div>

        @foreach ($campuses as $campus)
          <div class="col-md-4">
            <div class="product-item">
            <a href="#"><img src="{{ asset('/storage/'. $campus->image) }}" alt=""></a>
              <div class="down-content">
              <a><h4>{{ $campus->name }}</h4></a>
                {{-- <p>Schedule Visit : </p> --}}
                @if (Auth::check())
                  <ul class="stars">
                    <li><a href="{{ route('campusPrograms', $campus->id) }}">PROGRAMS</a></li>
                    <li><a href="/storage/{{ $campus->certificate }}" target="__blank">CERTIFICATES</a></li>
                  </ul> 
                @endif
              </div>
            </div>
          </div>
        @endforeach


        
      
      </div>
    </div>
  </div>
@endsection

    
@section('documents')
  <div class="send-message">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Others</h2>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="others">
                
              @foreach ($documents as $document)
                  
                  @if ($document->name == "Accreditation Status")
                      <li>
                          <a href="/storage/{{ $document->file }}" target="new">Accreditation Status</a>
                      </li>
                  @endif

                  @if ($document->name == "Survey Visit Schedule")
                      <li>
                          <a href="/storage/{{ $document->file }}" target="new">Survey Visit Schedule</a>
                      </li>
                  @endif

                  @if ($document->name == "Accomplishment Report")
                      <li>
                          <a href="/storage/{{ $document->file }}" target="new">Accomplishment Report</a>
                      </li>
                  @endif
                
                  @if ($document->name == "List of Internal Accreditors")
                      <li>
                          <a href="/storage/{{ $document->file }}" target="new">List of Internal Accreditors</a>
                      </li>
                  @endif
            
              @endforeach

                  <li>
                    <a>Photo Documentation </a>
                  </li>
          </ul>
        </div>
        <div class="col-md-6">
          <div class="contact-form">
            <form id="contact" action="" method="post">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <fieldset>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                  </fieldset>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <fieldset>
                    <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail Address" required="">
                  </fieldset>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <fieldset>
                    <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" required="">
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="filled-button">Send Message</button>
                  </fieldset>
                </div>
              </div>
            </form>
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