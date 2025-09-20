@extends('layouts.company.app')
@section('content')
<main class="page-content professional-bg">
    <!--Enhanced Professional Breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">
            <i class="bx bx-user-circle me-2 text-primary"></i>Candidate
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 enhanced-breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-home-alt"></i>Dashboard
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button class="btn btn-outline-secondary btn-sm" onclick="refreshDashboard()">
                    <i class="bx bx-refresh"></i>Refresh
                </button>
                <button class="btn btn-primary btn-sm" onclick="downloadReport()">
                    <i class="bx bx-download"></i>Export Report
                </button>
            </div>
        </div>
    </div>

    <!--Mobile Breadcrumb-->
    <div class="mobile-breadcrumb d-flex d-sm-none align-items-center mb-3 px-3">
        <div class="breadcrumb-mobile">
            <div class="current-page">Dashboard</div>
            <div class="page-subtitle">Your recruitment overview</div>
        </div>
        <div class="ms-auto">
            <button class="btn btn-primary btn-sm">
                <i class="bx bx-bell"></i>
            </button>
        </div>
    </div>

    <div class="dashboard-container">
        
        <!-- Compact Metrics Grid -->
        <div class="metrics-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="bx bx-bar-chart-alt-2"></i>Dashboard Metrics
                </h3>
            </div>
            
            <div class="metrics-grid">
                <!-- 1. Candidates Logged In Today -->
                <div class="metric-card primary">
                    <div class="metric-icon">
                        <i class="bx bx-user-check"></i>
                    </div>
                    <div class="metric-content">
                        <div class="metric-value">533</div>
                        <div class="metric-label">Candidates Logged In Today</div>
                        <div class="metric-trend positive">
                            <i class="bx bx-trending-up"></i>
                            <span>+12% from yesterday</span>
                        </div>
                    </div>
                </div>

                <!-- 2. Today Applied Candidates -->
                <div class="metric-card success">
                    <div class="metric-icon">
                        <i class="bx bx-user-plus"></i>
                    </div>
                    <div class="metric-content">
                        <div class="metric-value">133</div>
                        <div class="metric-label">Today Applied Candidates</div>
                        <div class="metric-trend positive">
                            <i class="bx bx-trending-up"></i>
                            <span>+8% from yesterday</span>
                        </div>
                    </div>
                </div>

                <!-- 3. Yesterday Applied Candidates -->
                <div class="metric-card info">
                    <div class="metric-icon">
                        <i class="bx bx-calendar-minus"></i>
                    </div>
                    <div class="metric-content">
                        <div class="metric-value">213</div>
                        <div class="metric-label">Yesterday Applied Candidates</div>
                        <div class="metric-trend neutral">
                            <i class="bx bx-minus"></i>
                            <span>Stable performance</span>
                        </div>
                    </div>
                </div>

                <!-- 4. This Week -->
                <div class="metric-card warning">
                    <div class="metric-icon">
                        <i class="bx bx-calendar-week"></i>
                    </div>
                    <div class="metric-content">
                        <div class="metric-value">1,247</div>
                        <div class="metric-label">This Week Applications</div>
                        <div class="metric-trend positive">
                            <i class="bx bx-trending-up"></i>
                            <span>+15% from last week</span>
                        </div>
                    </div>
                </div>

                <!-- 5. Daily Downloads -->
                <div class="metric-card teal">
                    <div class="metric-icon">
                        <i class="bx bx-download"></i>
                    </div>
                    <div class="metric-content">
                        <div class="metric-value">342</div>
                        <div class="metric-label">Daily Downloads (Avg)</div>
                        <div class="metric-trend positive">
                            <i class="bx bx-trending-up"></i>
                            <span>+5% increase</span>
                        </div>
                    </div>
                </div>

                <!-- 6. Today's Downloads -->
                <div class="metric-card indigo">
                    <div class="metric-icon">
                        <i class="bx bx-cloud-download"></i>
                    </div>
                    <div class="metric-content">
                        <div class="metric-value">89</div>
                        <div class="metric-label">Today's Downloads</div>
                        <div class="metric-trend positive">
                            <i class="bx bx-trending-up"></i>
                            <span>+18% from yesterday</span>
                        </div>
                    </div>
                </div>

                <!-- 7. Validated Resume -->
                <div class="metric-card green">
                    <div class="metric-icon">
                        <i class="bx bx-check-circle"></i>
                    </div>
                    <div class="metric-content">
                        <div class="metric-value">756</div>
                        <div class="metric-label">Validated Resumes</div>
                        <div class="metric-trend positive">
                            <i class="bx bx-trending-up"></i>
                            <span>+25% validation rate</span>
                        </div>
                    </div>
                </div>

                <!-- 8. Hot Jobs Applications -->
                <div class="metric-card orange">
                    <div class="metric-icon">
                        <i class="bx bx-fire"></i>
                    </div>
                    <div class="metric-content">
                        <div class="metric-value">156</div>
                        <div class="metric-label">Hot Jobs Applications</div>
                        <div class="metric-trend positive">
                            <i class="bx bx-trending-up"></i>
                            <span>+35% hot job interest</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Section (Keep as requested) -->
        <div class="premium-section">
            <div class="premium-card">
                <div class="premium-background"></div>
                <div class="premium-content">
                    <div class="premium-header">
                        <div class="premium-badge">
                            <i class="bx bx-crown"></i>
                            <span>Premium Insights</span>
                        </div>
                        <h3 class="premium-title">Premium Candidate Analytics</h3>
                        <p class="premium-subtitle">Get detailed insights into premium candidate performance and engagement metrics</p>
                    </div>
                    
                    <div class="premium-stats">
                        <div class="premium-stat">
                            <div class="stat-number">78</div>
                            <div class="stat-label">Premium Active Today</div>
                            <div class="stat-icon">
                                <i class="bx bx-user-plus"></i>
                            </div>
                        </div>
                        <div class="premium-stat">
                            <div class="stat-number">342</div>
                            <div class="stat-label">Profile Views</div>
                            <div class="stat-icon">
                                <i class="bx bx-show"></i>
                            </div>
                        </div>
                        <div class="premium-stat">
                            <div class="stat-number">89%</div>
                            <div class="stat-label">Success Rate</div>
                            <div class="stat-icon">
                                <i class="bx bx-trending-up"></i>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Professional Background */
