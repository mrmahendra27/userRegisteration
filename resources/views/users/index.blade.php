@extends('layouts.master')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users Lists</h6>
        <form class="float-right class" action="{{ route('admin.users.removeDuplicates') }}" method="POST">
            @csrf
            <button type="submit" onclick="return confirm('{{ __('Are you sure, You want to remove duplicate data?')}}')" class="btn btn-danger">Removes Duplicates</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>Address</th>
                        <th>Ip Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>Address</th>
                        <th>Ip Address</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($users as $key=>$user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile_number }}</td>
                        <td>{{ $user->state }}</td>
                        <td>{{ $user->city }}</td>
                        <td>{{ $user->pincode }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->ip_address }}</td>
                        <td class="text-center">
                            <div class="card">
                                <div class="dropdown no-arrow">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if($user->deleted_at == null)
                                        <form action="{{ route('admin.users.destroy', [$user->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            class="dropdown-item" onclick="return confirm('{{ __('Are you sure, You want to delete?')}}')"
                                                >{{ __('Delete') }}</button>
                                        </form>
                                        @else
                                        <form
                                            action="{{ route('admin.users.forcedestroy', [$user->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('{{ __('Are you sure, You want to delete user permanently?')}}')"
                                                class="dropdown-item">{{ __('Permanent Delete') }}</button>
                                        </form>
                                        <form action="{{ route('admin.users.restore', [$user->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit"
                                                onclick="return confirm('{{ __('Are you sure, You want to restore?')}}')"
                                                class="dropdown-item">{{ __('Restore') }}</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <h4 style="text-align: center">No Data yet..! </h4>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('extrajs')
<script>
    $(document).ready(function() {
            $('#userLists').DataTable();
        });
</script>
@endsection
