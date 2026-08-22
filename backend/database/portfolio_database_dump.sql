-- ========================================================
-- PUVY PORTFOLIO DATABASE EXPORT / DUMP
-- Generated on: 2026-08-22 06:41:34
-- ========================================================

-- --------------------------------------------------------
-- Table structure & data for table `users`
-- --------------------------------------------------------

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Puvy', 'admin@puvy.dev', NULL, '$2y$12$SCuBtgc0KuJICZAVohi4C.fjTyTizxfrYhViTmjGuiIZ.MWELeeVy', NULL, '2026-08-19 08:33:23', '2026-08-19 10:20:15');

-- --------------------------------------------------------
-- Table structure & data for table `profiles`
-- --------------------------------------------------------

INSERT INTO `profiles` (`id`, `user_id`, `name`, `title`, `bio`, `avatar`, `location`, `cv_url`, `about_me_text`, `experience_years`, `happy_clients`, `projects_completed`, `technologies_count`, `available_for_hire`, `created_at`, `updated_at`) VALUES (1, 1, 'PUVY', 'IT Support Specialist | Full-Stack Web & App Developer', 'I am an IT Support Specialist and Full-Stack Developer passionate about building reliable, scalable, and user-friendly digital solutions. I specialize in IT support, web applications, backend systems, REST APIs, database management, and modern frontend development.', '/profile.jpg', 'Cambodia, Tnaot Chum 4 Village, Boeung Tumpun Sangkat, Meanchey Khan, Phnom Penh', '/downloads/puvy-cv.pdf', 'With extensive hands-on experience spanning enterprise IT infrastructure, hardware troubleshooting, network administration, and modern software development, I bridge the gap between technical operations and elegant software engineering. Whether diagnosing server bottlenecks, configuring secure local and cloud networks, or architecting responsive full-stack applications with Vue 3, TypeScript, and Laravel, I focus on stability, security, and exceptional user experience.', 6, 48, 54, 28, 1, '2026-08-19 08:33:23', '2026-08-19 10:20:15');

-- --------------------------------------------------------
-- Table structure & data for table `projects`
-- --------------------------------------------------------

