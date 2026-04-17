@extends('layouts.guest')

@section('title')
    Contact us - Ubuvivi Tours and Safaris
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
    <section style="background-color: rgb(255, 245, 175)" class="about pt-5">
        <section class="clearfix">
            <div class="container">
                <div class="contact_details_wrap aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="row justify-content-lg-between">
                        <div class="col-lg-5 col-12">
                            <div class="image_area">
                                <p class="mb_30">UBUVIVI Car Rental and UBUVIVI Tours
                                    and Travels aim at making our clients
                                    smile as they enjoy the ride.</p>
                                <div class="image_wrap d-none d-lg-block"><img src="assets/images/about/img_02.jpg"
                                        alt="image_not_found">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="content_area">
                                <h2 class="mb_30">CONTACT DETAILS:</h2>
                                <ul class="ul_li_block mb_30 clearfix">
                                    <li class="d-flex align-items-baseline"><i class="fas fa-map-marker-alt"></i>
                                        Remera- kisiment KG11 Ave,
                                        Amahoro stadium road, Ikaze
                                        house, 3rd floor.</li>
                                    <li class="d-flex align-items-baseline">
                                        <i class="fas fa-envelope"></i>
                                        <a class="text-dark" href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a>
                                    </li>
                                    <li class="d-flex align-items-baseline"><i class="fas fa-phone"></i>
                                        <strong class="d-flex flex-column font-weight-normal">
                                            <a class="text-dark" href="tel:+250789044222">+250 789 044 222</a>
                                            <a class="text-dark" href="tel:+250783123089">+250 783 123 089</a>
                                            <a class="text-dark" href="tel:+250787229916">+250 787 229 916</a>
                                        </strong>
                                    </li>
                                </ul>
                                <ul class="primary_social_links ul_li clearfix">
                                    <li class="mx-1 my-2"><a
                                            href="https://www.facebook.com/profile.php?id=100077752760078"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li class="mx-1 my-2"><a href="https://www.instagram.com/ubuvivitours"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li class="mx-1 my-2"><a href="#!"><i class="fab fa-twitter"></i></a></li>
                                    <li class="mx-1 my-2"><a href="#!"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact_form_section sec_ptb_100 clearfix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10 col-g-8 bg-dark-1 px-md-5 rounded px-3 py-4">
                        <div class="section_title aos-init aos-animate mb-5 text-center" data-aos="fade-up"
                            data-aos-delay="100">
                            <h2 class="title_text mb-4"><span class="h1 text-white">Send Us a Message</span></h2>
                            @include('flash::message')
                        </div>
                        <form class="font-15 text-white" method="POST" action="/contact">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form_item aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                        <input type="text" name="names" placeholder="Full Names" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form_item aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                        <input type="email" name="email" placeholder="E-mail" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form_item aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                                        <input type="text" name="subject" placeholder="Subject" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form_item aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
                                <textarea name="message" placeholder="Leave Your Message" required></textarea>
                            </div>
                            <div class="abtn_wrap clearfix aos-init aos-animate float-right text-center" data-aos="fade-up"
                                data-aos-delay="600">
                                <button type="submit" class="custom_btn btn_width bg_default_red text-uppercase">
                                    Submit now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="world_location_section sec_ptb_100 clearfix"
            data-bg-gradient="linear-gradient(0deg, #161829, #292D45)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12">
                        <div class="section_title mb_60 text-center text-white" data-aos="fade-up" data-aos-delay="100">
                            <h2 class="title_text mb_15 text-white"><span>Our Location</span></h2>
                        </div>
                    </div>
                </div>
                <div class="world_location clearfix rounded">
                    <iframe class="w-100 overflow-hidden rounded"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.4866435475124!2d30.108154114298564!3d-1.9589186372811278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca76d9f57f4dd%3A0x82fc7b5b7c073b9f!2sUBUVIVI%20Tours%20and%20Car%20Rental!5e0!3m2!1sen!2srw!4v1649668603950!5m2!1sen!2srw"
                        height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>
    </section>
@endsection
