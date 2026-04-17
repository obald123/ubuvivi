<!-- Booking Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('booking_type_id', 'Booking Type Id:') !!}
    {!! Form::number('booking_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Package Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('package_id', 'Package Id:') !!}
    {!! Form::number('package_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::textarea('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Departure Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('departure_address', 'Departure Address:') !!}
    {!! Form::text('departure_address', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Arrival Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('arrival_address', 'Arrival Address:') !!}
    {!! Form::text('arrival_address', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Departure Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('departure_time', 'Departure Time:') !!}
    {!! Form::text('departure_time', null, ['class' => 'form-control','id'=>'departure_time']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#departure_time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Arrival Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('arrival_time', 'Arrival Time:') !!}
    {!! Form::text('arrival_time', null, ['class' => 'form-control','id'=>'arrival_time']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#arrival_time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Approved Field -->
<div class="form-group col-sm-6">
    {!! Form::label('approved', 'Approved:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('approved', 0) !!}
        {!! Form::checkbox('approved', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('bookings.index') }}" class="btn btn-light">Cancel</a>
</div>
