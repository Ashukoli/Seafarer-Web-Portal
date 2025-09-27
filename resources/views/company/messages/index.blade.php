@extends('layouts.company.app')

@section('title', 'Messages - Communication Center')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">
        <!-- Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="modern-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('company.dashboard') }}" class="breadcrumb-link">
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
                            <span class="breadcrumb-text">Messages</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Messaging Header -->
        <div class="messaging-header-section mb-4">
            <div class="messaging-header-card">
                <div class="messaging-header-content">
                    <div class="messaging-header-icon">
                        <i class="bx bx-message-dots"></i>
                    </div>
                    <div class="messaging-header-text">
                        <h1 class="messaging-page-title">Communication Center</h1>
                        <p class="messaging-page-subtitle">Stay connected with admin support and receive important system notifications.</p>
                    </div>
                </div>
                <div class="messaging-header-actions">
                    <button class="enterprise-btn btn-outline-primary" onclick="refreshMessages()">
                        <i class="bx bx-refresh"></i>
                        <span>Refresh</span>
                    </button>
                    <div class="messaging-status">
                        <div class="status-indicator online"></div>
                        <span>Online</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messaging Interface -->
        <div class="enterprise-messaging-section">
            <div class="messaging-interface">
                <!-- Contacts Sidebar -->
                <div class="contacts-sidebar">
                    <div class="sidebar-header">
                        <div class="sidebar-header-title">
                            <i class="bx bx-chat"></i>
                            <span>Conversations</span>
                        </div>
                        <div class="search-container">
                            <div class="search-wrapper">
                                <i class="bx bx-search search-icon"></i>
                                <input type="text" class="search-input" placeholder="Search conversations...">
                            </div>
                        </div>
                        <div class="sidebar-tabs">
                            <button class="tab-btn active" data-tab="all">
                                <i class="bx bx-message"></i>
                                <span>All</span>
                                <div class="tab-indicator"></div>
                            </button>
                        </div>
                    </div>

                    <div class="contacts-list">
                        <!-- Admin Support Contact -->
                        <div class="contact-item active" data-contact="admin">
                            <div class="contact-avatar">
                                <img src="https://ui-avatars.com/api/?name=Admin+Support&size=56&background=6366f1&color=ffffff&bold=true" alt="Admin Support">
                                <div class="status-indicator online"></div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Admin Support</div>
                                <div class="contact-role">System Administrator</div>
                                <div class="last-message">How can we help you today?</div>
                                <div class="message-meta-info">
                                    <span class="message-time">Just now</span>
                                </div>
                            </div>
                        </div>

                        <!-- System Notifications Contact (no reply) -->
                        <div class="contact-item" data-contact="notifications">
                            <div class="contact-avatar">
                                <img src="https://ui-avatars.com/api/?name=System+Notifications&size=56&background=8b5cf6&color=ffffff&bold=true" alt="System Notifications">
                                <div class="status-indicator"></div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">System Notifications</div>
                                <div class="contact-role">Automated Updates</div>
                                <div class="last-message">New job matches available for your profile.</div>
                                <div class="message-meta-info">
                                    <span class="message-time">3 days ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="chat-area">
                   

                    <!-- Messages Container -->
                    <div class="messages-container" id="chatMessages">
                        <div class="date-separator">
                            <div class="date-line"></div>
                            <span class="date-text">Today, {{ \Carbon\Carbon::now()->format('F d, Y') }}</span>
                            <div class="date-line"></div>
                        </div>
                        <!-- Messages will be loaded here -->
                    </div>

                    <!-- Message Input (only for Admin Support) -->
                    <div class="message-input-container" id="messageInputContainer">
                        <form id="chatForm" class="message-form">
                            <div class="input-group-enhanced">
                                <div class="input-wrapper">
                                    <textarea
                                        id="chatInput"
                                        class="message-input"
                                        placeholder="Type your message..."
                                        rows="1"
                                        maxlength="1000"></textarea>
                                    <div class="input-footer">
                                        <div class="char-counter">
                                            <span id="charCount">0</span>/1000
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="send-btn" id="sendButton" disabled>
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
@endsection

