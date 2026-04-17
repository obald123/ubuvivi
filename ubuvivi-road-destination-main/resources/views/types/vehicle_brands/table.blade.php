<div class="table-responsive">
    <table class="table" id="vehicleBrands-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($vehicleBrands->isEmpty())
                <tr>
                    <td colspan="7">
                        <div class="empty text-center py-5">
                            No Vehicles Brands available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($vehicleBrands as $vehicleBrand)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vehicleBrand->name }}</td>
                        <td class=" text-center">
                            {!! Form::open(['route' => ['types.vehicleBrands.destroy', $vehicleBrand->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{!! route('types.vehicleBrands.edit', [$vehicleBrand->id]) !!}" class='btn btn-warning action-btn edit-btn'>
                                    <i class="fa fa-edit"></i>
                                </a>
                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