INSERT INTO `projects` (`id`, `project_category_id`, `title`, `slug`, `summary`, `description`, `thumbnail`, `live_url`, `github_url`, `tags`, `features`, `client`, `start_date`, `end_date`, `is_featured`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 3, 'Nexus Cloud Operations & SysAdmin Dashboard', 'nexus-cloud-ops', 'Real-time enterprise server health, CPU/RAM telemetry, active session tracking, and network latency monitoring system.', 'Nexus Cloud Ops is an enterprise dashboard designed for IT infrastructure engineers to monitor Linux & Windows servers, track container health, diagnose network bottlenecks, and dispatch incident alerts in real-time. Built with Vue 3, Element Plus, and Laravel REST APIs.', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80', 'https://demo-nexus.example.com', 'https://github.com/example/nexus-cloud', '[\"Vue 3\",\"TypeScript\",\"Element Plus\",\"Laravel\",\"MySQL\",\"System Administration\"]', '[\"Real-time hardware metric streams\",\"SSH remote session diagnostics\",\"Role-based permission hierarchy\",\"Automated incident dispatch webhooks\"]', 'CloudScale Infrastructure Inc.', '2024-01-15 00:00:00', '2024-06-30 00:00:00', 1, 1, 1, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `projects` (`id`, `project_category_id`, `title`, `slug`, `summary`, `description`, `thumbnail`, `live_url`, `github_url`, `tags`, `features`, `client`, `start_date`, `end_date`, `is_featured`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 1, 'OmniFlow SaaS Task & Project Hub', 'omniflow-project-hub', 'Collaborative task management platform with Kanban workflows, sprint analytics, and real-time notifications.', 'A scalable project tracking platform supporting multi-tenant teams, drag-and-drop Kanban boards, team permission policies, and time tracking. The frontend utilizes shadcn/ui and Tailwind CSS with Pinia for responsive user interactions.', 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=900&q=80', 'https://demo-omniflow.example.com', 'https://github.com/example/omniflow', '[\"Vue 3\",\"Tailwind CSS\",\"shadcn\\/ui\",\"Laravel\",\"Sanctum\",\"MySQL\"]', '[\"Interactive drag-and-drop Kanban board\",\"Sprint velocity & burndown charts\",\"File attachment & S3 storage\",\"Instant email & WebSocket notifications\"]', 'Apex Digital Solutions', '2023-08-01 00:00:00', '2023-12-20 00:00:00', 1, 1, 2, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `projects` (`id`, `project_category_id`, `title`, `slug`, `summary`, `description`, `thumbnail`, `live_url`, `github_url`, `tags`, `features`, `client`, `start_date`, `end_date`, `is_featured`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 4, 'SecureGate Identity & REST API Gateway', 'securegate-api', 'High-throughput authentication gateway providing Sanctum token authorization, rate-limiting, and audit logging.', 'Engineered a centralized API gateway that verifies client signatures, provides OAuth2 & Sanctum token lifecycle handling, inspects malicious payload signatures, and logs every incoming request for compliance auditing.', 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=80', 'https://api-docs.example.com', 'https://github.com/example/securegate', '[\"PHP 8\",\"Laravel 11\",\"Sanctum\",\"REST API\",\"Redis\",\"MySQL\"]', '[\"Sub-15ms response latency\",\"Dynamic IP rate limiting & ban rules\",\"Granular token permission abilities\",\"Automated OpenAPI 3.0 specs\"]', 'FinSecure Technologies', '2023-02-10 00:00:00', '2023-07-15 00:00:00', 1, 1, 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `projects` (`id`, `project_category_id`, `title`, `slug`, `summary`, `description`, `thumbnail`, `live_url`, `github_url`, `tags`, `features`, `client`, `start_date`, `end_date`, `is_featured`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 2, 'FieldTech IT Dispatch Mobile Companion', 'fieldtech-mobile', 'Mobile field support application for on-site technicians to log repair tickets, scan asset barcodes, and capture signatures.', 'Cross-platform progressive app enabling IT support specialists in the field to view assigned tickets, diagnose network devices, scan QR asset codes, and sync offline resolution notes with the central Laravel server.', 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=900&q=80', 'https://fieldtech.example.com', 'https://github.com/example/fieldtech', '[\"Vue 3\",\"TypeScript\",\"Tailwind CSS\",\"PWA\",\"REST API\"]', '[\"Offline ticket storage & auto-sync\",\"Camera barcode \\/ QR code scanner\",\"GPS job check-in validation\",\"Digital customer sign-off pad\"]', 'OmniSupport Field Operations', '2024-03-01 00:00:00', '2024-07-10 00:00:00', 0, 1, 4, '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `project_images`
-- --------------------------------------------------------

-- --------------------------------------------------------
-- Table structure & data for table `skill_categories`
-- --------------------------------------------------------

INSERT INTO `skill_categories` (`id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'Frontend Development', 1, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skill_categories` (`id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'Backend & APIs', 2, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skill_categories` (`id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 'IT Support & Systems', 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skill_categories` (`id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 'Databases & Cloud', 4, '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `skills`
-- --------------------------------------------------------

INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 1, 'Vue 3 / Composition API', 'FileCode', 96, '5+ yrs', 1, 1, '2026-08-19 08:33:32', '2026-08-19 10:20:15');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 1, 'TypeScript', 'Code', 92, '4+ yrs', 1, 2, '2026-08-19 08:33:32', '2026-08-19 10:20:15');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 1, 'Tailwind CSS & shadcn/ui', 'Palette', 98, '4+ yrs', 1, 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 1, 'Element Plus UI', 'Layout', 90, '4+ yrs', 1, 4, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (5, 1, 'JavaScript (ES6+)', 'FileCode2', 95, '6+ yrs', 0, 5, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (6, 1, 'HTML5 / CSS3 / Responsive Design', 'Globe', 99, '6+ yrs', 0, 6, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (7, 2, 'PHP 8+ & Laravel', 'Server', 95, '5+ yrs', 1, 1, '2026-08-19 08:33:32', '2026-08-19 10:20:15');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (8, 2, 'RESTful API & Sanctum Auth', 'KeyRound', 94, '5+ yrs', 1, 2, '2026-08-19 08:33:32', '2026-08-19 10:20:15');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (9, 2, 'Eloquent ORM & Migrations', 'Database', 92, '5+ yrs', 1, 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (10, 2, 'Node.js & Express', 'Cpu', 84, '3+ yrs', 0, 4, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (11, 3, 'Hardware & Peripheral Diagnostics', 'Wrench', 96, '6+ yrs', 1, 1, '2026-08-19 08:33:32', '2026-08-19 10:20:15');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (12, 3, 'Windows & Linux SysAdmin', 'Terminal', 92, '6+ yrs', 1, 2, '2026-08-19 08:33:32', '2026-08-19 10:20:15');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (13, 3, 'Network Troubleshooting & VLANs', 'Network', 88, '5+ yrs', 1, 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (14, 3, 'Remote Desktop & User Management', 'MonitorPlay', 95, '6+ yrs', 0, 4, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (15, 3, 'Backup & Disaster Recovery Plans', 'ShieldCheck', 90, '4+ yrs', 0, 5, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (16, 4, 'MySQL & Performance Tuning', 'Database', 90, '5+ yrs', 1, 1, '2026-08-19 08:33:32', '2026-08-19 10:20:15');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (17, 4, 'Git & GitHub CI/CD', 'GitBranch', 95, '5+ yrs', 1, 2, '2026-08-19 08:33:32', '2026-08-19 10:20:15');
INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `icon`, `proficiency`, `experience_years`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (18, 4, 'Docker Containerization', 'Boxes', 85, '3+ yrs', 0, 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `services`
-- --------------------------------------------------------

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `features`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'Hardware & PC Diagnostics', 'Comprehensive component testing, faulty RAM/HDD replacement, thermal paste renewal, and power issue resolution.', 'Wrench', '[\"Component level diagnosis\",\"RAM\\/SSD upgrade & cloning\",\"Thermal management & cleaning\",\"Warranty claims coordination\"]', 75, 1, 1, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `features`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'Windows & Linux OS Support', 'Clean operating system installations, kernel optimizations, active directory user setups, driver updates, and registry troubleshooting.', 'Terminal', '[\"OS reinstall & data migration\",\"Active Directory user provision\",\"Malware removal & firewall hardening\",\"Automated patch scheduling\"]', 90, 1, 2, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `features`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 'Network Configuration & Troubleshooting', 'Router, switch, access point setup, structured cabling testing, VPN deployment, and WiFi latency optimization.', 'Network', '[\"Subnetting & VLAN design\",\"WireGuard & OpenVPN deployment\",\"WiFi mesh coverage heatmapping\",\"DNS & DHCP troubleshooting\"]', 120, 1, 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `features`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 'Full-Stack Web Application Development', 'Custom SaaS platforms and web portals built with Vue 3, TypeScript, Tailwind CSS, Laravel, and MySQL.', 'Globe', '[\"Single Page Applications (SPA)\",\"Clean MVC & Domain architecture\",\"State management with Pinia\",\"Automated testing and CI\\/CD\"]', 1500, 1, 4, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `features`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (5, 'RESTful API & Microservices', 'High-throughput, secure REST API architecture with Laravel Sanctum authentication, rate limiting, and API Resource standards.', 'Server', '[\"Token & OAuth2 auth flows\",\"Strict Form Request validation\",\"Standardized JSON error envelopes\",\"Automated Swagger\\/OpenAPI docs\"]', 800, 1, 5, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `features`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (6, 'Admin Dashboard & Internal Tools', 'Powerful back-office interfaces with advanced data tables, batch actions, file managers, analytics charts, and audit logs.', 'LayoutDashboard', '[\"Element Plus & shadcn components\",\"Real-time telemetry and filters\",\"Role-based access control (RBAC)\",\"Excel \\/ PDF data exports\"]', 1200, 1, 6, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `features`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (7, 'Database Design & Optimization', 'Normalized relational schema design, query indexing tuning, execution plan analysis, and automated backup strategies.', 'Database', '[\"3NF relational schema creation\",\"Index & slow query tuning\",\"Replication and failover setup\",\"Automated S3 snapshot archives\"]', 600, 1, 7, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `features`, `price`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (8, 'IT Asset Management & Backup Solutions', 'Inventory tracking for enterprise hardware, scheduled cloud backups (3-2-1 strategy), and disaster recovery validation.', 'ShieldCheck', '[\"3-2-1 backup verification\",\"NAS & Cloud storage sync\",\"Hardware inventory lifecycle audit\",\"Rapid bare-metal disaster recovery\"]', 350, 1, 8, '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `experiences`
-- --------------------------------------------------------

INSERT INTO `experiences` (`id`, `role`, `company`, `location`, `period`, `description`, `achievements`, `technologies`, `is_current`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'Senior IT Support & Full-Stack Developer', 'Vortex Systems & Tech Group', 'San Francisco, CA', '2023 - Present', 'Leading internal infrastructure operations while engineering high-availability client web applications with Vue 3 and Laravel.', '[\"Reduced IT ticket resolution time by 35% through custom automated diagnostic scripts.\",\"Engineered 4 enterprise web applications with 99.9% uptime on Linux servers.\",\"Administered Active Directory, network firewall rules, and automated cloud backup protocols.\"]', '[\"Vue 3\",\"TypeScript\",\"Laravel 11\",\"MySQL\",\"Linux SysAdmin\",\"Tailwind CSS\"]', 1, 1, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `experiences` (`id`, `role`, `company`, `location`, `period`, `description`, `achievements`, `technologies`, `is_current`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'IT Support Specialist & Web Developer', 'PixelCraft Solutions', 'Austin, TX', '2021 - 2023', 'Provided tier 2/3 technical support for 250+ workstations and built bespoke web portals for commercial clients.', '[\"Configured hardware, routers, switches, and remote access VPNs across 3 branch offices.\",\"Developed custom responsive client dashboards utilizing Element Plus and REST APIs.\",\"Migrated internal legacy MySQL databases to normalized structures with zero data loss.\"]', '[\"Hardware Diagnostics\",\"Windows Server\",\"Laravel\",\"Vue.js\",\"MySQL\",\"Network Troubleshooting\"]', 0, 2, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `experiences` (`id`, `role`, `company`, `location`, `period`, `description`, `achievements`, `technologies`, `is_current`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 'Systems Support Technician', 'DataCore Networking Labs', 'San Jose, CA', '2019 - 2021', 'Delivered on-site hardware repairs, operating system installations, and routine network maintenance.', '[\"Built automated OS image deployment workflows reducing setup time from 3 hours to 20 minutes.\",\"Managed asset inventory of over 500 computers, servers, and network devices.\"]', '[\"PC Hardware\",\"Linux\",\"TCP\\/IP\",\"Active Directory\",\"Bash Scripting\"]', 0, 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `certifications`
-- --------------------------------------------------------

INSERT INTO `certifications` (`id`, `name`, `organization`, `credential_id`, `issue_date`, `expiration_date`, `credential_url`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'CompTIA Security+ (SY0-601)', 'CompTIA', 'COMP001020304', '2023-04-15 00:00:00', '2026-04-15 00:00:00', 'https://www.comptia.org/certifications/security', 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=400&q=80', 1, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `certifications` (`id`, `name`, `organization`, `credential_id`, `issue_date`, `expiration_date`, `credential_url`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'CompTIA Network+ (N10-008)', 'CompTIA', 'COMP009988776', '2022-08-10 00:00:00', '2025-08-10 00:00:00', 'https://www.comptia.org/certifications/network', 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=400&q=80', 2, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `certifications` (`id`, `name`, `organization`, `credential_id`, `issue_date`, `expiration_date`, `credential_url`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 'AWS Certified Solutions Architect – Associate', 'Amazon Web Services', 'AWS-ASA-994812', '2023-11-20 00:00:00', '2026-11-20 00:00:00', 'https://aws.amazon.com/certification/certified-solutions-architect-associate/', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=400&q=80', 3, '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `blog_categories`
-- --------------------------------------------------------

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES (1, 'Web Development', 'web-development', '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `blog_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES (2, 'IT Infrastructure & Support', 'it-support', '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `blog_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES (3, 'System Architecture', 'system-architecture', '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `blog_posts`
-- --------------------------------------------------------

INSERT INTO `blog_posts` (`id`, `blog_category_id`, `title`, `slug`, `featured_image`, `excerpt`, `content`, `author`, `published_at`, `status`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES (1, 1, 'Architecting Scalable Single Page Apps with Vue 3, TypeScript & Laravel 11', 'building-scalable-vue3-laravel-spas', 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=900&q=80', 'A practical blueprint for combining Vue 3 Composition API with TypeScript, Tailwind CSS, and Laravel Sanctum REST APIs.', '## Modern Full-Stack Architecture

When developing enterprise-grade web applications, separating the frontend client and backend REST API provides immense flexibility.

### Key Benefits:
1. **Independent Scalability**: Scale the Vue SPA on high-performance CDN edges while keeping Laravel APIs behind load balancers.
2. **Type Safety**: TypeScript interfaces ensure every payload returned from Laravel matches frontend expectations.
3. **Modular Component Trees**: Using Tailwind CSS with headless component primitives creates consistent, maintainable UI tokens.

### Authentication with Sanctum
Laravel Sanctum provides an ultra-lightweight token authentication guard ideal for SPAs and mobile applications alike.', 'Puvy', '2026-07-15 10:00:00', 'published', 'Vue 3 and Laravel 11 Full-Stack Architecture Guide', 'Learn how to architect clean, maintainable web applications using Vue 3, TypeScript, and Laravel 11 REST APIs.', 'vue 3, typescript, laravel 11, sanctum, tailwind css, rest api', '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `blog_posts` (`id`, `blog_category_id`, `title`, `slug`, `featured_image`, `excerpt`, `content`, `author`, `published_at`, `status`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES (2, 2, 'Essential Network Diagnostics: From Physical Layer to DNS Resolution', 'network-troubleshooting-handbook-it-pros', 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=900&q=80', 'A step-by-step diagnostic workflow for IT engineers to resolve packet loss, DNS latency, and VLAN routing conflicts.', '## The IT Engineer\'s Network Diagnostic Playbook

Network downtime halts business operations. Approaching connectivity issues methodically across the OSI model saves critical hours.

### 1. Physical Layer & Link Status
Always verify cable integrity and port auto-negotiation first. A degraded CAT6 cable frequently drops down to 100Mbps half-duplex.

### 2. ARP & IP Conflict Checks
Use `arp -a` and ping broadcasts to identify duplicate IP assignments in static DHCP subnet pools.

### 3. DNS Lookup & TTL Cache
Verify that the client resolves internal domain names through the designated DNS resolver rather than public fallbacks.', 'Puvy', '2026-08-01 14:30:00', 'published', 'Network Troubleshooting Handbook for IT Support Engineers', 'Master network diagnostics: identify packet drops, resolve DHCP conflicts, and optimize WiFi mesh throughput.', 'network troubleshooting, it support, dns, vlan, ping, sysadmin', '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `testimonials`
-- --------------------------------------------------------

INSERT INTO `testimonials` (`id`, `client_name`, `company`, `role`, `avatar`, `content`, `rating`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'Marcus Vance', 'CloudMatrix Global', 'Chief Technology Officer', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80', 'Puvy transformed our chaotic office IT infrastructure and built an incredible custom monitoring dashboard. Having an engineer who understands both hardware diagnostics and full-stack software architecture is exceptionally rare!', 5, 1, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `testimonials` (`id`, `client_name`, `company`, `role`, `avatar`, `content`, `rating`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'Elena Rostova', 'NovaPay Systems', 'VP of Engineering', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80', 'The REST API and Vue 3 frontend Puvy delivered was fast, securely protected with Sanctum, and beautifully designed. Highly recommended for any serious web development or system engineering project.', 5, 2, '2026-08-19 08:33:32', '2026-08-19 08:33:32');

-- --------------------------------------------------------
-- Table structure & data for table `contacts`
-- --------------------------------------------------------

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `ip_address`, `is_read`, `created_at`, `updated_at`) VALUES (1, 'vy', 'saravyvonn@gmail.com', 'mini system for DrinkBar', 'Hi puvy. I need you to provide me a bout mini system for DrinkBar', '127.0.0.1', 0, '2026-08-19 10:23:37', '2026-08-19 10:23:37');

-- --------------------------------------------------------
-- Table structure & data for table `settings`
-- --------------------------------------------------------

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (1, 'site_name', 'PUVY - IT Specialist & Full-Stack Developer', '2026-08-19 08:33:23', '2026-08-19 10:20:15');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (2, 'site_tagline', 'Bridging Hardware, Networks, and High-Performance Software', '2026-08-19 08:33:23', '2026-08-19 08:33:23');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (3, 'contact_email', 'khounvyvy@gmail.com', '2026-08-19 08:33:23', '2026-08-19 09:09:26');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (4, 'contact_phone', '+855 963454358', '2026-08-19 08:33:23', '2026-08-19 09:09:26');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (5, 'contact_location', 'Cambodia, Tnaot Chum 4 Village, Boeung Tumpun Sangkat, Meanchey Khan, Phnom Penh', '2026-08-19 08:33:23', '2026-08-19 09:09:26');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (6, 'telegram_username', '+855 963454358', '2026-08-19 08:33:23', '2026-08-19 09:09:26');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (7, 'github_url', 'https://github.com/puvy123', '2026-08-19 08:33:23', '2026-08-19 09:09:26');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (8, 'linkedin_url', 'https://www.linkedin.com/in/khonn-vy-498743389?utm_source=share_via&utm_content=profile&utm_medium=member_ios', '2026-08-19 08:33:23', '2026-08-19 09:09:26');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (9, 'facebook_url', 'https://www.facebook.com/vysabay.jit/', '2026-08-19 08:33:23', '2026-08-19 09:13:30');

-- --------------------------------------------------------
-- Table structure & data for table `social_links`
-- --------------------------------------------------------

INSERT INTO `social_links` (`id`, `platform`, `url`, `icon`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'GitHub', 'https://github.com/puvy123', 'Github', 1, 1, '2026-08-19 08:33:32', '2026-08-19 09:09:26');
INSERT INTO `social_links` (`id`, `platform`, `url`, `icon`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'LinkedIn', 'https://www.linkedin.com/in/khonn-vy-498743389?utm_source=share_via&utm_content=profile&utm_medium=member_ios', 'Linkedin', 1, 2, '2026-08-19 08:33:32', '2026-08-19 09:09:26');
INSERT INTO `social_links` (`id`, `platform`, `url`, `icon`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 'Telegram', 'https://t.me/+855963454358', 'Send', 1, 5, '2026-08-19 08:33:32', '2026-08-19 09:13:30');
INSERT INTO `social_links` (`id`, `platform`, `url`, `icon`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 'Twitter/X', 'https://x.com', 'Twitter', 1, 4, '2026-08-19 08:33:32', '2026-08-19 08:33:32');
INSERT INTO `social_links` (`id`, `platform`, `url`, `icon`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (5, 'Facebook', 'https://www.facebook.com/vysabay.jit/', 'Facebook', 1, 3, '2026-08-19 08:33:32', '2026-08-19 09:13:30');
INSERT INTO `social_links` (`id`, `platform`, `url`, `icon`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES (6, 'Email', 'mailto:khounvyvy@gmail.com', 'Mail', 1, 4, '2026-08-19 09:09:26', '2026-08-19 09:13:30');

