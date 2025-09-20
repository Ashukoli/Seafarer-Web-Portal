@extends('layouts.admin.app')

@section('title', 'Candidates')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Candidates</div>
        <div class="ms-auto">
            <a href="{{ route('admin.candidates.create') }}" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Add Candidate</a>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Candidate List</h6>
    <hr>

    <div class="card">
        <div class="card-body">
            {{-- Optional filters / search form --}}
            <form method="GET" class="row g-2 mb-3">
                <div class="col-auto">
                    <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" class="form-control" placeholder="Search name, email, indos, passport">
                </div>
                <div class="col-auto">
                    <select name="rank_id" class="form-select">
                        <option value="">All Ranks</option>
                        @foreach(\App\Models\Rank::orderBy('sort')->get() as $r)
                            <option value="{{ $r->id }}" @selected(isset($filters['rank_id']) && $filters['rank_id']==$r->id)>{{ $r->rank }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-primary">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID / Indos / View</th>
                            <th>Registered / Posted Date</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Mobile</th>
                            <th>Present Rank</th>
                            <th>Post Applied For</th>
                            <th>Ship Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($candidates as $candidate)
                            <tr>
                                <td>{{ $loop->iteration + ($candidates->currentPage()-1) * $candidates->perPage() }}</td>
                                <td>
                                    ID: {{ $candidate->id }}<br>
                                    Indos: {{ optional($candidate->resume)->indos_number ?? '-' }}<br>
                                    <a href="{{ route('admin.candidates.show', $candidate->id) }}">View Resume</a>
                                </td>
                                <td>
                                    Registered: {{ $candidate->created_at->format('Y-m-d') }}<br>
                                    Posted: {{ optional($candidate->resume)->date_of_availability ? \Carbon\Carbon::parse(optional($candidate->resume)->date_of_availability)->format('Y-m-d') : '-' }}
                                </td>
                                <td>{{ $candidate->name }}<br><small class="text-muted">{{ optional($candidate->profile)->first_name }} {{ optional($candidate->profile)->last_name }}</small></td>
                                <td>
                                    @if(optional($candidate->profile)->dob)
                                        {{ \Carbon\Carbon::parse($candidate->profile->dob)->age }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $candidate->mobile_number ?? optional($candidate->profile)->mobile_number ?? '-' }}</td>
                                <td>{{ optional($candidate->resume)->present_rank ? optional($candidate->resume->presentRank)->rank ?? optional($candidate->presentRank)->rank : '-' }}</td>
                                <td>{{ optional($candidate->resume)->post_applied_for ? optional(\App\Models\Rank::find(optional($candidate->resume)->post_applied_for))->rank : '-' }}</td>
                                <td>{{ optional($candidate->seaServiceDetails->first())->ship_name ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.candidates.show', $candidate->id) }}" class="text-info" title="View"><i class="bx bx-show"></i></a>
                                        {{-- <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="text-warning" title="Edit"><i class="bx bx-edit"></i></a> --}}

                                        <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST" onsubmit="return confirm('Delete candidate?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn p-0 border-0 bg-transparent text-danger" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="10" class="text-center py-4">No candidates found.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $candidates->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
