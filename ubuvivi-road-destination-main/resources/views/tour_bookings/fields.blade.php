{!! Form::hidden('names') !!}
{!! Form::hidden('email') !!}
{!! Form::hidden('phone_number') !!}
{!! Form::hidden('date') !!}
{!! Form::hidden('message') !!}

<div class="form-group col-sm-12">
    {!! Form::label('approved', 'Approval:') !!}
    {!! Form::select('approved', ['1' => 'Approved', '0' => 'Disapproved'], 1, ['class' => 'form-control
    custom-select']) !!}
</div>

<!-- Price Field -->

<div class="form-group col-sm-12">
    {!! Form::label(null, 'Price Per Person:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!!
        Form::number(null, $tourBooking->tour->price ?? 0, ['id'=>'price_field','class' =>'form-control','maxlength' =>
        255])
        !!}
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label(null, 'Number of People:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-users"></i>
            </span>
        </div>
        {!! Form::number(null, $tourBooking->number_of_people ?? 1, ['id'=>'number_of_people','class' => 'form-control',
        'maxlength' => 255]) !!}
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('price', 'Total Price:') !!}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number('price', ($tourBooking->tour->price ?? 0) * ($tourBooking->number_of_people ?? 1),
        ['id'=>'total_price','class' =>
        'form-control', 'maxlength' => 255]) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tourBookings.index') }}" class="ml-2 btn btn-light">Cancel</a>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
            $('#price_field').on('keyup', function() {
                var price = $('#price_field').val();
                var number_of_people = $('#number_of_people').val();
                var total_price = price * number_of_people;
                $('#total_price').val(total_price);
            });

            $('#number_of_people').on('keyup', function() {
                var price = $('#price_field').val();
                var number_of_people = $('#number_of_people').val();
                var total_price = price * number_of_people;
                $('#total_price').val(total_price);
            });
        });
</script>
@endsection