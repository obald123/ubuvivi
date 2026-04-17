@section('css')
    <style>
        .card li {
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
<img class="card-img-top"
    src="{{ $itinerary->images ? $itinerary->images[0] : asset('/assets/images/vehicles/not_found.png') }}"
    alt="image" style="height: 250px;object-fit: cover;object-position: top;">
<div class="card-body">
    <h3 class="mt-2">{{ $itinerary->title }}</h3>
    @if ($itinerary->price)
        <h6>$ {{ $itinerary->price }} / per person</h6>
    @endif

    @if ($itinerary->description)
        <section class="mt-5 mb-5">
            <h5>Tour Description</h5>
            <article>
                {{ $itinerary->description }}
            </article>
        </section>
    @endif

    @if (!empty($itinerary->highlights))
        <section class="mb-5">
            <h5>Tour Highlights</h5>
            <ul>
                @foreach ($itinerary->highlights as $highlight)
                    <li>{{ $highlight['title'] }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    @if (!empty($itinerary->days_description))
        <section class="pb-5">
            <h5>Tour Agenda</h5>
            <div class="container ml-0">
                <div class="timeline">
                    @foreach ($itinerary->days_description as $description)
                        <div class="timeline-section mb-3">
                            <div class="timeline-date">
                                Day {{ $loop->iteration }}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6>{{ $description['title'] }}</h6>
                                    <article>{{ $description['description'] }}</article>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <div class="row">
        @if (!empty($itinerary->inclusions))
            <div class="col-12 col-md-6">
                <h5>Inclusions</h5>
                <ul>
                    @foreach ($itinerary->inclusions as $inclusion)
                        <li>{{ $inclusion['title'] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($itinerary->exclusions))
            <div class="col-12 col-md-6">
                <h5>Exclusions</h5>
                <ul>
                    @foreach ($itinerary->exclusions as $exclusion)
                        <li>{{ $exclusion['title'] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@section('scripts')
    <script>
        $('img').on("error", function() {
            this.src = `{{ asset('/assets/images/vehicles/not_found.png') }}`;
            this.style = this.style + "height: 250px;object-fit: contain; background-size: contain;"
        })
    </script>
@endsection
