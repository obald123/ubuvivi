@section('css')
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
    crossorigin="anonymous">
@endsection

<!-- Brand Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand_id', 'Vehicle Brand:') !!}
    <select name="brand_id" class="custom-select text-capitalize">
        <option value="" disabled selected>Select Brand</option>
        @foreach ($brands as $brand)
        <option value="{{ $brand->id }}" @if (isset($vehicle) && $vehicle->brand_id == $brand->id) selected @endif>{{
            $brand->name }}
        </option>
        @endforeach
    </select>
</div>

<!-- Model Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_id', 'Vehicle Model:') !!}
    <select name="model_id" class="custom-select text-capitalize">
        <option value="" disabled selected>Select Model</option>
        @foreach ($models as $model)
        <option value="{{ $model->id }}" @if (isset($vehicle) && $vehicle->model_id == $model->id) selected @endif>{{
            $model->name }}
        </option>
        @endforeach
    </select>
</div>

<!-- Production Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('production_year', 'Production Year:') !!}
    {!! Form::text('production_year', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Seats Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seats', 'Number of Seats:') !!}
    {!! Form::number('seats', null, ['class' => 'form-control']) !!}
</div>

<!-- Transmission Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transmission_id', 'Vehicle Transmission:') !!}
    <select name="transmission_id" class="custom-select text-capitalize">
        <option value="" disabled selected>Select Transmission</option>
        @foreach ($transmissions as $transmission)
        <option value="{{ $transmission->id }}" @if (isset($vehicle) && $vehicle->transmission_id == $transmission->id)
            selected @endif>
            {{ $transmission->name }}</option>
        @endforeach
    </select>
</div>
<!-- Fuel Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fuel_type_id', 'Vehicle Fuel Type:') !!}
    <select name="fuel_type_id" class="custom-select text-capitalize">
        <option value="" disabled selected>Select Fuel Type</option>
        @foreach ($fuelTypes as $fuelType)
        <option value="{{ $fuelType->id }}" @if (isset($vehicle) && $vehicle->fuel_type_id == $fuelType->id) selected
            @endif>
            {{ $fuelType->name }}</option>
        @endforeach
    </select>
</div>

<!-- Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price Per Day:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number('price', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
    </div>
</div>

<!-- One Day Caution Field -->
<div class="form-group col-sm-6">
    {!! Form::label('one_day_caution', 'Caution:') !!}
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {!! Form::number('one_day_caution', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Location Field -->
<div class="form-group col-sm-12">
    {!! Form::label('location', 'Location:') !!}
    {!! Form::text('location', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 255, 'rows' => 5]) !!}
</div>

<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('images', 'Vehicle Images:') !!}
        <input id="vehicleImages" name="images[]" multiple="multiple" accept="image/*" type="file">
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('vehicles.index') }}" class="btn btn-light">Cancel</a>
</div>


@isset($vehicle)
@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/themes/fa/theme.min.js"></script>
<script>
    $(document).ready(function() {
                $.fn.fileinputBsVersion = "3.3.7";

                var configs = [];
                var {
                    id,
                    images
                } = {!! json_encode($vehicle->toArray()) !!}
                
                images = images.map((image, i) => {
                    configs.push({
                        key: i,
                        extra: {
                            id,
                            image,
                        }
                    })

                    return `<img src='${image}' class='file-preview-image' alt='Vehicle image ${i+1}' title='Vehicle image ${i+1}'>`
                })

                $("#vehicleImages").fileinput({
                    showUpload: false,
                    previewFileType: ['image'],
                    allowedFileTypes: ['image'],
                    browseClass: "py-2 btn btn-primary",
                    removeClass: "btn btn-default btn-dark",
                    initialPreview: images,
                    initialPreviewConfig: configs,
                    deleteUrl: `/vehicle/image/delete`,
                });

            })
</script>
@endsection
@else
@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/themes/fa/theme.min.js"></script>
<script>
    $(document).ready(function() {
                $.fn.fileinputBsVersion = "3.3.7";

                // with plugin option

                $("#vehicleImages").fileinput({
                    showUpload: false,
                    previewFileType: ['image'],
                    allowedFileTypes: ['image'],
                    browseClass: "py-2 btn btn-primary",
                    removeClass: "btn btn-default btn-dark",
                });

            })
</script>
@endsection
@endisset