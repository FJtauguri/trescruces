@extends('layouts.app')
@section('content')
@include('layouts.navs')

<style>
.linkz-footer {
  overflow-wrap: break-word;
  word-break: break-all;
  display: block;
}

.f-body {
  padding: 0 15px;
}

@media (max-width: 768px) {
  .f-body {
    text-align: center;
  }
}
    .announcement-section {
      padding: 20px 0; /* Adjust padding as needed */
    }

   .announcement-card {
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 20px;
      background-color: #f9f9f9;
      height: 450px; 
      display: flex;
      flex-direction: column;
      justify-content: space-between; 
   }
   .announcement-card img {
      width: 100%;
      height: 200px;
      object-fit: cover; 
      margin-bottom: 15px; 
   }
   .announcement-card .content {
      flex-grow: 1;
   }

.map-container {
  margin-top: 30px; /* Adjust margin as needed */
  padding: 20px 0; /* Adjust padding as needed */
}

.mapouter {
  position: relative;
  text-align: right;
  height: 450px; /* Adjust height as needed */
  width: 100%; /* Ensure full width */
}

.gmap_canvas {
  overflow: hidden;
  background: #fff;
  height: 100%;
  width: 100%;
}

@media (min-width: 768px) {
  .announcement-section,
  .map-container {
    margin-left: auto;
    margin-right: auto;
    max-width: 100%; /* Ensure it doesn’t overflow */
  }
}
</style>

<header class="w-100 mb-4 custom-header" style="overflow: hidden; max-height: 100%;">
   <div class="carousel-container">
       <div id="headerCarousel" class="carousel slide" data-bs-ride="carousel">
           <div class="carousel-inner">
               @php $tmp_bool = true; @endphp
               @foreach($homeimgs as $bg)
                   @php
                       $isActive = $tmp_bool ? 'active' : '';
                       $tmp_bool = false;
                       $bg_img = base64_decode($bg->name);
                   @endphp 
                   <div class="carousel-item {{ $isActive }}"> 
                       <img src="{{ asset('assets/imgs_uploads/' . $bg_img) }}" class="d-block w-100 img-header-cover" style="object-fit: cover; max-height: 500px;">
                   </div>
               @endforeach
           </div>
       </div>

       <div class="carousel-controls">
           <a class="carousel-btn-main carousel-control-prev" href="#headerCarousel" role="button" data-bs-slide="prev">
               <span class="rounded-circle cstm-carousel-btn material-symbols-outlined">arrow_back_ios_new</span>
           </a>
           <a class="carousel-btn-main carousel-control-next" href="#headerCarousel" role="button" data-bs-slide="next">
               <span class="rounded-circle cstm-carousel-btn material-symbols-outlined">arrow_forward_ios</span>
           </a>
       </div>

       <div class="carousel-content text-center p-3 p-md-5">
           @foreach ($gens as $gen)
               <h1 class="display-4 text-light fw-bold" style="color: rgb(248, 220, 120);">{{ $gen->head_title }}</h1>
           @endforeach
           
           @foreach($headerbtns as $h_btn)
               @php
                   $name = $h_btn->name;
                   $link = $h_btn->link;
                   $outline = ($h_btn->outline == 'off') ? 'cstm-btn-c-yellow' : '';
               @endphp
               @guest
                   <a href="{{ $link }}" class="rounded-pill btn cstm-btn1 {{ $outline }} mt-2 mt-md-3">{{ $name }}</a>
               @endguest

               @auth
                   @if (auth()->user()->hasRole('admin'))
                       <a href="/dashboard" class="rounded-pill btn cstm-btn1 {{ $outline }} mt-2 mt-md-3">Dashboard</a>    
                   @elseif (auth()->user()->hasRole('staff'))
                       <a href="/staff-dashboard" class="rounded-pill btn cstm-btn1 {{ $outline }} mt-2 mt-md-3">Dashboard</a>    
                   @elseif (auth()->user()->hasRole('resident'))
                       <a href="/user-dashboard" class="rounded-pill btn cstm-btn1 {{ $outline }} mt-2 mt-md-3">Dashboard</a>    
                   @endif
               @endauth
           @endforeach
       </div>
   </div>
</header>

<style>
   /* Position header lower on mobile screens */
   .custom-header {
       padding-top: 20px; /* Default padding for larger screens */
   }

   @media (max-width: 768px) {
       .custom-header {
           padding-top: 60px; /* Increased padding for smaller screens */
       }
   }

   @media (max-width: 576px) {
       .custom-header {
           padding-top: 80px; /* Further increased padding for very small screens */
       }
   }
</style>

<div class="container">
   <div class="row d-flex justify-content-center">
   @foreach($homecards as $cdata)
       @php
           $img = base64_decode($cdata->img);
           $ctitle = $cdata->title;
           $clink = $cdata->link;
       @endphp
       <div class="col-md-4">
           <div class="three-box">
               <i><img class="img-fluid" style="max-height: 150px;" src="{{ asset('header_cards/' . $img) }}" alt="{{ $img }}"/></i>
               <h3>{{ $ctitle }}</h3>
               <a class="mt-2 rounded-pill btn cstm-btn2 cstm-btn-c-yellow" href="{{ $clink }}">Learn More</a>
           </div>
       </div>
   @endforeach
   </div>
