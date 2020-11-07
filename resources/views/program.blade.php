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
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('about') }}">About Us
                      </a>
                  </li>
                  @if (Auth::user()->role == 'Admin')
                      <li class="nav-item">
                          <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                      </li>
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
    <div class="page-heading contact-heading header-text" 
    style="background: url({{ asset('/storage/'.$campus->image) }}); filter: brightness(1);">
        <div class="overlay">
            <div class="container">
                <div class="row">
                <div class="col-md-12 justify-content-center">
                    <div class="text-content">
                    <h2 style="
                    font-weight: bold; 
                    color: rgb(46, 45, 45);
                    background: rgb(255, 255, 255, 0.5);
                    padding: 5px 0;
                    
                
                    " >{{ $campus->name }}</h2>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('showcase')
    <div class="find-us">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table text-center">
                <thead>
                    <tr>
                    <th>Program Name</th>
                    <th>Level</th>
                    <th>Validity</th>
                    <th>Link</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($campusPrograms as $program)
                        <tr>
                            <td scope="row">{{ $program->name }}</td>
                            <td>{{ $program->level }}</td>
                            <td>{{ $program->validity }}</td>
                            <td>
                                <a href="{{ $program->link }}" target="__blank"><i class="fa fa-link text-success" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach

                            
                </tbody>
                </table>
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