<!-- Booking Type Id Field -->
<div class="form-group">
    {!! Form::label('booking_type_id', 'Booking Type Id:') !!}
    <p>{{ $booking->booking_type_id }}</p>
</div>

<!-- Package Id Field -->
<div class="form-group">
    {!! Form::label('package_id', 'Package Id:') !!}
    <p>{{ $booking->package_id }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>$ {{ $booking->price }}</p>
</div>

<!-- Departure Address Field -->
<div class="form-group">
    {!! Form::label('departure_address', 'Departure Address:') !!}
    <p>{{ $booking->departure_address }}</p>
</div>

<!-- Arrival Address Field -->
<div class="form-group">
    {!! Form::label('arrival_address', 'Arrival Address:') !!}
    <p>{{ $booking->arrival_address }}</p>
</div>

<!-- Departure Time Field -->
<div class="form-group">
    {!! Form::label('departure_time', 'Departure Time:') !!}
    <p>{{ $booking->departure_time }}</p>
</div>

<!-- Arrival Time Field -->
<div class="form-group">
    {!! Form::label('arrival_time', 'Arrival Time:') !!}
    <p>{{ $booking->arrival_time }}</p>
</div>

<!-- Approved Field -->
<div class="form-group">
    {!! Form::label('approved', 'Approved:') !!}
    <p>{{ $booking->approved }}</p>
</div>