.professional-bg {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    min-height: 100vh;
}

/* Enhanced Breadcrumb Styling */
.enhanced-breadcrumb {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    padding: 14px 24px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
}

.breadcrumb-title {
    font-weight: 600;
    color: #374151;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 8px;
    line-height: 1.2;
}

.breadcrumb-item.active {
    color: #6b7280;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    line-height: 1.2;
}

/* Mobile Breadcrumb */
.mobile-breadcrumb {
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.current-page {
    font-weight: 600;
    color: #1f2937;
    font-size: 1rem;
    line-height: 1.2;
}

.page-subtitle {
    font-size: 0.85rem;
    color: #6b7280;
    margin-top: 2px;
}

/* Dashboard Container */
.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Simplified Dashboard Header Card */
.dashboard-header-card {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: #ffffff;
    border-radius: 12px;
    padding: 20px 24px;
    margin-bottom: 24px;
    box-shadow: 0 4px 16px rgba(99, 102, 241, 0.25);
    position: relative;
    overflow: hidden;
}

.dashboard-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 150px;
    height: 150px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    transform: translate(50%, -50%);
}

.header-content {
    position: relative;
    z-index: 2;
}

.header-left {
    flex: 1;
}

.dashboard-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 12px 0;
    line-height: 1.2;
}

.quick-stats {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.quick-stat {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    opacity: 0.8;
}

/* Metrics Section */
.metrics-section {
    margin-bottom: 24px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.section-title i {
    color: #6366f1;
}

.metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 16px;
}

/* Compact Metric Cards */
.metric-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
    position: relative;
    transition: all 0.3s ease;
    overflow: hidden;
}

.metric-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    transition: all 0.3s ease;
}

