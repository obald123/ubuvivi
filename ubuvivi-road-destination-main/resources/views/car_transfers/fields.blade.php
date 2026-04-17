{!! Form::hidden('names') !!}
{!! Form::hidden('email') !!}
{!! Form::hidden('phone_number') !!}
{!! Form::hidden('pickup_location') !!}
{!! Form::hidden('pickup_date') !!}
{!! Form::hidden('pickup_time') !!}
{!! Form::hidden('destination') !!}
{!! Form::hidden('message') !!}

<div class="form-group col-sm-12">
    {!! Form::label(null, 'Price:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number(null, $carTransfer->vehicle->price ?? 0, ['class' => 'form-control', 'maxlength' =>
        255,'id' => 'price']) !!}
    </div>
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label(null, '1 Day Caution:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number(null, $carTransfer->vehicle->one_day_caution ?? 0, ['class' => 'form-control', 'maxlength' =>
        255,'id' => 'one_day_caution']) !!}
    </div>
</div>
<div class="form-group col-sm-12">
    {!! Form::label(null, 'More Days Caution:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number(null, $carTransfer->vehicle->one_day_caution ?? 0, ['class' => 'form-control', 'maxlength' =>
        255, 'id' => 'more_days_caution']) !!}
    </div>
</div>
<div class="form-group col-sm-12">
    {!! Form::label(null, 'Number of Days:') !!}
    {!! Form::number('number_of_days', $carTransfer->number_of_days ?? 0, ['class' => 'form-control', 'maxlength' =>
    255,'id' => 'number_of_days']) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('price', 'Total Price:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number('price',null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255 ,'id' =>
        'total_price']) !!}
    </div>
</div>
<div class="form-group col-sm-12">
    {!! Form::label('approved', 'Approval:') !!}
    {!! Form::select('approved', ['1' => 'Approved', '0' => 'Disapproved'], 1, ['class' => 'form-control
    custom-select']) !!}
</div>


<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('carTransfers.index') }}" class="btn btn-light">Cancel</a>
</div>


@section('scripts')
<script>
    $(document).ready(function() {
        function initialize() {
            var price = $('#price').val();
            var one_day_caution = $('#one_day_caution').val();
            var more_days_caution = $('#more_days_caution').val();
            var number_of_days = $('#number_of_days').val();
            var total_price = price * number_of_days;
            var total_price_with_caution = number_of_days >= 3 ? Number(total_price) + Number(more_days_caution) : Number(total_price) + Number(one_day_caution);
            $('#total_price').val(total_price_with_caution);
        }

        initialize();

        $('#price').on('keyup', function() {
            var price = $('#price').val();
            var one_day_caution = $('#one_day_caution').val();
            var more_days_caution = $('#more_days_caution').val();
            var number_of_days = $('#number_of_days').val();
            var total_price = price * number_of_days;
            var total_price_with_caution = number_of_days >= 3 ? Number(total_price) + Number(more_days_caution) : Number(total_price) + Number(one_day_caution);
            $('#total_price').val(total_price_with_caution);
        });
        
        $('#number_of_days').on('keyup', function() {
            var price = $('#price').val();
            var one_day_caution = $('#one_day_caution').val();
            var more_days_caution = $('#more_days_caution').val();
            var number_of_days = $('#number_of_days').val();
            var total_price = price * number_of_days;
            var total_price_with_caution = number_of_days >= 3 ? Number(total_price) + Number(more_days_caution) : Number(total_price) + Number(one_day_caution);
            $('#total_price').val(total_price_with_caution);
        });

        $('#one_day_caution').on('keyup', function() {
            var price = $('#price').val();
            var one_day_caution = $('#one_day_caution').val();
            var more_days_caution = $('#more_days_caution').val();
            var number_of_days = $('#number_of_days').val();
            var total_price = price * number_of_days;
            var total_price_with_caution = number_of_days >= 3 ? Number(total_price) + Number(more_days_caution) : Number(total_price) + Number(one_day_caution);
            $('#total_price').val(total_price_with_caution);
        });

        $('#more_days_caution').on('keyup', function() {
            var price = $('#price').val();
            var one_day_caution = $('#one_day_caution').val();
            var more_days_caution = $('#more_days_caution').val();
            var number_of_days = $('#number_of_days').val();
            var total_price = price * number_of_days;
            var total_price_with_caution = number_of_days >= 3 ? Number(total_price) + Number(more_days_caution) : Number(total_price) + Number(one_day_caution);
            $('#total_price').val(total_price_with_caution);
        });
    });
</script>
@endsection