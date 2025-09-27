@extends('layouts.admin.app')

@section('title', 'Admin Communication Center')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">
        <!-- Enhanced Professional Breadcrumb -->
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-message-dots"></i>
                            </div>
                            <span class="breadcrumb-text">Communication Center</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Professional Admin Messaging Header -->
        <div class="admin-messaging-header-section mb-4">
            <div class="admin-messaging-header-card">
                <div class="admin-messaging-header-content">
                    <div class="admin-messaging-header-icon">
                        <i class="bx bx-message-dots"></i>
                    </div>
                    <div class="admin-messaging-header-text">
                        <h1 class="admin-messaging-page-title">Admin Communication Center</h1>
                        <p class="admin-messaging-page-subtitle">Send notifications and manage communications with companies and candidates</p>
                    </div>
                </div>
                <div class="admin-messaging-header-actions">
                    <button class="enterprise-btn btn-outline-primary" onclick="refreshMessages()">
                        <i class="bx bx-refresh"></i>
                        <span>Refresh</span>
                    </button>
                    <div class="admin-messaging-status">
                        <div class="status-indicator online"></div>
                        <span>Online</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Professional Admin Messaging Interface -->
        <div class="enterprise-admin-messaging-section">
            <div class="admin-messaging-interface">
                <!-- Enhanced Admin Contacts Sidebar -->
                <div class="admin-contacts-sidebar">
                    <div class="admin-sidebar-header">
                        <div class="admin-sidebar-header-title">
                            <i class="bx bx-chat"></i>
                            <span>Communications</span>
                        </div>
                        <div class="admin-search-container">
                            <div class="admin-search-wrapper">
                                <i class="bx bx-search admin-search-icon"></i>
                                <input type="text" class="admin-search-input" placeholder="Search conversations...">
                            </div>
                        </div>
                        <div class="admin-sidebar-tabs">
                            <button class="admin-tab-btn active" data-tab="all">
                                <i class="bx bx-message"></i>
                                <span>All</span>
                            </button>
                            <button class="admin-tab-btn" data-tab="companies">
                                <i class="bx bx-buildings"></i>
                                <span>Companies</span>
                            </button>
                            <button class="admin-tab-btn" data-tab="candidates">
                                <i class="bx bx-user-circle"></i>
                                <span>Candidates</span>
                            </button>
                        </div>
                    </div>

                    <div class="admin-contacts-list" id="adminContactsList">
                        <!-- Broadcast Notifications Section -->
                        <div class="admin-broadcast-section">
                            <div class="admin-section-title">
                                <i class="bx bx-broadcast"></i>
                                <span>Broadcast Messages</span>
                            </div>

                            <!-- Notify All Companies -->
                            <div class="admin-contact-item admin-broadcast-item" data-contact-id="all_companies" data-contact-type="notification">
                                <div class="admin-contact-avatar">
                                    <div class="admin-avatar-wrapper broadcast companies">
                                        <i class="bx bx-buildings"></i>
                                    </div>
                                    <div class="admin-broadcast-badge">
                                        <i class="bx bx-broadcast"></i>
                                    </div>
                                </div>
                                <div class="admin-contact-info">
                                    <div class="admin-contact-name">All Companies</div>
                                    <div class="admin-contact-role">Broadcast Notification</div>
                                    <div class="admin-last-message">Send notification to all registered companies</div>
                                    <div class="admin-message-meta-info">
                                        <span class="admin-message-time">Available</span>
                                        <div class="admin-broadcast-count">{{ $companiesCount ?? 0 }} recipients</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notify All Candidates -->
                            <div class="admin-contact-item admin-broadcast-item" data-contact-id="all_candidates" data-contact-type="notification">
                                <div class="admin-contact-avatar">
                                    <div class="admin-avatar-wrapper broadcast candidates">
                                        <i class="bx bx-user-circle"></i>
                                    </div>
                                    <div class="admin-broadcast-badge">
                                        <i class="bx bx-broadcast"></i>
                                    </div>
                                </div>
                                <div class="admin-contact-info">
                                    <div class="admin-contact-name">All Candidates</div>
                                    <div class="admin-contact-role">Broadcast Notification</div>
                                    <div class="admin-last-message">Send notification to all registered candidates</div>
                                    <div class="admin-message-meta-info">
                                        <span class="admin-message-time">Available</span>
                                        <div class="admin-broadcast-count">{{ $candidatesCount ?? 0 }} recipients</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Individual Conversations -->
                        <div class="admin-conversations-section">
                            <div class="admin-section-title">
                                <i class="bx bx-conversation"></i>
                                <span>Recent Conversations</span>
                            </div>

                            <!-- Sample Company Conversation -->
                            <div class="admin-contact-item active" data-contact-id="2" data-contact-type="company">
                                <div class="admin-contact-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Oceanic+Shipping&size=56&background=0ea5e9&color=ffffff&bold=true" alt="Oceanic Shipping">
                                    <div class="status-indicator online"></div>
                                    <div class="admin-entity-badge company">
                                        <i class="bx bx-buildings"></i>
                                    </div>
                                </div>
                                <div class="admin-contact-info">
                                    <div class="admin-contact-name">Oceanic Shipping</div>
                                    <div class="admin-contact-role">Maritime Company</div>
                                    <div class="admin-last-message">Thank you for your support with the recent updates!</div>
                                    <div class="admin-message-meta-info">
                                        <span class="admin-message-time">5 min ago</span>
                                        <div class="admin-message-status">
                                            <div class="admin-unread-badge">2</div>
                                            <i class="bx bx-check-double admin-message-read"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sample Company Conversation 2 -->
                            <div class="admin-contact-item" data-contact-id="3" data-contact-type="company">
                                <div class="admin-contact-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Blue+Wave+Marine&size=56&background=6366f1&color=ffffff&bold=true" alt="Blue Wave Marine">
                                    <div class="status-indicator away"></div>
                                    <div class="admin-entity-badge company">
                                        <i class="bx bx-buildings"></i>
                                    </div>
                                </div>
                                <div class="admin-contact-info">
                                    <div class="admin-contact-name">Blue Wave Marine</div>
                                    <div class="admin-contact-role">Shipping Company</div>
                                    <div class="admin-last-message">We have a query regarding the new job posting features.</div>
                                    <div class="admin-message-meta-info">
                                        <span class="admin-message-time">2 hours ago</span>
                                        <div class="admin-message-status">
                                            <i class="bx bx-check admin-message-sent"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sample Candidate Conversation -->
                            <div class="admin-contact-item" data-contact-id="5" data-contact-type="candidate">
                                <div class="admin-contact-avatar">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&size=56&background=10b981&color=ffffff&bold=true" alt="John Doe">
                                    <div class="status-indicator online"></div>
                                    <div class="admin-entity-badge candidate">
                                        <i class="bx bx-user"></i>
                                    </div>
                                </div>
                                <div class="admin-contact-info">
                                    <div class="admin-contact-name">John Doe</div>
                                    <div class="admin-contact-role">Marine Engineer</div>
                                    <div class="admin-last-message">Thank you for helping with my profile verification.</div>
                                    <div class="admin-message-meta-info">
                                        <span class="admin-message-time">1 day ago</span>
                                        <div class="admin-message-status">
                                            <i class="bx bx-check-double admin-message-read"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sample Candidate Conversation 2 -->
                            <div class="admin-contact-item" data-contact-id="7" data-contact-type="candidate">
                                <div class="admin-contact-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Sarah+Smith&size=56&background=f59e0b&color=ffffff&bold=true" alt="Sarah Smith">
                                    <div class="status-indicator offline"></div>
                                    <div class="admin-entity-badge candidate">
                                        <i class="bx bx-user"></i>
                                    </div>
                                </div>
                                <div class="admin-contact-info">
                                    <div class="admin-contact-name">Sarah Smith</div>
                                    <div class="admin-contact-role">Ship Captain</div>
                                    <div class="admin-last-message">Is there an update on my application status?</div>
                                    <div class="admin-message-meta-info">
                                        <span class="admin-message-time">3 days ago</span>
                                        <div class="admin-message-status">
                                            <div class="admin-unread-badge">1</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Admin Chat Area -->
                <div class="admin-chat-area">
                    <!-- Professional Admin Chat Header -->
                    <div class="admin-chat-header">
                        <div class="admin-chat-user-info">
                            <div class="admin-chat-avatar">
                                <img src="https://ui-avatars.com/api/?name=Oceanic+Shipping&size=48&background=0ea5e9&color=ffffff&bold=true" alt="Oceanic Shipping">
                                <div class="status-indicator online"></div>
                            </div>
                            <div class="admin-chat-details">
                                <div class="admin-chat-name">Oceanic Shipping</div>
                                <div class="admin-chat-status">
                                    <i class="bx bx-circle"></i>
                                    <span>Online • Active now</span>
                                </div>
                            </div>
                        </div>
                        <div class="admin-chat-actions">
                            <button class="admin-chat-action-btn" title="View Profile">
                                <i class="bx bx-user"></i>
                            </button>
                            <button class="admin-chat-action-btn" title="Search Messages">
                                <i class="bx bx-search"></i>
                            </button>
                            <button class="admin-chat-action-btn" title="More Actions">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Enhanced Admin Messages Container -->
                    <div class="admin-messages-container" id="adminChatMessages">
                        <div class="admin-date-separator">
                            <div class="admin-date-line"></div>
                            <span class="admin-date-text">Today, {{ \Carbon\Carbon::now()->format('F d, Y') }}</span>
                            <div class="admin-date-line"></div>
                        </div>

                        <!-- Welcome Message for Default Load -->
                        <div class="admin-message-wrapper incoming">
                            <div class="admin-message-avatar">
                                <img src="https://ui-avatars.com/api/?name=Oceanic+Shipping&size=40&background=0ea5e9&color=ffffff&bold=true" alt="Oceanic Shipping">
                            </div>
                            <div class="admin-message-content">
                                <div class="admin-message-bubble">
                                    <div class="admin-message-text">
                                        Hello Admin, thank you for your continued support with our company profile and job postings. We appreciate your quick responses!
                                    </div>
                                </div>
                                <div class="admin-message-meta">
                                    <span class="admin-message-sender">Oceanic Shipping</span>
                                    <span class="admin-message-time">09:15 AM</span>
                                    <i class="bx bx-check-double admin-message-status"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Admin Message Input -->
                    <div class="admin-message-input-container" id="adminMessageInputContainer">
                        <form id="adminChatForm" class="admin-message-form">
                            <div class="admin-input-group-enhanced">
                                <div class="admin-input-actions-left">
                                    <button type="button" class="admin-action-btn" title="Attach File">
                                        <i class="bx bx-paperclip"></i>
                                    </button>
                                    <button type="button" class="admin-action-btn" title="Quick Templates">
                                        <i class="bx bx-bookmark"></i>
                                    </button>
                                </div>
                                <div class="admin-input-wrapper">
                                    <textarea
                                        id="adminChatInput"
                                        class="admin-message-input"
                                        placeholder="Type your message or notification..."
                                        rows="1"
                                        maxlength="1000"></textarea>
                                    <div class="admin-input-footer">
                                        <div class="admin-char-counter">
                                            <span id="adminCharCount">0</span>/1000
                                        </div>
                                        <div class="admin-message-type" id="adminMessageType">
                                            <i class="bx bx-message-dots"></i>
                                            <span>Message</span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="admin-send-btn" id="adminSendButton" disabled>
                                    <i class="bx bx-send"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Admin Notification Confirmation Modal -->
