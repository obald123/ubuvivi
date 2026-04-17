@extends('layouts.guest')

@section('title')
    {{ $tour->title }} | Tour Booking - Ubuvivi
@endsection

@section('meta')
    <meta name="description" content="{{ $tour->description }}">
    <meta name="keywords" content="ubuvivi, {{ $tour->title }}, {{ $tour->title }} Rwanda, {{ $tour->title }} booking">
@endsection

@section('css')
    <style>
        .input_title {
            font-size: 16px;
        }

        h5 {
            font-weight: bold
        }
    </style>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sticksy/dist/sticksy.min.js"></script>

    <script>
        $('img').on("error", function() {
            this.src = `{{ asset('/assets/images/vehicles/not_found.png') }}`;
            this.style = "max-height: 55vh;object-fit: contain;object-position: center;"
            this.classList.add("border-bottom");
        })
    </script>
@endsection

@section('content')
    <section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 40px">
    </section>
    <section style="background-color:rgb(255, 245, 175)">
        <div class="img"
            style="max-height: 55vh;object-fit: contain;object-position: center;background-repeat: no-repeat;background-size: cover;background-image: url({{ $tour->images ? $tour->images[0] : asset('/assets/images/vehicles/not_found.png') }})">
            <img class="card-img-top"
                src="{{ $tour->images ? $tour->images[0] : asset('/assets/images/vehicles/not_found.png') }}" alt="image"
                class="border-bottom" style="max-height: 55vh;object-fit: contain;object-position: center;backdrop-filter: blur(15px);">
        </div>

        <div class="container">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h1 class="font-weight-bold h3 mt-2">{{ $tour->title }}</h3>
                            @if (!$tour->price == 0)
                                <h6 class="font-weight-bold">$ {{ $tour->price }} / person sharing</h6>
                            @endif

                            <section class="mt-4">
                                <h5>Tour Details</h5>
                            </section>

                            @if (!empty($tour->description))
                                <section class="mb-4">
                                    <pre class="font-primary">{{ $tour->description }}</pre>
                                </section>
                            @endif

                            @if (!empty($tour->highlights))
                                <section class="mb-4">
                                    <h5>Tour Highlights</h5>
                                    <ul>
                                        @foreach ($tour->highlights as $highlight)
                                            <li>{{ $highlight['title'] }}</li>
                                        @endforeach
                                    </ul>
                                </section>
                            @endif

                            @if (!empty($tour->days_description))
                                <section class="pb-2">
                                    <h5>Tour Agenda</h5>
                                    <div class="container">
                                        <div class="timeline">
                                            @foreach ($tour->days_description as $description)
                                                <div class="timeline-section mb-2">
                                                    <li class="font-weight-bold">
                                                        {{ $description['title'] }}
                                                    </li>
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <pre class="font-primary pl-4">
                                                            {{ $description['description'] }}
                                                        </pre>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </section>
                            @endif

                            <div class="row">
                                @if (!empty($tour->inclusions))
                                    <div class="col-12 mb-2">
                                        <h5>Trip Inclusions</h5>
                                        <ul>
                                            @foreach ($tour->inclusions as $inclusion)
                                                <li>{{ $inclusion['title'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (!empty($tour->exclusions))
                                    <div class="col-12 mb-4">
                                        <h5>Trip Exclusions</h5>
                                        <ul>
                                            @foreach ($tour->exclusions as $exclusion)
                                                <li>{{ $exclusion['title'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                    </div>
                    <div class="col">
                        <section class="clearfix">
                            @if (!empty($errors))
                                @if ($errors->any())
                                    <ul class="alert bg-danger font-15 text-white" style="list-style-type: none">
                                        @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                            @include('flash::message')
                            <div class="card-body bg-dark-1 rounded">

                                <div class="row justify-content-center">
                                    <h4 class="mb-4 mt-2 text-center text-white">Inquire this tour</h4>
                                </div>
                                {!! Form::open(['route' => ['tour.book', $tour->id]]) !!}
                                <div class="">
                                    <div class="row no-gutters m-auto">
                                        <!-- Name Field -->
                                        <div class="form-group col-sm-12">
                                            <h4 class="input_title text-white">Full names: *</h4>
                                            {!! Form::text('names', isset($names) ? $names : null, [
                                                'class' => 'form-control',
                                                'required' => true,
                                                'maxlength' => 255,
                                            ]) !!}
                                        </div>

                                        <!-- Email Field -->
                                        <div class="form-group col-sm-12">
                                            <h4 class="input_title text-white">Email: *</h4>
                                            {!! Form::email('email', isset($email) ? $email : null, [
                                                'class' => 'form-control',
                                                'required' => true,
                                                'maxlength' => 255,
                                            ]) !!}
                                        </div>

                                        <!-- Phone Number Field -->
                                        <div class="form-group col-sm-12">
                                            <h4 class="input_title text-white">Phone Number: *</h4>
                                            {!! Form::tel('phone_number', isset($phone_number) ? $phone_number : null, [
                                                'class' => 'form-control',
                                                'required' => true,
                                                'maxlength' => 13,
                                            ]) !!}
                                        </div>

                                        <!-- Number of people Field -->
                                        <div class="form-group col-sm-12">
                                            <h4 class="input_title text-white">Number of people:</h4>
                                            {!! Form::text('number_of_people', isset($number_of_people) ? $number_of_people : null, [
                                                'class' => 'form-control',
                                                'maxlength' => 255,
                                            ]) !!}
                                        </div>

                                        <!-- Number of people Field -->
                                        <div class="form-group col-12">
                                            <h4 class="input_title text-white">Date:</h4>
                                            <div class="position-relative">
                                                {!! Form::date('date', null, ['id' => 'dateField', 'class' => 'form-control', 'maxlength' => 255]) !!}
                                            </div>
                                        </div>

                                        <!-- message Field -->
                                        <div class="form-group col-12">
                                            <h4 class="input_title text-white">Additional Message:</h4>
                                            <div class="position-relative">
                                                {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 5, 'maxlength' => 255]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-auto">
                                        <div class="form-group col-12">
                                            <div class="row justify-content-end mt-3">
                                                <div class="col-auto px-0">
                                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <style>
        .d-flex flex-column li {
            list-style-type: square;
        }

        .timeline {
            margin-top: 20px;
            position: relative;

        }

        .timeline:before {
            position: absolute;
            content: '';
            width: 4px;
            height: calc(100% + 25px);
            background: #6c757d;
            left: 14px;
            top: 5px;
            border-radius: 4px;
        }

        .timeline-section {
            padding-left: 35px;
            display: block;
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-date {
            margin-bottom: 15px;
            padding: 2px 15px;
            background: var(--gray-dark);
            position: relative;
            display: inline-block;
            border-radius: 5px;
            border: 1px solid var(--gray-dark);
            color: #fff;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
        }

        .timeline-section:before {
            content: '';
            position: absolute;
            width: 30px;
            height: 1px;
            background-color: #6c757d;
            top: 12px;
            left: 20px;
        }

        .timeline-section:after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background: #6c757d;
            top: 7px;
            left: 11px;
            border: 1px solid #6c757d;
            border-radius: 100%;
        }

        .timeline-section .col-sm-4 {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $('.date').datepicker({
            format: 'DD/MM/YYYY'
        });
        $("#dateField").val(new Date().toLocaleString('en-US').substring(0, 10));
        console.log($("#dateField").val());
        $('img').on("error", function() {
            this.src = `{{ asset('/assets/images/vehicles/not_found.png') }}`;
            this.style = this.style + "object-fit: contain; background-size: contain;"
        })
    </script>
@endsection
