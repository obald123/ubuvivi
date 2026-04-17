@if (!empty($carBooking->vehicle))
    @include('vehicles.show_fields')
@endif

<div class="col-12">
    <h4 class="text-primary">Customer Details</h4>
    <hr>
</div>
<!-- Names Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('names', 'Names:') !!}
    {!! Form::text(null, $carBooking->names, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text(null, $carBooking->email, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::number(null, $carBooking->phone_number, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Delivery Location Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('delivery_location', 'Delivery Location:') !!}
    {!! Form::text(null, $carBooking->delivery_location, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Delivery Date Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('delivery_date', 'Delivery Date:') !!}
    {!! Form::text(null, $carBooking->delivery_date . ' ' . $carBooking->delivery_time, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Number Of Days Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('number_of_days', 'Number Of Days:') !!}
    {!! Form::text(null, $carBooking->number_of_days, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-12 mb-4">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea(null, $carBooking->message, ['readonly' => true, 'class' => 'form-control', 'rows' => '5']) !!}
</div>

<div class="form-group col-12 col-md-6 mb-4">
    <a href="{{ route('carBookings.edit', $carBooking->id) }}" class="btn btn-primary">Next</a>
</div>
