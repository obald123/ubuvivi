@section('css')
    <style>
        .card-img-top {
            display: none
        }

    </style>
@endsection
@if (!empty($tourBooking->tour))
    <div class="col-12">
        <h4 class="text-primary" >Booked Itinerary</h4>
        <hr>
    </div>
    @include('itineraries.show_fields')
@endif
<div class="col-12">
    <h4 class="text-primary">Customer Details</h4>
    <hr>
</div>

<!-- Names Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('names', 'Names:') !!}
    {!! Form::text(null, $tourBooking->names, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text(null, $tourBooking->email, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::number(null, $tourBooking->phone_number, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Pickup Location Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text(null, $tourBooking->date, ['readonly' => true, 'class' => 'form-control']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-12 mb-4">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea(null, $tourBooking->message, ['readonly' => true, 'class' => 'form-control', 'rows' => '5']) !!}
</div>


<!-- Approved Field -->
<div class="form-group col-12 col-md-6 mb-4">
    <a href="{{ route('tourBookings.edit', $tourBooking->id) }}" class="btn btn-primary">Next</a>
</div>
