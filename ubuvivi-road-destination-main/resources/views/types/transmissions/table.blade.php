<div class="table-responsive">
    <table class="table" id="transmissions-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($transmissions->isEmpty())
                <tr>
                    <td colspan="3">
                        <div class="empty text-center py-5">
                            No Transmissions available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($transmissions as $transmission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transmission->name }}</td>
                        <td class=" text-center">
                            {!! Form::open(['route' => ['types.transmissions.destroy', $transmission->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{!! route('types.transmissions.edit', [$transmission->id]) !!}" class='btn btn-warning action-btn edit-btn'>
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