<div class="modal fade" id="adminNotificationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bx bx-broadcast"></i>
                    Confirm Broadcast Notification
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="broadcast-confirmation">
                    <div class="broadcast-icon">
                        <i class="bx bx-broadcast"></i>
                    </div>
                    <div class="broadcast-details">
                        <h6 id="broadcastTitle">Send to All Companies</h6>
                        <p id="broadcastMessage">Your message will be sent to all registered companies.</p>
                        <div class="recipient-count">
                            <i class="bx bx-group"></i>
                            <span id="recipientCount">0 recipients</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modern-btn modern-btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="modern-btn modern-btn-primary" id="confirmBroadcast">Send Notification</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Professional Admin Design Variables */
:root {
    --admin-primary-color: #4f46e5;
    --admin-primary-hover: #4338ca;
    --admin-primary-light: #f0f4ff;
    --admin-success-color: #059669;
    --admin-success-hover: #047857;
    --admin-success-light: #f0fdf9;
    --admin-warning-color: #d97706;
    --admin-warning-hover: #b45309;
    --admin-warning-light: #fffbeb;
    --admin-danger-color: #dc2626;
    --admin-danger-hover: #b91c1c;
    --admin-danger-light: #fef2f2;
    --admin-info-color: #0891b2;
    --admin-info-hover: #0e7490;
    --admin-info-light: #f0f9ff;
    --admin-secondary-color: #64748b;
    --admin-secondary-hover: #475569;
    --admin-secondary-light: #f8fafc;
    --admin-background-primary: #f8fafc;
    --admin-surface-elevated: #ffffff;
    --admin-border-primary: #e2e8f0;
    --admin-text-primary: #0f172a;
    --admin-text-secondary: #475569;
    --admin-text-muted: #94a3b8;
    --admin-shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --admin-shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --admin-shadow-elevated: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --admin-shadow-floating: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    --admin-border-radius-sm: 8px;
    --admin-border-radius-md: 12px;
    --admin-border-radius-lg: 16px;
    --admin-transition-fast: all 0.15s ease;
    --admin-transition-medium: all 0.25s ease;
    --admin-spacing-xs: 0.5rem;
    --admin-spacing-sm: 0.75rem;
    --admin-spacing-md: 1rem;
    --admin-spacing-lg: 1.5rem;
    --admin-spacing-xl: 2rem;
}

