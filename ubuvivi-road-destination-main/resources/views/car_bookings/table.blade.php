<div class="table-responsive">
    <table class="table" id="carBookings-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Names</th>
                <th>Phone Number</th>
                <th>Delivery Location</th>
                <th>Delivery Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($carBookings->isEmpty())
                <tr>
                    <td colspan="7">
                        <div class="empty text-center py-5">
                            No Car Bookings available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($carBookings as $carBooking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $carBooking->names }}</td>
                        <td>{{ $carBooking->phone_number }}</td>
                        <td>{{ $carBooking->delivery_location ? $carBooking->delivery_location : 'N/A' }}</td>
                        <td>
                            {{ $carBooking->delivery_date ? date('jS F, Y', strtotime($carBooking->delivery_date ?? null)) : 'N/A' }}
                            {{ $carBooking->delivery_date ? date('h:i A', strtotime($carBooking->delivery_time ?? null)) : '' }}
                        </td>
                        <td>{{ $carBooking->approved ? 'Approved' : 'Not Approved' }}</td>
                        <td class=" text-center">
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true"
                                    aria-expanded="false">
                                    Action
                                </button>
                                {!! Form::open(['route' => ['carBookings.destroy', $carBooking->id], 'method' => 'delete']) !!}
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                                    <a href="{!! route('carBookings.show', [$carBooking->id]) !!}" class='dropdown-item font-15 px-3'>
                                        View Booking
                                    </a>
                                    {!! Form::button('<span>Delete Booking</span>', ['type' => 'submit', 'class' => 'dropdown-item font-15 px-3 text-danger', 'onclick' => 'return confirm("Are you sure want to delete this booking ?")']) !!}
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
{!! $carBookings->onEachSide(-1)->links('layouts.pagination') !!}
