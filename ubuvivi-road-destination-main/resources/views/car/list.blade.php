@extends('layouts.guest')

@section('title')
    Car Rentals in Kigali, Rwanda - UBUVIVI
@endsection

@section('meta')
    <meta name="description"
        content="Car Rentals in Kigali, Rwanda - UBUVIVI We offer the best Car hire Rwanda, 4X4 rent a car Rwanda, and self drive Rwanda services">
    <meta name="keywords" content="ubuvivi, Rwanda Cars for Rental, Car Rentals in Kigali, Car Rentals in Kigali, Kigali Car Rentals">
@endsection

@section('content')
    <section class="search_section clearfix pb-3" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 180px">
        <div class="container">
            <h1 class="h3 font-weight-bold mb-5 text-center text-white">Rwanda Cars for Rental</h1>
            <div class="advance_search_form2 mt-0 p-0 shadow-none">
                <form action="/cars">
                    {{ csrf_field() }}
                    <div class="row align-items-start justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" style="z-index: 45">
                            <div class="form_item aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                <h4 class="input_title text-white">Vehicle Brand</h4>
                                <div class="position-relative">
                                    <select id="brand_select" name="vehicle_brand"
                                        class="text-capitalize small justify-content-between">
                                        <option value="" selected>Select Vehicle Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}"
                                                @if (request()->has('vehicle_brand') && request()->get('vehicle_brand') == $brand->name) selected @endif>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" style="z-index: 4">
                            <div class="form_item aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                <h4 class="input_title text-white">Vehicle Model</h4>
                                <div class="position-relative">
                                    <select id="model_select" name="vehicle_model"
                                        class="text-capitalize small justify-content-between">
                                        <option value="" selected>Select Vehicle Model</option>
                                        @if (request()->has('vehicle_model') && request()->get('vehicle_model'))
                                            <option value="{{ request()->get('vehicle_model') }}" selected>
                                                {{ request()->get('vehicle_model') }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center col-lg-auto col-md-6 col-sm-12 col-xs-12 aos-init aos-animate mt-4 flex-wrap"
                            data-aos="fade-up" data-aos-delay="600">
                            <a href="{{ route('car.list') }}"
                                style="font-family: 'nunito', Arial, cursive;height: 48px; line-height: 50px;"
                                class="font-weight-bold font-15 bg_default_red text-uppercase my-2 mr-2 rounded px-3 text-white">
                                Back
                            </a>
                            <button id="sbmt_btn" type="submit" class="custom_btn bg_default_red text-uppercase my-2 ms-2"
                                style="height: 48px;line-height: 50px;min-width: 0; width: fit-content">
                                <span id="sbmt_btn_loading" class="fa fa-spinner fa-spin"></span>
                                <span id="sbmt_btn_text">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        </div>
    </section>
    <section style="background-color: rgb(255, 245, 175)">
        <div class="container">
            <div class="row clearfix">
                @if ($vehicles->count())
                    @foreach ($vehicles as $vehicle)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="feature_vehicle_item bg-light overflow-hidden rounded shadow" data-aos="fade-up"
                                data-aos-delay="100">
                                <div class="title bg-dark-1 text-light px-3 py-2">
                                    <h5 style="line-height: 1.7" class="font-primary mb-0 text-white">
                                        {{ $vehicle->brand->name ?? '' }}
                                        {{ $vehicle->model->name ?? '' }}
                                        {{ $vehicle->production_year }}
                                    </h5>
                                </div>
                                <div class="card-img-top rounded-0"
                                    style="height: 180px;background-size: cover;background-repeat: no-repeat;background-position: center;background-image:  @if ($vehicle->images) url({{ $vehicle->images[0] }}), @endif url('{{ asset('/assets/images/vehicles/not_found.png') }}')">
                                </div>
                                <div class="row no-gutters flex-nowrap" style="font-size: 14px;line-height: 1.5;">
                                    <div class="col border">
                                        <div class="p-1">
                                            <p class="font-weight-bold mb-1" style="white-space: nowrap">Transmission</p>
                                            <span>{{ $vehicle->transmission->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col border">
                                        <div class="p-1">
                                            <p class="font-weight-bold mb-1" style="white-space: nowrap">Fuel type</p>
                                            <span>{{ $vehicle->fuelType->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col border">
                                        <div class="p-1">
                                            <p class="font-weight-bold mb-1" style="white-space: nowrap">Price / Day</p>
                                            <span><span style="">$</span>
                                                {{ $vehicle->price ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col border">
                                        <div class="p-1">
                                            <p class="font-weight-bold mb-1" style="white-space: nowrap">Caution</p>
                                            <span><span style="">$</span>
                                                {{ $vehicle->one_day_caution ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 p-3">
                                    <a href="{{ route('car.booking', $vehicle->id) }}"
                                        class="btn d-block btn-primary font-15 book-btn" type="button">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="container">
                        <div class="row align-items-center justify-content-center py-5">
                            <h4 class="text-center">No vehicles available</h4>
                        </div>
                    </div>
                @endisset
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        getModels();
        $('#brand_select').on('change', getModels);

        function getModels() {
            $('#sbmt_btn_loading').show();
            $('#sbmt_btn_text').hide();
            $('#sbmt_btn').attr('disabled', true);
            $('#model_select').attr('disabled', true);
            $('#model_select').niceSelect('update');


            var brand = $('#brand_select').val();
            $.ajax({
                url: `{{ route('brand.models', ':brand_id') }}`.replace(':brand_id', brand),
                data: {
                    _token: "{{ csrf_token() }}"
                },
                type: "POST",
                success: function(data) {
                    data = $.map(data, function(value, index) {
                        return {
                            id: index,
                            name: value
                        }
                    });

                    var options = $('#model_select option');

                    for (var i = 0; i < options.length; i++) {
                        if (i > 0) {
                            $('#model_select option').last().remove();
                        }
                    }
                    data.forEach(function(value) {
                        var isSelected =
                            "{{ request()->has('vehicle_model') ? request()->get('vehicle_model') : '' }}" ==
                            value.name;
                        $('#model_select').append($('<option>', {
                            value: value.name,
                            text: value.name,
                            selected: isSelected
                        }));
                    });


                    $('#sbmt_btn_loading').hide();
                    $('#sbmt_btn_text').show();
                    $('#sbmt_btn').attr('disabled', false);
                    $('#model_select').attr('disabled', false);
                    $('#model_select').niceSelect('update');
                },
                error: function(error) {
                    $('#sbmt_btn_loading').hide();
                    $('#sbmt_btn_text').show();
                    $('#sbmt_btn').attr('disabled', false);
                    $('#model_select').attr('disabled', false);
                    $('#model_select').niceSelect('update');
                }
            });
        }

    });
</script>
@endsection