* {
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: var(--admin-text-primary);
    background: var(--admin-background-primary);
}

.professional-bg {
    background: linear-gradient(135deg, var(--admin-background-primary) 0%, #f1f5f9 100%);
    min-height: 100vh;
    padding: var(--admin-spacing-xl) 0;
}

/* Modern Admin Breadcrumb */
.modern-breadcrumb {
    display: flex;
    align-items: center;
    background: var(--admin-surface-elevated);
    padding: var(--admin-spacing-md) var(--admin-spacing-lg);
    border-radius: var(--admin-border-radius-md);
    box-shadow: var(--admin-shadow-subtle);
    border: 1px solid var(--admin-border-primary);
    margin: 0;
    list-style: none;
    gap: var(--admin-spacing-sm);
    flex-wrap: wrap;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    text-decoration: none;
    color: var(--admin-text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    padding: var(--admin-spacing-xs) var(--admin-spacing-sm);
    border-radius: var(--admin-border-radius-sm);
    transition: var(--admin-transition-fast);
}

.breadcrumb-link:hover {
    color: var(--admin-primary-color);
    background: var(--admin-primary-light);
    text-decoration: none;
}

.breadcrumb-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 4px;
    background: var(--admin-primary-light);
    color: var(--admin-primary-color);
    font-size: 0.875rem;
}

.breadcrumb-link:hover .breadcrumb-icon {
    background: var(--admin-primary-color);
    color: white;
}

.breadcrumb-text {
    font-weight: 500;
}

.breadcrumb-separator {
    color: var(--admin-text-muted);
    font-size: 0.75rem;
}

.breadcrumb-item.active {
    color: var(--admin-text-primary);
    font-weight: 600;
}

.breadcrumb-item.active .breadcrumb-icon {
    background: var(--admin-primary-color);
    color: white;
}

/* Admin Messaging Header */
.admin-messaging-header-section {
    margin-bottom: var(--admin-spacing-lg);
}

.admin-messaging-header-card {
    background: var(--admin-surface-elevated);
    border-radius: var(--admin-border-radius-md);
    box-shadow: var(--admin-shadow-subtle);
    border: 1px solid var(--admin-border-primary);
    padding: var(--admin-spacing-lg) var(--admin-spacing-xl);
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--admin-spacing-lg);
}

.admin-messaging-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--admin-primary-color) 0%, var(--admin-info-color) 50%, var(--admin-success-color) 100%);
}

.admin-messaging-header-content {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-md);
    flex: 1;
    min-width: 300px;
}

.admin-messaging-header-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, var(--admin-primary-color) 0%, var(--admin-primary-hover) 100%);
    border-radius: var(--admin-border-radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    flex-shrink: 0;
    box-shadow: var(--admin-shadow-medium);
}

.admin-messaging-page-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--admin-text-primary);
    line-height: 1.2;
}

.admin-messaging-page-subtitle {
    margin: 0;
    font-size: 1rem;
    color: var(--admin-text-secondary);
    line-height: 1.4;
}

.admin-messaging-header-actions {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-md);
    flex-shrink: 0;
}

.admin-messaging-status {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    font-size: 0.875rem;
    color: var(--admin-text-secondary);
    font-weight: 500;
}

/* Enterprise Admin Messaging Section */
.enterprise-admin-messaging-section {
    background: var(--admin-surface-elevated);
    border-radius: var(--admin-border-radius-lg);
    box-shadow: var(--admin-shadow-elevated);
    border: 1px solid var(--admin-border-primary);
    overflow: hidden;
    height: 750px;
    transition: var(--admin-transition-medium);
}

.enterprise-admin-messaging-section:hover {
    box-shadow: var(--admin-shadow-floating);
}

.admin-messaging-interface {
    display: flex;
    height: 100%;
}

/* Enhanced Admin Contacts Sidebar */
.admin-contacts-sidebar {
    width: 420px;
    border-right: 1px solid var(--admin-border-primary);
    background: linear-gradient(135deg, #fafbff 0%, var(--admin-secondary-light) 100%);
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
}

.admin-sidebar-header {
    padding: var(--admin-spacing-lg);
    border-bottom: 1px solid var(--admin-border-primary);
    background: var(--admin-surface-elevated);
}

.admin-sidebar-header-title {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--admin-text-primary);
    margin-bottom: var(--admin-spacing-md);
}

.admin-sidebar-header-title i {
    color: var(--admin-primary-color);
    font-size: 1.5rem;
}

.admin-search-container {
    margin-bottom: var(--admin-spacing-md);
}

.admin-search-wrapper {
    position: relative;
}

.admin-search-icon {
    position: absolute;
    left: var(--admin-spacing-sm);
    top: 50%;
    transform: translateY(-50%);
    color: var(--admin-text-muted);
    font-size: 1rem;
    z-index: 2;
}

.admin-search-input {
    width: 100%;
    padding: var(--admin-spacing-sm) var(--admin-spacing-sm) var(--admin-spacing-sm) 2.5rem;
    border: 2px solid var(--admin-border-primary);
    border-radius: var(--admin-border-radius-sm);
    font-size: 0.875rem;
    background: var(--admin-surface-elevated);
    transition: var(--admin-transition-fast);
}

