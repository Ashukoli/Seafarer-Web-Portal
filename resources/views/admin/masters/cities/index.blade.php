@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3"><span>Cities</span></div>
        <div class="ms-auto">
            <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">Add City</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <h6 class="mb-0">City List</h6>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>City Name</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cities as $city)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $city->city_name }}</td>
                            <td>{{ $city->state->state_name }}</td>
                            <td>{{ $city->state->country->country_name }}</td>
                            <td>
                                @if($city->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.cities.edit', $city->id) }}" class="text-warning"><i class="bx bx-edit"></i></a>
                                <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 bg-transparent text-danger"
                                            onclick="return confirm('Delete this city?')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No cities found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $cities->links('pagination::bootstrap-4') }}</div>
        </div>
    </div>
</main>
@endsection