@push('styles')
<style>
/* Professional Design Variables */
:root {
    --primary-color: #4f46e5;
    --primary-hover: #4338ca;
    --primary-light: #f0f4ff;
    --success-color: #059669;
    --success-hover: #047857;
    --success-light: #f0fdf9;
    --warning-color: #d97706;
    --warning-hover: #b45309;
    --warning-light: #fffbeb;
    --danger-color: #dc2626;
    --danger-hover: #b91c1c;
    --danger-light: #fef2f2;
    --info-color: #0891b2;
    --info-hover: #0e7490;
    --info-light: #f0f9ff;
    --secondary-color: #64748b;
    --secondary-hover: #475569;
    --secondary-light: #f8fafc;
    --background-primary: #f8fafc;
    --surface-elevated: #ffffff;
    --border-primary: #e2e8f0;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --shadow-elevated: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --shadow-floating: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
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

    /* Messaging specific colors */
    --message-bg-incoming: #ffffff;
    --message-bg-outgoing: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
    --contact-active-bg: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
}

* {
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
    background: var(--background-primary);
}

.professional-bg {
    background: linear-gradient(135deg, var(--background-primary) 0%, #f1f5f9 100%);
    min-height: 100vh;
    padding: var(--spacing-xl) 0;
}

/* Modern Breadcrumb */
.modern-breadcrumb {
    display: flex;
    align-items: center;
    background: var(--surface-elevated);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-subtle);
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

/* Professional Messaging Header */
.messaging-header-section {
    margin-bottom: var(--spacing-lg);
}

.messaging-header-card {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-subtle);
    border: 1px solid var(--border-primary);
    padding: var(--spacing-lg) var(--spacing-xl);
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--spacing-lg);
}

.messaging-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--info-color) 0%, var(--primary-color) 50%, var(--success-color) 100%);
}

.messaging-header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    flex: 1;
    min-width: 300px;
}

.messaging-header-icon {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, var(--info-color) 0%, var(--info-hover) 100%);
    border-radius: var(--border-radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.75rem;
    flex-shrink: 0;
    box-shadow: var(--shadow-medium);
}

.messaging-page-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
}

.messaging-page-subtitle {
    margin: 0;
    font-size: 0.9375rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

.messaging-header-actions {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    flex-shrink: 0;
}

.messaging-status {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

/* Mobile Breadcrumb */
.mobile-breadcrumb {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    padding: var(--spacing-md);
    box-shadow: var(--shadow-subtle);
    border: 1px solid var(--border-primary);
}

.btn-back {
    width: 44px;
    height: 44px;
    border: none;
    background: var(--secondary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    font-size: 1.25rem;
    transition: var(--transition-fast);
}

.btn-back:hover {
    background: var(--secondary-color);
    color: white;
    transform: translateX(-2px);
}

.current-page {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 1.125rem;
    line-height: 1.2;
}

.page-subtitle {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.125rem;
}

/* Enterprise Messaging Section */
.enterprise-messaging-section {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-elevated);
    border: 1px solid var(--border-primary);
    overflow: hidden;
    height: 700px;
    transition: var(--transition-medium);
}

.enterprise-messaging-section:hover {
    box-shadow: var(--shadow-floating);
}

.messaging-interface {
    display: flex;
    height: 100%;
}

/* Enhanced Contacts Sidebar */
.contacts-sidebar {
    width: 400px;
    border-right: 1px solid var(--border-primary);
    background: linear-gradient(135deg, #fafbff 0%, var(--secondary-light) 100%);
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
}

.sidebar-header {
    padding: var(--spacing-lg);
    border-bottom: 1px solid var(--border-primary);
    background: var(--surface-elevated);
}

.sidebar-header-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--spacing-md);
}

.sidebar-header-title i {
    color: var(--info-color);
    font-size: 1.25rem;
}

.search-container {
    margin-bottom: var(--spacing-md);
}

.search-wrapper {
    position: relative;
}

.search-icon {
    position: absolute;
    left: var(--spacing-sm);
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 1rem;
    z-index: 2;
}

.search-input {
    width: 100%;
    padding: var(--spacing-sm) var(--spacing-sm) var(--spacing-sm) 2.5rem;
    border: 2px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    background: var(--surface-elevated);
    transition: var(--transition-fast);
}

.search-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    outline: none;
}

.sidebar-tabs {
    display: flex;
    gap: var(--spacing-xs);
    background: var(--secondary-light);
    padding: 4px;
    border-radius: var(--border-radius-sm);
}

