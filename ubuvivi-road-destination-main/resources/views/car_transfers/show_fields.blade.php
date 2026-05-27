@if (!empty($carTransfer->vehicle))
    @include('vehicles.show_fields')
@endif

<div class="col-12">
    <h3 style="color: #6c5ce7; font-weight: bold; margin-bottom: 20px; border-bottom: 3px solid #6c5ce7; padding-bottom: 10px;">Booking Status & Details</h3>
</div>

<!-- Status Badge -->
<div class="col-12 mb-4">
    <div style="padding: 15px; border-radius: 8px; background: #f8f9fa; border-left: 4px solid #6c5ce7;">
        <strong style="font-size: 16px;">Status: </strong>
        @if (null === $carTransfer->approved)
            <span class="badge badge-warning" style="padding: 8px 12px; font-size: 14px;">Pending Review</span>
        @elseif (true === $carTransfer->approved)
            <span class="badge badge-success" style="padding: 8px 12px; font-size: 14px;">Approved</span>
        @elseif (false === $carTransfer->approved)
            <span class="badge badge-danger" style="padding: 8px 12px; font-size: 14px;">Rejected</span>
        @else
            <span class="badge badge-secondary" style="padding: 8px 12px; font-size: 14px;">Cancelled</span>
        @endif
    </div>
</div>

<div class="col-12">
    <h4 style="color: #6c5ce7; font-weight: bold; margin-top: 20px; margin-bottom: 15px;">Customer Information</h4>
</div>

<!-- Names Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('names', 'Full Name:') !!}
    {!! Form::text(null, $carTransfer->names, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('email', 'Email Address:') !!}
    {!! Form::text(null, $carTransfer->email, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::text(null, $carTransfer->phone_number, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<div class="col-12">
    <h4 style="color: #6c5ce7; font-weight: bold; margin-top: 20px; margin-bottom: 15px;">Transfer Details</h4>
</div>

<!-- Pickup Location Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('pickup_location', 'Pickup Location:') !!}
    {!! Form::text(null, $carTransfer->pickup_location, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Destination Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('destination', 'Destination:') !!}
    {!! Form::text(null, $carTransfer->destination, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Pickup Date Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('pickup_date', 'Pickup Date & Time:') !!}
    {!! Form::text(null, $carTransfer->pickup_date . ' ' . $carTransfer->pickup_time, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Number Of Days Field -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('number_of_days', 'Duration (Days):') !!}
    {!! Form::text(null, $carTransfer->number_of_days, ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Booking Date -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('created_at', 'Booking Date:') !!}
    {!! Form::text(null, $carTransfer->created_at->format('M d, Y H:i A'), ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Reference Number -->
<div class="form-group col-12 col-md-6 mb-4">
    {!! Form::label('id', 'Booking Reference:') !!}
    {!! Form::text(null, '#' . str_pad($carTransfer->id, 5, '0', STR_PAD_LEFT), ['readonly' => true, 'class' => 'form-control', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-12 mb-4">
    {!! Form::label('message', 'Special Requests & Notes:') !!}
    {!! Form::textarea(null, $carTransfer->message, ['readonly' => true, 'class' => 'form-control', 'rows' => '4', 'style' => 'border-left: 4px solid #6c5ce7;']) !!}
</div>

<div class="form-group col-12 mb-4" style="margin-top: 20px; border-top: 1px solid #dee2e6; padding-top: 20px;">
    <a href="{{ route('carTransfers.edit', $carTransfer->id) }}" class="btn btn-primary" style="background: #6c5ce7; border: none;">Edit Transfer Details</a>
</div>