.admin-search-input:focus {
    border-color: var(--admin-primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    outline: none;
}

.admin-sidebar-tabs {
    display: flex;
    gap: var(--admin-spacing-xs);
    background: var(--admin-secondary-light);
    padding: 4px;
    border-radius: var(--admin-border-radius-sm);
}

.admin-tab-btn {
    flex: 1;
    padding: var(--admin-spacing-sm) var(--admin-spacing-xs);
    border: none;
    background: transparent;
    color: var(--admin-text-secondary);
    border-radius: var(--admin-border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    transition: var(--admin-transition-fast);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2px;
    position: relative;
}

.admin-tab-btn.active {
    background: var(--admin-surface-elevated);
    color: var(--admin-primary-color);
    box-shadow: var(--admin-shadow-subtle);
}

.admin-tab-btn:hover:not(.active) {
    background: rgba(255, 255, 255, 0.5);
    color: var(--admin-text-primary);
}

/* Enhanced Admin Contacts List */
.admin-contacts-list {
    flex: 1;
    overflow-y: auto;
    padding: var(--admin-spacing-sm);
}

.admin-contacts-list::-webkit-scrollbar {
    width: 6px;
}

.admin-contacts-list::-webkit-scrollbar-track {
    background: transparent;
}

.admin-contacts-list::-webkit-scrollbar-thumb {
    background: var(--admin-border-primary);
    border-radius: 3px;
}

.admin-contacts-list::-webkit-scrollbar-thumb:hover {
    background: var(--admin-text-muted);
}

/* Admin Broadcast Section */
.admin-broadcast-section {
    margin-bottom: var(--admin-spacing-lg);
}

.admin-section-title {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--admin-text-primary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: var(--admin-spacing-md);
    padding: 0 var(--admin-spacing-sm);
}

.admin-section-title i {
    color: var(--admin-primary-color);
}

/* Admin Contact Items */
.admin-contact-item {
    display: flex;
    align-items: flex-start;
    padding: var(--admin-spacing-md);
    border-radius: var(--admin-border-radius-md);
    margin-bottom: var(--admin-spacing-sm);
    cursor: pointer;
    transition: var(--admin-transition-medium);
    background: var(--admin-surface-elevated);
    border: 1px solid transparent;
    position: relative;
}

.admin-contact-item:hover {
    background: #fafbff;
    border-color: rgba(79, 70, 229, 0.1);
    transform: translateY(-1px);
    box-shadow: var(--admin-shadow-medium);
}

.admin-contact-item.active {
    background: linear-gradient(135deg, var(--admin-primary-color) 0%, var(--admin-primary-hover) 100%);
    color: white;
    border-color: var(--admin-primary-color);
    box-shadow: var(--admin-shadow-elevated);
}

/* Admin Broadcast Items */
.admin-broadcast-item {
    background: linear-gradient(135deg, var(--admin-info-light) 0%, #e0f7fa 100%);
    border: 1px solid rgba(8, 145, 178, 0.2);
}

.admin-broadcast-item:hover {
    background: linear-gradient(135deg, #e0f7fa 0%, var(--admin-info-light) 100%);
    border-color: var(--admin-info-color);
}

.admin-broadcast-item.active {
    background: linear-gradient(135deg, var(--admin-info-color) 0%, var(--admin-info-hover) 100%);
    color: white;
    border-color: var(--admin-info-color);
}

/* Admin Contact Avatar */
.admin-contact-avatar {
    position: relative;
    margin-right: var(--admin-spacing-md);
    flex-shrink: 0;
}

.admin-contact-avatar img {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255, 255, 255, 0.9);
}

.admin-avatar-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    border: 3px solid rgba(255, 255, 255, 0.9);
}

.admin-avatar-wrapper.broadcast.companies {
    background: linear-gradient(135deg, var(--admin-info-color) 0%, var(--admin-info-hover) 100%);
}

.admin-avatar-wrapper.broadcast.candidates {
    background: linear-gradient(135deg, var(--admin-warning-color) 0%, var(--admin-warning-hover) 100%);
}

.status-indicator {
    position: absolute;
    bottom: 3px;
    right: 3px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 3px solid white;
}

.status-indicator.online {
    background: var(--admin-success-color);
    animation: adminPulse 2s infinite;
}

.status-indicator.away {
    background: var(--admin-warning-color);
}

.status-indicator.offline {
    background: var(--admin-secondary-color);
}

@keyframes adminPulse {
    0% {
        box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(5, 150, 105, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
    }
}

/* Admin Entity Badges */
.admin-entity-badge {
    position: absolute;
    top: -3px;
    left: -3px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.625rem;
    font-weight: 700;
    border: 2px solid white;
}

.admin-entity-badge.company {
    background: var(--admin-info-color);
    color: white;
}

.admin-entity-badge.candidate {
    background: var(--admin-success-color);
    color: white;
}

.admin-broadcast-badge {
    position: absolute;
    top: -3px;
    right: -3px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--admin-warning-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.625rem;
    border: 2px solid white;
}

/* Admin Contact Info */
.admin-contact-info {
    flex: 1;
    min-width: 0;
}

.admin-contact-name {
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 0.125rem;
    line-height: 1.3;
}

.admin-contact-role {
    font-size: 0.8125rem;
    opacity: 0.8;
    margin-bottom: var(--admin-spacing-xs);
    line-height: 1.2;
}

.admin-last-message {
    font-size: 0.875rem;
    opacity: 0.9;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-bottom: var(--admin-spacing-xs);
    line-height: 1.3;
}

.admin-message-meta-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.admin-message-time {
    font-size: 0.75rem;
    opacity: 0.7;
    font-weight: 500;
}

.admin-message-status {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
}

.admin-unread-badge {
    background: var(--admin-danger-color);
    color: white;
    font-size: 0.6875rem;
    font-weight: 700;
    padding: 3px 7px;
    border-radius: 12px;
    min-width: 20px;
    text-align: center;
}

.admin-contact-item.active .admin-unread-badge {
    background: rgba(255, 255, 255, 0.25);
}

.admin-broadcast-count {
    background: var(--admin-info-color);
    color: white;
    font-size: 0.6875rem;
    font-weight: 700;
    padding: 3px 7px;
    border-radius: 12px;
    text-align: center;
}

.admin-broadcast-item.active .admin-broadcast-count {
    background: rgba(255, 255, 255, 0.25);
}

.admin-message-read {
    color: var(--admin-success-color);
    font-size: 1rem;
}

.admin-message-sent {
    color: var(--admin-text-muted);
    font-size: 1rem;
}

.admin-contact-item.active .admin-message-read,
.admin-contact-item.active .admin-message-sent {
    color: white;
    opacity: 0.8;
}

/* Enhanced Admin Chat Area */
.admin-chat-area {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: var(--admin-surface-elevated);
}

/* Professional Admin Chat Header */
.admin-chat-header {
    padding: var(--admin-spacing-lg);
    border-bottom: 1px solid var(--admin-border-primary);
    background: var(--admin-surface-elevated);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.admin-chat-user-info {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-md);
}

.admin-chat-avatar {
    position: relative;
    flex-shrink: 0;
}

.admin-chat-avatar img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--admin-border-primary);
}

.admin-chat-name {
    font-weight: 700;
    font-size: 1.125rem;
    margin-bottom: 0.125rem;
    color: var(--admin-text-primary);
    line-height: 1.2;
}

.admin-chat-status {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    font-size: 0.8125rem;
    color: var(--admin-text-secondary);
    font-weight: 500;
}

.admin-chat-status i {
    font-size: 0.5rem;
    color: var(--admin-success-color);
}

.admin-chat-actions {
    display: flex;
    gap: var(--admin-spacing-xs);
}

.admin-chat-action-btn {
    width: 44px;
    height: 44px;
    border: none;
    background: var(--admin-secondary-light);
    border-radius: var(--admin-border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--admin-text-secondary);
    font-size: 1.125rem;
    transition: var(--admin-transition-fast);
    cursor: pointer;
}

.admin-chat-action-btn:hover {
    background: var(--admin-primary-light);
    color: var(--admin-primary-color);
    transform: translateY(-1px);
}

/* Enhanced Admin Messages Container */
.admin-messages-container {
    flex: 1;
    padding: var(--admin-spacing-lg);
    overflow-y: auto;
    background: linear-gradient(135deg, #fafbff 0%, #f1f5f9 100%);
    position: relative;
}

.admin-messages-container::-webkit-scrollbar {
    width: 6px;
}

.admin-messages-container::-webkit-scrollbar-track {
    background: transparent;
}

.admin-messages-container::-webkit-scrollbar-thumb {
    background: var(--admin-border-primary);
    border-radius: 3px;
}

.admin-messages-container::-webkit-scrollbar-thumb:hover {
    background: var(--admin-text-muted);
}

/* Enhanced Admin Date Separator */
.admin-date-separator {
    display: flex;
    align-items: center;
    margin: var(--admin-spacing-xl) 0;
    gap: var(--admin-spacing-md);
}

.admin-date-line {
    flex: 1;
    height: 1px;
    background: var(--admin-border-primary);
}

.admin-date-text {
    background: var(--admin-surface-elevated);
    color: var(--admin-text-muted);
    padding: var(--admin-spacing-xs) var(--admin-spacing-md);
    border-radius: var(--admin-border-radius-sm);
    font-size: 0.8125rem;
    font-weight: 600;
    border: 1px solid var(--admin-border-primary);
    white-space: nowrap;
}

/* Professional Admin Message Bubbles */
.admin-message-wrapper {
    display: flex;
    margin-bottom: var(--admin-spacing-lg);
    animation: adminMessageSlideIn 0.4s ease-out;
}

@keyframes adminMessageSlideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.admin-message-wrapper.outgoing {
    flex-direction: row-reverse;
}

.admin-message-avatar {
    flex-shrink: 0;
    margin: 0 var(--admin-spacing-md);
}

.admin-message-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
    box-shadow: var(--admin-shadow-subtle);
}

.admin-message-content {
    flex: 1;
    max-width: 75%;
}

.admin-message-wrapper.outgoing .admin-message-content {
    text-align: right;
}

.admin-message-bubble {
    display: inline-block;
    padding: var(--admin-spacing-md) var(--admin-spacing-lg);
    border-radius: 20px;
    position: relative;
    margin-bottom: var(--admin-spacing-xs);
    max-width: 100%;
    word-wrap: break-word;
    box-shadow: var(--admin-shadow-medium);
}

.admin-message-wrapper.incoming .admin-message-bubble {
    background: var(--admin-surface-elevated);
    border: 1px solid var(--admin-border-primary);
    border-bottom-left-radius: 8px;
}

.admin-message-wrapper.outgoing .admin-message-bubble {
    background: linear-gradient(135deg, var(--admin-primary-color) 0%, var(--admin-primary-hover) 100%);
    color: white;
    border-bottom-right-radius: 8px;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.admin-message-text {
    font-size: 0.9375rem;
    line-height: 1.5;
    margin: 0;
}

.admin-message-meta {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-sm);
    font-size: 0.75rem;
    color: var(--admin-text-muted);
    font-weight: 500;
}

.admin-message-wrapper.outgoing .admin-message-meta {
    justify-content: flex-end;
}

.admin-message-sender {
    font-weight: 600;
}

.admin-message-status {
    font-size: 0.875rem;
}

/* Enhanced Admin Message Input */
.admin-message-input-container {
    padding: var(--admin-spacing-lg);
    background: var(--admin-surface-elevated);
    border-top: 1px solid var(--admin-border-primary);
}

.admin-input-group-enhanced {
    display: flex;
    align-items: flex-end;
    gap: var(--admin-spacing-sm);
    background: linear-gradient(135deg, #fafbff 0%, var(--admin-secondary-light) 100%);
    border: 2px solid var(--admin-border-primary);
    border-radius: var(--admin-border-radius-md);
    padding: var(--admin-spacing-sm);
    transition: var(--admin-transition-fast);
}

.admin-input-group-enhanced:focus-within {
    border-color: var(--admin-primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.admin-input-actions-left {
    display: flex;
    gap: var(--admin-spacing-xs);
}

.admin-action-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: transparent;
    color: var(--admin-text-secondary);
    border-radius: var(--admin-border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.125rem;
    transition: var(--admin-transition-fast);
    cursor: pointer;
}

.admin-action-btn:hover {
    background: var(--admin-primary-light);
    color: var(--admin-primary-color);
}

.admin-input-wrapper {
    flex: 1;
    position: relative;
}

.admin-message-input {
    width: 100%;
    border: none;
    background: transparent;
    resize: none;
    font-size: 0.9375rem;
    line-height: 1.5;
    padding: var(--admin-spacing-sm) 0;
    max-height: 120px;
    min-height: 44px;
    font-family: inherit;
    color: var(--admin-text-primary);
}

.admin-message-input:focus {
    outline: none;
}

.admin-message-input::placeholder {
    color: var(--admin-text-muted);
}

.admin-input-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--admin-spacing-xs);
}

.admin-char-counter {
    font-size: 0.6875rem;
    color: var(--admin-text-muted);
    font-weight: 500;
}

.admin-message-type {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.6875rem;
    color: var(--admin-primary-color);
    font-weight: 600;
}

.admin-send-btn {
    width: 48px;
    height: 48px;
    border: none;
    background: linear-gradient(135deg, var(--admin-primary-color) 0%, var(--admin-primary-hover) 100%);
    color: white;
    border-radius: var(--admin-border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    transition: var(--admin-transition-fast);
    cursor: pointer;
    box-shadow: var(--admin-shadow-medium);
}

.admin-send-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, var(--admin-primary-hover) 0%, #3730a3 100%);
    transform: translateY(-2px);
    box-shadow: var(--admin-shadow-elevated);
}

.admin-send-btn:disabled {
    background: var(--admin-secondary-color);
    cursor: not-allowed;
    transform: none;
    box-shadow: var(--admin-shadow-subtle);
}

/* Enterprise Button */
.enterprise-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1;
    border-radius: var(--admin-border-radius-sm);
    border: 2px solid;
    text-decoration: none;
    cursor: pointer;
    transition: var(--admin-transition-fast);
    white-space: nowrap;
}

.btn-outline-primary {
    background: var(--admin-surface-elevated);
    color: var(--admin-primary-color);
    border-color: var(--admin-primary-color);
}

.btn-outline-primary:hover {
    background: var(--admin-primary-color);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--admin-shadow-medium);
}

