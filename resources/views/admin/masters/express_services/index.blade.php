{{-- filepath: resources/views/admin/masters/express_services/index.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Express Services Management')

@section('content')
<main class="page-content professional-bg">
   
      <div class="container-fluid px-4">
        <!-- Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="modern-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-home-alt"></i>
                                </div>
                                <span class="breadcrumb-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-cog"></i>
                                </div>
                                <span class="breadcrumb-text">Masters</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-package"></i>
                            </div>
                            <span class="breadcrumb-text">Express Services</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Page Header --}}
        <div class="compact-header-section mb-4">
            <div class="compact-header-card">
                <div class="compact-header-content">
                    <div class="compact-header-icon">
                        <i class="bx bx-bolt-circle"></i>
                    </div>
                    <div class="compact-header-text">
                        <h1 class="compact-page-title">Express Services Management</h1>
                        <p class="compact-page-subtitle">Manage all available express services for your platform</p>
                    </div>
                </div>
                <div class="compact-header-actions">
                    <a href="{{ route('admin.expressservices.create') }}" class="enterprise-btn btn-success">
                        <i class="bx bx-plus"></i>
                        <span>Add New Express Service</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="modern-alert modern-alert-success mb-4">
                <div class="alert-icon">
                    <i class="bx bx-check-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Success!</strong>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="modern-alert modern-alert-error mb-4">
                <div class="alert-icon">
                    <i class="bx bx-error-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Error!</strong>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif

        {{-- Express Services Data Section --}}
        <div class="enterprise-section">
            <div class="professional-table-wrapper">
                <div class="table-container">
                    <table class="enterprise-data-table">
                        <thead class="table-header-section">
                            <tr>
                                <th class="table-header-cell no-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-hash header-icon"></i>
                                        <span>#</span>
                                    </div>
                                </th>
                                <th class="table-header-cell title-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-bolt-circle header-icon"></i>
                                        <span>Title</span>
                                    </div>
                                </th>
                                <th class="table-header-cell desc-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-align-left header-icon"></i>
                                        <span>Description</span>
                                    </div>
                                </th>
                                <th class="table-header-cell amount-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-dollar header-icon"></i>
                                        <span>Amount</span>
                                    </div>
                                </th>
                                <th class="table-header-cell image-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-image header-icon"></i>
                                        <span>Image</span>
                                    </div>
                                </th>
                                <th class="table-header-cell status-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-check-circle header-icon"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                                <th class="table-header-cell actions-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-cog header-icon"></i>
                                        <span>Actions</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-body-section">
                            @forelse($expressServices as $service)
                                <tr class="table-data-row express-service-row" data-express-service-id="{{ $service->id }}">
                                    <td class="table-data-cell no-cell">
                                        <div class="number-display">
                                            <span class="row-number">{{ $loop->iteration }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell title-cell">
                                        <div class="fw-bold">{{ $service->package_title }}</div>
                                    </td>
                                    <td class="table-data-cell desc-cell">
                                        <div>{{ Str::limit($service->description, 40) }}</div>
                                    </td>
                                    <td class="table-data-cell amount-cell">
                                        <div>{{ number_format($service->amount, 2) }}</div>
                                    </td>
                                    <td class="table-data-cell image-cell">
                                        @if($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" alt="Image" width="50" height="50" style="object-fit:cover; border-radius:8px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td class="table-data-cell status-cell">
                                        <span class="badge {{ $service->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </td>
                                    <td class="table-data-cell actions-cell">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('admin.expressservices.edit', $service->id) }}"
                                               class="action-button edit-button"
                                               data-tooltip="Edit Express Service">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                         
                                            <form action="{{ route('admin.expressservices.destroy', $service->id) }}"
                                                  method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirmDelete('{{ $service->package_title }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="action-button delete-button"
                                                        data-tooltip="Delete Express Service">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-state-row">
                                    <td colspan="7" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon express-services-empty-icon">
                                                <i class="bx bx-bolt-circle"></i>
                                            </div>
                                            <h3 class="empty-state-title">No Express Services Found</h3>
                                            <p class="empty-state-message">Start by adding your first express service.</p>
                                            <a href="{{ route('admin.expressservices.create') }}" class="enterprise-btn btn-success">
                                                <i class="bx bx-plus"></i>
                                                <span>Add First Express Service</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@push('styles')
<style>
:root {
    --primary-color: #4f46e5;
    --primary-hover: #4338ca;
    --primary-light: #f0f4ff;
    --success-color: #059669;
    --success-hover: #047857;
    --success-light: #f0fdf9;
    --danger-color: #dc2626;
    --danger-hover: #b91c1c;
    --danger-light: #fef2f2;
    --background-primary: #f8fafc;
    --surface-elevated: #ffffff;
    --border-primary: #e2e8f0;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --border-radius-sm: 8px;
    --border-radius-md: 12px;
    --border-radius-lg: 16px;
    --transition-fast: all 0.15s ease;
    --transition-medium: all 0.25s ease;
    --spacing-xs: 0.5rem;
    --spacing-sm: 0.75rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;
}

.professional-bg {
    background: linear-gradient(135deg, var(--background-primary) 0%, #f1f5f9 100%);
    min-height: 100vh;
    padding: var(--spacing-xl) 0;
}

.modern-breadcrumb {
    display: flex;
    align-items: center;
    background: var(--surface-elevated);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-md);
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
    border: 1px solid var(--border-primary);
    margin: 0;
    list-style: none;
    gap: var(--spacing-sm);
    flex-wrap: wrap;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius-sm);
    transition: var(--transition-fast);
}

