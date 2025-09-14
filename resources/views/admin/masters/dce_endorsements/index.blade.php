@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3 d-flex justify-content-between">
        <h4>DCE Endorsements</h4>
        <a href="{{ route('admin.dce-endorsements.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>DCE Name</th>
                        <th>Sort</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($endorsements as $endorsement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $endorsement->dce_name }}</td>
                            <td>{{ $endorsement->sort }}</td>
                            <td>
                                <a href="{{ route('admin.dce-endorsements.edit', $endorsement->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.dce-endorsements.destroy', $endorsement->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this endorsement?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">No records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $endorsements->links('pagination::bootstrap-4') }}</div>
        </div>
    </div>
</main>
@endsection
