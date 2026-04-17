<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th class="w-1">No</th>
                <th>Names</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Role</th>
                @if (Auth::user()->role == 'admin')
                    <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (!count($users))
                <tr>
                    <td colspan="7">
                        <div class="empty text-center py-5">
                            No Users available at the moment
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($users as $user)
                    <tr>
                        <td class="w-1">{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number ?? 'N/A' }}</td>
                        <td class="text-capitalize">{{ $user->role ?? 'N/A' }}</td>
                        @if (Auth::user()->role == 'admin')
                            <td class=" text-center">
                                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-warning action-btn edit-btn'>
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{!! $users->onEachSide(-1)->links('layouts.pagination') !!}