.tab-btn {
    flex: 1;
    padding: var(--spacing-sm) var(--spacing-md);
    border: none;
    background: transparent;
    color: var(--text-secondary);
    border-radius: var(--border-radius-sm);
    font-size: 0.8125rem;
    font-weight: 600;
    transition: var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-xs);
    position: relative;
}

.tab-btn.active {
    background: var(--surface-elevated);
    color: var(--primary-color);
    box-shadow: var(--shadow-subtle);
}

.tab-btn:hover:not(.active) {
    background: rgba(255, 255, 255, 0.5);
    color: var(--text-primary);
}

.unread-count {
    background: var(--danger-color);
    color: white;
    font-size: 0.625rem;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 10px;
    min-width: 18px;
    text-align: center;
}

/* Enhanced Contacts List */
.contacts-list {
    flex: 1;
    overflow-y: auto;
    padding: var(--spacing-sm);
}

.contact-item {
    display: flex;
    align-items: flex-start;
    padding: var(--spacing-md);
    border-radius: var(--border-radius-md);
    margin-bottom: var(--spacing-sm);
    cursor: pointer;
    transition: var(--transition-medium);
    background: var(--surface-elevated);
    border: 1px solid transparent;
    position: relative;
}

.contact-item:hover {
    background: #fafbff;
    border-color: rgba(79, 70, 229, 0.1);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.contact-item.active {
    background: var(--contact-active-bg);
    color: white;
    border-color: var(--primary-color);
    box-shadow: var(--shadow-elevated);
}

.contact-avatar {
    position: relative;
    margin-right: var(--spacing-md);
    flex-shrink: 0;
}

.contact-avatar img {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255, 255, 255, 0.9);
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
    background: var(--success-color);
    animation: pulse 2s infinite;
}

.status-indicator.away {
    background: var(--warning-color);
}

.status-indicator.offline {
    background: var(--secondary-color);
}

