@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Countries</h4>
        <a href="{{ route('admin.countries.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Country</a>
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
                        <th>Country</th>
                        <th>Code</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($countries as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $c->country_name }}</td>
                            <td>{{ $c->country_code }}</td>
                            <td>{{ $c->sort }}</td>
                            <td>{!! $c->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>' !!}</td>
                            <td>
                                <a href="{{ route('admin.countries.edit',$c->id) }}" class="text-warning"><i class="bx bx-edit"></i></a>
                                <form action="{{ route('admin.countries.destroy',$c->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0"><i class="bx bx-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No countries found</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                    {{ $countries->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</main>
@endsection
