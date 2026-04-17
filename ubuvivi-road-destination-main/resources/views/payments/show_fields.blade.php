<div class="form-group col-12">
    {!! Form::label(null, 'Payment Reference:') !!}
    {!! Form::text(null, $payment->transaction_ref, ['class' => 'form-control', 'readonly' => true]) !!}
</div>

@isset($payment->car_booking_id)
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Names:') !!}
        {!! Form::text(null, $payment->carBooking->names, ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Phone Number:') !!}
        {!! Form::text(null, $payment->carBooking->phone_number, ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Booking Option:') !!}
        {!! Form::text(null, 'Car Booking', ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Price:') !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            {!! Form::text(null, $payment->carBooking->price, ['class' => 'form-control', 'readonly' => true]) !!}
        </div>
    </div>
    @if (!$payment->carBooking->vehicle->empy())
        <div class="form-group col-12">
            <a href="{{ route('carBookings.show', [$payment->carBooking->id]) }}" class="btn btn-primary">
                View Booking
            </a>
        </div>
    @endif
@endisset

@isset($payment->tour_booking_id)
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Names:') !!}
        {!! Form::text(null, $payment->tourBooking->names, ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Phone Number:') !!}
        {!! Form::text(null, $payment->tourBooking->phone_number, ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Booking Option:') !!}
        {!! Form::text(null, 'Tour Booking', ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Price:') !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            {!! Form::text(null, $payment->tourBooking->price, ['class' => 'form-control', 'readonly' => true]) !!}
        </div>
    </div>
    @if (!$payment->tourBooking->tour->empty())
        <div class="form-group col-12">
            <a href="{{ route('tourBookings.show', [$payment->tourBooking->id]) }}" class="btn btn-primary">
                View Booking
            </a>
        </div>
    @endif
@endisset

@isset($payment->car_transfer_id)
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Names:') !!}
        {!! Form::text(null, $payment->carTransfer->names, ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Phone Number:') !!}
        {!! Form::text(null, $payment->carTransfer->phone_number, ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Booking Option:') !!}
        {!! Form::text(null, 'Tour Booking', ['class' => 'form-control', 'readonly' => true]) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label(null, 'Price:') !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            {!! Form::text(null, $payment->carTransfer->price, ['class' => 'form-control', 'readonly' => true]) !!}
        </div>
    </div>
    @if (!$payment->carTransfer->vehicle->empty())
        <div class="form-group col-12">
            <a href="{{ route('carTransfers.show', [$payment->carTransfer->id]) }}" class="btn btn-primary">
                View Booking
            </a>
        </div>
    @endif
@endisset
