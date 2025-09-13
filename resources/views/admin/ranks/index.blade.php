{{-- resources/views/admin/ranks/index.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Rank List')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rank List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.ranks.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i>Add New Rank
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h6 class="mb-0 text-uppercase">Rank List</h6>
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th><i class="bx bx-list-ul me-1"></i>Rank</th>
                            <th style="width:120px;"><i class="bx bx-sort-alt-2 me-1"></i>Sort</th>
                            <th style="width:140px;"><i class="bx bx-cog me-1"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ranks as $rank)
                            <tr>
                                <td>{{ $loop->iteration + ($ranks->currentPage()-1) * $ranks->perPage() }}</td>
                                <td>{{ $rank->rank }}</td>
                                <td>{{ $rank->sort }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.ranks.edit', $rank->id) }}"
                                           class="text-warning"
                                           title="Edit Rank">
                                            <i class="bx bx-edit fs-5"></i>
                                        </a>

                                        <form action="{{ route('admin.ranks.destroy', $rank->id) }}"
                                              method="POST"
                                              style="display:inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete this rank?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn p-0 border-0 bg-transparent text-danger"
                                                    title="Delete Rank">
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
                                    <p class="text-muted mt-2">No ranks found.</p>
                                    <a href="{{ route('admin.ranks.create') }}" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i>Add First Rank
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- pagination --}}

                <div class="mt-3">
                    {{ $ranks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
