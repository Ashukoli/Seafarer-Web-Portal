# SeafarerJobs Database Table Structures

## 1. Users Table (Main Authentication)
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_type ENUM('super_admin', 'sub_admin', 'executive', 'company_superadmin', 'company_subadmin', 'candidate') NOT NULL,
    username VARCHAR(255) UNIQUE NULL COMMENT 'Only for admin users',
    email VARCHAR(255) UNIQUE NULL COMMENT 'For candidates and company users',
    mobile_country_code VARCHAR(5) NULL COMMENT 'Country code like +91, +1, etc.',
    mobile VARCHAR(20) UNIQUE NULL COMMENT 'For company users and candidates, null for admin users',
    password VARCHAR(255) NULL COMMENT 'Hashed - only for admin users and candidates',
    full_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NULL COMMENT 'Only for admin users since their mobile is null',
    otp VARCHAR(10) NULL COMMENT 'For OTP-based logins',
    otp_expires_at TIMESTAMP NULL COMMENT 'OTP expiration time',
    email_login_allowed BOOLEAN DEFAULT FALSE COMMENT 'For company_subadmin email login permission',
    role_id BIGINT UNSIGNED NULL COMMENT 'Foreign Key for sub_admin/executive/company_subadmin users',
    created_by BIGINT UNSIGNED NULL COMMENT 'Foreign Key - who created them',
    email_verified_at TIMESTAMP NULL,
    mobile_verified_at TIMESTAMP NULL,
    status ENUM('active', 'inactive', 'suspended', 'pending') DEFAULT 'pending',
    last_login_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_user_type (user_type),
    INDEX idx_email (email),
    INDEX idx_mobile (mobile),
    INDEX idx_username (username),
    INDEX idx_status (status)
);
```

## 2. Roles Table (For Admin & Company Users)
```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL COMMENT 'Candidate Manager, Company Manager, HR Manager, Recruiter, etc.',
    description TEXT NULL,
    role_type ENUM('admin', 'company') NOT NULL COMMENT 'To distinguish between admin roles and company roles',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    UNIQUE KEY unique_role_name_type (name, role_type),
    INDEX idx_role_type (role_type),
    INDEX idx_is_active (is_active)
);
```

## 3. Permissions Table
```sql
CREATE TABLE permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL COMMENT 'candidates.view, jobs.add, resumes.download, etc.',
    description TEXT NULL,
    module VARCHAR(100) NOT NULL COMMENT 'candidates, companies, jobs, banners, resumes, etc.',
    permission_type ENUM('admin', 'company') NOT NULL COMMENT 'To distinguish admin vs company permissions',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    UNIQUE KEY unique_permission_name_type (name, permission_type),
    INDEX idx_module (module),
    INDEX idx_permission_type (permission_type)
);
```

## 4. Role Permissions Table (Mapping)
```sql
CREATE TABLE role_permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role_id BIGINT UNSIGNED NOT NULL,
    permission_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_role_permission (role_id, permission_id),
    INDEX idx_role_id (role_id),
    INDEX idx_permission_id (permission_id)
);
```

## 5. Company Login Logs Table
```sql
CREATE TABLE company_login_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    login_type ENUM('mobile_otp', 'email_otp') NOT NULL,
    ip_address VARCHAR(45) NOT NULL COMMENT 'Supports IPv4 and IPv6',
    login_time TIMESTAMP NOT NULL,
    logout_time TIMESTAMP NULL,
    session_duration INT NULL COMMENT 'In minutes',
    browser_info TEXT NULL COMMENT 'User agent string',
    device_info VARCHAR(255) NULL,
    location VARCHAR(255) NULL COMMENT 'Based on IP geolocation',
    status ENUM('success', 'failed', 'logout') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_user_id (user_id),
    INDEX idx_login_time (login_time),
    INDEX idx_ip_address (ip_address),
    INDEX idx_status (status)
);
```

## 6. Admin Login Logs Table
```sql
CREATE TABLE admin_login_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    username VARCHAR(255) NOT NULL COMMENT 'For tracking purposes',
    ip_address VARCHAR(45) NOT NULL COMMENT 'Supports IPv4 and IPv6',
    login_time TIMESTAMP NOT NULL,
    logout_time TIMESTAMP NULL,
    session_duration INT NULL COMMENT 'In minutes',
    browser_info TEXT NULL COMMENT 'User agent string',
    device_info VARCHAR(255) NULL,
    location VARCHAR(255) NULL COMMENT 'Based on IP geolocation',
    status ENUM('success', 'failed', 'logout') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_user_id (user_id),
    INDEX idx_username (username),
    INDEX idx_login_time (login_time),
    INDEX idx_ip_address (ip_address),
    INDEX idx_status (status)
);
```

## 7. Security Notifications Table (For Super Admin)
```sql
CREATE TABLE security_notifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL COMMENT 'The user who triggered the notification',
    notification_type ENUM('suspicious_login', 'multiple_failed_attempts', 'unusual_location', 'concurrent_sessions', 'account_lockout') NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    severity ENUM('low', 'medium', 'high') DEFAULT 'medium',
    ip_address VARCHAR(45) NULL,
    additional_data JSON NULL COMMENT 'For storing extra details',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_user_id (user_id),
    INDEX idx_notification_type (notification_type),
    INDEX idx_is_read (is_read),
    INDEX idx_severity (severity),
    INDEX idx_created_at (created_at)
);
```

# CANDIDATE MODULE TABLES

## 8. Candidates Table (Main candidate profile)
```sql
CREATE TABLE candidates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to users table',
    candidate_id VARCHAR(20) UNIQUE NOT NULL COMMENT 'Generated candidate ID like SJ00',
    
    -- Personal Details (Form 1)
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    marital_status ENUM('single', 'married', 'divorced', 'widowed') NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    whatsapp_country_code VARCHAR(5) NULL COMMENT 'Country code like +91, +1, etc.',
    whatsapp_number VARCHAR(20) NULL,
    same_as_mobile BOOLEAN DEFAULT FALSE,
    
    -- Profile Status
    registration_step TINYINT DEFAULT 1 COMMENT '1-7 for registration forms completion',    
    validation_notes TEXT NULL COMMENT 'Admin notes during validation',
    validated_by BIGINT UNSIGNED NULL COMMENT 'Admin user who validated',
    validated_at TIMESTAMP NULL,
    
    -- Resume Management
    resume_status ENUM('Pending', 'Incomplete', 'Validated', 'Inactive') DEFAULT 'Pending' COMMENT 'Resume validation status',
    profile_picture VARCHAR(255) NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (validated_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_user_id (user_id),
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_profile_status (profile_status),
    INDEX idx_registration_step (registration_step),
    INDEX idx_nationality (nationality),
    INDEX idx_state (state),
    INDEX idx_city (city)
);
```

## 9. Candidate Documents Table (Form 2 - Passport & Seaman Book)
```sql
CREATE TABLE candidate_documents (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    
    -- Passport Details
    passport_nationality VARCHAR(100) NULL,
    passport_number VARCHAR(50) NULL,
    passport_expiry_date DATE NULL,
    
    -- CDC Details
    cdc_type VARCHAR(100) NULL,
    cdc_number VARCHAR(50) NULL,
    cdc_expiry_date DATE NULL,
    
    -- Visa Details
    us_visa_type VARCHAR(100) NULL,
    indos_number VARCHAR(50) NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    INDEX idx_candidate_id (candidate_id)
);
```

## 10. Candidate Certificates Table (Form 3 - Pre Sea & COC/COP)
```sql
CREATE TABLE candidate_certificates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    
    -- Pre Sea Training
    pre_sea_training_type VARCHAR(100) NULL,
    pre_sea_training_date DATE NULL,
    
    -- COC/COP Details
    coc_cop_details VARCHAR(100) NULL,
    coc_number VARCHAR(50) NULL,
    grade VARCHAR(50) NULL,
    coc_cop_expiry_date DATE NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    INDEX idx_candidate_id (candidate_id)
);
```

## 11. Candidate Endorsements Table (Form 4 - GMDSS & DCE)
```sql
CREATE TABLE candidate_endorsements (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    endorsement_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to endorsement_master',
    validity_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (endorsement_id) REFERENCES endorsement_master(id) ON DELETE RESTRICT,
    
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_endorsement_id (endorsement_id),
    INDEX idx_validity_date (validity_date)
);
```

## 12. Candidate Courses Table (Form 5 - Valid Courses)
```sql
CREATE TABLE candidate_courses (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    course_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to course_master',
    completion_date DATE NULL,
    certificate_number VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES course_master(id) ON DELETE RESTRICT,
    
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_course_id (course_id),
    INDEX idx_completion_date (completion_date)
);
```

## 13. Candidate Sea Service Table (Form 6 - Sea Service Details)
```sql
CREATE TABLE candidate_sea_service (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    rank_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to rank_master',
    company_shipname VARCHAR(255) NOT NULL,
    ship_type_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to ship_type_master',
    engine_type VARCHAR(100) NULL,
    tonnage INT NULL,
    tonnage_unit VARCHAR(10) DEFAULT 'GRT',
    bhp INT NULL,
    sign_on_date DATE NOT NULL,
    sign_off_date DATE NOT NULL,
    duration_calculated VARCHAR(20) NULL COMMENT 'Auto-calculated like "7m 28d"',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (rank_id) REFERENCES rank_master(id) ON DELETE RESTRICT,
    FOREIGN KEY (ship_type_id) REFERENCES ship_type_master(id) ON DELETE RESTRICT,
    
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_rank_id (rank_id),
    INDEX idx_ship_type_id (ship_type_id),
    INDEX idx_sign_on_date (sign_on_date)
);
```

## 14. Candidate Experience Table (Form 7 - Profile & Total Experience)
```sql
CREATE TABLE candidate_experience (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    present_rank_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to rank_master',
    rank_experience_years TINYINT DEFAULT 0,
    rank_experience_months TINYINT DEFAULT 0,
    post_rank_id BIGINT UNSIGNED NULL COMMENT 'Foreign Key to rank_master',
    available_from_date DATE NULL,
    additional_info TEXT NULL COMMENT 'Last/expected salary, additional qualifications, etc.',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (present_rank_id) REFERENCES rank_master(id) ON DELETE RESTRICT,
    FOREIGN KEY (post_rank_id) REFERENCES rank_master(id) ON DELETE SET NULL,
    
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_present_rank_id (present_rank_id),
    INDEX idx_post_rank_id (post_rank_id),
    INDEX idx_available_from_date (available_from_date)
);
```

## 15. Candidate Login Logs Table
```sql
CREATE TABLE candidate_login_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    login_time TIMESTAMP NOT NULL,
    logout_time TIMESTAMP NULL,
    session_duration INT NULL COMMENT 'In minutes',
    browser_info TEXT NULL,
    device_info VARCHAR(255) NULL,
    pages_visited TEXT NULL COMMENT 'JSON array of pages visited during session',
    actions_performed TEXT NULL COMMENT 'JSON array of actions performed',
    last_activity_time TIMESTAMP NULL,
    status ENUM('active', 'logout', 'timeout') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_user_id (user_id),
    INDEX idx_login_time (login_time),
    INDEX idx_status (status),
    INDEX idx_last_activity_time (last_activity_time)
);
```

## 16. Candidate Follow-ups Table (Admin management)
```sql
CREATE TABLE candidate_followups (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    executive_id BIGINT UNSIGNED NOT NULL COMMENT 'Admin user handling follow-up',
    followup_date TIMESTAMP NOT NULL,
    next_followup_date TIMESTAMP NULL,
    notes TEXT NOT NULL,
    status ENUM('completed', 'pending', 'scheduled', 'cancelled') DEFAULT 'pending',
    outcome TEXT NULL COMMENT 'Result of the follow-up',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (executive_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_executive_id (executive_id),
    INDEX idx_followup_date (followup_date),
    INDEX idx_next_followup_date (next_followup_date),
    INDEX idx_status (status)
);
```

## 17. Candidate Reports Table (Company reports against candidates)
```sql
CREATE TABLE candidate_reports (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    reported_by_company_id BIGINT UNSIGNED NOT NULL COMMENT 'Company user who reported',
    report_description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (reported_by_company_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_reported_by_company_id (reported_by_company_id),
    INDEX idx_created_at (created_at)
);
```

## 18. Candidate Profile Deletion Requests Table
```sql
CREATE TABLE candidate_deletion_requests (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    deletion_reason TEXT NULL COMMENT 'Optional reason provided by candidate',
    request_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    admin_notes TEXT NULL COMMENT 'Admin decision notes',
    processed_by BIGINT UNSIGNED NULL COMMENT 'Admin user who processed the request',
    processed_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (processed_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_request_status (request_status),
    INDEX idx_created_at (created_at)
);
```

## 19. Candidate Hidden Companies Table (Hide resume from specific companies)
```sql
CREATE TABLE candidate_hidden_companies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    company_id BIGINT UNSIGNED NOT NULL COMMENT 'Company to hide resume from',
    hidden_type ENUM('manual', 'reported') NOT NULL COMMENT 'manual=candidate chose to hide, reported=auto-hidden due to company report',
    hidden_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (company_id) REFERENCES users(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_candidate_company (candidate_id, company_id),
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_company_id (company_id),
    INDEX idx_hidden_type (hidden_type)
);
```

**Business Logic for Candidate Hidden Companies:**
- **Manual Limit**: Candidates can manually hide their resume from maximum 5 companies
- **Report Override**: When a company reports a candidate, it bypasses the 5-company limit (hidden_type='reported')
- **Priority**: Company reports take precedence over manual hiding limits
- **UI Logic**: 
  - Count only `hidden_type='manual'` entries for the 5-company limit
  - Always allow `hidden_type='reported'` entries regardless of count
  - If candidate tries to manually hide from 6th company, show error
  - If candidate at 5-company limit gets reported, still auto-hide (total becomes 6+)
  
## 20. Express Service Purchases Table (Candidate premium services)
```sql
CREATE TABLE express_service_purchases (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    package_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to express_service_packages',
    purchase_amount DECIMAL(10,2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'INR',
    payment_method VARCHAR(50) NULL,
    transaction_id VARCHAR(100) NULL,
    receipt_number VARCHAR(50) UNIQUE NOT NULL,
    
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    start_date TIMESTAMP NOT NULL,
    expiry_date TIMESTAMP NOT NULL,
    
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    service_status ENUM('pending_validation', 'active', 'expired', 'cancelled') DEFAULT 'pending_validation',
    
    validated_by BIGINT UNSIGNED NULL COMMENT 'Admin who validated the service',
    validated_at TIMESTAMP NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (package_id) REFERENCES express_service_packages(id) ON DELETE RESTRICT,
    FOREIGN KEY (validated_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_package_id (package_id),
    INDEX idx_payment_status (payment_status),
    INDEX idx_service_status (service_status),
    INDEX idx_expiry_date (expiry_date),
    INDEX idx_receipt_number (receipt_number)
);
```

## 21. Express Service Refund Requests Table
```sql
CREATE TABLE express_service_refunds (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    purchase_id BIGINT UNSIGNED NOT NULL COMMENT 'Reference to express_service_purchases',
    candidate_id BIGINT UNSIGNED NOT NULL,
    refund_reason ENUM('service_not_working', 'accidental_purchase', 'duplicate_payment', 'dissatisfaction', 'technical_issues', 'other') NOT NULL,
    refund_description TEXT NOT NULL,
    refund_amount DECIMAL(10,2) NOT NULL,
    
    request_status ENUM('pending', 'approved', 'rejected', 'processed') DEFAULT 'pending',
    admin_notes TEXT NULL,
    processed_by BIGINT UNSIGNED NULL COMMENT 'Admin who processed the refund',
    processed_at TIMESTAMP NULL,
    
    refund_transaction_id VARCHAR(100) NULL,
    refund_receipt_number VARCHAR(50) NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (purchase_id) REFERENCES express_service_purchases(id) ON DELETE CASCADE,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (processed_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_purchase_id (purchase_id),
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_request_status (request_status),
    INDEX idx_created_at (created_at)
);
```

# MASTER TABLES

## 22. Express Service Packages Master Table
```sql
CREATE TABLE express_service_packages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(100) NOT NULL UNIQUE COMMENT '30 Days Package, 60 Days Package',
    package_description TEXT NOT NULL COMMENT 'Description of what is included in the package',
    pricing DECIMAL(8,2) NOT NULL COMMENT 'Package price',
    validity_days INT NOT NULL COMMENT 'Number of days the package is valid for',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_package_name (package_name),
    INDEX idx_is_active (is_active),
    INDEX idx_pricing (pricing)
);
```

**Sample Express Service Packages Data (based on screenshot):**
```sql
-- 30 Days Package
INSERT INTO express_service_packages (package_name, package_description, pricing, validity_days) VALUES
('30 Days Money Saver Combo Plan', 'Highlight Resume + Job Alert + Resume Blaster - Highlight Profile to Recruiters, Stand out and get noticed in recruiter eyes, Increase your profile views upto 3 times. Direct Access: Send Your Resume directly to the Company of your choice. Be the First to Apply for the Job Opening - Get Notified Within 30 Minutes of Job Posting through SMS Notification', 10000.00, 30);

-- 60 Days Package  
INSERT INTO express_service_packages (package_name, package_description, pricing, validity_days) VALUES
('60 Days Money Back Guarantee Combo Plan', 'Highlight Resume + Job Alert + Resume Blaster - Highlight Profile to Recruiters, Stand out and get noticed in recruiter eyes, Increase your profile views upto 3 times. Direct Access: Send Your Resume directly to the Company of your choice. Be the First to Apply for the Job Opening - Get Notified Within 30 Minutes of Job Posting through SMS Notification', 18000.00, 60);
```

**Package Features Breakdown:**
- **Highlight Resume**: Highlight Profile to Recruiters, Stand out and get noticed in recruiter eyes, Increase your profile views upto 3 times
- **Resume Blaster**: Direct Access - Send Your Resume directly to the Company of your choice  
- **SMS Job Alert**: Be the First to Apply for the Job Opening - Get Notified Within 30 Minutes of Job Posting through SMS Notification

## 23. Rank Master Table
```sql
CREATE TABLE rank_master (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rank_name VARCHAR(100) NOT NULL UNIQUE,
    sort INT NOT NULL DEFAULT 0 COMMENT 'Sort order for display',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_sort (sort)
);
```

## 24. Ship Type Master Table
```sql
CREATE TABLE ship_type_master (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ship_name VARCHAR(100) NOT NULL UNIQUE,
    sort INT NOT NULL DEFAULT 0 COMMENT 'Sort order for display',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_sort (sort)
);
```

## 25. Endorsement Master Table
```sql
CREATE TABLE endorsement_master (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    dce_name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## 26. Course Master Table
```sql
CREATE TABLE course_master (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL UNIQUE,
    sort INT NOT NULL DEFAULT 0 COMMENT 'Sort order for display',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_sort (sort)
);
```

## Login Methods Summary:
- **super_admin, sub_admin, executive**: Username + Password
- **company_superadmin, company_subadmin**: Mobile + OTP OR Email + OTP
- **candidate**: Email + Password

## Notes:
- All login activities for companies are tracked in `company_login_logs`
- All login activities for admin users are tracked in `admin_login_logs`
- Security notifications are sent to super admin for suspicious activities
- Role-based permissions system supports both admin and company user types
- OTP expiration and email login permissions are handled at user level

# COMPANY MODULE TABLES

## 27. Companies Table (Main company profile)
```sql
CREATE TABLE companies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to users table (company_superadmin)',
    
    -- Company Details
    company_name VARCHAR(255) NOT NULL,
    company_type ENUM('Owner Ship', 'Management', 'Crew Supply') NOT NULL,
    
    -- Contact Information
    primary_contact_person VARCHAR(255) NOT NULL,
    company_email VARCHAR(255) NOT NULL,
    company_phone VARCHAR(20) NULL,
    company_mobile VARCHAR(20) NULL,
    company_mobile_country_code VARCHAR(5) NULL COMMENT 'Country code like +91, +1, etc.',
    
    -- Address Details
    address_line VARCHAR(255) NOT NULL,
    area VARCHAR(255) NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NULL,
    
    -- Business Information (RPSL Details)
    rpsl_number VARCHAR(100) NULL COMMENT 'RPSL Registration Number',
    rpsl_expiry_date DATE NULL COMMENT 'RPSL Expiry Date',
    
    -- Company Status
    verification_status ENUM('pending', 'under_review', 'verified', 'rejected', 'suspended') DEFAULT 'pending',
    verification_notes TEXT NULL COMMENT 'Admin notes during verification',
    verified_by BIGINT UNSIGNED NULL COMMENT 'Admin user who verified',
    verified_at TIMESTAMP NULL,
    
    -- Subscription Packages (3 types with dropdown values: 0,5,15,25,50,75,unlimited)
    resumes_download_per_day ENUM('0', '5', '15', '25', '50', '75','100','unlimited') DEFAULT '0',
    resumes_view_per_day ENUM('0', '5', '15', '25', '50', '75','100','unlimited') DEFAULT '0',
    hot_jobs_per_day ENUM('0', '5', '15', '25', '50', '75','100','unlimited') DEFAULT '0',
    subscription_expiry_date DATE NULL COMMENT 'Common expiry date for all 3 packages',
    subscription_status ENUM('trial', 'active', 'expired', 'suspended') DEFAULT 'trial',
    
    -- Hot Job SMS Features
    is_hotjob_sms_enabled BOOLEAN DEFAULT FALSE COMMENT 'Whether hot job SMS notifications are enabled',
    sms_count_limit INT DEFAULT 0 COMMENT 'Number of SMS notifications allowed',
    
    -- Profile Management
    logo_path VARCHAR(500) NULL,
    company_description TEXT NULL,
    
    -- Company Hierarchy
    max_subadmins INT DEFAULT 0 COMMENT 'Maximum number of subadmins allowed',
    
    -- Directors Information
    company_directors JSON NULL COMMENT 'JSON array of director names and details',
    
    -- Account & Banner Management
    account_type ENUM('advertisement', 'database') NOT NULL DEFAULT 'database' COMMENT 'Type of account - advertisement or database',
    listed_in_banner_section ENUM('yes', 'no') DEFAULT 'no' COMMENT 'Whether company is listed in banner section',
    banner_advertisment_visibility BOOLEAN DEFAULT FALSE COMMENT 'Controls visibility of banner advertisements for this company',
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (verified_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_user_id (user_id),
    INDEX idx_company_name (company_name),
    INDEX idx_verification_status (verification_status),
    INDEX idx_subscription_status (subscription_status),
    INDEX idx_company_type (company_type),
    INDEX idx_city (city),
    INDEX idx_state (state),
    INDEX idx_country (country),
    INDEX idx_subscription_expiry (subscription_expiry_date)
);
```

## 28. Company Sub-admins Table
```sql
CREATE TABLE company_subadmins (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to users table',
    
    -- Personal Details
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_company_user (company_id, user_id),
    INDEX idx_company_id (company_id),
    INDEX idx_user_id (user_id)
);
```

## 29. Company Resume Activities Table (Track company interactions with candidates)
```sql
CREATE TABLE company_resume_activities (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id BIGINT UNSIGNED NOT NULL,
    candidate_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL COMMENT 'Company user who performed the action',
    
    activity_type ENUM('viewed', 'downloaded') NOT NULL,
    activity_details TEXT NULL COMMENT 'Additional notes about the activity',
    
    -- For tracking express service interactions
    is_express_candidate BOOLEAN DEFAULT FALSE,
    express_service_id BIGINT UNSIGNED NULL COMMENT 'Reference to express service purchase',
    
    activity_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (express_service_id) REFERENCES express_service_purchases(id) ON DELETE SET NULL,
    
    INDEX idx_company_id (company_id),
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_user_id (user_id),
    INDEX idx_activity_type (activity_type),
    INDEX idx_activity_date (activity_date),
    INDEX idx_is_express_candidate (is_express_candidate)
);
```

# JOBS MODULE TABLES

## 30. Jobs Table (Main job postings - Two types: Banner Advertisement & Hot Jobs)
```sql
CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to companies table',
    posted_by BIGINT UNSIGNED NOT NULL COMMENT 'Company user who posted the job',
    
    -- Job Type (NEW: Two distinct types)
    job_type ENUM('banner_advertisement', 'hot_job') NOT NULL,
    
    -- Common Job Details
    subject VARCHAR(255) NOT NULL COMMENT 'Job subject/title',
    description TEXT NOT NULL COMMENT 'Job description',
    posted_date DATE NOT NULL COMMENT 'Date when job was posted',
    
    -- Banner Advertisement Specific Fields
    banner_type ENUM('customized', 'fixed') NULL COMMENT 'Only for banner_advertisement type',
    banner_content TEXT NULL COMMENT 'Customized content from text editor for banner ads',
    banner_image_path VARCHAR(500) NULL COMMENT 'Fixed image path for banner ads',
    
    -- Hot Job Specific Fields
    rank_id BIGINT UNSIGNED NULL COMMENT 'Foreign Key to rank_master (for hot jobs)',
    ship_type_id BIGINT UNSIGNED NULL COMMENT 'Foreign Key to ship_type_master (for hot jobs)',
    joining_date DATE NULL COMMENT 'Date of joining (for hot jobs)',
    nationality VARCHAR(100) NULL COMMENT 'Required nationality (for hot jobs)',
    rank_experience_value INT NULL COMMENT 'Experience value 1-24 (for hot jobs)',
    rank_experience_unit ENUM('years', 'months') NULL COMMENT 'Experience unit (for hot jobs)',
    advertisement_expiry_date DATE NULL COMMENT 'Advertisement expiry date (for hot jobs)',
    is_sms_enabled BOOLEAN DEFAULT FALSE COMMENT 'Hot job with SMS notifications (for hot jobs)',
    posted_by_name VARCHAR(255) NULL COMMENT 'Name of person posting (for hot jobs)',
    contact_number VARCHAR(20) NULL COMMENT 'Contact number (for hot jobs)',
    contact_country_code VARCHAR(5) NULL COMMENT 'Country code for contact (for hot jobs)',
    contact_email VARCHAR(255) NULL COMMENT 'Contact email (for hot jobs)',
    
    -- Job Status & Settings
    job_status ENUM('active', 'inactive', 'expired') DEFAULT 'active',
    
    -- Dates
    expiry_date DATE NULL COMMENT 'General expiry date',
    published_at TIMESTAMP NULL,
    
    -- Admin Control
    admin_approved BOOLEAN DEFAULT FALSE,
    approved_by BIGINT UNSIGNED NULL COMMENT 'Admin who approved the job',
    approved_at TIMESTAMP NULL,
    rejection_reason TEXT NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE,
    FOREIGN KEY (posted_by) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (rank_id) REFERENCES rank_master(id) ON DELETE RESTRICT,
    FOREIGN KEY (ship_type_id) REFERENCES ship_type_master(id) ON DELETE RESTRICT,
    FOREIGN KEY (approved_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_company_id (company_id),
    INDEX idx_posted_by (posted_by),
    INDEX idx_job_type (job_type),
    INDEX idx_rank_id (rank_id),
    INDEX idx_ship_type_id (ship_type_id),
    INDEX idx_job_status (job_status),
    INDEX idx_published_at (published_at),
    INDEX idx_expiry_date (expiry_date),
    INDEX idx_admin_approved (admin_approved),
    INDEX idx_posted_date (posted_date)
);
```

## 31. Job Ranks Table (Multiple ranks for banner advertisements)
```sql
CREATE TABLE job_ranks (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    job_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to jobs table',
    rank_id BIGINT UNSIGNED NOT NULL COMMENT 'Foreign Key to rank_master',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (rank_id) REFERENCES rank_master(id) ON DELETE RESTRICT,
    
    UNIQUE KEY unique_job_rank (job_id, rank_id),
    INDEX idx_job_id (job_id),
    INDEX idx_rank_id (rank_id)
);
```

**How Multiple Ranks Work for Banner Advertisements:**

1. **Storage Method**: 
   - Main job record in `jobs` table stores the ship_type_id (if applicable)
   - Multiple ranks are stored in the `job_ranks` table with separate rows for each rank
   - Each row links `job_id` to `rank_id`

2. **Example Data Structure**:
   ```sql
   -- Job record in jobs table
   INSERT INTO jobs (id, job_type, subject, ship_type_id, ...) VALUES 
   (1, 'banner_advertisement', 'Multiple Ranks Available', 5, ...);
   
   -- Multiple ranks in job_ranks table
   INSERT INTO job_ranks (job_id, rank_id) VALUES 
   (1, 10), -- Captain
   (1, 15), -- Chief Engineer  
   (1, 20), -- Second Engineer
   (1, 25); -- Third Engineer
   ```

3. **Database Queries**:
   ```sql
   -- Get all ranks for a banner advertisement
   SELECT r.rank_name 
   FROM job_ranks jr
   JOIN rank_master r ON jr.rank_id = r.id
   WHERE jr.job_id = 1;
   
   -- Get all banner ads for a specific rank
   SELECT j.* 
   FROM jobs j
   JOIN job_ranks jr ON j.id = jr.job_id
   WHERE jr.rank_id = 10 AND j.job_type = 'banner_advertisement';
   ```

4. **Business Logic**:
   - **Banner Advertisements**: Use `job_ranks` table for multiple ranks per job
   - **Hot Jobs**: Use single `rank_id` field in main `jobs` table
   - **Validation**: Ensure job_ranks entries only exist for banner_advertisement type jobs

## 32. Candidate Job Interactions Table (Combined views and applications)
```sql
CREATE TABLE candidate_job_interactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    job_id BIGINT UNSIGNED NOT NULL,
    candidate_id BIGINT UNSIGNED NOT NULL,
    
    -- Interaction Types
    has_viewed BOOLEAN DEFAULT FALSE COMMENT 'Whether candidate has viewed this job',
    has_applied BOOLEAN DEFAULT FALSE COMMENT 'Whether candidate has applied to this job',
    
    -- Timestamps
    first_viewed_at TIMESTAMP NULL COMMENT 'When candidate first viewed the job',
    applied_at TIMESTAMP NULL COMMENT 'When candidate applied to the job',
    last_viewed_at TIMESTAMP NULL COMMENT 'Most recent view timestamp',
    
    -- View Analytics
    view_count INT DEFAULT 0 COMMENT 'Number of times candidate viewed this job',
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_job_candidate (job_id, candidate_id),
    INDEX idx_job_id (job_id),
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_has_applied (has_applied),
    INDEX idx_has_viewed (has_viewed),
    INDEX idx_applied_at (applied_at),
    INDEX idx_first_viewed_at (first_viewed_at)
);
```

## Job Posting Business Logic

### **Banner Advertisement Jobs** (`job_type = 'banner_advertisement'`)
- **Purpose**: Advertisement-style job postings for better visibility
- **Required Fields**: `subject`, `description`, `posted_date`, `banner_type`
- **Banner Types**:
  - **Customized**: Uses `banner_content` field with rich text editor content
  - **Fixed**: Uses `banner_image_path` field with uploaded image
- **Multiple Ranks**: Companies can select multiple ranks for a single ship type using `job_ranks` table
- **Fields Used**: `subject`, `description`, `posted_date`, `banner_type`, `banner_content`/`banner_image_path`

### **Hot Jobs** (`job_type = 'hot_job'`)
- **Purpose**: Premium job postings with enhanced features and SMS notifications
- **Required Fields**: All hot job specific fields as per screenshot
- **Features**: SMS notifications, priority display, enhanced analytics
- **Fields Used**: 
  - `rank_id`, `ship_type_id`, `joining_date`, `nationality`
  - `rank_experience_value`, `rank_experience_unit` (1-24 years/months)
  - `description`, `advertisement_expiry_date`, `is_sms_enabled`
  - `posted_by_name`, `contact_number`, `contact_country_code`, `contact_email`

### **Data Validation Rules**:
1. **Banner Advertisement**: Must have either `banner_content` OR `banner_image_path` based on `banner_type`
2. **Hot Jobs**: Must have all required fields including contact details
3. **Multiple Ranks**: Only applicable for banner advertisements via `job_ranks` table
4. **SMS Notifications**: Only available for hot jobs when company has SMS credits

# MESSAGING MODULE TABLES

## 34. Messages Table (Communication between candidates and companies)
```sql
CREATE TABLE messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    conversation_id VARCHAR(100) NOT NULL COMMENT 'Unique conversation identifier',
    
    -- Participants
    sender_id BIGINT UNSIGNED NOT NULL COMMENT 'User who sent the message',
    receiver_id BIGINT UNSIGNED NOT NULL COMMENT 'User who should receive the message',
    
    -- Message Content
    subject VARCHAR(255) NULL COMMENT 'Message subject line',
    message_body TEXT NOT NULL,
    
    -- Message Status
    is_read BOOLEAN DEFAULT FALSE,
    read_at TIMESTAMP NULL,
    
    -- Admin Moderation
    is_flagged BOOLEAN DEFAULT FALSE,
    flagged_reason TEXT NULL,
    moderated_by BIGINT UNSIGNED NULL,
    moderated_at TIMESTAMP NULL,
    
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (moderated_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_conversation_id (conversation_id),
    INDEX idx_sender_id (sender_id),
    INDEX idx_receiver_id (receiver_id),
    INDEX idx_is_read (is_read),
    INDEX idx_sent_at (sent_at),
    INDEX idx_is_flagged (is_flagged)
);
```

# BANNER ADVERTISEMENT MODULE TABLES

## 35. Banner Clicks Table (Track banner click analytics)
```sql
CREATE TABLE banner_clicks (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    job_id BIGINT UNSIGNED NOT NULL COMMENT 'References jobs table where job_type = banner_advertisement',
    
    -- User Details
    user_id BIGINT UNSIGNED NULL COMMENT 'User who clicked (NULL for anonymous)',
    user_type ENUM('candidate', 'company', 'admin', 'anonymous') NOT NULL,
    
    -- Click Details
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT NULL,
    referrer_url TEXT NULL,
    click_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Location (if available)
    country VARCHAR(100) NULL,
    state VARCHAR(100) NULL,
    city VARCHAR(100) NULL,
    
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_job_id (job_id),
    INDEX idx_user_id (user_id),
    INDEX idx_user_type (user_type),
    INDEX idx_click_timestamp (click_timestamp),
    INDEX idx_country (country)
);
```

## 36. Banner Impressions Table (Track banner view analytics)
```sql
CREATE TABLE banner_impressions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    job_id BIGINT UNSIGNED NOT NULL COMMENT 'References jobs table where job_type = banner_advertisement',
    
    -- User Details
    user_id BIGINT UNSIGNED NULL COMMENT 'User who viewed (NULL for anonymous)',
    user_type ENUM('candidate', 'company', 'admin', 'anonymous') NOT NULL,
    
    -- Impression Details
    page_url VARCHAR(500) NOT NULL COMMENT 'Page where banner was shown',
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT NULL,
    impression_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Location (if available)
    country VARCHAR(100) NULL,
    state VARCHAR(100) NULL,
    city VARCHAR(100) NULL,
    
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_job_id (job_id),
    INDEX idx_user_id (user_id),
    INDEX idx_user_type (user_type),
    INDEX idx_impression_timestamp (impression_timestamp),
    INDEX idx_page_url (page_url)
);
```

# STATISTICS MODULE TABLES

## 37. System Statistics Table (Overall platform statistics)
```sql
CREATE TABLE system_statistics (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Date for the statistics
    stat_date DATE NOT NULL,
    
    -- User Statistics
    total_candidates INT DEFAULT 0,
    active_candidates INT DEFAULT 0,
    new_candidates_today INT DEFAULT 0,
    total_companies INT DEFAULT 0,
    verified_companies INT DEFAULT 0,
    new_companies_today INT DEFAULT 0,
    
    -- Job Statistics
    total_jobs INT DEFAULT 0,
    active_jobs INT DEFAULT 0,
    hot_jobs INT DEFAULT 0,
    jobs_posted_today INT DEFAULT 0,
    total_applications INT DEFAULT 0,
    applications_today INT DEFAULT 0,
    
    -- Express Service Statistics
    express_service_purchases INT DEFAULT 0,
    express_service_revenue DECIMAL(12,2) DEFAULT 0,
    
    -- Activity Statistics
    resume_views_today INT DEFAULT 0,
    resume_downloads_today INT DEFAULT 0,
    job_views_today INT DEFAULT 0,
    messages_sent_today INT DEFAULT 0,
    
    -- Banner Statistics
    banner_impressions_today INT DEFAULT 0,
    banner_clicks_today INT DEFAULT 0,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    UNIQUE KEY unique_stat_date (stat_date),
    INDEX idx_stat_date (stat_date)
);
```

## 38. Company Statistics Table (Individual company analytics)
```sql
CREATE TABLE company_statistics (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id BIGINT UNSIGNED NOT NULL,
    stat_date DATE NOT NULL,
    
    -- Job Statistics
    jobs_posted INT DEFAULT 0,
    active_jobs INT DEFAULT 0,
    hot_jobs INT DEFAULT 0,
    job_views INT DEFAULT 0,
    applications_received INT DEFAULT 0,
    
    -- Resume Activity
    resumes_viewed INT DEFAULT 0,
    resumes_downloaded INT DEFAULT 0,
    candidates_contacted INT DEFAULT 0,
    
    -- Subscription Usage
    daily_view_limit INT DEFAULT 0,
    daily_download_limit INT DEFAULT 0,
    daily_hot_job_limit INT DEFAULT 0,
    views_used INT DEFAULT 0,
    downloads_used INT DEFAULT 0,
    hot_jobs_used INT DEFAULT 0,
    
    -- Message Statistics
    messages_sent INT DEFAULT 0,
    messages_received INT DEFAULT 0,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_company_date (company_id, stat_date),
    INDEX idx_company_id (company_id),
    INDEX idx_stat_date (stat_date)
);
```

## 39. Candidate Statistics Table (Individual candidate analytics)
```sql
CREATE TABLE candidate_statistics (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    candidate_id BIGINT UNSIGNED NOT NULL,
    stat_date DATE NOT NULL,
    
    -- Profile Statistics
    profile_views INT DEFAULT 0,
    profile_downloads INT DEFAULT 0,
    companies_contacted_by INT DEFAULT 0,
    
    -- Job Activity
    jobs_viewed INT DEFAULT 0,
    applications_sent INT DEFAULT 0,
    
    -- Express Service Impact
    express_service_active BOOLEAN DEFAULT FALSE,
    priority_visibility BOOLEAN DEFAULT FALSE,
    
    -- Message Statistics
    messages_sent INT DEFAULT 0,
    messages_received INT DEFAULT 0,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    
    UNIQUE KEY unique_candidate_date (candidate_id, stat_date),
    INDEX idx_candidate_id (candidate_id),
    INDEX idx_stat_date (stat_date)
);
```

# SYSTEM CONFIGURATION TABLES

## 40. System Settings Table (Global system configuration)
```sql
CREATE TABLE system_settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(255) NOT NULL UNIQUE,
    setting_value TEXT NULL,
    setting_type ENUM('string', 'integer', 'boolean', 'json', 'decimal') DEFAULT 'string',
    setting_category VARCHAR(100) NOT NULL COMMENT 'general, email, sms, payment, etc.',
    setting_description TEXT NULL,
    is_editable BOOLEAN DEFAULT TRUE,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_setting_key (setting_key),
    INDEX idx_setting_category (setting_category)
);
```

**Sample System Settings Data:**
```sql
INSERT INTO system_settings (setting_key, setting_value, setting_type, setting_category, setting_description) VALUES
('site_name', 'SeafarerJobs.com', 'string', 'general', 'Website name'),
('max_file_upload_size', '5242880', 'integer', 'general', 'Maximum file upload size in bytes (5MB)'),
('email_verification_required', 'true', 'boolean', 'email', 'Whether email verification is required'),
('sms_enabled', 'true', 'boolean', 'sms', 'Whether SMS notifications are enabled'),
('express_service_enabled', 'true', 'boolean', 'services', 'Whether express services are available'),
('candidate_hiding_limit', '5', 'integer', 'candidates', 'Maximum companies a candidate can hide from'),
('job_expiry_days', '30', 'integer', 'jobs', 'Default job expiry in days'),
('hot_job_duration_days', '7', 'integer', 'jobs', 'Default hot job feature duration'),
('banner_max_file_size', '2097152', 'integer', 'banners', 'Maximum banner image size in bytes (2MB)');
```

## Summary of Complete Database Schema

The SeafarerJobs database now includes **40 comprehensive tables** covering:

### **Core Modules:**
1. **Authentication & Users** (Tables 1-7): Complete user management with roles, permissions, and security
2. **Candidate Module** (Tables 8-21): Full candidate lifecycle with 7-step registration, express services, and admin management
3. **Master Data** (Tables 22-26): Reference data for ranks, ships, endorsements, courses, and packages
4. **Company Module** (Tables 27-29): Company profiles, subscriptions, subadmins, and activity tracking
5. **Jobs Module** (Tables 30-33): Job postings with banner advertisements and hot jobs integrated, plus analytics
6. **Messaging** (Table 34): Simplified text-only communication system
7. **Banner Advertisements** (Tables 35-36): Banner analytics referencing jobs table
8. **Statistics** (Tables 37-39): Comprehensive reporting for system, companies, and candidates
9. **System Configuration** (Table 40): Global settings management

### **Key Features Implemented:**
- Multi-role authentication with OTP support
- Subscription-based company packages with daily limits
- Express service system for candidates
- Hot jobs with SMS notifications
- Banner advertisements integrated into jobs table with job_type field
- Advanced search and filtering capabilities
- Comprehensive analytics and reporting
- Simplified text-only messaging system
- Admin approval workflows
- Complete audit trails

### **Recent Schema Simplifications:**
- **Messages**: Removed `job_id`, `is_archived`, `message_type` fields - now text-only
- **Message Attachments**: Table removed completely
- **Banner Advertisements**: Table removed - functionality moved to jobs table with `job_type = 'banner_advertisement'`
- **Banner Analytics**: Updated to reference jobs table instead of banner_advertisements

The database is now ready for Laravel migration generation and application development!