@keyframes pulse {
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

.priority-badge {
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
}

.priority-badge.high {
    background: var(--warning-color);
    color: white;
}

.contact-info {
    flex: 1;
    min-width: 0;
}

.contact-name {
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 0.125rem;
    line-height: 1.3;
}

.contact-role {
    font-size: 0.8125rem;
    opacity: 0.8;
    margin-bottom: var(--spacing-xs);
    line-height: 1.2;
}

.last-message {
    font-size: 0.875rem;
    opacity: 0.9;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-bottom: var(--spacing-xs);
    line-height: 1.3;
}

.message-meta-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.message-time {
    font-size: 0.75rem;
    opacity: 0.7;
    font-weight: 500;
}

.message-status {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.unread-badge {
    background: var(--danger-color);
    color: white;
    font-size: 0.6875rem;
    font-weight: 700;
    padding: 3px 7px;
    border-radius: 12px;
    min-width: 20px;
    text-align: center;
}

.contact-item.active .unread-badge {
    background: rgba(255, 255, 255, 0.25);
}

.contact-pin {
    font-size: 0.875rem;
    opacity: 0.7;
}

.contact-read {
    color: var(--success-color);
    font-size: 1rem;
}

.contact-sent {
    color: var(--text-muted);
    font-size: 1rem;
}

.contact-item.active .contact-read,
.contact-item.active .contact-sent,
.contact-item.active .contact-pin {
    color: white;
    opacity: 0.8;
}

/* Enhanced Chat Area */
.chat-area {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: var(--surface-elevated);
}

/* Professional Chat Header */
.chat-header {
    padding: var(--spacing-lg);
    border-bottom: 1px solid var(--border-primary);
    background: var(--surface-elevated);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-user-info {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
}

.chat-avatar {
    position: relative;
    flex-shrink: 0;
}

.chat-avatar img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--border-primary);
}

.chat-name {
    font-weight: 700;
    font-size: 1.125rem;
    margin-bottom: 0.125rem;
    color: var(--text-primary);
    line-height: 1.2;
}

.chat-status {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    font-size: 0.8125rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.chat-status i {
    font-size: 0.5rem;
    color: var(--success-color);
}

.chat-actions {
    display: flex;
    gap: var(--spacing-xs);
}

.chat-action-btn {
    width: 44px;
    height: 44px;
    border: none;
    background: var(--secondary-light);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    font-size: 1.125rem;
    transition: var(--transition-fast);
    cursor: pointer;
}

.chat-action-btn:hover {
    background: var(--primary-light);
    color: var(--primary-color);
    transform: translateY(-1px);
}

/* Enhanced Messages Container */
.messages-container {
    flex: 1;
    padding: var(--spacing-lg);
    overflow-y: auto;
    background: linear-gradient(135deg, #fafbff 0%, #f1f5f9 100%);
    position: relative;
}

.messages-container::-webkit-scrollbar {
    width: 6px;
}

.messages-container::-webkit-scrollbar-track {
    background: transparent;
}

.messages-container::-webkit-scrollbar-thumb {
    background: var(--border-primary);
    border-radius: 3px;
}

.messages-container::-webkit-scrollbar-thumb:hover {
    background: var(--text-muted);
}

/* Enhanced Date Separator */
.date-separator {
    display: flex;
    align-items: center;
    margin: var(--spacing-xl) 0;
    gap: var(--spacing-md);
}

.date-line {
    flex: 1;
    height: 1px;
    background: var(--border-primary);
}

.date-text {
    background: var(--surface-elevated);
    color: var(--text-muted);
    padding: var(--spacing-xs) var(--spacing-md);
    border-radius: var(--border-radius-sm);
    font-size: 0.8125rem;
    font-weight: 600;
    border: 1px solid var(--border-primary);
    white-space: nowrap;
}

/* Professional Message Bubbles */
.message-wrapper {
    display: flex;
    margin-bottom: var(--spacing-lg);
    animation: messageSlideIn 0.4s ease-out;
}

@keyframes messageSlideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message-wrapper.outgoing {
    flex-direction: row-reverse;
}

.message-avatar {
    flex-shrink: 0;
    margin: 0 var(--spacing-md);
}

.message-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
    box-shadow: var(--shadow-subtle);
}

.message-content {
    flex: 1;
    max-width: 75%;
}

.message-wrapper.outgoing .message-content {
    text-align: right;
}

.message-bubble {
    display: inline-block;
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: 20px;
    position: relative;
    margin-bottom: var(--spacing-xs);
    max-width: 100%;
    word-wrap: break-word;
    box-shadow: var(--shadow-medium);
}

.message-wrapper.incoming .message-bubble {
    background: var(--message-bg-incoming);
    border: 1px solid var(--border-primary);
    border-bottom-left-radius: 8px;
}

.message-wrapper.outgoing .message-bubble {
    background: var(--message-bg-outgoing);
    color: white;
    border-bottom-right-radius: 8px;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.message-text {
    font-size: 0.9375rem;
    line-height: 1.5;
    margin: 0;
}

.message-meta {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    font-size: 0.75rem;
    color: var(--text-muted);
    font-weight: 500;
}

.message-wrapper.outgoing .message-meta {
    justify-content: flex-end;
}

.message-sender {
    font-weight: 600;
}

.message-status {
    font-size: 0.875rem;
}

.message-status.delivered {
    color: var(--primary-color);
}

.message-status.sent {
    color: var(--text-muted);
}

/* Professional Typing Indicator */
.typing-indicator {
    display: flex;
    margin-bottom: var(--spacing-lg);
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.typing-content {
    flex: 1;
    max-width: 75%;
}

.typing-bubble {
    background: var(--surface-elevated);
    border: 1px solid var(--border-primary);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: 20px;
    border-bottom-left-radius: 8px;
    display: inline-block;
    margin-bottom: var(--spacing-xs);
    box-shadow: var(--shadow-subtle);
}

.typing-dots {
    display: flex;
    gap: 4px;
    align-items: center;
}

.typing-dots span {
    width: 8px;
    height: 8px;
    background: var(--text-muted);
    border-radius: 50%;
    animation: typingAnimation 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(1) { animation-delay: -0.32s; }
.typing-dots span:nth-child(2) { animation-delay: -0.16s; }

@keyframes typingAnimation {
    0%, 80%, 100% {
        transform: scale(0.8);
        opacity: 0.5;
    }
    40% {
        transform: scale(1.2);
        opacity: 1;
    }
}

.typing-text {
    font-size: 0.75rem;
    color: var(--text-muted);
    font-style: italic;
    font-weight: 500;
}

/* Enhanced Message Input */
.message-input-container {
    padding: var(--spacing-lg);
    background: var(--surface-elevated);
    border-top: 1px solid var(--border-primary);
}

.input-group-enhanced {
    display: flex;
    align-items: flex-end;
    gap: var(--spacing-sm);
    background: linear-gradient(135deg, #fafbff 0%, var(--secondary-light) 100%);
    border: 2px solid var(--border-primary);
    border-radius: var(--border-radius-md);
    padding: var(--spacing-sm);
    transition: var(--transition-fast);
}

.input-group-enhanced:focus-within {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.input-actions-left {
    display: flex;
    gap: var(--spacing-xs);
}

.action-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: transparent;
    color: var(--text-secondary);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.125rem;
    transition: var(--transition-fast);
    cursor: pointer;
}

.action-btn:hover {
    background: var(--primary-light);
    color: var(--primary-color);
}

.input-wrapper {
    flex: 1;
    position: relative;
}

.message-input {
    width: 100%;
    border: none;
    background: transparent;
    resize: none;
    font-size: 0.9375rem;
    line-height: 1.5;
    padding: var(--spacing-sm) 0;
    max-height: 120px;
    min-height: 44px;
    font-family: inherit;
    color: var(--text-primary);
}

.message-input:focus {
    outline: none;
}

.message-input::placeholder {
    color: var(--text-muted);
}

.input-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--spacing-xs);
}

.char-counter {
    font-size: 0.6875rem;
    color: var(--text-muted);
    font-weight: 500;
}

.quick-actions {
    display: flex;
    gap: var(--spacing-xs);
}

.quick-action {
    width: 24px;
    height: 24px;
    border: none;
    background: transparent;
    color: var(--text-muted);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    transition: var(--transition-fast);
    cursor: pointer;
}

.quick-action:hover {
    color: var(--primary-color);
}

.send-btn {
    width: 48px;
    height: 48px;
    border: none;
    background: var(--message-bg-outgoing);
    color: white;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    transition: var(--transition-fast);
    cursor: pointer;
    box-shadow: var(--shadow-medium);
}

.send-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, var(--primary-hover) 0%, #3730a3 100%);
    transform: translateY(-2px);
    box-shadow: var(--shadow-elevated);
}

.send-btn:disabled {
    background: var(--secondary-color);
    cursor: not-allowed;
    transform: none;
    box-shadow: var(--shadow-subtle);
}

/* Enterprise Button */
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

.btn-outline-primary {
    background: var(--surface-elevated);
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .messaging-interface {
        flex-direction: column;
    }

    .contacts-sidebar {
        width: 100%;
        height: 250px;
        border-right: none;
        border-bottom: 1px solid var(--border-primary);
    }

    .enterprise-messaging-section {
        height: 600px;
    }

    .messaging-header-card {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-md);
    }
}

@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }

    .contacts-sidebar {
        height: 200px;
    }

    .sidebar-header {
        padding: var(--spacing-md);
    }

    .contacts-list {
        padding: var(--spacing-xs);
    }

    .contact-item {
        padding: var(--spacing-sm);
    }

    .contact-avatar img {
        width: 48px;
        height: 48px;
    }

    .chat-header {
        padding: var(--spacing-md);
    }

    .messages-container {
        padding: var(--spacing-md);
    }

    .message-input-container {
        padding: var(--spacing-md);
    }

    .chat-actions {
        gap: var(--spacing-xs);
    }

    .chat-action-btn {
        width: 36px;
        height: 36px;
        font-size: 1rem;
    }

    .messaging-page-title {
        font-size: 1.25rem;
    }
}

