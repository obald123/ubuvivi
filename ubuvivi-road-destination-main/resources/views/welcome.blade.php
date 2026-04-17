@extends('layouts.guest')

@section('title')
    Ubuvivi Tours Safaris | Best Transport and Travel Company in Rwanda
@endsection

@section('meta')
    <meta name="description"
        content="UBUVIVI leading in Tour operators company in Rwanda, book your dream vacation today for ubuvivi safaris, ubuvivi EAC Safari, ubuvivi Gorillas tracking & ubuvivi Hotel booking">
    <meta name="keywords"
        content="ubuvivi, ubuvivi safaris, ubuvivi tours and safaris, ubuvivi tours & Safari, ubuvivi Hotel booking, ubuvivi safaris, ubuvivi tours, ubuvivi Gorillas tracking, ubuvivi EAC Safari, Rwanda Travel Agency, Best Transport Company in Rwanda">
@endsection

@section('content')
    <section class="slider_section position-relative clearfix text-center text-white">
        <div class="main_slider clearfix">
            <div class="item has_overlay d-flex align-items-center"
                data-bg-image="{{ asset('assets/images/backgrounds/bg_6.jpg') }}">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="slider_content text-center" style="backdrop-filter: blur(2px)">
                                <h3 class="text-uppercase text-white" data-animation="fadeInUp" data-delay=".3s">
                                    Gorilla Trekking
                                </h3>
                                <p data-animation="fadeInUp" data-delay=".5s">
                                    We bring you face to
                                    face with the Gorillas
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item has_overlay d-flex align-items-center"
                data-bg-image="{{ asset('assets/images/backgrounds/bg_11.jpg') }}">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="slider_content text-center" style="backdrop-filter: blur(2px)">
                                <h3 class="text-uppercase text-white" data-animation="fadeInUp" data-delay=".3s">
                                    The Big 5 of Akagera
                                </h3>
                                <p data-animation="fadeInUp" data-delay=".5s">
                                    Get to see Lions, Elephants, Buffalos, Leopards, and Rhinos also known as the big 5 of
                                    the Akagera National Park
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item has_overlay d-flex align-items-center"
                data-bg-image="{{ asset('assets/images/backgrounds/bg_14.jpg') }}">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="slider_content text-center" style="backdrop-filter: blur(2px)">
                                <h3 class="text-uppercase text-white" data-animation="fadeInUp" data-delay=".3s">
                                    Car Rental
                                </h3>
                                <p data-animation="fadeInUp" data-delay=".5s">
                                    We provide car rental services at amazing prices.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item has_overlay d-flex align-items-center"
                data-bg-image="{{ asset('assets/images/backgrounds/bg_15.jpg') }}">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="slider_content text-center" style="backdrop-filter: blur(2px)">
                                <h3 class="text-uppercase text-white" data-animation="fadeInUp" data-delay=".3s">
                                    Car Transfer
                                </h3>
                                <p data-animation="fadeInUp" data-delay=".5s">
                                    We transfer clients from places like airport and make sure that they reach their
                                    intended destination.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="carousel_nav clearfix">
            <button type="button" class="main_left_arrow" aria-label="Previous">
                <i class="fal fa-chevron-left"></i>
            </button>
            <button type="button" class="main_right_arrow" aria-label="Next">
                <i class="fal fa-chevron-right"></i>
            </button>
        </div>
    </section>
    <section class="booking_section has_overlay d-flex align-items-center clearfix py-5"
        style="background-color: rgb(255, 245, 175)">
        <div class="overlay"></div>
        <div class="container px-4">
            <h1 class="text-uppercase aos-init aos-animate font-weight-bold mb-5 text-center" data-aos="fade-up"
                data-aos-delay="100">
                Ubuvivi Tours & Safari
            </h1>
            <div
                class="row align-items-start justify-content-lg-between justify-content-md-center justify-content-sm-center">
                <div class="col-lg-7 col-ms-8 col-sm-10 col-xs-12">
                    <div class="booking_content">
                        <h2 class="title_text aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                            Get to know us
                        </h2>
                        <ul class="booking_info_list ul_li_block clearfix">
                            <li data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate pl-1">
                                UBUVIVI car rental & Tours is the
                                best company in Rwanda offering
                                excellent transport service. We are
                                extremely professional at assessing
                                and providing the most appropriate
                                vehicle for the task.
                            </li>
                            <li data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate pl-1">
                                Our cars are in a pristine conditions
                                and installed with the state of art
                                technology, with all the required
                                Authority Documentation.
                            </li>
                            <li data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate pl-1">
                                We also have professional drivers who
                                know all attractive places in Kigali and
                                paradise-like sceneries throughout
                                Rwanda.
                            </li>
                            <li data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate pl-1">
                                Book with us now. We pledge to serve
                                you to the best of our professional
                                capability.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-ms-8 col-sm-10 col-xs-12">
                    <div class="aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                        <img width="640" height="360" src="{{ asset('assets/images/backgrounds/bg_16.png') }}" class="rounded" alt="not_found">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="world_location_section sec_ptb_100 clearfix" data-bg-gradient="linear-gradient(0deg, #161829, #292D45)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12">
                    <div class="section_title mb_60 text-center text-white" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="title_text mb_15 text-white"><span class="text-uppercase">Ubuvivi Tours Location</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="world_location clearfix">
                <iframe class="w-100 overflow-hidden rounded" title="Ubuvivi Tours Location"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15949.946523129527!2d30.1103428!3d-1.958924!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca76d9f57f4dd%3A0x82fc7b5b7c073b9f!2sUBUVIVI%20Tours%20and%20Car%20Rental!5e0!3m2!1sen!2srw!4v1695154532377!5m2!1sen!2srw"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection
