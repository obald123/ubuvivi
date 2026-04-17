@extends('layouts.guest')

@section('title')
    Tour & Travels Agents Rwanda | Rwanda Tourism Services - Ubuvivi
@endsection

@section('meta')
    <meta name="description"
        content="Rwanda tourism services from Ubuvivi we arrange custom tour packages with an expert local tour guide to explore Rwanda tourism">
    <meta name="keywords" content="ubuvivi, Rwanda tourism services, Tour & Travels Agents Rwanda">
@endsection

@section('css')
    <style>
        .clamp-text {
            margin: 0;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 65px;
        }
    </style>
@endsection


@section('content')
    <section class="search_section clearfix pb-5" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 150px">
    </section>
    <section style="background-color: rgb(255, 245, 175)">
        <div class="container py-4">
            <h1 class="h3 font-weight-bold mb-5 text-center">Rwanda Tourism Services</h1>
            <div class="clearfix">
                @if ($tours->count())
                    <div class="row justify-content-start">
                        @foreach ($tours as $tour)
                            <div class="col-12 col-md-6 col-lg-4 d-flex">
                                <div class="d-flex flex-column flex-grow-1 bg-light mb-3 rounded shadow">
                                    <div class="card-img-top rounded-top"
                                        style="height: 150px;background-size: cover;background-repeat: no-repeat;background-position: center;background-image:url('{{ $tour->images ? $tour->images[0] : asset('/assets/images/vehicles/not_found.png') }}');">
                                    </div>
                                    <div class="card-body overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                                        <div class="row flex-column no-gutters align-items-start justify-content-start"
                                            style="font-size: 16px;line-height: 1.5;height:100%;">
                                            <h4 class="font-primary">{{ $tour->title }}</h4>
                                            @if (!$tour->price == 0)
                                                <h6>$ {{ $tour->price }} / person sharing</h6>
                                            @else
                                                <h6>-</h6>
                                            @endif
                                            <pre class="clamp-text font-primary">
                                                {{ $tour->description }}
                                            </pre>
                                            <div class="flex-grow-1"></div>
                                            <div style="width:100%">
                                                <a href="{{ route('tour.booking', $tour->id) }}"
                                                    class="btn btn-block btn-primary book-btn font-primary mt-3"
                                                    type="button">
                                                    See Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="container py-5">
                        <div class="row align-items-center justify-content-center">
                            <h4 class="text-center">No Tours available</h4>
                        </div>
                    </div>
                @endisset
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function lineclamp() {
        var lineheight = parseFloat($('p').css('line-height'));
        var articleheight = $('.clamp-text').height();
        var calc = parseInt(articleheight / lineheight);
        $("p").css({
            "-webkit-line-clamp": "" + calc + ""
        });
    }


    $(document).ready(function() {
        lineclamp();
    });

    $(window).resize(function() {
        lineclamp();
    });
</script>
@endsection