.breadcrumb-link:hover {
    color: var(--primary-color);
    background: var(--primary-light);
    text-decoration: none;
}

.breadcrumb-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 4px;
    background: var(--primary-light);
    color: var(--primary-color);
    font-size: 0.875rem;
}

.breadcrumb-link:hover .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

.breadcrumb-text {
    font-weight: 500;
}

.breadcrumb-separator {
    color: var(--text-muted);
    font-size: 0.75rem;
}

.breadcrumb-item.active {
    color: var(--text-primary);
    font-weight: 600;
}

.breadcrumb-item.active .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

.compact-header-section {
    margin-bottom: var(--spacing-lg);
}

.compact-header-card {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
    border: 1px solid var(--border-primary);
    padding: var(--spacing-lg);
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.compact-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--success-color) 0%, var(--primary-color) 100%);
}

.compact-header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    flex: 1;
}

.compact-header-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--success-color) 100%);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.compact-page-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
}

.compact-page-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

.compact-header-actions {
    flex-shrink: 0;
}

.enterprise-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1;
    border-radius: var(--border-radius-sm);
    border: 2px solid;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition-fast);
    white-space: nowrap;
}

.btn-success {
    background: var(--success-color);
    color: white;
    border-color: var(--success-color);
}

.btn-success:hover {
    background: var(--success-hover);
    border-color: var(--success-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
}

.modern-alert {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-md);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-sm);
    border: 1px solid;
    position: relative;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
    animation: slideInDown 0.3s ease-out;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-alert-success {
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.08) 0%, rgba(5, 150, 105, 0.05) 100%);
    border-color: rgba(5, 150, 105, 0.2);
    color: #065f46;
}

.modern-alert-error {
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.08) 0%, rgba(220, 38, 38, 0.05) 100%);
    border-color: rgba(220, 38, 38, 0.2);
    color: #7f1d1d;
}

.alert-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1rem;
}

.modern-alert-success .alert-icon {
    background: var(--success-color);
    color: white;
}

.modern-alert-error .alert-icon {
    background: var(--danger-color);
    color: white;
}

.alert-content {
    flex: 1;
    line-height: 1.5;
}

.alert-content strong {
    font-weight: 600;
    display: inline;
    margin-right: 0.5rem;
    font-size: 0.875rem;
}

.alert-close {
    position: absolute;
    top: var(--spacing-sm);
    right: var(--spacing-md);
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition-fast);
    opacity: 0.7;
}

.alert-close:hover {
    opacity: 1;
    background: rgba(0, 0, 0, 0.1);
}

