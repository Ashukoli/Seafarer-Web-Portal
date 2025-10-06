@extends('layouts.company.app')
@section('content')
<main class="page-content professional-bg">
    <div class="search-container">
        <div class="row">
            <!-- Search Filters Sidebar -->
            <div class="col-lg-3 col-md-4">
                <div class="filters-card">
                    <div class="filters-header">
                        <h5 class="filters-title">
                            <i class="bx bx-filter-alt"></i>Search Filters
                        </h5>
                    </div>
                    <div class="filters-content">
                        <form method="GET" action="{{ route('company.search.candidates') }}">
                            <div class="filter-section">
                                <label class="filter-label" for="rankFilter">
                                    <i class="bx bx-user-circle"></i>Select Rank
                                </label>
                                <select class="filter-select" id="rankFilter" name="rank">
                                    <option value="">All Ranks</option>
                                    @foreach($ranks as $rank)
                                        <option value="{{ $rank->id }}" {{ (request('rank') == $rank->id) ? 'selected' : '' }}>
                                            {{ $rank->rank }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-section">
                                <label class="filter-label" for="shipTypeFilter">
                                    <i class="bx bx-anchor"></i>Ship Type
                                </label>
                                <select class="filter-select" id="shipTypeFilter" name="shipType">
                                    <option value="">All Ship Types</option>
                                    @foreach($shipTypes as $type)
                                        <option value="{{ $type->id }}" {{ (request('shipType') == $type->id) ? 'selected' : '' }}>
                                            {{ $type->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-section">
                                <label class="filter-label" for="cocCopFilter">
                                    <i class="bx bx-certification"></i>COC / COP
                                </label>
                                <select class="filter-select" id="cocCopFilter" name="cocCop">
                                    <option value="">All COC Nationality</option>
                                    @foreach($cocCountries as $country)
                                        <option value="{{ $country }}" {{ (request('cocCop') == $country) ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-section">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bx bx-search"></i>Search Candidates
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Candidates Results -->
            <div class="col-lg-9 col-md-8">
                <div class="results-card">
                    <div class="results-header">
                        <h2 class="results-title">Search Results</h2>
                        <p class="results-count">
                            <span class="count-number">{{ $candidates->total() }}</span> candidates found
                        </p>
                    </div>

                    <div class="candidates-list">
                        @forelse($candidates as $candidate)
                            <div class="candidate-card">
                                <!-- Header -->
                                <div class="candidate-header">
                                    <div class="candidate-id">ID : SJ{{ str_pad($candidate->user->id, 7, '0', STR_PAD_LEFT) }}</div>
                                    <div class="candidate-status {{ $candidate->user->is_online ?? false ? 'online' : 'offline' }}">
                                        <span class="status-dot"></span>
                                        {{ $candidate->user->is_online ?? false ? 'Online' : 'Offline' }}
                                        <span class="last-seen">Last Seen: {{ $candidate->user->last_seen ? \Carbon\Carbon::parse($candidate->user->last_seen)->format('Y-m-d H:i:s') : '2025-10-06 07:55:36' }}</span>
                                    </div>
                                    <div class="candidate-photo">
                                        @if($candidate->user->profile_photo_url ?? false)
                                            <img src="{{ $candidate->user->profile_photo_url }}" alt="Profile Photo">
                                        @else
                                            <div class="no-photo">No Profile Pic</div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Body -->
                                <div class="candidate-body">
                                    <div class="info-line">
                                        <span><strong>Nationality :</strong> {{ $candidate->user->nationality ?? 'Indian' }}</span>
                                        <span class="sep">|</span>
                                        <span><strong>Location :</strong> {{ $candidate->user->city ?? 'Unknown' }}{{ $candidate->user->state ? '('.$candidate->user->state.')' : '(Tamil Nadu)' }}</span>
                                        <span class="sep">|</span>
                                        <span><strong>Age :</strong> {{ $candidate->user->age ?? '67' }} Yrs.</span>
                                    </div>

                                    <div class="info-line">
                                        <span><strong>Posted Date :</strong> {{ $candidate->created_at ? $candidate->created_at->format('jS M, Y') : '27th Sep, 2025' }}</span>
                                        <span class="sep">|</span>
                                        <span><strong>Date of Availability :</strong> {{ $candidate->date_of_availability ? \Carbon\Carbon::parse($candidate->date_of_availability)->format('jS M, Y') : '25th Oct, 2025' }}</span>
                                    </div>

                                    <div class="info-line">
                                        <span><strong>Present Rank :</strong> {{ $candidate->rank->rank ?? 'Bosun' }}</span>
                                        <span class="sep">|</span>
                                        <span><strong>Post Applied For :</strong> {{ $candidate->postAppliedFor->rank ?? 'Bosun' }}</span>
                                    </div>

                                    <div class="info-line">
                                        <span><strong>Present Rank Experience:</strong> {{ $candidate->present_rank_exp ?? '5 yrs & above' }}</span>
                                        <span class="sep">|</span>
                                        <span><strong>COC / COP Nationality :</strong> {{ $candidate->coc_nationality ?? 'India' }}</span>
                                    </div>

                                    <div class="info-line">
                                        <span><strong>Ship Type:</strong>
                                            @if($candidate->shipType)
                                                <a href="#" class="ship-type-link">{{ $candidate->shipType->type }}</a>
                                            @else
                                                <a href="#" class="ship-type-link">Bulk Carrier</a>
                                            @endif
                                            , General Cargo, RORO.
                                        </span>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="candidate-footer">
                                    <a href="{{ url('/company/candidate/'.$candidate->user->id.'/resume') }}" class="btn-view-resume">View Resume</a>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-icon"><i class="bx bx-search-alt"></i></div>
                                <div class="empty-title">No Candidates Found</div>
                                <div class="empty-subtitle">Try adjusting your search filters to find more candidates</div>
                            </div>
                        @endforelse
                    </div>

                    @if($candidates->hasPages())
                        <div class="pagination-section">
                            {{ $candidates->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Compact Professional Design */
.professional-bg {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.search-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 15px;
}

/* Compact Filters Card */
.filters-card {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid #e2e8f0;
    margin-bottom: 20px;
    position: sticky;
    top: 15px;
}

.filters-header {
    background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    color: white;
    padding: 12px 16px;
    border-radius: 8px 8px 0 0;
}

.filters-title {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

.filters-content {
    padding: 16px;
}

.filter-section {
    margin-bottom: 16px;
}

.filter-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.filter-select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 0.85rem;
    background: #ffffff;
    transition: border-color 0.2s ease;
    color: #374151;
}

.filter-select:focus {
    border-color: #4f46e5;
    outline: none;
    box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
}

/* Compact Results Card */
.results-card {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid #e2e8f0;
}

.results-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 16px 20px;
    border-bottom: 1px solid #e2e8f0;
    border-radius: 8px 8px 0 0;
}

.results-title {
    margin: 0 0 4px 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
}

.results-count {
    margin: 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.count-number {
    font-weight: 600;
    color: #4f46e5;
}

/* Compact Candidates List */
.candidates-list {
    padding: 16px 20px;
    background: #fafbfc;
}

/* Ultra Compact Candidate Card */
.candidate-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    margin-bottom: 12px;
    overflow: hidden;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.candidate-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border-color: #c7d2fe;
}

/* Compact Header */
.candidate-header {
    background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
    padding: 10px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #d1d5db;
    min-height: 50px;
}

.candidate-id {
    font-size: 0.95rem;
    font-weight: 700;
    color: #1f2937;
}

.candidate-status {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.8rem;
    font-weight: 500;
}

.candidate-status.online { color: #059669; }
.candidate-status.offline { color: #dc2626; }

.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.candidate-status.online .status-dot {
    background: #10b981;
    box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.2);
}

.candidate-status.offline .status-dot {
    background: #ef4444;
    box-shadow: 0 0 0 1px rgba(239, 68, 68, 0.2);
}

.last-seen {
    font-size: 0.75rem;
    color: #6b7280;
    margin-left: 6px;
}

.candidate-photo {
    width: 60px;
    height: 60px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    background: #f9fafb;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
}

.candidate-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-photo {
    color: #6b7280;
    font-size: 0.75rem;
    text-align: center;
    line-height: 1.2;
    font-weight: 500;
}

/* Compact Body */
.candidate-body {
    padding: 12px 16px;
    background: #ffffff;
}

.info-line {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 6px;
    font-size: 0.85rem;
    color: #374151;
    line-height: 1.4;
}

.info-line:last-child {
    margin-bottom: 0;
}

.info-line strong {
    color: #1f2937;
    font-weight: 600;
}

.sep {
    margin: 0 8px;
    color: #9ca3af;
    font-weight: 300;
}

.ship-type-link {
    color: #4f46e5;
    text-decoration: underline;
    font-weight: 500;
    transition: color 0.2s ease;
}

.ship-type-link:hover {
    color: #3730a3;
    text-decoration: none;
}

/* Compact Footer */
.candidate-footer {
    padding: 10px 16px;
    background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
}

.btn-view-resume {
    background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 6px 16px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(79, 70, 229, 0.2);
}

.btn-view-resume:hover {
    background: linear-gradient(135deg, #3730a3 0%, #4f46e5 100%);
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(79, 70, 229, 0.3);
}

/* Compact Button */
.btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    border: none;
    cursor: pointer;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    color: #ffffff;
    box-shadow: 0 1px 3px rgba(79, 70, 229, 0.2);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #3730a3 0%, #4f46e5 100%);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(79, 70, 229, 0.3);
    color: #ffffff;
    text-decoration: none;
}

/* Compact Empty State */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #6b7280;
}

.empty-icon {
    font-size: 3rem;
    color: #d1d5db;
    margin-bottom: 16px;
}

.empty-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

.empty-subtitle {
    font-size: 0.9rem;
    margin-bottom: 20px;
}

/* Compact Pagination */
.pagination-section {
    padding: 16px 20px;
    border-top: 1px solid #e5e7eb;
    background: #f8fafc;
    display: flex;
    justify-content: center;
}

/* Responsive Design */
@media (max-width: 992px) {
    .search-container { padding: 12px; }
    .candidates-list { padding: 12px 16px; }
    .results-header { padding: 12px 16px; }

    .candidate-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        padding: 8px 12px;
    }

    .candidate-photo {
        width: 50px;
        height: 50px;
        align-self: flex-end;
    }
}

@media (max-width: 768px) {
    .info-line {
        flex-direction: column;
        align-items: flex-start;
        gap: 2px;
    }

    .sep { display: none; }

    .candidate-body { padding: 8px 12px; }
    .candidate-footer { padding: 8px 12px; }

    .info-line { font-size: 0.8rem; }
    .candidate-card { margin-bottom: 10px; }
}

@media (max-width: 480px) {
    .search-container { padding: 8px; }
    .results-title { font-size: 1.1rem; }
    .btn-view-resume { padding: 5px 12px; font-size: 0.8rem; }
    .candidate-photo { width: 40px; height: 40px; }
}
</style>
@endsection
