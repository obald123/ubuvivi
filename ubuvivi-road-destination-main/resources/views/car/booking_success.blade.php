@extends("layouts.guest")
@section('title')
    Booking Successful - Ubuvivi Car Rental
@endsection

@section('css')
    <style>
        .input_title {
            font-size: 16px;
        }

    </style>
@endsection

@section('content')
    <section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 40px">
    </section>
    <section class="px-4 py-5 clearfix" style="background-color: rgb(255, 245, 175)">
        <div class="container mb-4">
            <div class="row justify-content-center flex-column align-items-center ">
                <i class="fa fa-check-circle text-success fa-5x mb-4"></i>
                <h3 class="text-center text-success mb-3">Success</h3>
                <h5 class="text-center mb-3 font-primary font-weight-bold">Booking Information Received</h5>
                <div class="col-12 col-md-8 col-lg-6">
                    <h5 class="text-center mb-3 font-primary">
                        Thank you for contacting us, one of our staff will get back to you as soon as possible to
                        your email: <a style="text-decoration: underline;"
                            href="mailto:{{ $booking->email }}">{{ $booking->email }}</a> . Regards
                    </h5>
                </div>
                <a class="btn btn-primary" href="{{ $booking_route }}">Check approval status</a>

            </div>
        </div>
    </section>
@endsection