/* Modern Modal */
.modern-modal {
    border-radius: var(--admin-border-radius-md);
    box-shadow: var(--admin-shadow-floating);
    border: none;
}

.modern-modal .modal-header {
    background: linear-gradient(135deg, var(--admin-primary-light) 0%, #f8fafc 100%);
    border-bottom: 1px solid var(--admin-border-primary);
    border-radius: var(--admin-border-radius-md) var(--admin-border-radius-md) 0 0;
    padding: var(--admin-spacing-lg);
}

.modern-modal .modal-title {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    color: var(--admin-text-primary);
    font-weight: 600;
}

.modern-modal .modal-body {
    padding: var(--admin-spacing-xl);
}

.broadcast-confirmation {
    display: flex;
    gap: var(--admin-spacing-lg);
    align-items: flex-start;
}

.broadcast-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
    background: var(--admin-primary-light);
    color: var(--admin-primary-color);
}

.broadcast-details {
    flex: 1;
}

.broadcast-details h6 {
    margin: 0 0 var(--admin-spacing-sm) 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--admin-text-primary);
}

.broadcast-details p {
    margin: 0 0 var(--admin-spacing-sm) 0;
    color: var(--admin-text-secondary);
    line-height: 1.5;
}

.recipient-count {
    display: flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    font-size: 0.875rem;
    color: var(--admin-text-muted);
    font-weight: 500;
}

