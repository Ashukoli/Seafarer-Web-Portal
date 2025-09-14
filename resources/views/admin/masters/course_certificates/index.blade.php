@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Courses & Certificates</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.course-certificates.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Add New
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-3" action="{{ route('admin.course-certificates.index') }}">
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="search" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Search by name">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-secondary">Search</button>
                    </div>
                </div>
            </form>

            <h6 class="mb-0 text-uppercase">List</h6>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Sort</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($items->currentPage()-1) * $items->perPage() }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sort }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.course-certificates.edit', $item->id) }}" class="text-warning" title="Edit">
                                            <i class="bx bx-edit fs-5"></i>
                                        </a>
                                        <form action="{{ route('admin.course-certificates.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-0 border-0 bg-transparent text-danger" title="Delete">
                                                <i class="bx bx-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</main>
@endsection