.enterprise-section {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1);
    border: 1px solid var(--border-primary);
    overflow: hidden;
    transition: var(--transition-medium);
}

.enterprise-section:hover {
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
}

.professional-table-wrapper {
    background: var(--surface-elevated);
}

.table-container {
    overflow-x: auto;
}

.enterprise-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.table-header-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.table-header-cell {
    padding: 1.25rem 1rem;
    text-align: left;
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--border-primary);
    white-space: nowrap;
}

.header-cell-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.header-icon {
    color: var(--primary-color);
    font-size: 1rem;
}

.no-column { width: 5%; }
.title-column { width: 18%; }
.desc-column { width: 22%; }
.amount-column { width: 10%; }
.image-column { width: 12%; }
.status-column { width: 10%; }
.actions-column { width: 18%; }

.table-body-section {
    background: var(--surface-elevated);
}

.table-data-row {
    transition: var(--transition-fast);
    border-bottom: 1px solid rgba(226, 232, 240, 0.5);
}

.table-data-row:hover {
    background: rgba(248, 250, 252, 0.8);
    transform: translateY(-1px);
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
}

.table-data-cell {
    padding: 1rem;
    vertical-align: middle;
    color: var(--text-primary);
}

.number-display {
    display: flex;
    justify-content: center;
}

.row-number {
    width: 32px;
    height: 32px;
    background: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.badge {
    display: inline-block;
    padding: 0.25em 0.75em;
    border-radius: 8px;
    font-size: 0.85em;
    font-weight: 600;
    line-height: 1.2;
}

.badge-success {
    background: var(--success-color);
    color: #fff;
}

.badge-danger {
    background: var(--danger-color);
    color: #fff;
}

.action-buttons-group {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    justify-content: center;
}

.action-button {
    width: 36px;
    height: 36px;
    border-radius: var(--border-radius-sm);
    border: 2px solid;
    background: var(--surface-elevated);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition-fast);
    text-decoration: none;
}

.edit-button {
    color: var(--primary-color);
    border-color: rgba(79, 70, 229, 0.3);
}

.edit-button:hover {
    background: var(--primary-light);
    border-color: var(--primary-color);
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
}

.view-button {
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.3);
}

.view-button:hover {
    background: var(--success-light);
    border-color: var(--success-color);
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
}

.delete-button {
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.3);
}

.delete-button:hover {
    background: var(--danger-light);
    border-color: var(--danger-color);
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
}

.professional-empty-state {
    text-align: center;
    padding: var(--spacing-xl) var(--spacing-md);
    max-width: 480px;
    margin: 0 auto;
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--spacing-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 2.5rem;
}

.express-services-empty-icon {
    background: var(--primary-light);
    color: var(--primary-color);
}

.empty-state-title {
    margin: 0 0 var(--spacing-md) 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
}

.empty-state-message {
    margin: 0 0 var(--spacing-lg) 0;
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 0.9375rem;
}

@media (max-width: 1024px) {
    .compact-header-card {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-md);
    }
    .compact-header-actions {
        align-self: stretch;
    }
    .enterprise-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }
    .compact-header-card {
        padding: var(--spacing-md);
    }
    .compact-header-content {
        gap: var(--spacing-sm);
    }
    .compact-header-icon {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
    }
    .compact-page-title {
        font-size: 1.125rem;
    }
    .table-header-cell,
    .table-data-cell {
        padding: var(--spacing-sm);
        font-size: 0.8125rem;
    }
    .action-buttons-group {
        flex-direction: column;
        gap: 0.25rem;
    }
    .modern-breadcrumb {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
        padding: var(--spacing-sm) var(--spacing-md);
    }
    .breadcrumb-separator {
        display: none;
    }
    .breadcrumb-item {
        width: 100%;
    }
    .breadcrumb-link {
        width: 100%;
        justify-content: flex-start;
        padding: var(--spacing-xs);
    }
}
</style>
@endpush

@push('scripts')
<script>
function confirmDelete(serviceTitle) {
    return confirm(`Are you sure you want to delete the express service "${serviceTitle}"?\n\nThis action cannot be undone.`);
}
</script>
@endpush