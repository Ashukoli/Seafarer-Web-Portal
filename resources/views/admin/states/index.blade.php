@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">States</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.states.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>Add State
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.states.index') }}" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <label for="country_id" class="form-label">Filter by Country</label>
                    <select name="country_id" id="country_id" class="form-select">
                        <option value="">-- All Countries --</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>
                                {{ $country->country_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-search"></i> Filter</button>
                </div>
                <div class="col-md-2 mt-4">
                    <a href="{{ route('admin.states.index') }}" class="btn btn-secondary"><i class="bx bx-reset"></i> Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- States Table -->
    <div class="card">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">State List</h6>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>State Name</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($states as $state)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $state->state_name }}</td>
                                <td>{{ $state->country->country_name ?? 'N/A' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.states.edit', $state->id) }}" class="text-warning">
                                            <i class="bx bx-edit fs-5"></i>
                                        </a>
                                        <form action="{{ route('admin.states.destroy', $state->id) }}" method="POST"
                                              onsubmit="return confirm('Delete this state?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn p-0 border-0 bg-transparent text-danger">
                                                <i class="bx bx-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No states found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $states->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</main>
@endsection