.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--admin-spacing-xs);
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1;
    border-radius: var(--admin-border-radius-sm);
    border: 2px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: var(--admin-transition-fast);
    white-space: nowrap;
}

.modern-btn-outline-secondary {
    background: white;
    color: var(--admin-secondary-color);
    border-color: var(--admin-border-primary);
}

.modern-btn-outline-secondary:hover {
    background: var(--admin-secondary-color);
    color: white;
    border-color: var(--admin-secondary-color);
}

.modern-btn-primary {
    background: var(--admin-primary-color);
    color: white;
    border-color: var(--admin-primary-color);
}

.modern-btn-primary:hover {
    background: var(--admin-primary-hover);
    border-color: var(--admin-primary-hover);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .admin-messaging-interface {
        flex-direction: column;
    }

    .admin-contacts-sidebar {
        width: 100%;
        height: 280px;
        border-right: none;
        border-bottom: 1px solid var(--admin-border-primary);
    }

    .enterprise-admin-messaging-section {
        height: 650px;
    }

    .admin-messaging-header-card {
        flex-direction: column;
        text-align: center;
        gap: var(--admin-spacing-md);
    }

    .admin-sidebar-tabs {
        grid-template-columns: 1fr 1fr 1fr;
        display: grid;
    }
}

@media (max-width: 768px) {
    .professional-bg {
        padding: var(--admin-spacing-md) 0;
    }

    .admin-contacts-sidebar {
        height: 220px;
    }

    .admin-sidebar-header {
        padding: var(--admin-spacing-md);
    }

    .admin-contacts-list {
        padding: var(--admin-spacing-xs);
    }

    .admin-contact-item {
        padding: var(--admin-spacing-sm);
    }

    .admin-contact-avatar img,
    .admin-avatar-wrapper {
        width: 48px;
        height: 48px;
    }

    .admin-chat-header {
        padding: var(--admin-spacing-md);
    }

    .admin-messages-container {
        padding: var(--admin-spacing-md);
    }

    .admin-message-input-container {
        padding: var(--admin-spacing-md);
    }

    .admin-chat-actions {
        gap: var(--admin-spacing-xs);
    }

    .admin-chat-action-btn {
        width: 36px;
        height: 36px;
        font-size: 1rem;
    }

    .admin-messaging-page-title {
        font-size: 1.5rem;
    }

    .admin-sidebar-tabs {
        flex-direction: column;
        gap: 4px;
    }

    .admin-tab-btn {
        flex-direction: row;
        justify-content: flex-start;
    }
}

@media (max-width: 480px) {
    .admin-message-content {
        max-width: 90%;
    }

    .admin-message-bubble {
        padding: var(--admin-spacing-sm) var(--admin-spacing-md);
        font-size: 0.875rem;
    }

    .admin-contact-avatar img,
    .admin-avatar-wrapper {
        width: 40px;
        height: 40px;
    }

    .admin-message-avatar img {
        width: 32px;
        height: 32px;
    }

    .admin-input-group-enhanced {
        padding: var(--admin-spacing-xs);
    }

    .admin-action-btn {
        width: 36px;
        height: 36px;
    }

    .admin-send-btn {
        width: 44px;
        height: 44px;
    }

    .admin-messaging-header-card {
        padding: var(--admin-spacing-md);
    }
}
</style>
@endpush

@push('scripts')
<script>
let currentContactId = "2"; // Default to first company
let currentContactType = "company";

document.addEventListener('DOMContentLoaded', function() {
    initializeAdminMessaging();
});

function initializeAdminMessaging() {
    const chatForm = document.getElementById('adminChatForm');
    const chatInput = document.getElementById('adminChatInput');
    const chatMessages = document.getElementById('adminChatMessages');
    const charCount = document.getElementById('adminCharCount');
    const sendButton = document.getElementById('adminSendButton');
    const messageInputContainer = document.getElementById('adminMessageInputContainer');
    const messageType = document.getElementById('adminMessageType');

    // Load default conversation
    loadAdminConversation(currentContactId, currentContactType);

    // Contact switching with enhanced functionality
    document.querySelectorAll('.admin-contact-item').forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all contacts
            document.querySelectorAll('.admin-contact-item').forEach(contact => {
                contact.classList.remove('active');
                contact.style.transform = 'translateX(0)';
            });

            // Add active class with animation
            this.classList.add('active');
            this.style.transform = 'translateX(4px)';

            currentContactId = this.getAttribute('data-contact-id');
            currentContactType = this.getAttribute('data-contact-type');

            updateAdminChatHeader(this);
            loadAdminConversation(currentContactId, currentContactType);
            updateMessageTypeIndicator(currentContactType);
        });
    });

    // Enhanced tab switching
    document.querySelectorAll('.admin-tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.admin-tab-btn').forEach(tab => tab.classList.remove('active'));
            this.classList.add('active');
            filterAdminContacts(this.dataset.tab);
        });
    });

    // Enhanced search functionality
    const searchInput = document.querySelector('.admin-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchAdminContacts(this.value);
        });
    }

    // Auto-resize textarea with enhanced functionality
    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';

        const currentLength = this.value.length;
        charCount.textContent = currentLength;

        // Color coding for character count
        if (currentLength > 800) {
            charCount.style.color = 'var(--admin-danger-color)';
        } else if (currentLength > 600) {
            charCount.style.color = 'var(--admin-warning-color)';
        } else {
            charCount.style.color = 'var(--admin-text-muted)';
        }

        sendButton.disabled = this.value.trim().length === 0;
    });

    // Enhanced keyboard shortcuts
    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (this.value.trim()) {
                chatForm.dispatchEvent(new Event('submit'));
            }
        }
    });

    // Form submission with enhanced handling
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = chatInput.value.trim();

        if (message) {
            if (currentContactType === "notification") {
                showBroadcastConfirmation(message);
            } else {
                sendAdminMessage(message);
            }

            chatInput.value = '';
            chatInput.style.height = 'auto';
            charCount.textContent = '0';
            charCount.style.color = 'var(--admin-text-muted)';
            sendButton.disabled = true;
        }
    });

    // Initialize message type indicator
    updateMessageTypeIndicator(currentContactType);
}

