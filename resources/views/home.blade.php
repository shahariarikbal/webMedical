@extends('layouts.app-web')

@section('slider')
    <div class="slideshow-container">

        <div class="mySlides fade">
            <img src="{{ asset('fontend/assets/images/banner.png') }}" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="{{ asset('fontend/assets/images/banner0.jpg') }}" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="{{ asset('fontend/assets/images/banner1.jpg') }}" style="width:100%">
        </div>

    </div>
    <br>

    <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
@endsection
@section('content')
    <section class="w3l-content-6">
        <!-- /content-6-main-->
        <div class="content-6-mian py-5">
            <div class="container py-lg-5">
                <div class="title-content text-left mb-4">
                    <h6 class="sub-title">About Us</h6>
                    <h3 class="hny-title">Welcome to our WebMedical</h3>
                </div>
                <div class="content-info-in row">
                    <div class="content-gd col-lg-6 pl-lg-4">
                        <p>Ea consequuntur illum facere aperiam sequi optio consectetur adipisicing elitFuga, suscipit
                            totam animi consequatur saepe blanditiis.Lorem ipsum dolor sit amet,Ea consequuntur illum
                            facere aperiam sequi optio consectetur adipisicing elit. Fuga, suscipit totam animi
                            consequatur saepe blanditiis.</p>
                    </div>
                    <div class="content-gd col-lg-6 pl-lg-4 pl-lg-4">
                        <p>Ea consequuntur illum facere aperiam sequi optio consectetur adipisicing elitFuga, suscipit
                            totam animi consequatur saepe blanditiis.Lorem ipsum dolor sit amet,Ea consequuntur illum
                            facere aperiam sequi optio consectetur adipisicing elit. Fuga, suscipit totam animi
                            consequatur saepe blanditiis.</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- //content-6-->
    <!-- services block3 -->
    <div class="w3l-open-block-services py-5">
        <div class="container py-lg-5 pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center">
                        <div class="icon-holder">
                            <span class="fa fa-credit-card service-icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission">1 Month Free</h4>
                        <div class="open-description">
                            <p>Maecenas sodales eu commodo ligula eget dolor dolor sit amet ligula</p>
                            <a href="#read">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-md-0 mt-5 pt-md-0 pt-3">
                    <div class="card text-center">
                        <div class="icon-holder">
                            <span class="fa fa-credit-card-alt service-icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission">Paid Service</h4>
                        <div class="open-description">
                            <p>Maecenas sodales eu commodo ligula eget dolor dolor sit amet ligula</p>
                            <a href="#read">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-lg-0 mt-5 pt-lg-0 pt-3">
                    <div class="card text-center">
                        <div class="icon-holder">
                            <span class="fa fa-diamond service-icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission">Premium Service</h4>
                        <div class="open-description">
                            <p>Maecenas sodales eu commodo ligula eget dolor dolor sit amet ligula</p>
                            <a href="#read">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-lg-0 mt-5 pt-lg-0 pt-3">
                    <div class="card text-center">
                        <div class="icon-holder">
                            <span class="fa fa-cogs service-icon" aria-hidden="true"></span>
                        </div>
                        <h4 class="mission">Maintenance service</h4>
                        <div class="open-description">
                            <p>Maecenas sodales eu commodo ligula eget dolor dolor sit amet ligula</p>
                            <a href="#read">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //services block3 -->

    <!-- /specification-6-->
    <section class="w3l-specification-6">
        <div class="specification-6-mian py-5">
            <div class="container py-lg-5">
                <div class="row story-6-grids text-left">
                    <div class="col-lg-5 story-gd">
                        <img src="{{ asset('/fontend/') }}/assets/images/service.png" class="img-fluid" alt="/">
                    </div>
                    <div class="col-lg-7 story-gd pl-lg-4">
                        <div class="title-content text-left mb-lg-5 mt-4">
                            <h6 class="sub-title">For a New support</h6>
                            <h3 class="hny-title">WebMadical Technologies For Always your business support</h3>
                            <p>Lorem illum facere aperiam sequi optio consectetur adipisicing elitFuga, suscipit totam
                                animi
                                consequatur saepe blanditiis.Lorem ipsum dolor sit amet</p>
                        </div>
                        <div class="skill_info mt-lg-5 mt-4">
                            <div class="stats_left">
                                <div class="counter_grid">
                                    <div class="icon_info">
                                        <p class="counter">165</p>
                                        <h4>Daily appointments</h4>
                                        <p class="counter-para">Lorem ipsum dolor sit amet consectetur adipisicing elit
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="stats_left">
                                <div class="counter_grid">
                                    <div class="icon_info">
                                        <p class="counter">563</p>
                                        <h4>Happy Clients</h4>
                                        <p class="counter-para">Lorem ipsum dolor sit amet consectetur adipisicing elit
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //specification-6-->
    <section class="w3l-about5">
        <div class="container-fluid px-0">
            <div class="history-info position-relative">
                <div class="heading text-center mx-auto">
                    <h3 class="hny-title two">Creating the healthy smile you want through science and artistry.</h3>
                    <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit sunt in culpa qui officia
                        sed deserunt mollit anim id est laborum mollit anim id est nulla.</p>
                    <span class="video-play-icon">
                    <span class="fa fa-play"></span>
                </span>
                </div>
            </div>
        </div>
    </section>
    <!--/testimonials-->
    <section class="w3l-free-consultion" id="app">
        <div class="container">
            <div class="consultation-grids">
                <div class="apply-form">
                    <h5>Frequently Ask About WebMedical</h5>
                    
                    <contact></contact>

                </div>
                <div class="consultation-img">
                    <img src="{{ asset('/fontend/') }}/assets/images/ab.jpg" class="img-fluid" alt="/">
                </div>
            </div>
        </div>
    </section>
@endsection