@media (max-width: 480px) {
    .message-content {
        max-width: 90%;
    }

    .message-bubble {
        padding: var(--spacing-sm) var(--spacing-md);
        font-size: 0.875rem;
    }

    .contact-avatar img {
        width: 40px;
        height: 40px;
    }

    .message-avatar img {
        width: 32px;
        height: 32px;
    }

    .input-group-enhanced {
        padding: var(--spacing-xs);
    }

    .action-btn {
        width: 36px;
        height: 36px;
    }

    .send-btn {
        width: 44px;
        height: 44px;
    }

    .sidebar-tabs {
        flex-direction: column;
    }

    .tab-btn {
        justify-content: flex-start;
    }
}
</style>
@endpush

@push('scripts')
<script>
const adminId = 1; // Set your admin user id here

document.addEventListener('DOMContentLoaded', function() {
    initializeMessaging();
});

function initializeMessaging() {
    const chatForm = document.getElementById('chatForm');
    const chatInput = document.getElementById('chatInput');
    const chatMessages = document.getElementById('chatMessages');
    const charCount = document.getElementById('charCount');
    const sendButton = document.getElementById('sendButton');
    const messageInputContainer = document.getElementById('messageInputContainer');

    // Load default conversation (Admin Support)
    loadConversation('admin');

    // Contact switching
    document.querySelectorAll('.contact-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.contact-item').forEach(contact => contact.classList.remove('active'));
            this.classList.add('active');
            const contact = this.getAttribute('data-contact');
            loadConversation(contact);

            // Show/hide input based on contact
            if (contact === 'admin') {
                messageInputContainer.style.display = '';
            } else {
                messageInputContainer.style.display = 'none';
            }
        });
    });

    // Input events
    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        charCount.textContent = this.value.length;
        sendButton.disabled = this.value.trim().length === 0;
    });

    // Form submission
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (message) {
            sendMessage(message);
            chatInput.value = '';
            chatInput.style.height = 'auto';
            charCount.textContent = '0';
            sendButton.disabled = true;
        }
    });
}

