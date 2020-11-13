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
            <h4>UNIVERSITY PROFILE </h4>
            <p>The Cavite State University (CvSU) has its humble beginnings in 1906 as the Indang
              Intermediate School with the American Thomasites as the first teachers. Several
              transformations in the name of the school took place; Indang Farm School in 1918, Indang
              Rural High School in 1927, and Don Severino National Agriculture School in 1958. In 1964, the
              school was converted into a State College by virtue of Republic Act 3917 and became known as
              Don Severino Agricultural College (DSAC). <span class="dots"> ...</span> </p>
            
            <span class="more" style="display: none;">
              <p>On January 22, 1998, by virtue of Republic Act No.8468, DSAC was converted into
                Cavite State University. In 2001, Cavite College of Fisheries (CACOF) in Naic, Cavite and
                Cavite College of Arts and Trade (CCAT) in Rosario, Cavite, were integrated to the University
                by virtue of CHED Memo No. 27 s. 2000. Since then, additional campuses in the province were
                established through memoranda of agreement with the LGUs that led to having Cvsu having 11
                campuses in the province. These are located in Bacoor, Carmona, Cavite City, General Trias,
                Imus, Naic, Rosario, Silang, Trece Martires, Tanza and Indang. The main campus in Indang,
                Cavite is approximately 70 hectares in land area and is named as Don Severino delas Alas
                Campus. It has 10 colleges that include the following: College of Education; College of Arts and
                Sciences; College of Engineering and Information Technology; College of Agriculture, Food,
                Environment and Natural Resources; College of Criminal Justice; College of Economics,
                Management and Development Studies; College of Sports, Physical Education and Recreation,
                College of Nursing; College of Veterinary Medicine and Biomedical Sciences, and the Graduate
                Studies-Open Learning College.
                At present, CvSU remains to be a Level IV state university with an ISO 9001:2015 certification
                and a BS Agriculture program that is considered a Center of Excellence. Out of 107 accreditable
                programs, 21 are with Level III status, 37 are with Level II and 46 programs with Level 1.
                Meanwhile, it is also awarded as CALABARZON’s Most Outstanding SUC in GAD
                Implementation for four years.</p>
  
                <p>CvSU remains committed to its core values of “Truth, Excellence and Service” as it
                  envisions to be the “premier University in historic Cavite recognized for excellence in the
                  development of globally competitive and morally upright individuals”.</p>
  
                <p>Partnering with stakeholders, it continuously aims “to provide excellent, equitable and
                  relevant educational opportunities in the arts, sciences and technology through quality
                  instruction, and responsive research and development activities. It shall produce professional,
                  skilled and morally upright individuals for global competitiveness.”</p>
  
                <p>The University also adopts a 5-point Research and Extension Agenda mainstreamed in
                  all its colleges and campuses. This include: Agri-Fisheries and Food Security; Biodiversity and
                  Environmental Conservation; Smart Engineering, ICT and Industrial Competitiveness; Societal
                  Development and Equality; and Public Health and Welfare.</p>
  
                <p>Agri-Fisheries and Food Security emphasizes on developing agriculture systems to
                  contribute to an economically viable and sustainable society with improved quality of life for
                  farmers and fisherfolks. Biodiversity and Environmental Conservation focuses on environmental
                  stewardship and equitable allocation and sustainable use of natural resources. Meanwhile,
                  Smart Engineering, ICT and Industrial Competitiveness covers methods, processes, systems
                  
                  and tools for the development of innovative and interconnected products, services and
                  infrastructures. The area of Societal Development and Equality is concerned with creating
                  growth, social harmony and equal opportunities among different groups to lessen economic
                  divide and marginalization. The fifth agenda, Public Health and Welfare, deals with human and
                  animal healthcare including researches that may be transmitted connected with both or the
                  environment as a whole.</p>
  
                  <p>CvSU aims to contribute to the study of these areas to innovate systems towards the
                    improvement of lives of community members.</p>
            </span>

                  <button class="read btn" type="button" onclick="readMore()">Read More</button>

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

{{-- Campuses --}}
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

              @if ($campus->programs->count() > 0)
                <a href="#"><img src="{{ asset('/storage/'. $campus->image) }}" alt=""></a>
              @else 
                <a href="#"><img src="{{ asset('/storage/'. $campus->image) }}" alt="" style="filter: blur(4px);"></a>
              @endif

              <div class="down-content">
                  <a><h4>{{ $campus->name }}</h4></a>
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
      </div>

      <div class="row d-flex justify-space-between">
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

                  @if ($document->name == "Organizational Structure")
                      <li>
                          <a href="/storage/{{ $document->file }}" target="new">Organizational Structure</a>
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
              <img src="{{ asset('img/abstract.png') }}" style="width: 70%" alt="">
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