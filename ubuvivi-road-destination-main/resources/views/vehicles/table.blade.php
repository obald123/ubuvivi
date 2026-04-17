<div class="table-responsive">
    <table class="table" id="vehicles-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Brand</th>
                <th>Model</th>
                <th class="text-center">Production Year</th>
                <th>Location</th>
                {{-- <th class="text-center">Status</th> --}}
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($vehicles->isEmpty())
                <tr>
                    <td colspan="7">
                        <div class="empty text-center py-5">
                            No Vehicles available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vehicle->brand ? $vehicle->brand->name : '-' }}</td>
                        <td>{{ $vehicle->model ? $vehicle->model->name : '-' }}</td>
                        <td class="text-center">{{ $vehicle->production_year }}</td>
                        <td>{{ $vehicle->location }}</td>
                        {{-- <td class="text-center">{{ $vehicle->approved == 1 ? 'Approved' : 'Not Approved' }}</td> --}}
                        <td class=" text-center">
                            {!! Form::open(['route' => ['vehicles.destroy', $vehicle->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{!! route('vehicles.show', [$vehicle->id]) !!}" class='btn btn-light action-btn '><i
                                        class="fa fa-eye"></i></a>
                                <a href="{!! route('vehicles.edit', [$vehicle->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
                                        class="fa fa-edit"></i></a>
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
{!! $vehicles->onEachSide(-1)->links('layouts.pagination') !!}