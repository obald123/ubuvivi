@extends('layouts.guest')

@section('title')
    Best Airport Transfer Services Rwanda - Ubuvivi
@endsection

@section('meta')
    <meta name="description"
        content="Providing hassle-free Rwanda airport transfers services seven days a week, Our services are 24/7 so any time you get to the airport">
    <meta name="keywords" content="ubuvivi, Rwanda Airport Transfers, Airport Transfer Services Rwanda, Airport Car Services Rwanda">
@endsection

@section('css')
    <style>
        .about img {
            max-height: 350px;
            object-fit: cover;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <section class="search_section clearfix pb-5" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 90px">

    </section>
    <section style="background-color: rgb(255, 245, 175)" class="pt-md-5 about pt-0">
        <section>
            <div class="container mb-5">
                <div class="clearfix">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8" data-aos="fade-up" data-aos-delay="300">
                            <h1 class="mb-3 text-center">Rwanda Airport Transfers</h1>
                            <div>
                                UBUVIVI Car Rental and Tours, we
                                offer Self drive cars, car with a driver,
                                We also provide tours services such
                                as professional tour guidence, to the
                                different touristic destinations like
                                Rubavu, Karongi, Nyungwe national
                                Park, Akagera national park and
                                Volcanoes national Park
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container py-5">

                <div class="row">
                    <div class="col-12 col-md-6 d-flex justify-content-start order-md-2 mb-4" data-aos="fade-up"
                        data-aos-delay="300">
                        <img src="{{ asset('assets/images/about/3.jpg') }}" class="img img-fluid rounded" alt="">
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="500">
                        <h2 class="mb-3">
                            Car Rental
                        </h2>
                        <div>
                            we offer Self drive cars, car with a driver. Our cars are in a pristine conditions
                            and installed with the state of art technology, with all the required Authority Documentation.
                            <br>
                            We also have professional drivers who
                            know all attractive places in Kigali and
                            paradise-like sceneries throughout
                            Rwanda.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container py-5">
                <div class="clearfix">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex justify-content-end2 mb-4" data-aos="fade-up"
                            data-aos-delay="300">
                            <img src="{{ asset('assets/images/about/4.png') }}" class="img img-fluid rounded"
                                alt="">
                        </div>
                        <div class="col" data-aos="fade-up" data-aos-delay="500">
                            <h2 class="mb-3">Tours and travels</h2>
                            <div>
                                Travelers visiting this beautiful
                                country are usually taken aback by her beauty;
                                the stud lush green and well-terraced hills in the
                                countryside, the dazzling blue crystal lakes such
                                as Lake Kivu, her rivers that meander through hills
                                and mountains, stunning national parks and her
                                hospitable people.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container py-5">

                <div class="row">
                    <div class="col-12 col-md-6 d-flex justify-content-start order-md-2 mb-4" data-aos="fade-up"
                        data-aos-delay="300">
                        <img src="{{ asset('assets/images/about/5.jpg') }}" class="img img-fluid rounded" alt="">
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="500">
                        <h2 class="mb-3">
                            Airport transfers
                        </h2>
                        <div>
                            We provide pre-booked methods of transport for picking up passengers from
                            an airport and dropping them off at their holiday resort or chosen destination.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
