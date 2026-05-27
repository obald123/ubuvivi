@if ($vehicle)
<div class="col-12">
    <div class="section-body">
        <h3 class="section-title mt-1 mb-4">{{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }}
            {{ $vehicle->production_year ?? '' }}</h3>

        <div class="row">
            @php
                $images = $vehicle->images;
                if (is_string($images)) {
                    $images = json_decode($images, true);
                }
                $images = is_array($images) ? $images : [];
            @endphp
            @if (count($images) > 0)
            <div class="col-12 col-md-6 show_image mb-3">
                <div class="card shadow-none overflow-hidden">
                    <div class="card-body">
                        <div class="owl-carousel owl-theme">
                            @foreach ($images as $image)
                            <div>
                                <img alt="image" class="rounded" src="{{ $image }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif



            <div class="col-12 col-md-6 mb-3">
                <div class="card shadow-none">
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col-12 col-xl-4 col-sm-4 col-md-6 border">
                                <div class="">
                                    <h6 class="bg-primary text-white p-2">Year</h6>
                                    <p class="mb-1 px-2"> {{ $vehicle->production_year }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-xl-4 col-sm-4 col-md-6 border">
                                <div>
                                    <h6 class="bg-primary text-white p-2">Transmission</h6>
                                    <p class="mb-1 px-2"> {{ $vehicle->transmission->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-xl-4 col-sm-4 col-md-6 border">
                                <div>
                                    <h6 class="bg-primary text-white p-2">Fuel Type</h6>
                                    <p class="mb-1 px-2"> {{ $vehicle->fuelType->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-xl-4 col-sm-4 col-md-6 border">
                                <div>
                                    <h6 class="bg-primary text-white p-2">Seats</h6>
                                    <p class="mb-1 px-2"> {{ $vehicle->seats ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-xl-4 col-sm-4 col-md-6 border">
                                <div>
                                    <h6 class="bg-primary text-white p-2">Price / Day</h6>
                                    <p class="mb-1 px-2">$ {{ $vehicle->price ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-xl-4 col-sm-4 col-md-6 border">
                                <div>
                                    <h6 class="bg-primary text-white p-2">Caution</h6>
                                    <p class="mb-1 px-2">$ {{ $vehicle->one_day_caution ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @if ($vehicle->description)
            <div class="col-12">
                <div class="card">
                    <h4 class="px-4">Description</h4>
                    <div class="card-body">
                        {{ $vehicle->description }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @section('scripts')
    <script>
        $(document).ready(function() {
                $(".owl-carousel").owlCarousel({
                    center: true,
                    loop: true,
                    items: 1,
                    nav: false,
                    singleItem: true,
                    autoHeight: false,
                    dotsEach: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                });

                $('img').on("error", function() {
                    this.src = `{{ asset('/assets/images/vehicles/not_found.png') }}`;
                    this.style = this.style + "object-fit: contain; background-size: contain;"
                })
            });
    </script>
    @endsection
</div>
@endif