@extends('layouts.app')
@section('content')
<main class="page-content professional-bg">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">
            <i class="bx bx-message-square-dots me-2 text-primary"></i>Candidate
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 enhanced-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.dashboard') }}" class="breadcrumb-link">
                            <i class="bx bx-home-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-chat me-1"></i>Messages
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 messaging-container">
                <div class="messaging-card">
                    <!-- Sidebar -->
                    <div class="messaging-sidebar">
                        <div class="sidebar-header">
                            <h5 class="sidebar-title">
                                <i class="bx bx-message-square-detail me-2"></i>Messages
                            </h5>
                            <div class="online-indicator">
                                <i class="bx bx-circle text-success me-1"></i>
                                <small class="text-muted">Online</small>
                            </div>
                        </div>
                        
                        <!-- Admin Section (Always at Top) -->
                        <div class="admin-section">
                            <div class="section-header">
                                <div class="section-title">
                                    <i class="bx bx-shield-check me-2"></i>
                                    <span>Customer Support</span>
                                </div>
                            </div>
                            <div class="contact-item active admin-contact" data-contact-type="admin" data-contact-id="admin">
                                <div class="contact-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=6c757d&color=fff" alt="Admin">
                                    <div class="status-dot online"></div>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Customer Support</div>
                                    <div class="contact-status">
                                        <i class="bx bx-circle text-success me-1"></i>
                                        <small>Online</small>
                                    </div>
                                </div>
                                <div class="contact-meta">
                                    <small class="last-seen">10:05 AM</small>
                                    <div class="unread-badge">2</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Companies Section -->
                        <div class="companies-section">
                            <div class="section-header">
                                <div class="section-title">
                                    <i class="bx bx-buildings me-2"></i>
                                    <span>Companies</span>
                                </div>
                                <small class="section-count">3 active</small>
                            </div>
                            <div class="contacts-list">
                                <!-- Company 1 -->
                                <div class="contact-item company-contact" data-contact-type="company" data-contact-id="mas_ship">
                                    <div class="contact-avatar">
                                        <img src="{{ asset('theme/assets/images/products/28.png') }}" alt="MAS Ship Management">
                                        <div class="status-dot online"></div>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-name">MAS Ship Management</div>
                                        <div class="contact-status">
                                            <i class="bx bx-circle text-success me-1"></i>
                                            <small>Online</small>
                                        </div>
                                        <div class="last-message">Thank you for your application...</div>
                                    </div>
                                    <div class="contact-meta">
                                        <small class="last-seen">9:45 AM</small>
                                        <div class="unread-badge">1</div>
                                    </div>
                                </div>
                                
                                <!-- Company 2 -->
                                <div class="contact-item company-contact" data-contact-type="company" data-contact-id="oceanic_crew">
                                    <div class="contact-avatar">
                                        <img src="{{ asset('theme/assets/images/products/100.jpg') }}" alt="Oceanic Crew Management">
                                        <div class="status-dot offline"></div>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-name">Oceanic Crew Management</div>
                                        <div class="contact-status">
                                            <i class="bx bx-circle text-muted me-1"></i>
                                            <small>Last seen 2 hours ago</small>
                                        </div>
                                        <div class="last-message">We would like to interview you...</div>
                                    </div>
                                    <div class="contact-meta">
                                        <small class="last-seen">Yesterday</small>
                                    </div>
                                </div>
                                
                                <!-- Company 3 -->
                                <div class="contact-item company-contact" data-contact-type="company" data-contact-id="global_maritime">
                                    <div class="contact-avatar">
                                        <img src="{{ asset('theme/assets/images/products/download.png') }}" alt="Global Maritime Services">
                                        <div class="status-dot online"></div>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-name">Global Maritime Services</div>
                                        <div class="contact-status">
                                            <i class="bx bx-circle text-success me-1"></i>
                                            <small>Online</small>
                                        </div>
                                        <div class="last-message">Your profile matches our requirements</div>
                                    </div>
                                    <div class="contact-meta">
                                        <small class="last-seen">2 days ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chat Area -->
                    <div class="chat-area">                       
                        <div class="chat-messages" id="chatMessages">
                            <!-- Admin messages (default) -->
                            <div class="message-group admin-messages">
                                <div class="message incoming">
                                    <div class="message-avatar">
                                        <img src="https://ui-avatars.com/api/?name=Admin&background=6c757d&color=fff" alt="Admin">
                                    </div>
                                    <div class="message-content">
                                        <div class="message-bubble">
                                            Hello! How can I assist you today?
                                        </div>
                                        <div class="message-time">Customer Support • 10:01 AM</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="message-group outgoing">
                                <div class="message outgoing">
                                    <div class="message-content">
                                        <div class="message-bubble">
                                            Hi Admin, I need help with my profile.
                                        </div>
                                        <div class="message-time">You • 10:02 AM</div>
                                    </div>
                                    <div class="message-avatar">
                                        <img src="https://ui-avatars.com/api/?name=You&background=0d6efd&color=fff" alt="You">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- MAS Ship Management messages (hidden by default) -->
                            <div class="message-group company-messages" data-company="mas_ship" style="display: none;">
                                <div class="message incoming">
                                    <div class="message-avatar">
                                        <img src="{{ asset('theme/assets/images/products/28.png') }}" alt="MAS Ship">
                                    </div>
                                    <div class="message-content">
                                        <div class="message-bubble">
                                            Thank you for applying to our 2nd Officer position. We are impressed with your qualifications.
                                        </div>
                                        <div class="message-time">MAS Ship Management • 9:45 AM</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Oceanic Crew messages (hidden by default) -->
                            <div class="message-group company-messages" data-company="oceanic_crew" style="display: none;">
                                <div class="message incoming">
                                    <div class="message-avatar">
                                        <img src="{{ asset('theme/assets/images/products/100.jpg') }}" alt="Oceanic Crew">
                                    </div>
                                    <div class="message-content">
                                        <div class="message-bubble">
                                            We would like to schedule an interview with you for the Chief Engineer position. Are you available next week?
                                        </div>
                                        <div class="message-time">Oceanic Crew Management • Yesterday</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Global Maritime messages (hidden by default) -->
                            <div class="message-group company-messages" data-company="global_maritime" style="display: none;">
                                <div class="message incoming">
                                    <div class="message-avatar">
                                        <img src="{{ asset('theme/assets/images/products/download.png') }}" alt="Global Maritime">
                                    </div>
                                    <div class="message-content">
                                        <div class="message-bubble">
                                            Your profile matches our requirements perfectly. We have an immediate opening for Master position.
                                        </div>
                                        <div class="message-time">Global Maritime Services • 2 days ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="chat-input-area">
                            <form id="chatForm" autocomplete="off">
                                <div class="input-wrapper">
                                    <div class="input-actions">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Attach file">
                                            <i class="bx bx-paperclip"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Emoji">
                                            <i class="bx bx-smile"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control chat-input" id="chatInput" placeholder="Type your message..." required>
                                    <button class="btn btn-primary send-btn" type="submit">
                                        <i class="bx bx-send"></i>
                                    </button>
                                </div>
                            </form>
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
    
    .breadcrumb-link {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }
    
    .breadcrumb-link:hover {
        color: #3730a3;
        transform: translateX(2px);
    }
    
    .breadcrumb-title {
        font-weight: 600;
        color: #374151;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }
    
    .breadcrumb-item.active {
        color: #6b7280;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    
    /* Messaging Container */
    .messaging-container {
        max-width: 1200px;
    }
    
    .messaging-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        display: flex;
        min-height: 700px;
        border: 1px solid #e5e7eb;
    }
    
    /* Messaging Sidebar */
    .messaging-sidebar {
        width: 350px;
        background: #f9fafb;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
    }
    
    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #ffffff;
    }
    
    .sidebar-title {
        margin: 0;
        color: #111827;
        font-weight: 600;
        font-size: 1.15rem;
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .online-indicator {
        display: flex;
        align-items: center;
        color: #6b7280;
    }
    
    /* Admin Section (Always at Top) */
    .admin-section {
        background: #ffffff;
        border-bottom: 2px solid #e5e7eb;
        flex-shrink: 0;
    }
    
    .admin-section .contact-item {
        background: #f8fafc;
        border-left: 4px solid #6366f1;
    }
    
    .admin-section .contact-item.active {
        background: #eff6ff;
        border-left: 4px solid #3b82f6;
    }
    
    /* Companies Section */
    .companies-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    .section-header {
        padding: 16px 20px 12px;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        color: #374151;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .section-count {
        color: #6b7280;
        font-size: 0.8rem;
        background: #e5e7eb;
        padding: 2px 8px;
        border-radius: 10px;
    }
    
    .contacts-list {
        flex: 1;
        overflow-y: auto;
        padding: 10px 0;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        background: transparent;
        position: relative;
    }
    
    .contact-item:hover {
        background: #f3f4f6;
    }
    
    .contact-item.active {
        background: #eff6ff;
        border-right: 3px solid #3b82f6;
    }
    
    .contact-avatar {
        position: relative;
        margin-right: 12px;
        flex-shrink: 0;
    }
    
    .contact-avatar img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 2px solid #e5e7eb;
        object-fit: cover;
    }
    
    .status-dot {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid #ffffff;
    }
    
    .status-dot.online {
        background: #10b981;
    }
    
    .status-dot.offline {
        background: #9ca3af;
    }
    
    .contact-info {
        flex: 1;
        min-width: 0;
    }
    
    .contact-name {
        font-weight: 600;
        color: #111827;
        font-size: 0.95rem;
        margin-bottom: 4px;
    }
    
    .contact-status {
        display: flex;
        align-items: center;
        color: #6b7280;
        font-size: 0.85rem;
        margin-bottom: 4px;
    }
    
    .last-message {
        color: #9ca3af;
        font-size: 0.8rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 180px;
    }
    
    .contact-meta {
        text-align: right;
        color: #9ca3af;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 4px;
    }
    
    .last-seen {
        font-size: 0.8rem;
    }
    
    .unread-badge {
        background: #ef4444;
        color: #ffffff;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }
    
    /* Chat Area */
    .chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #ffffff;
    }
    
    .chat-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .chat-user-info {
        display: flex;
        align-items: center;
    }
    
    .chat-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        margin-right: 12px;
        border: 2px solid #e5e7eb;
        object-fit: cover;
    }
    
    .chat-user-name {
        font-weight: 600;
        color: #111827;
        font-size: 1rem;
        margin-bottom: 2px;
    }
    
    .chat-user-status {
        display: flex;
        align-items: center;
        color: #6b7280;
        font-size: 0.85rem;
    }
    
    .chat-actions {
        display: flex;
        gap: 8px;
    }
    
    .chat-actions .btn {
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    
    /* Chat Messages */
    .chat-messages {
        flex: 1;
        padding: 20px;
        background: #fafafa;
        overflow-y: auto;
        scroll-behavior: smooth;
    }
    
    .message-group {
        margin-bottom: 20px;
    }
    
    .message {
        display: flex;
        align-items: flex-end;
        margin-bottom: 4px;
    }
    
    .message.incoming {
        justify-content: flex-start;
    }
    
    .message.outgoing {
        justify-content: flex-end;
    }
    
    .message-group.outgoing {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    
    .message-avatar img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
        object-fit: cover;
    }
    
    .message-content {
        max-width: 70%;
    }
    
    .message.incoming .message-content {
        margin-left: 8px;
    }
    
    .message.outgoing .message-content {
        margin-right: 8px;
    }
    
    .message-bubble {
        padding: 12px 16px;
        border-radius: 18px;
        font-size: 0.95rem;
        line-height: 1.4;
        word-wrap: break-word;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
    }
    
    .message.incoming .message-bubble {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #374151;
        border-bottom-left-radius: 6px;
    }
    
    .message.outgoing .message-bubble {
        background: #3b82f6;
        color: #ffffff;
        border-bottom-right-radius: 6px;
    }
    
    .message-time {
        margin-top: 4px;
        font-size: 0.75rem;
        color: #9ca3af;
    }
    
    .message.outgoing .message-time {
        text-align: right;
    }
    
    /* Chat Input */
    .chat-input-area {
        padding: 20px;
        border-top: 1px solid #e5e7eb;
        background: #ffffff;
    }
    
    .input-wrapper {
        display: flex;
        align-items: center;
        background: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 24px;
        padding: 4px;
        transition: all 0.3s ease;
    }
    
    .input-wrapper:focus-within {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .input-actions {
        margin-left: 8px;
        display: flex;
        gap: 4px;
    }
    
    .input-actions .btn {
        border: none;
        color: #6b7280;
        background: transparent;
        padding: 6px;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .input-actions .btn:hover {
        color: #374151;
        background: #f3f4f6;
    }
    
    .chat-input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 12px 16px;
        font-size: 0.95rem;
        outline: none;
        box-shadow: none;
    }
    
    .chat-input::placeholder {
        color: #9ca3af;
    }
    
    .send-btn {
        margin-right: 4px;
        border-radius: 20px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #3b82f6;
        color: #ffffff;
        transition: all 0.3s ease;
        padding: 0;
    }
    
    .send-btn:hover {
        background: #2563eb;
        transform: scale(1.05);
    }
    
    .send-btn:disabled {
        background: #9ca3af;
        cursor: not-allowed;
        transform: none;
    }
    
    /* Scrollbar */
    .contacts-list::-webkit-scrollbar,
    .chat-messages::-webkit-scrollbar {
        width: 6px;
    }
    
    .contacts-list::-webkit-scrollbar-track,
    .chat-messages::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .contacts-list::-webkit-scrollbar-thumb,
    .chat-messages::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }
    
    .contacts-list::-webkit-scrollbar-thumb:hover,
    .chat-messages::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .messaging-card {
            flex-direction: column;
            min-height: 600px;
        }
        
        .messaging-sidebar {
            width: 100%;
            max-height: 250px;
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .companies-section {
            max-height: 180px;
        }
        
        .contacts-list {
            max-height: 120px;
        }
        
        .chat-messages {
            padding: 15px;
        }
        
        .message-content {
            max-width: 85%;
        }
        
        .chat-input-area {
            padding: 15px;
        }
        
        .breadcrumb-title {
            font-size: 1rem;
        }
        
        .enhanced-breadcrumb {
            padding: 12px 16px;
        }
        
        .chat-actions {
            display: none;
        }
    }
    
    /* Animation for new messages */
    @keyframes messageSlideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .message-group.new {
        animation: messageSlideIn 0.3s ease-out;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const chatForm = document.getElementById('chatForm');
    const chatInput = document.getElementById('chatInput');
    const chatMessages = document.getElementById('chatMessages');
    const sendBtn = document.querySelector('.send-btn');
    const chatAvatar = document.getElementById('chatAvatar');
    const chatUserName = document.getElementById('chatUserName');
    const chatUserStatus = document.getElementById('chatUserStatus');
    
    let currentContact = {
        type: 'admin',
        id: 'admin',
        name: 'Customer Support',
        avatar: 'https://ui-avatars.com/api/?name=Admin&background=6c757d&color=fff',
        status: 'Online'
    };
    
    // Contact data
    const contacts = {
        admin: {
            name: 'Customer Support',
            avatar: 'https://ui-avatars.com/api/?name=Admin&background=6c757d&color=fff',
            status: 'Online',
            statusIcon: 'bx-circle text-success'
        },
        mas_ship: {
            name: 'MAS Ship Management',
            avatar: '{{ asset("theme/assets/images/products/28.png") }}',
            status: 'Online',
            statusIcon: 'bx-circle text-success'
        },
        oceanic_crew: {
            name: 'Oceanic Crew Management',
            avatar: '{{ asset("theme/assets/images/products/100.jpg") }}',
            status: 'Last seen 2 hours ago',
            statusIcon: 'bx-circle text-muted'
        },
        global_maritime: {
            name: 'Global Maritime Services',
            avatar: '{{ asset("theme/assets/images/products/download.png") }}',
            status: 'Online',
            statusIcon: 'bx-circle text-success'
        }
    };
    
    // Handle contact switching
    function switchContact(contactType, contactId) {
        // Remove active class from all contacts
        document.querySelectorAll('.contact-item').forEach(item => {
            item.classList.remove('active');
        });
        
        // Add active class to selected contact
        const selectedContact = document.querySelector(`[data-contact-id="${contactId}"]`);
        if (selectedContact) {
            selectedContact.classList.add('active');
        }
        
        // Update current contact
        currentContact = {
            type: contactType,
            id: contactId,
            ...contacts[contactId]
        };
        
        // Update chat header
        updateChatHeader();
        
        // Show appropriate messages
        showMessagesForContact(contactType, contactId);
        
        // Remove unread badge
        const unreadBadge = selectedContact?.querySelector('.unread-badge');
        if (unreadBadge) {
            unreadBadge.remove();
        }
    }
    
    // Update chat header
    function updateChatHeader() {
        chatAvatar.src = currentContact.avatar;
        chatUserName.textContent = currentContact.name;
        chatUserStatus.innerHTML = `
            <i class="${currentContact.statusIcon} me-1"></i>
            <span>${currentContact.status}</span>
        `;
    }
    
    // Show messages for specific contact
    function showMessagesForContact(contactType, contactId) {
        // Hide all message groups
        document.querySelectorAll('.message-group').forEach(group => {
            if (group.classList.contains('admin-messages')) {
                group.style.display = contactType === 'admin' ? 'block' : 'none';
            } else if (group.classList.contains('company-messages')) {
                const companyId = group.getAttribute('data-company');
                group.style.display = (contactType === 'company' && companyId === contactId) ? 'block' : 'none';
            } else if (group.classList.contains('outgoing')) {
                // Show user messages for current contact
                group.style.display = 'block';
            }
        });
        
        scrollToBottom();
    }
    
    // Auto-scroll to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Create message element
    function createMessage(content, isOutgoing = false, time = 'Now') {
        const messageGroup = document.createElement('div');
        messageGroup.className = `message-group new ${isOutgoing ? 'outgoing' : ''}`;
        
        const avatarUrl = isOutgoing 
            ? 'https://ui-avatars.com/api/?name=You&background=0d6efd&color=fff'
            : currentContact.avatar;
        
        const avatarAlt = isOutgoing ? 'You' : currentContact.name;
        const sender = isOutgoing ? 'You' : currentContact.name;
        
        messageGroup.innerHTML = `
            <div class="message ${isOutgoing ? 'outgoing' : 'incoming'}">
                ${!isOutgoing ? `<div class="message-avatar"><img src="${avatarUrl}" alt="${avatarAlt}"></div>` : ''}
                <div class="message-content">
                    <div class="message-bubble">${content}</div>
                    <div class="message-time">${sender} • ${time}</div>
                </div>
                ${isOutgoing ? `<div class="message-avatar"><img src="${avatarUrl}" alt="${avatarAlt}"></div>` : ''}
            </div>
        `;
        
        return messageGroup;
    }
    
    // Show typing indicator
    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.id = 'typing-indicator';
        typingDiv.className = 'typing-indicator';
        typingDiv.innerHTML = `
            ${currentContact.name} is typing
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        `;
        chatMessages.appendChild(typingDiv);
        scrollToBottom();
    }
    
    // Remove typing indicator
    function removeTypingIndicator() {
        const typing = document.getElementById('typing-indicator');
        if (typing) {
            typing.remove();
        }
    }
    
    // Handle form submission
    chatForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const msg = chatInput.value.trim();
        
        if (msg) {
            // Disable send button temporarily
            sendBtn.disabled = true;
            
            // Add user message
            const userMessage = createMessage(msg, true);
            chatMessages.appendChild(userMessage);
            chatInput.value = '';
            scrollToBottom();
            
            // Show typing indicator after a short delay
            setTimeout(() => {
                showTypingIndicator();
                
                // Simulate reply
                setTimeout(() => {
                    removeTypingIndicator();
                    let replyText = 'Thank you for your message. Our team will get back to you shortly.';
                    
                    if (currentContact.type === 'company') {
                        replyText = 'Thank you for your interest. We will review your message and respond accordingly.';
                    }
                    
                    const replyMessage = createMessage(replyText, false);
                    chatMessages.appendChild(replyMessage);
                    scrollToBottom();
                    sendBtn.disabled = false;
                    chatInput.focus();
                }, 2000);
            }, 500);
        }
    });
    
    // Handle contact item clicks
    document.addEventListener('click', function(e) {
        const contactItem = e.target.closest('.contact-item');
        if (contactItem) {
            const contactType = contactItem.getAttribute('data-contact-type');
            const contactId = contactItem.getAttribute('data-contact-id');
            switchContact(contactType, contactId);
        }
    });
    
    // Handle Enter key
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });
    
    // Initial setup
    scrollToBottom();
    chatInput.focus();
    updateChatHeader();
});
</script>
@endsection
