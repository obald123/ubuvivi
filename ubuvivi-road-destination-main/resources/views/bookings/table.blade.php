<div class="table-responsive">
    <table class="table" id="bookings-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Booking Type</th>
                <th>Package</th>
                <th>Price</th>
                <th>Departure Address</th>
                <th>Arrival Address</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>Approved</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->booking_type_id }}</td>
                    <td>{{ $booking->package_id }}</td>
                    <td>$ {{ $booking->price }}</td>
                    <td>{{ $booking->departure_address }}</td>
                    <td>{{ $booking->arrival_address }}</td>
                    <td>{{ $booking->departure_time }}</td>
                    <td>{{ $booking->arrival_time }}</td>
                    <td>{{ $booking->approved }}</td>
                    <td class=" text-center">
                        {!! Form::open(['route' => ['bookings.destroy', $booking->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('bookings.show', [$booking->booking_type_id, $booking->id]) !!}" class='btn btn-light action-btn '><i
                                    class="fa fa-eye"></i></a>
                            <a href="{!! route('bookings.edit', [$booking->booking_type_id, $booking->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
                                    class="fa fa-edit"></i></a>
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
