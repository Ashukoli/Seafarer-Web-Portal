@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ship Types</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.shiptypes.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Add New Ship Type
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h6 class="mb-0 text-uppercase">Ship Type List</h6>
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ship Name</th>
                            <th>Sort</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($shipTypes as $ship)
                            <tr>
                                <td>{{ $loop->iteration + (($shipTypes->currentPage()-1) * $shipTypes->perPage()) }}</td>
                                <td>{{ $ship->ship_name }}</td>
                                <td>{{ $ship->sort }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.shiptypes.edit', $ship->id) }}" class="text-warning" title="Edit">
                                            <i class="bx bx-edit fs-5"></i>
                                        </a>

                                        <form action="{{ route('admin.shiptypes.destroy', $ship->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this ship type?')">
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
                                <td colspan="4" class="text-center py-4">
                                    <i class="bx bx-info-circle display-6 text-muted"></i>
                                    <p class="text-muted mt-2">No ship types found.</p>
                                    <a href="{{ route('admin.shiptypes.create') }}" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i> Add First Ship Type
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $shipTypes->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