function sendMessage(messageText) {
    const chatMessages = document.getElementById('chatMessages');
    const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

    // Append outgoing message immediately
    const messageWrapper = document.createElement('div');
    messageWrapper.className = 'message-wrapper outgoing';
    messageWrapper.innerHTML = `
        <div class="message-content">
            <div class="message-bubble">
                <div class="message-text">${escapeHtml(messageText)}</div>
            </div>
            <div class="message-meta">
                <span class="message-time">${currentTime}</span>
                <i class="bx bx-check message-status sent"></i>
            </div>
        </div>
        <div class="message-avatar">
            <img src="https://ui-avatars.com/api/?name=You&size=40&background=64748b&color=ffffff&bold=true" alt="You">
        </div>
    `;
    chatMessages.appendChild(messageWrapper);
    scrollToBottom();

    // Send to backend
    fetch("{{ route('company.messages.send') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            receiver_id: adminId,
            receiver_type: "admin",
            message: messageText
        })
    })
    .then(response => response.json())
    .then(data => {
        // Optionally update UI with delivery status
    })
    .catch(error => {
        alert("Failed to send message.");
    });
}

function loadConversation(contact) {
    const chatMessages = document.getElementById('chatMessages');
    chatMessages.innerHTML = `
        <div class="date-separator">
            <div class="date-line"></div>
            <span class="date-text">Today, {{ \Carbon\Carbon::now()->format('F d, Y') }}</span>
            <div class="date-line"></div>
        </div>
    `;

    // Example: Load from backend via AJAX if needed
    if (contact === 'admin') {
        // TODO: Fetch messages from backend via AJAX and render
        // For now, show a welcome message
        const welcome = document.createElement('div');
        welcome.className = 'message-wrapper incoming';
        welcome.innerHTML = `
            <div class="message-avatar">
                <img src="https://ui-avatars.com/api/?name=Admin+Support&size=40&background=6366f1&color=ffffff&bold=true" alt="Admin Support">
            </div>
            <div class="message-content">
                <div class="message-bubble">
                    <div class="message-text">Hello! How can I assist you today?</div>
                </div>
                <div class="message-meta">
                    <span class="message-sender">Admin Support</span>
                    <span class="message-time">09:00 AM</span>
                    <i class="bx bx-check-double message-status"></i>
                </div>
            </div>
        `;
        chatMessages.appendChild(welcome);
    } else if (contact === 'notifications') {
        // System notifications (no reply)
        const notification = document.createElement('div');
        notification.className = 'message-wrapper incoming';
        notification.innerHTML = `
            <div class="message-avatar">
                <img src="https://ui-avatars.com/api/?name=System+Notifications&size=40&background=8b5cf6&color=ffffff&bold=true" alt="System Notifications">
            </div>
            <div class="message-content">
                <div class="message-bubble">
                    <div class="message-text">New job matches available for your profile. We found 3 positions that match your qualifications and preferences.</div>
                </div>
                <div class="message-meta">
                    <span class="message-sender">System Notifications</span>
                    <span class="message-time">3 days ago</span>
                </div>
            </div>
        `;
        chatMessages.appendChild(notification);
    }
    scrollToBottom();
}

function scrollToBottom() {
    const chatMessages = document.getElementById('chatMessages');
    requestAnimationFrame(() => {
        chatMessages.scrollTo({
            top: chatMessages.scrollHeight,
            behavior: 'smooth'
        });
    });
}

function refreshMessages() {
    location.reload();
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
</script>
@endpush
