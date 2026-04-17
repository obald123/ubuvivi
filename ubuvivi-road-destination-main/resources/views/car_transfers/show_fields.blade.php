@if (!empty($carTransfer->vehicle))
    @include('vehicles.show_fields')
@endif

<div class="col-12">
    <h4 class="text-primary">Customer Details</h4>
    <hr>
</div><!-- Names Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('names', 'Names:') !!}
    {!! Form::text(null, $carTransfer->names, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text(null, $carTransfer->email, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::number(null, $carTransfer->phone_number, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Pickup Location Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('pickup_location', 'Pickup Location:') !!}
    {!! Form::text(null, $carTransfer->pickup_location, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Pickup Location Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('destination', 'Destination:') !!}
    {!! Form::text(null, $carTransfer->destination, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Pickup Date Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('pickup_date', 'Pickup Time:') !!}
    {!! Form::text(null, $carTransfer->pickup_date . ' ' . $carTransfer->pickup_time, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Number Of Days Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('number_of_days', 'Number Of Days:') !!}
    {!! Form::text(null, $carTransfer->number_of_days, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-12 mb-4">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea(null, $carTransfer->message, ['readonly' => true, 'class' => 'form-control', 'rows' => '5']) !!}
</div>

<div class="form-group col-12 col-md-6 mb-4">
    <a href="{{ route('carTransfers.edit', $carTransfer->id) }}" class="btn btn-primary">Next</a>
</div>