/* Color Variants */
.metric-card.primary::before { background: linear-gradient(135deg, #6366f1, #4f46e5); }
.metric-card.success::before { background: linear-gradient(135deg, #10b981, #059669); }
.metric-card.info::before { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
.metric-card.warning::before { background: linear-gradient(135deg, #f59e0b, #d97706); }
.metric-card.teal::before { background: linear-gradient(135deg, #14b8a6, #0d9488); }
.metric-card.indigo::before { background: linear-gradient(135deg, #6366f1, #4338ca); }
.metric-card.green::before { background: linear-gradient(135deg, #22c55e, #16a34a); }
.metric-card.orange::before { background: linear-gradient(135deg, #f97316, #ea580c); }

.metric-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
}

.metric-card:hover::before {
    height: 4px;
}

.metric-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: #ffffff;
    margin-bottom: 12px;
    position: relative;
    z-index: 2;
}

/* Icon Color Variants */
.metric-card.primary .metric-icon { background: linear-gradient(135deg, #6366f1, #4f46e5); }
.metric-card.success .metric-icon { background: linear-gradient(135deg, #10b981, #059669); }
.metric-card.info .metric-icon { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
.metric-card.warning .metric-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
.metric-card.teal .metric-icon { background: linear-gradient(135deg, #14b8a6, #0d9488); }
.metric-card.indigo .metric-icon { background: linear-gradient(135deg, #6366f1, #4338ca); }
.metric-card.green .metric-icon { background: linear-gradient(135deg, #22c55e, #16a34a); }
.metric-card.orange .metric-icon { background: linear-gradient(135deg, #f97316, #ea580c); }

.metric-content {
    flex: 1;
}

.metric-value {
    font-size: 1.8rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 6px;
    color: #1f2937;
}

.metric-label {
    font-size: 0.85rem;
    color: #6b7280;
    margin-bottom: 8px;
    font-weight: 500;
    line-height: 1.3;
}

.metric-trend {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.75rem;
    font-weight: 500;
}

.metric-trend.positive { color: #10b981; }
.metric-trend.negative { color: #ef4444; }
.metric-trend.neutral { color: #6b7280; }

/* Compact Premium Section */
.premium-section {
    margin-bottom: 24px;
}

.premium-card {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-radius: 16px;
    padding: 24px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.25);
}

.premium-background {
    position: absolute;
    top: 0;
    right: 0;
    width: 120px;
    height: 120px;
    background: rgba(245, 158, 11, 0.1);
    border-radius: 50%;
    transform: translate(50%, -50%);
}

.premium-content {
    position: relative;
    z-index: 2;
}

.premium-header {
    text-align: center;
    margin-bottom: 24px;
}

.premium-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(245, 158, 11, 0.2);
    color: #92400e;
    padding: 6px 12px;
    border-radius: 16px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.premium-title {
    font-size: 1.6rem;
    font-weight: 700;
    color: #92400e;
    margin-bottom: 6px;
}

.premium-subtitle {
    font-size: 0.95rem;
    color: #a16207;
    margin: 0;
    opacity: 0.8;
}

.premium-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.premium-stat {
    background: rgba(255, 255, 255, 0.8);
    padding: 16px;
    border-radius: 10px;
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    position: relative;
    transition: all 0.3s ease;
}

.premium-stat:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.2);
}

.premium-stat .stat-number {
    font-size: 1.6rem;
    font-weight: 700;
    color: #92400e;
    line-height: 1;
    margin-bottom: 4px;
}

.premium-stat .stat-label {
    font-size: 0.75rem;
    color: #a16207;
    margin-bottom: 6px;
}

.premium-stat .stat-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 24px;
    height: 24px;
    background: rgba(245, 158, 11, 0.2);
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #92400e;
    font-size: 0.8rem;
}

.premium-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
}

.btn-premium {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
}

.btn-premium:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    color: #ffffff;
}

.btn-outline-premium {
    background: transparent;
    color: #92400e;
    border: 2px solid #f59e0b;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
}

.btn-outline-premium:hover {
    background: #f59e0b;
    color: #ffffff;
}

/* Button Styling */
.btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    justify-content: center;
    line-height: 1.2;
}

.btn:focus {
    outline: 2px solid #6366f1;
    outline-offset: 2px;
}

.btn i {
    font-size: 0.9rem;
    flex-shrink: 0;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 0.8rem;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #ffffff;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #4f46e5, #4338ca);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    color: #ffffff;
    text-decoration: none;
}

.btn-outline-secondary {
    background: transparent;
    color: #6b7280;
    border: 1px solid #e5e7eb;
}

.btn-outline-secondary:hover {
    background: #f9fafb;
    border-color: #cbd5e1;
    color: #374151;
    text-decoration: none;
}

/* Mobile Responsive Design */
@media (max-width: 992px) {
    .dashboard-container {
        padding: 0 12px;
    }

    .section-header {
        flex-direction: column;
        gap: 12px;
        text-align: center;
    }

    .premium-actions {
        flex-direction: column;
    }

    .metrics-grid {
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    }
}

@media (max-width: 768px) {
    .dashboard-header-card {
        padding: 16px 20px;
    }

    .dashboard-title {
        font-size: 1.5rem;
    }

    .premium-title {
        font-size: 1.4rem;
    }

    .metrics-grid {
        grid-template-columns: 1fr;
    }

    .premium-stats {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .dashboard-header-card {
        padding: 16px;
    }

    .dashboard-title {
        font-size: 1.4rem;
    }

    .metric-card {
        padding: 14px;
    }

    .metric-value {
        font-size: 1.6rem;
    }

    .premium-card {
        padding: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeDashboard();
});

function initializeDashboard() {
    try {
        console.log('Simplified dashboard initialized');
        
        // Initialize metric animations
        animateMetrics();
        
    } catch (error) {
        console.error('Error initializing dashboard:', error);
    }
}

function animateMetrics() {
    try {
        const metrics = document.querySelectorAll('.metric-value');
        
        metrics.forEach(metric => {
            const finalValue = metric.textContent.replace(/,/g, '');
            const numericValue = parseInt(finalValue);
            
            if (!isNaN(numericValue)) {
                let currentValue = 0;
                const increment = numericValue / 30; // Animate over 30 steps
                
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= numericValue) {
                        metric.textContent = numericValue.toLocaleString();
                        clearInterval(timer);
                    } else {
                        metric.textContent = Math.floor(currentValue).toLocaleString();
                    }
                }, 50);
            }
        });
    } catch (error) {
        console.error('Error animating metrics:', error);
    }
}

function refreshDashboard() {
    try {
        console.log('Refreshing dashboard...');
        
        const button = event.target.closest('.btn');
        const originalContent = button.innerHTML;
        button.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>Refreshing...';
        button.disabled = true;
        
        setTimeout(() => {
            // Simulate refresh
            animateMetrics();
            
            button.innerHTML = originalContent;
            button.disabled = false;
            
            // Show success notification
            showNotification('Dashboard refreshed successfully!', 'success');
        }, 2000);
    } catch (error) {
        console.error('Error refreshing dashboard:', error);
    }
}

function downloadReport() {
    try {
        console.log('Downloading report...');
        
        const button = event.target.closest('.btn');
        const originalContent = button.innerHTML;
        button.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>Preparing...';
        button.disabled = true;
        
        setTimeout(() => {
            // Simulate download
            const link = document.createElement('a');
            link.href = '/dashboard/report/download';
            link.download = 'dashboard_report.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            button.innerHTML = originalContent;
            button.disabled = false;
            
            showNotification('Report downloaded successfully!', 'success');
        }, 3000);
    } catch (error) {
        console.error('Error downloading report:', error);
    }
}

function showNotification(message, type) {
    try {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="bx bx-check-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        // Add notification styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            animation: slideIn 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    } catch (error) {
        console.error('Error showing notification:', error);
    }
}

// Add CSS for notification animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    .notification-content {
        display: flex;
        align-items: center;
        gap: 8px;
    }
`;
document.head.appendChild(style);
</script>
@endsection
