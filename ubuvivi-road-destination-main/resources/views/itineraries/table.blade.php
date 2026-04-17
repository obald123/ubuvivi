<div class="table-responsive">
    <table class="table" id="itineraries-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Title</th>
                <th>Price</th>
                <th>Date Created</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($itineraries->isEmpty())
                <tr>
                    <td colspan="7">
                        <div class="empty text-center py-5">
                            No Itineraries available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($itineraries as $itinerary)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $itinerary->title }}</td>
                        <td>$ {{ $itinerary->price }}</td>
                        <td>{{ date('jS F, Y', strtotime($itinerary->created_at ?? null)) }}</td>
                        <td class=" text-center">
                            {!! Form::open(['route' => ['itineraries.destroy', $itinerary->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{!! route('itineraries.show', [$itinerary->id]) !!}" class='btn btn-light action-btn '><i
                                        class="fa fa-eye"></i></a>
                                <a href="{!! route('itineraries.edit', [$itinerary->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
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
{!! $itineraries->onEachSide(-1)->links('layouts.pagination') !!}