</div>

<!-- Start of announcement -->
<div class="container">
   <div class="row">
      <div class="col-md-12 announcement-section">
         <div class="home-announcement">
            <h3><b>Recent</b> Announcement</h3>
         </div>
         <p>Check the latest news, events and announcements here.</p>
         <div class="row">
         @php
            $result = DB::table('announcements')->orderBy('id', 'desc')->limit(3)->get();
         @endphp
         @foreach($result as $a_data)
            @php
               $a_img = base64_decode($a_data->cover);
               $a_title = base64_decode($a_data->title);
               $a_content = base64_decode($a_data->content);
               // Set limits for title and content
               $title_limit = 50; // Adjust as needed
               $content_limit = 150; // Adjust as needed
            @endphp
            <div class="col-md-4 announcement-card">
                   <i><img class="img-fluid" src="{{ asset('announcement_img/' . $a_img) }}" alt="#"/></i>
                   <h3>{{ \Str::limit($a_title, $title_limit) }}</h3>
                   <h6>{{ \Carbon\Carbon::parse($a_data->created_at)->format('F d, Y h:i A') }}</h6>
                   <div class="content" style="text-align: justify;">
                      <p>{!! nl2br(preg_replace('/https?:\/\/[^\s<]+/', '<a href="$0" target="_blank">$0</a>', \Str::limit($a_content, $content_limit))) !!}</p>
                   </div>
                </div>
         @endforeach
         </div> 
      </div>
   </div>
   <div class="d-flex justify-content-center mt-4">
      <a class="cstm-btn3 btn" href="/announcements">View all Announcements</a>
   </div>
</div>
<!-- End of Announcement -->


<div class="container">
   <div class="map-container">
      <div class="mapouter">
         <div class="gmap_canvas">
            <iframe width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.673286431573!2d120.83200192202257!3d14.330400612984032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33962b315248f85f%3A0x27b10b5030b4d8e1!2sBrgy.%20Tres%20Cruses%20(Barangay%20Hall)!5e0!3m2!1sen!2sph!4v1698968047190!5m2!1sen!2sph" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>
      </div>
   </div>
</div>

<footer>
   @foreach ($gens as $gen)
   <div class="f-head d-flex p-4 align-items-center">
     <img style=" border-radius:50%;" height="65" src="{{ asset('assets/head_logo/' . $gen->logo) }}" alt="Web Logo">
     <div class="ms-2 d-flex align-items-center">
       <p><b>{{ $gen->title }}</b></p>
     </div>
   </div>
   <div class="f-body container">
     <div class="row">
       <div class="col-md-2 text-center mb-3 mb-md-0">
         <img style=" border-radius:50%;" height="100" src="{{ asset('assets/head_logo/' . $gen->logo) }}" alt="Web Logo">
       </div>
       <div class="col-md-3 mb-3 mb-md-0">
         <h6 class="fw-bold">Gov Links</h6>
         <ul class="list-unstyled">
           @foreach($footers as $footer)
             @if(isset($footer['gov']))
               @php
                 $govLink = $footer['gov'];
                 $govText = rtrim(str_replace(['http://', 'https://'], '', $govLink), '/');
               @endphp
               <li><a style="text-decoration:none;" class="linkz-footer d-block mb-2" href="{{ $govLink }}">{{ $govText }}</a></li>
             @endif
           @endforeach
         </ul>
       </div>
       <div class="col-md-3 mb-3 mb-md-0">
         <h6 class="fw-bold">Official Social Media Accounts</h6>
         <ul class="list-unstyled">
           @foreach($footers as $footer)
             @if(isset($footer['social']))
               @php
                 $socialLink = $footer['social'];
                 $socialText = rtrim(str_replace(['http://', 'https://'], '', $socialLink), '/');
               @endphp
               <li><a style="text-decoration:none;" class="linkz-footer d-block mb-2" href="{{ $socialLink }}">{{ $socialText }}</a></li>
             @endif
           @endforeach
         </ul>
       </div>
       <div class="col-md-4 mb-3 mb-md-0">
         <h6 class="fw-bold">Contact Us</h6>
         <ul class="list-unstyled">
           @foreach($footers as $footer)
             @if(isset($footer['contact']))
               @php
                 $contactLink = $footer['contact'];
                 $contactText = rtrim(str_replace(['http://', 'https://'], '', $contactLink), '/');
               @endphp
               <li><a style="text-decoration:none;" class="linkz-footer d-block mb-2" href="{{ $contactLink }}">{{ $contactText }}</a></li>
             @endif
           @endforeach
         </ul>
       </div>
     </div>
   </div>
   @endforeach
</footer>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">
@endsection
@section('title', 'TRES CRUSES CITY OF TANZA')