function sendAdminMessage(messageText) {
    const chatMessages = document.getElementById('adminChatMessages');
    const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

    // Create enhanced admin message
    const messageWrapper = document.createElement('div');
    messageWrapper.className = 'admin-message-wrapper outgoing';
    messageWrapper.innerHTML = `
        <div class="admin-message-content">
            <div class="admin-message-bubble">
                <div class="admin-message-text">${escapeHtml(messageText)}</div>
            </div>
            <div class="admin-message-meta">
                <span class="admin-message-time">${currentTime}</span>
                <i class="bx bx-check admin-message-status sent"></i>
            </div>
        </div>
        <div class="admin-message-avatar">
            <img src="https://ui-avatars.com/api/?name=Admin+Support&size=40&background=6366f1&color=ffffff&bold=true" alt="Admin Support">
        </div>
    `;

    chatMessages.appendChild(messageWrapper);
    scrollAdminToBottom();

    // Update message status with delay
    setTimeout(() => {
        const statusIcon = messageWrapper.querySelector('.admin-message-status');
        statusIcon.className = 'bx bx-check-double admin-message-status delivered';
        statusIcon.style.color = 'var(--admin-primary-color)';
    }, 1000);

    // Send to backend
    fetch("{{ route('admin.messages.send') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            receiver_id: currentContactId,
            receiver_type: currentContactType,
            message: messageText
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAdminToast('Message sent successfully!', 'success');
            updateContactLastMessage(messageText);
        } else {
            showAdminToast('Failed to send message.', 'error');
        }
    })
    .catch(error => {
        showAdminToast('Failed to send message.', 'error');
        console.error('Error:', error);
    });
}

function showBroadcastConfirmation(message) {
    const modal = document.getElementById('adminNotificationModal');
    const title = document.getElementById('broadcastTitle');
    const messageEl = document.getElementById('broadcastMessage');
    const recipientCount = document.getElementById('recipientCount');
    const confirmBtn = document.getElementById('confirmBroadcast');

    // Update modal content
    if (currentContactId === 'all_companies') {
        title.textContent = 'Send to All Companies';
        messageEl.textContent = 'Your notification will be sent to all registered companies.';
        recipientCount.textContent = '{{ $companiesCount ?? 0 }} recipients';
    } else {
        title.textContent = 'Send to All Candidates';
        messageEl.textContent = 'Your notification will be sent to all registered candidates.';
        recipientCount.textContent = '{{ $candidatesCount ?? 0 }} recipients';
    }

    // Show modal
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();

    // Handle confirmation
    confirmBtn.onclick = function() {
        sendBroadcastNotification(message);
        bootstrapModal.hide();
    };
}

function sendBroadcastNotification(message) {
    const chatMessages = document.getElementById('adminChatMessages');
    const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

    // Add broadcast message to chat
    const messageWrapper = document.createElement('div');
    messageWrapper.className = 'admin-message-wrapper outgoing';
    messageWrapper.innerHTML = `
        <div class="admin-message-content">
            <div class="admin-message-bubble" style="background: linear-gradient(135deg, var(--admin-info-color) 0%, var(--admin-info-hover) 100%);">
                <div class="admin-message-text">
                    <strong>📢 Broadcast Notification</strong><br>
                    ${escapeHtml(message)}
                </div>
            </div>
            <div class="admin-message-meta">
                <span class="admin-message-time">${currentTime}</span>
                <i class="bx bx-broadcast admin-message-status"></i>
            </div>
        </div>
        <div class="admin-message-avatar">
            <img src="https://ui-avatars.com/api/?name=Admin+Broadcast&size=40&background=0891b2&color=ffffff&bold=true" alt="Admin Broadcast">
        </div>
    `;

    chatMessages.appendChild(messageWrapper);
    scrollAdminToBottom();

    // Send broadcast to backend
    fetch("{{ route('admin.messages.fetch') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            target: currentContactId,
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAdminToast(`Broadcast sent to ${data.count} recipients!`, 'success');

            // Update status
            setTimeout(() => {
                const statusIcon = messageWrapper.querySelector('.admin-message-status');
                statusIcon.className = 'bx bx-check-double admin-message-status';
                statusIcon.style.color = 'var(--admin-success-color)';
            }, 1500);
        } else {
            showAdminToast('Failed to send broadcast.', 'error');
        }
    })
    .catch(error => {
        showAdminToast('Failed to send broadcast.', 'error');
        console.error('Error:', error);
    });
}

