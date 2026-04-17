{!! Form::hidden('names') !!}
{!! Form::hidden('email') !!}
{!! Form::hidden('phone_number') !!}
{!! Form::hidden('delivery_location') !!}
{!! Form::hidden('delivery_date') !!}
{!! Form::hidden('delivery_time') !!}
{!! Form::hidden('message') !!}
<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label(null, 'Caution:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number(null, $carBooking->vehicle->one_day_caution ?? 0, ['class' => 'form-control', 'maxlength' =>
        255,'id' => 'one_day_caution']) !!}
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label(null, 'Price Per Day:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number(null, $carBooking->vehicle->price ?? 0, ['class' => 'form-control', 'maxlength' => 255,'id' =>
        'price_per_day']) !!}
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label(null, 'Number of Days:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number('number_of_days', $carBooking->number_of_days ?? 0, ['class' => 'form-control', 'maxlength'
        =>255,'id' => 'number_of_days']) !!}
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('price', 'Total Price:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number('price', (($carBooking->vehicle->price ?? 0) *($carBooking->number_of_days ?? 0)) +
        ($carBooking->vehicle->one_day_caution ?? 0), ['class' => 'form-control',
        'maxlength' => 255,'id' => 'total_price']) !!}
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('approved', 'Approval:') !!}
    {!! Form::select('approved', ['1' => 'Approved', '0' => 'Disapproved'], 1, ['class' => 'form-control
    custom-select']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('carBookings.index') }}" class="ml-2 btn btn-light">Cancel</a>
</div>


@section('scripts')
<script>
    $(document).ready(function() {
        $('#number_of_days').on('change', function() {
            var one_day_caution = $('#one_day_caution').val();
            var price_per_day = $('#price_per_day').val();
            var number_of_days = $('#number_of_days').val();
            var total_price = Number((price_per_day * number_of_days)) + Number(one_day_caution);
            $('#total_price').val(total_price);
        });

        $('#one_day_caution').on('change', function() {
            var one_day_caution = $('#one_day_caution').val();
            var price_per_day = $('#price_per_day').val();
            var number_of_days = $('#number_of_days').val();
            var total_price = Number((price_per_day * number_of_days)) + Number(one_day_caution);
            $('#total_price').val(total_price);
        });

        $('#price_per_day').on('change', function() {
            var one_day_caution = $('#one_day_caution').val();
            var price_per_day = $('#price_per_day').val();
            var number_of_days = $('#number_of_days').val();
            var total_price = Number((price_per_day * number_of_days)) + Number(one_day_caution);
            $('#total_price').val(total_price);
        });
    });
</script>
@endsection