<div class="table-responsive">
    <table class="table" id="tourBookings-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Names</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Date</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($tourBookings->isEmpty())
                <tr>
                    <td colspan="6">
                        <div class="empty text-center py-5">
                            No Tour Bookings available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($tourBookings as $tourBooking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tourBooking->names }}</td>
                        <td>{{ $tourBooking->email }}</td>
                        <td>{{ $tourBooking->phone_number }}</td>
                        @if ($tourBooking->date)
                            <td> {{ date('jS F, Y', strtotime($tourBooking->date)) }}</td>
                        @else
                            <td>-</td>
                        @endif
                        <td>{{ $tourBooking->approved ? 'Approved' : 'Not Approved' }}</td>
                        <td class=" text-center">
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true"
                                    aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    {!! Form::open(['route' => ['tourBookings.destroy', $tourBooking->id], 'method' => 'delete']) !!}
                                    <a href="{!! route('tourBookings.show', [$tourBooking->id]) !!}" class='dropdown-item font-15 px-3'>
                                        View Booking
                                    </a>
                                    {!! Form::button('<span>Delete Booking</span>', ['type' => 'submit', 'class' => 'dropdown-item font-15 px-3 text-danger', 'onclick' => 'return confirm("Are you sure want to delete this booking ?")']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
</div>

</td>
</tr>
@endforeach
@endif
</tbody>
</table>
</div>{!! $tourBookings->onEachSide(-1)->links('layouts.pagination') !!}