function loadAdminConversation(contactId, contactType) {
    const chatMessages = document.getElementById('adminChatMessages');
    chatMessages.innerHTML = `
        <div class="admin-date-separator">
            <div class="admin-date-line"></div>
            <span class="admin-date-text">Today, {{ \Carbon\Carbon::now()->format('F d, Y') }}</span>
            <div class="admin-date-line"></div>
        </div>
    `;

    if (contactType === "notification") {
        // Show broadcast instructions
        const broadcastInfo = document.createElement('div');
        broadcastInfo.className = 'admin-message-wrapper incoming';
        broadcastInfo.innerHTML = `
            <div class="admin-message-avatar">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--admin-info-color); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.25rem;">
                    <i class="bx bx-broadcast"></i>
                </div>
            </div>
            <div class="admin-message-content">
                <div class="admin-message-bubble">
                    <div class="admin-message-text">
                        📢 <strong>Broadcast Mode</strong><br>
                        Send notifications to all ${contactId === 'all_companies' ? 'companies' : 'candidates'}. Your message will be delivered as a system notification.
                    </div>
                </div>
                <div class="admin-message-meta">
                    <span class="admin-message-sender">System</span>
                    <span class="admin-message-time">Now</span>
                </div>
            </div>
        `;
        chatMessages.appendChild(broadcastInfo);
        scrollAdminToBottom();
        return;
    }

    // Fetch messages from backend
    fetch(`{{ route('admin.messages.fetch') }}?with_id=${contactId}&with_type=${contactType}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && Array.isArray(data.messages)) {
                data.messages.forEach(message => {
                    const messageWrapper = document.createElement('div');
                    messageWrapper.className = `admin-message-wrapper ${message.type === 'incoming' ? 'incoming' : 'outgoing'}`;
                    if (message.type === 'incoming') {
                        messageWrapper.innerHTML = `
                            <div class="admin-message-avatar">
                                <img src="${message.avatar}" alt="${message.sender}">
                            </div>
                            <div class="admin-message-content">
                                <div class="admin-message-bubble">
                                    <div class="admin-message-text">${escapeHtml(message.text)}</div>
                                </div>
                                <div class="admin-message-meta">
                                    <span class="admin-message-sender">${message.sender}</span>
                                    <span class="admin-message-time">${message.time}</span>
                                    <i class="bx bx-check-double admin-message-status"></i>
                                </div>
                            </div>
                        `;
                    } else {
                        messageWrapper.innerHTML = `
                            <div class="admin-message-content">
                                <div class="admin-message-bubble">
                                    <div class="admin-message-text">${escapeHtml(message.text)}</div>
                                </div>
                                <div class="admin-message-meta">
                                    <span class="admin-message-time">${message.time}</span>
                                    <i class="bx bx-check-double admin-message-status" style="color: var(--admin-primary-color);"></i>
                                </div>
                            </div>
                            <div class="admin-message-avatar">
                                <img src="https://ui-avatars.com/api/?name=Admin+Support&size=40&background=6366f1&color=ffffff&bold=true" alt="Admin Support">
                            </div>
                        `;
                    }
                    chatMessages.appendChild(messageWrapper);
                });
                scrollAdminToBottom();
            }
        });
}

function updateAdminChatHeader(contactItem) {
    const contactName = contactItem.querySelector('.admin-contact-name').textContent;
    const contactRole = contactItem.querySelector('.admin-contact-role').textContent;
    const contactAvatar = contactItem.querySelector('.admin-contact-avatar img') ||
                         contactItem.querySelector('.admin-avatar-wrapper');
    const statusIndicator = contactItem.querySelector('.status-indicator');

    const chatHeader = document.querySelector('.admin-chat-header');
    const chatName = chatHeader.querySelector('.admin-chat-name');
    const chatAvatar = chatHeader.querySelector('.admin-chat-avatar img');
    const chatStatusIndicator = chatHeader.querySelector('.admin-chat-avatar .status-indicator');
    const chatStatusText = chatHeader.querySelector('.admin-chat-status span');

    chatName.textContent = contactName;

    if (contactAvatar.tagName === 'IMG') {
        chatAvatar.src = contactAvatar.src;
    } else {
        // Handle broadcast items
        chatAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(contactName)}&size=48&background=6366f1&color=ffffff&bold=true`;
    }

    // Update status indicator
    if (statusIndicator) {
        if (chatStatusIndicator) {
            chatStatusIndicator.className = statusIndicator.className;
        } else {
            const newIndicator = statusIndicator.cloneNode(true);
            chatHeader.querySelector('.admin-chat-avatar').appendChild(newIndicator);
        }

        const statusClass = statusIndicator.classList.contains('online') ? 'Online • Active now' :
                           statusIndicator.classList.contains('away') ? 'Away • Last seen recently' :
                           'Offline • Last seen recently';
        chatStatusText.textContent = statusClass;
    } else {
        // Remove status indicator for broadcast items
        if (chatStatusIndicator) {
            chatStatusIndicator.remove();
        }
        chatStatusText.textContent = 'Broadcast Mode';
    }
}

function updateMessageTypeIndicator(contactType) {
    const messageType = document.getElementById('adminMessageType');
    if (!messageType) return;

    if (contactType === "notification") {
        messageType.innerHTML = '<i class="bx bx-broadcast"></i><span>Broadcast</span>';
        messageType.style.color = 'var(--admin-info-color)';
    } else {
        messageType.innerHTML = '<i class="bx bx-message-dots"></i><span>Message</span>';
        messageType.style.color = 'var(--admin-primary-color)';
    }
}

function filterAdminContacts(filter) {
    const contactItems = document.querySelectorAll('.admin-contact-item');

    contactItems.forEach(item => {
        const contactType = item.getAttribute('data-contact-type');

        switch(filter) {
            case 'all':
                item.style.display = 'flex';
                break;
            case 'companies':
                item.style.display = (contactType === 'company' ||
                                     item.getAttribute('data-contact-id') === 'all_companies') ? 'flex' : 'none';
                break;
            case 'candidates':
                item.style.display = (contactType === 'candidate' ||
                                     item.getAttribute('data-contact-id') === 'all_candidates') ? 'flex' : 'none';
                break;
        }
    });
}

function searchAdminContacts(query) {
    const contactItems = document.querySelectorAll('.admin-contact-item');
    const searchTerm = query.toLowerCase();

    contactItems.forEach(item => {
        const contactName = item.querySelector('.admin-contact-name').textContent.toLowerCase();
        const contactRole = item.querySelector('.admin-contact-role').textContent.toLowerCase();
        const lastMessage = item.querySelector('.admin-last-message').textContent.toLowerCase();

        const matches = contactName.includes(searchTerm) ||
                       contactRole.includes(searchTerm) ||
                       lastMessage.includes(searchTerm);

        item.style.display = matches ? 'flex' : 'none';
    });
}

function updateContactLastMessage(message) {
    const activeContact = document.querySelector('.admin-contact-item.active');
    if (activeContact && !activeContact.classList.contains('admin-broadcast-item')) {
        const lastMessageEl = activeContact.querySelector('.admin-last-message');
        const timeEl = activeContact.querySelector('.admin-message-time');

        if (lastMessageEl && timeEl) {
            lastMessageEl.textContent = message.length > 50 ? message.substring(0, 47) + '...' : message;
            timeEl.textContent = 'Just now';
        }
    }
}

function scrollAdminToBottom() {
    const chatMessages = document.getElementById('adminChatMessages');
    requestAnimationFrame(() => {
        chatMessages.scrollTo({
            top: chatMessages.scrollHeight,
            behavior: 'smooth'
        });
    });
}

function refreshMessages() {
    const refreshBtn = document.querySelector('.enterprise-btn');
    const originalContent = refreshBtn.innerHTML;

    refreshBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i><span>Refreshing...</span>';
    refreshBtn.disabled = true;

    setTimeout(() => {
        refreshBtn.innerHTML = originalContent;
        refreshBtn.disabled = false;
        showAdminToast('Messages refreshed successfully!', 'success');

        // Reload current conversation
        loadAdminConversation(currentContactId, currentContactType);
    }, 2000);
}

function showAdminToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `admin-toast-notification ${type}`;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? 'var(--admin-success-color)' : 'var(--admin-danger-color)'};
        color: white;
        padding: 12px 24px;
        border-radius: var(--admin-border-radius-sm);
        box-shadow: var(--admin-shadow-elevated);
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;

    toast.innerHTML = `
        <i class="bx ${type === 'success' ? 'bx-check-circle' : 'bx-error-circle'}"></i>
        <span>${message}</span>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);

    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 300);
    }, 3000);
}

function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips if available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>
@endpush
