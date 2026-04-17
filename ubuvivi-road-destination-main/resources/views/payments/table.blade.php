<div class="table-responsive">
    <table class="table" id="payments-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Booking Type</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($payments->isEmpty())
                <tr>
                    <td colspan="7">
                        <div class="empty text-center py-5">
                            No Payments available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @isset($payment->car_booking_id)
                            <td>Car Booking</td>
                        @endisset
                        @isset($payment->car_transfer_id)
                            <td>Car Transfer</td>
                        @endisset
                        @isset($payment->tour_booking_id)
                            <td>Tour Booking</td>
                        @endisset
                        <td>{{ $payment->status }}</td>
                        <td>
                            {{ date('jS F, Y', strtotime($payment->created_at ?? null)) }}
                        </td>
                        <td class=" text-center">
                            <div class='btn-group'>
                                <a href="{!! route('payments.show', [$payment->id]) !!}" class='btn btn-light action-btn '>
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{!! $payments->onEachSide(-1)->links('layouts.pagination') !!}
