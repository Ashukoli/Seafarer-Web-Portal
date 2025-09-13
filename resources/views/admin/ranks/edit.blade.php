{{-- resources/views/admin/ranks/edit.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Edit Rank')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Rank</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.ranks.index') }}" class="btn btn-primary">List of Ranks</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Edit Rank</h6>
                        <hr>

                        <form action="{{ route('admin.ranks.update', $rank->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Rank <span class="text-danger">*</span></label>
                                <input type="text"
                                       name="rank"
                                       class="form-control @error('rank') is-invalid @enderror"
                                       value="{{ old('rank', $rank->rank) }}"
                                       required>
                                @error('rank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sort</label>
                                <input type="number"
                                       name="sort"
                                       class="form-control @error('sort') is-invalid @enderror"
                                       value="{{ old('sort', $rank->sort) }}">
                                @error('sort')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Update Rank</button>
                                <a href="{{ route('admin.ranks.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                        <hr class="mt-4">

                        {{-- Delete button --}}
                        <form action="{{ route('admin.ranks.destroy', $rank->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this rank? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bx bx-trash me-1"></i>Delete Rank
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
