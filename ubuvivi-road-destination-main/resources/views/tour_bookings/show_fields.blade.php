@section('css')
    <style>
        .card-img-top {
            display: none
        }
    </style>
@endsection

<div class="col-12">
    <h3 style="color: #6c5ce7; font-weight: bold; margin-bottom: 20px; border-bottom: 3px solid #6c5ce7; padding-bottom: 10px;">Booking Status & Tour Information</h3>
</div>

<!-- Status Badge -->
<div class="col-12 mb-4">
    <div style="padding: 15px; border-radius: 8px; background: #f8f9fa; border-left: 4px solid #6c5ce7;">
        <strong style="font-size: 16px;">Status: </strong>
        @if (null === $tourBooking->approved)
            <span class="badge badge-warning" style="padding: 8px 12px; font-size: 14px;">Pending Review</span>
        @elseif (true === $tourBooking->approved)
            <span class="badge badge-success" style="padding: 8px 12px; font-size: 14px;">Approved</span>
        @elseif (false === $tourBooking->approved)
            <span class="badge badge-danger" style="padding: 8px 12px; font-size: 14px;">Rejected</span>
        @else
            <span class="badge badge-secondary" style="padding: 8px 12px; font-size: 14px;">Cancelled</span>
        @endif
    </div>
</div>

@if (!empty($tourBooking->tour))
    <div class="col-12">
        <h4 style="color: #6c5ce7; font-weight: bold; margin-top: 20px; margin-bottom: 15px;">Booked Tour/Itinerary</h4>
    </div>
    @include('itineraries.show_fields')
@endif

<div class="col-12">
    <h4 style="color: #6c5ce7; font-weight: bold; margin-top: 20px; margin-bottom: 15px;">Customer Information</h4>
</div>

<!-- Names Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('names', 'Full Name:') !!}
    {!! Form::text(null, $tourBooking->names, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('email', 'Email Address:') !!}
    {!! Form::text(null, $tourBooking->email, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::text(null, $tourBooking->phone_number, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Number of People Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('number_of_people', 'Number of People:') !!}
    {!! Form::text(null, $tourBooking->number_of_people ?? 'Not specified', ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<div class="col-12">
    <h4 style="color: #6c5ce7; font-weight: bold; margin-top: 20px; margin-bottom: 15px;">Tour Details</h4>
</div>

<!-- Date Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('date', 'Preferred Date:') !!}
    {!! Form::text(null, $tourBooking->date ?? 'Not specified', ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Booking Date -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('created_at', 'Booking Date:') !!}
    {!! Form::text(null, $tourBooking->created_at->format('M d, Y H:i A'), ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Reference Number -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('id', 'Booking Reference:') !!}
    {!! Form::text(null, '#' . str_pad($tourBooking->id, 5, '0', STR_PAD_LEFT), ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text(null, 'RWF ' . number_format($tourBooking->price ?? 0), ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-12 mb-4">
    {!! Form::label('message', 'Special Requests & Notes:') !!}
    {!! Form::textarea(null, $tourBooking->message ?? 'No special requests', ['readonly' => true, 'class' => 'form-control', 'rows' => '4', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<div class="form-group col-12 mb-4" style="margin-top: 20px; border-top: 1px solid #dee2e6; padding-top: 20px;">
    <a href="{{ route('tourBookings.edit', $tourBooking->id) }}" class="btn btn-primary" style="background: #6c5ce7; border: none;">Edit Tour Booking</a>
</div>
