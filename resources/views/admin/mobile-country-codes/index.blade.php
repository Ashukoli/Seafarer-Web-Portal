@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div>
            <div class="breadcrumb-title pe-3">Masters</div>
            <div class="ps-3"><span>Mobile Country Codes</span></div>
        </div>

        <div class="ms-auto d-flex gap-2">
            <form action="{{ route('admin.mobile-country-codes.index') }}" method="GET" class="d-flex">
                <input type="search"
                       name="q"
                       value="{{ request('q') }}"
                       class="form-control form-control-sm"
                       placeholder="Search country, code or dial (+91)"
                       aria-label="Search">
                <button type="submit" class="btn btn-sm btn-outline-primary ms-2">
                    <i class="bx bx-search"></i>
                </button>
                @if(request()->has('q') && request('q') !== '')
                    <a href="{{ route('admin.mobile-country-codes.index') }}" class="btn btn-sm btn-outline-secondary ms-2">
                        Clear
                    </a>
                @endif
            </form>

            <a href="{{ route('admin.mobile-country-codes.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>Add New Code
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <h6 class="mb-0">Mobile Country Code List</h6>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th style="width:60px">#</th>
                            <th>Country Name</th>
                            <th>Dial Code</th>
                            <th>Country Code</th>
                            <th style="width:110px">Status</th>
                            <th style="width:120px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($codes as $code)
                            <tr>
                                <td>{{ $codes->firstItem() + $loop->index }}</td>
                                <td>{{ $code->country_name }}</td>
                                <td>{{ $code->dial_code }}</td>
                                <td>{{ $code->country_code }}</td>
                                <td>
                                    @if($code->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.mobile-country-codes.edit', $code->id) }}" class="text-warning me-2" title="Edit">
                                        <i class="bx bx-edit fs-5"></i>
                                    </a>

                                    <form action="{{ route('admin.mobile-country-codes.destroy', $code->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this code?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn p-0 border-0 bg-transparent text-danger" title="Delete">
                                            <i class="bx bx-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="bx bx-info-circle display-6 text-muted"></i>
                                    <p class="text-muted mt-2">No records found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">Showing {{ $codes->firstItem() ?? 0 }} - {{ $codes->lastItem() ?? 0 }} of {{ $codes->total() }} results</div>
                <div>{{ $codes->appends(request()->only('q'))->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</main>
@endsection
