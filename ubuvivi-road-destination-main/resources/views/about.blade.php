@extends('layouts.guest')

@section('title')
    About us - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description"
        content="UBUVIVI leading in Tour operators company in Rwanda, book your dream vacation today for ubuvivi safaris, ubuvivi EAC Safari, ubuvivi Gorillas tracking & ubuvivi Hotel booking">
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
            <div class="container mb-4">
                <div class="clearfix py-5">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10" data-aos="fade-up" data-aos-delay="300">
                            <h1 class="mb-3 text-center">Who We Are</h1>
                            <div>
                                <p>
                                    UBUVIVI car rental & Tours is the
                                    best company in Rwanda offering
                                    excellent transport service. We are
                                    extremely professional at assessing
                                    and providing the most appropriate
                                    vehicle for the task.
                                </p>
                                <p>
                                    our cars are in a pristine conditions
                                    and installed with the state of art
                                    technology, with all the required
                                    Authority Documentation. We also have professional drivers who
                                    know all attractive places in Kigali and
                                    paradise-like sceneries throughout
                                    Rwanda.
                                </p>
                                <p class="font-weight-bold text-center">
                                    Book with us now. We pledge to serve
                                    you to the best of our professional
                                    capability
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="search_section clearfix" data-aos="fade-up" data-aos-delay="400"
            style="background-color: rgb(22, 24, 41);">
            <div class="container py-5">
                <div class="row justify-content-center text-light">
                    <div class="col-12 col-md-8 my-4">
                        <h1 class="text-danger text-center">UBUVIVI Meaning</h1>
                        <p>
                            <span class="font-weight-bold">UBUVIVI</span> is a Rwandan word referring
                            to the fifth family generation, which
                            by implication, we intend that this
                            company will exist beyond that family
                            generation. May they reap the fruits of
                            what we have set up today.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container mt-5 py-5">
                <div class="clearfix">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex justify-content-end mb-4" data-aos="fade-up"
                            data-aos-delay="300">
                            <img src="{{ asset('assets/images/about/gorilla.png') }}" class="img img-fluid rounded"
                                alt="">
                        </div>
                        <div class="col" data-aos="fade-up" data-aos-delay="500">
                            <h2 class="mb-3">We bring you face to
                                face with the Gorillas</h2>
                            <div>
                                Gorillas are classed as
                                infants until they reach
                                around three-anda-half years old, and
                                adults from around 8
                                years. Males between
                                8-12 years are called
                                ‘blackbacks’. Then
                                from 12 years old, they
                                develop a silver section
                                of hair over their back
                                and hips, earning them
                                the name <span class="font-weight-bold">‘silverback’</span>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container py-5">
                <div class="clearfix">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex justify-content-start order-md-2 mb-4" data-aos="fade-up"
                            data-aos-delay="300">
                            <img class="img img-fluid rounded" src="{{ asset('assets/images/vehicles/1.jpg') }}"
                                alt="">
                        </div>
                        <div class="col" data-aos="fade-up" data-aos-delay="500">
                            <h2 class="mb-3">Car Rental</h2>
                            <div>
                                UBUVIVI car rental & Tours is the
                                best company in Rwanda offering
                                excellent transport service. We are
                                extremely professional at assessing
                                and providing the most appropriate
                                vehicle for the task.
                                our cars are in a pristine conditions
                                and installed with the state of art
                                technology, with all the required
                                Authority Documentation.
                                We also have professional drivers who
                                know all attractive places in Kigali and
                                paradise-like sceneries throughout
                                Rwanda.
                                Book with us now. We pledge to serve
                                you to the best of our professional
                                capability.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container py-5">

                <div class="row">
                    <div class="col-12 col-md-6 d-flex justify-content-start mb-4" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ asset('assets/images/about/2.jpg') }}" class="img img-fluid rounded" alt="">
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="500">
                        <h2 class="mb-3">
                            Big 5 in Akagera National Park
                        </h2>
                        <div>
                            Big 5 in Akagera National Park are one of the
                            biggest attractions in Akagera whereby travelers
                            get to see the Lions, Elephants, Buffalos,
                            Leopards, and Rhinos. Rwanda is truly the Land
                            of a thousand hills. Travelers visiting this beautiful
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

        </section>
        <section class="search_section clearfix" style="background-color: rgb(22, 24, 41);">
            <div class="container py-5">
                <div class="row justify-content-around text-light">
                    <div class="col-12 col-md-6 my-4">
                        <div class="">
                            <h1 class="text-danger">Objective</h1>
                            <div>
                                UBUVIVI Car Rental is created to solve
                                problems that people have of missing
                                appropriate vehicles when in need of
                                them. We offering them at affordable
                                prices. We are working hard and smart
                                to provide an excellent service to our
                                clients to ensure maximum satisfaction.
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 my-4">
                        <div class="">
                            <h1 class="text-danger">Aim</h1>
                            <div>
                                UBUVIVI car Rental and UBUVIVI tours
                                and travels aim at making our clients
                                smile as they enjoy the ride.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
