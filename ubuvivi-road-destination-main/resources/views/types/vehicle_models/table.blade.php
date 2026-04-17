<div class="table-responsive">
    <table class="table" id="vehicleModels-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($vehicleModels->isEmpty())
                <tr>
                    <td colspan="3">
                        <div class="empty text-center py-5">
                            No Vehicle Models available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($vehicleModels as $vehicleModel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vehicleModel->name }}</td>
                        <td class=" text-center">
                            {!! Form::open(['route' => ['types.vehicleModels.destroy', $vehicleModel->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{!! route('types.vehicleModels.edit', [$vehicleModel->id]) !!}" class='btn btn-warning action-btn edit-btn'>
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
