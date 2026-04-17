<div class="table-responsive">
    <table class="table" id="carTransfers-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Names</th>
                <th>Phone Number</th>
                <th>Pickup Location</th>
                <th>Destination</th>
                <th>Pickup Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($carTransfers->isEmpty())
                <tr>
                    <td colspan="7">
                        <div class="empty text-center py-5">
                            No Car Transfers available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($carTransfers as $carTransfer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $carTransfer->names }}</td>
                        <td>{{ $carTransfer->phone_number }}</td>
                        <td>{{ $carTransfer->pickup_location ? $carTransfer->pickup_location : 'N/A' }}</td>
                        <td>{{ $carTransfer->destination ? $carTransfer->destination : 'N/A' }}</td>
                        <td>
                            {{ $carTransfer->pickup_date ? date('jS F, Y', strtotime($carTransfer->pickup_date)) : 'N/A' }}
                            {{ $carTransfer->pickup_time ? date('h:i A', strtotime($carTransfer->pickup_time)) : '' }}
                        </td>
                        <td>{{ $carTransfer->approved ? 'Approved' : 'Not Approved' }}</td>
                        <td class=" text-center">
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true"
                                    aria-expanded="false">
                                    Action
                                </button>
                                {!! Form::open(['route' => ['carTransfers.destroy', $carTransfer->id], 'method' => 'delete']) !!}
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                                    <a href="{!! route('carTransfers.show', [$carTransfer->id]) !!}" class='dropdown-item font-15 px-3'>
                                        View Transfer
                                    </a>
                                    {!! Form::button('<span>Delete Transfer</span>', ['type' => 'submit', 'class' => 'dropdown-item font-15 px-3 text-danger', 'onclick' => 'return confirm("Are you sure want to delete this transfer ?")']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{!! $carTransfers->onEachSide(-1)->links('layouts.pagination') !!}
