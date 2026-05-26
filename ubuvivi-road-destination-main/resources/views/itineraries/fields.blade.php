@section('css')
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
@endsection

<!-- Title Field -->
<div class="form-group col-12">
    {!! Form::label('title', 'Itinerary Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control bg-light', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-12">
    {!! Form::label('price', 'Itinerary Price:') !!}
    <div class="input-group">
        <div class="input-group-text bg-light">$</div>
        {!! Form::number('price', null, ['class' => 'form-control bg-light', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Itinerary Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control bg-light', 'rows' => 5]) !!}
</div>

<!-- Highlight Field -->
<div class="col-12">
    <div class="border form-group rounded p-3 bg-light" id="highlights">
        <label for="highlights" class="d-flex justify-content-between align-items-center">
            <span>Itinerary Highlights:</span>
            <button class="btn btn-dark btn-sm" type="button" id="add_btn">Add Highlight</button>
        </label>
        <hr>
        @empty($itinerary->highlights)
            <div class="mt-2 row" id="highlight">
                <div class="form-group col-12">
                    <div class="input-group">
                        <input class="form-control" name="highlight[0][title]" placeholder="Title" />
                        <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0" type="button"
                            id="remove_btn">Remove</button>
                    </div>
                </div>
            </div>
        @else
            @foreach ($itinerary->highlights as $highlight)
                <div class="mt-2 row" id="highlight">
                    <div class="form-group col-12">
                        <div class="input-group">
                            <input class="form-control" value="{{ $highlight['title'] }}"
                                name="highlight[{{ $loop->index }}][title]" placeholder="title" />
                            <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0"
                                type="button" id="remove_btn">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endempty
    </div>
</div>

<!-- Inclusions Field -->
<div class="col-12">
    <div class="border form-group rounded p-3 bg-light" id="inclusions">
        <label for="inclusions" class="d-flex justify-content-between align-items-center">
            <span>Itinerary Inclusions:</span>
            <button class="btn btn-dark" type="button" id="add_btn">Add Inclusion</button>
        </label>
        <hr>
        @empty($itinerary->inclusions)
            <div class="mt-2 row" id="inclusion">
                <div class="form-group col-12">
                    <div class="input-group">
                        <input class="form-control" name="inclusion[0][title]" placeholder="Title" />
                        <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0" type="button"
                            id="remove_btn">Remove</button>
                    </div>
                </div>
            </div>
        @else
            @foreach ($itinerary->inclusions as $inclusion)
                <div class="mt-2 row" id="inclusion">
                    <div class="form-group col-12">
                        <div class="input-group">
                            <input class="form-control" value="{{ $inclusion['title'] }}"
                                name="inclusion[{{ $loop->index }}][title]" placeholder="title" />
                            <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0"
                                type="button" id="remove_btn">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endempty
    </div>
</div>

<!-- Exclusion Field -->
<div class="col-12">
    <div class="border form-group rounded p-3 bg-light" id="exclusions">
        <label for="exclusions" class="d-flex justify-content-between align-items-center">
            <span>Itinerary Exclusions:</span>
            <button class="btn btn-dark" type="button" id="add_btn">Add Exclusion</button>
        </label>
        <hr>
        @empty($itinerary->exclusions)
            <div class="mt-2 row" id="exclusion">
                <div class="form-group col-12">
                    <div class="input-group">
                        <input class="form-control" name="exclusion[0][title]" placeholder="Title" />
                        <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0" type="button"
                            id="remove_btn">Remove</button>
                    </div>
                </div>
            </div>
        @else
            @foreach ($itinerary->exclusions as $exclusion)
                <div class="mt-2 row" id="exclusion">
                    <div class="form-group col-12">
                        <div class="input-group">
                            <input class="form-control" value="{{ $exclusion['title'] }}"
                                name="exclusion[{{ $loop->index }}][title]" placeholder="title" />
                            <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0"
                                type="button" id="remove_btn">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endempty
    </div>
</div>

<!-- Days Description Field -->
<div class="col-12">
    <div class="border form-group rounded p-3 bg-light" id="days_descriptions">
        <label for="days_descriptions" class="d-flex justify-content-between align-items-center">
            <span>Itinerary Days Descriptions:</span>
            <button class="btn btn-dark" type="button" id="add_btn">Add Description</button>
        </label>
        <hr>
        @empty($itinerary->days_description)
            <div class="mt-2 row" id="days_description">
                <div class="form-group col-12">
                    <div class="input-group">
                        <input class="form-control" name="days_description[0][title]" placeholder="Title" />
                        <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0" type="button"
                            id="remove_btn">Remove</button>
                    </div>
                </div>
                <div class="form-group col-12">
                    <textarea class="form-control" name="days_description[0][description]" placeholder="Description" rows="5"></textarea>
                </div>
            </div>
        @else
            @foreach ($itinerary->days_description as $days_description)
                <div class="mt-2 row" id="days_description">
                    <div class="form-group col-12">
                        <div class="input-group">
                            <input class="form-control" value="{{ $days_description['title'] }}"
                                name="days_description[{{ $loop->index }}][title]" placeholder="title" />
                            <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0"
                                type="button" id="remove_btn">Remove</button>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        {!! Form::textarea('days_description[' . $loop->index . '][description]', null, ['class' => 'form-control', 'rows' => 5]) !!}
                    </div>
                </div>
            @endforeach
        @endempty
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('images', 'Itinerary Images:') !!}
        <input id="itineraryImages" name="images[]" multiple="multiple" accept="image/*" type="file"
            class="bg-light">
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('itineraries.index') }}" class="btn btn-light">Cancel</a>
</div>



@section('scripts')
    @isset($itinerary)
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
                } = {!! json_encode($itinerary->toArray()) !!}


                images = images.map((image, i) => {
                    configs.push({
                        key: i,
                        extra: {
                            id,
                            image,
                        }
                    })

                    return `<img src='${image}' class='file-preview-image' alt='itinerary image ${i+1}' title='itinerary image ${i+1}'>`
                })

                $("#itineraryImages").fileinput({
                    showUpload: false,
                    previewFileType: ['image'],
                    allowedFileTypes: ['image'],
                    browseClass: "py-2 btn btn-primary",
                    removeClass: "btn btn-default btn-dark",
                    initialPreview: images,
                    initialPreviewConfig: configs,
                    deleteUrl: `/itinerary/image/delete`,
                });

            })
        </script>
    @else
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

                $("#itineraryImages").fileinput({
                    showUpload: false,
                    previewFileType: ['image'],
                    allowedFileTypes: ['image'],
                    browseClass: "py-2 btn btn-primary",
                    removeClass: "btn btn-default btn-dark",
                });

            })
        </script>
    @endisset

    <script>
        function getInstance(type, id, index) {
            if (type == 1) {
                return `<div class="mt-2 row" id="${id.slice(0,-1)}">
                            <div class="form-group col-12">
                               <div class="input-group">
                                 <input class="form-control" name="${id.slice(0,-1)}[${index}][title]" placeholder="Title" />
                                 <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0" type="button" id="remove_btn">Remove</button>
                                </div>
                            </div>
                        </div>`
            } else if (type == 2) {
                return `<div class="mt-2 row" id="${id.slice(0,-1)}">
                            <div class="form-group col-12">
                                <div class="input-group">
                                    <input class="form-control" name="${id.slice(0,-1)}[${index}][title]" placeholder="Title" />
                                    <button class="btn btn-dark input-group-btn rounded-right" style="border-radius: 0" type="button" id="remove_btn">Remove</button>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <textarea class="form-control" name="${id.slice(0,-1)}[${index}][description]" placeholder="Description" rows="5"></textarea>
                            </div>
                        </div>`
            }
        }


        function createOptions(id, type) {
            $(document).ready(function() {
                $(document).on("click", `#${id} #add_btn`, function() {
                    let index = $(`#${id}`).children().length;
                    let instance = getInstance(type, id, index);
                    $(`#${id}`).append(instance);
                })

                $(document).on("click", `#remove_btn`, function() {
                    $(this).parent().parent().parent().remove();
                    $(`#${id}`).children().each(function(i) {
                        if (type == 1) {
                            $(this).find("input").attr("name", `${id.slice(0,-1)}[${i}][title]`);
                        } else if (type == 2) {
                            $(this).find("input").attr("name", `${id.slice(0,-1)}[${i}][title]`);
                            $(this).find("textarea").attr("name",
                                `${id.slice(0,-1)}[${i}][description]`);
                        }
                    })
                })
            })
        }


        createOptions("highlights", 1);
        createOptions("inclusions", 1);
        createOptions("exclusions", 1);
        createOptions("days_descriptions", 2);
    </script>
@endsection
