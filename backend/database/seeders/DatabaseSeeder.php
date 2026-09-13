<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\SkillCategory;
use App\Models\Skill;
use App\Models\Service;
use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\SocialLink;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        $user = User::updateOrCreate(
            ['email' => 'admin@puvy.dev'],
            [
                'name' => 'Puvy',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Profile
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => 'PUVY',
                'title' => 'IT Support Specialist | Full-Stack Web & App Developer',
                'bio' => 'I am an IT Support Specialist and Full-Stack Developer passionate about building reliable, scalable, and user-friendly digital solutions. I specialize in IT support, web applications, backend systems, REST APIs, database management, and modern frontend development.',
                'about_me_text' => 'With extensive hands-on experience spanning enterprise IT infrastructure, hardware troubleshooting, network administration, and modern software development, I bridge the gap between technical operations and elegant software engineering. Whether diagnosing server bottlenecks, configuring secure local and cloud networks, or architecting responsive full-stack applications with Vue 3, TypeScript, and Laravel, I focus on stability, security, and exceptional user experience.',
                'avatar' => '/profile.jpg',
                'location' => 'Cambodia, Tnaot Chum 4 Village, Boeung Tumpun Sangkat, Meanchey Khan, Phnom Penh',
                'cv_url' => '/downloads/puvy-cv.pdf',
                'experience_years' => 5,
                'happy_clients' => 48,
                'projects_completed' => 54,
                'technologies_count' => 28,
                'available_for_hire' => true,
            ]
        );

        // 3. Settings
        $settings = [
            'site_name' => 'PUVY - IT Specialist & Full-Stack Developer',
            'site_tagline' => 'Bridging Hardware, Networks, and High-Performance Software',
            'contact_email' => 'khounvyvy@gmail.com',
            'contact_phone' => '+855 963454358',
            'contact_location' => 'Cambodia, Tnaot Chum 4 Village, Boeung Tumpun Sangkat, Meanchey Khan, Phnom Penh',
            'telegram_username' => '+855 963454358',
            'github_url' => 'https://github.com/puvy123',
            'linkedin_url' => 'https://www.linkedin.com/in/khonn-vy-498743389?utm_source=share_via&utm_content=profile&utm_medium=member_ios',
            'facebook_url' => 'https://www.facebook.com/vysabay.jit/',
        ];

        foreach ($settings as $k => $v) {
            Setting::updateOrCreate(['key' => $k], ['value' => $v]);
        }

        // 4. Social Links
        $socials = [
            ['platform' => 'GitHub', 'url' => 'https://github.com/puvy123', 'icon' => 'Github', 'is_active' => true, 'sort_order' => 1],
            ['platform' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/khonn-vy-498743389?utm_source=share_via&utm_content=profile&utm_medium=member_ios', 'icon' => 'Linkedin', 'is_active' => true, 'sort_order' => 2],
            ['platform' => 'Facebook', 'url' => 'https://www.facebook.com/vysabay.jit/', 'icon' => 'Facebook', 'is_active' => true, 'sort_order' => 3],
            ['platform' => 'Email', 'url' => 'mailto:khounvyvy@gmail.com', 'icon' => 'Mail', 'is_active' => true, 'sort_order' => 4],
            ['platform' => 'Telegram', 'url' => 'https://t.me/+855963454358', 'icon' => 'Send', 'is_active' => true, 'sort_order' => 5],
        ];
        foreach ($socials as $soc) {
            SocialLink::updateOrCreate(['platform' => $soc['platform']], $soc);
        }

        // 5. Skill Categories & Skills
        $catFrontend = SkillCategory::updateOrCreate(['name' => 'Frontend Development'], ['sort_order' => 1]);
        $catBackend = SkillCategory::updateOrCreate(['name' => 'Backend & APIs'], ['sort_order' => 2]);
        $catIT = SkillCategory::updateOrCreate(['name' => 'IT Support & Systems'], ['sort_order' => 3]);
        $catDB = SkillCategory::updateOrCreate(['name' => 'Databases & Cloud'], ['sort_order' => 4]);

        $skills = [
            // Frontend
            ['skill_category_id' => $catFrontend->id, 'name' => 'Vue 3 / Composition API', 'icon' => 'FileCode', 'proficiency' => 96, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 1],
            ['skill_category_id' => $catFrontend->id, 'name' => 'TypeScript', 'icon' => 'Code', 'proficiency' => 92, 'experience_years' => '4+ yrs', 'is_featured' => true, 'sort_order' => 2],
            ['skill_category_id' => $catFrontend->id, 'name' => 'Tailwind CSS & shadcn/ui', 'icon' => 'Palette', 'proficiency' => 98, 'experience_years' => '4+ yrs', 'is_featured' => true, 'sort_order' => 3],
            ['skill_category_id' => $catFrontend->id, 'name' => 'Element Plus UI', 'icon' => 'Layout', 'proficiency' => 90, 'experience_years' => '4+ yrs', 'is_featured' => true, 'sort_order' => 4],
            ['skill_category_id' => $catFrontend->id, 'name' => 'JavaScript (ES6+)', 'icon' => 'FileCode2', 'proficiency' => 95, 'experience_years' => '5+ yrs', 'is_featured' => false, 'sort_order' => 5],
            ['skill_category_id' => $catFrontend->id, 'name' => 'HTML5 / CSS3 / Responsive Design', 'icon' => 'Globe', 'proficiency' => 99, 'experience_years' => '5+ yrs', 'is_featured' => false, 'sort_order' => 6],
            
            // Backend
            ['skill_category_id' => $catBackend->id, 'name' => 'PHP 8+ & Laravel', 'icon' => 'Server', 'proficiency' => 95, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 1],
            ['skill_category_id' => $catBackend->id, 'name' => 'RESTful API & Sanctum Auth', 'icon' => 'KeyRound', 'proficiency' => 94, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 2],
            ['skill_category_id' => $catBackend->id, 'name' => 'Eloquent ORM & Migrations', 'icon' => 'Database', 'proficiency' => 92, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 3],
            ['skill_category_id' => $catBackend->id, 'name' => 'Node.js & Express', 'icon' => 'Cpu', 'proficiency' => 84, 'experience_years' => '3+ yrs', 'is_featured' => false, 'sort_order' => 4],

            // IT Support
            ['skill_category_id' => $catIT->id, 'name' => 'Hardware & Peripheral Diagnostics', 'icon' => 'Wrench', 'proficiency' => 96, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 1],
            ['skill_category_id' => $catIT->id, 'name' => 'Windows & Linux SysAdmin', 'icon' => 'Terminal', 'proficiency' => 92, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 2],
            ['skill_category_id' => $catIT->id, 'name' => 'Network Troubleshooting & VLANs', 'icon' => 'Network', 'proficiency' => 88, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 3],
            ['skill_category_id' => $catIT->id, 'name' => 'Remote Desktop & User Management', 'icon' => 'MonitorPlay', 'proficiency' => 95, 'experience_years' => '5+ yrs', 'is_featured' => false, 'sort_order' => 4],
            ['skill_category_id' => $catIT->id, 'name' => 'Backup & Disaster Recovery Plans', 'icon' => 'ShieldCheck', 'proficiency' => 90, 'experience_years' => '4+ yrs', 'is_featured' => false, 'sort_order' => 5],

            // Databases & Tools
            ['skill_category_id' => $catDB->id, 'name' => 'MySQL & Performance Tuning', 'icon' => 'Database', 'proficiency' => 90, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 1],
            ['skill_category_id' => $catDB->id, 'name' => 'Git & GitHub CI/CD', 'icon' => 'GitBranch', 'proficiency' => 95, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 2],
            ['skill_category_id' => $catDB->id, 'name' => 'Docker Containerization', 'icon' => 'Boxes', 'proficiency' => 85, 'experience_years' => '3+ yrs', 'is_featured' => false, 'sort_order' => 3],
        ];

        foreach ($skills as $sk) {
            Skill::updateOrCreate(
                ['name' => $sk['name']],
                $sk
            );
        }

        // 6. Services (IT Support + Web/App Development)
        $services = [
            [
                'title' => 'Hardware & PC Diagnostics',
                'description' => 'Comprehensive component testing, faulty RAM/HDD replacement, thermal paste renewal, and power issue resolution.',
                'icon' => 'Wrench',
                'features' => ['Component level diagnosis', 'RAM/SSD upgrade & cloning', 'Thermal management & cleaning', 'Warranty claims coordination'],
                'price' => 75.00,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Windows & Linux OS Support',
                'description' => 'Clean operating system installations, kernel optimizations, active directory user setups, driver updates, and registry troubleshooting.',
                'icon' => 'Terminal',
                'features' => ['OS reinstall & data migration', 'Active Directory user provision', 'Malware removal & firewall hardening', 'Automated patch scheduling'],
                'price' => 90.00,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Network Configuration & Troubleshooting',
                'description' => 'Router, switch, access point setup, structured cabling testing, VPN deployment, and WiFi latency optimization.',
                'icon' => 'Network',
                'features' => ['Subnetting & VLAN design', 'WireGuard & OpenVPN deployment', 'WiFi mesh coverage heatmapping', 'DNS & DHCP troubleshooting'],
                'price' => 120.00,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'Full-Stack Web Application Development',
                'description' => 'Custom SaaS platforms and web portals built with Vue 3, TypeScript, Tailwind CSS, Laravel, and MySQL.',
                'icon' => 'Globe',
                'features' => ['Single Page Applications (SPA)', 'Clean MVC & Domain architecture', 'State management with Pinia', 'Automated testing and CI/CD'],
                'price' => 1500.00,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'RESTful API & Microservices',
                'description' => 'High-throughput, secure REST API architecture with Laravel Sanctum authentication, rate limiting, and API Resource standards.',
                'icon' => 'Server',
                'features' => ['Token & OAuth2 auth flows', 'Strict Form Request validation', 'Standardized JSON error envelopes', 'Automated Swagger/OpenAPI docs'],
                'price' => 800.00,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'title' => 'Admin Dashboard & Internal Tools',
                'description' => 'Powerful back-office interfaces with advanced data tables, batch actions, file managers, analytics charts, and audit logs.',
                'icon' => 'LayoutDashboard',
                'features' => ['Element Plus & shadcn components', 'Real-time telemetry and filters', 'Role-based access control (RBAC)', 'Excel / PDF data exports'],
                'price' => 1200.00,
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'title' => 'Database Design & Optimization',
                'description' => 'Normalized relational schema design, query indexing tuning, execution plan analysis, and automated backup strategies.',
                'icon' => 'Database',
                'features' => ['3NF relational schema creation', 'Index & slow query tuning', 'Replication and failover setup', 'Automated S3 snapshot archives'],
                'price' => 600.00,
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'title' => 'IT Asset Management & Backup Solutions',
                'description' => 'Inventory tracking for enterprise hardware, scheduled cloud backups (3-2-1 strategy), and disaster recovery validation.',
                'icon' => 'ShieldCheck',
                'features' => ['3-2-1 backup verification', 'NAS & Cloud storage sync', 'Hardware inventory lifecycle audit', 'Rapid bare-metal disaster recovery'],
                'price' => 350.00,
                'is_active' => true,
                'sort_order' => 8
            ]
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['title' => $srv['title']], $srv);
        }

        // 7. Project Categories & Projects
        $pCatWeb = ProjectCategory::updateOrCreate(['name' => 'Web Application'], ['slug' => 'web-application']);
        $pCatEcommerce = ProjectCategory::updateOrCreate(['name' => 'E-Commerce & Retail'], ['slug' => 'ecommerce-retail']);
        $pCatPOS = ProjectCategory::updateOrCreate(['name' => 'Point of Sale (POS)'], ['slug' => 'pos-systems']);
        $pCatTools = ProjectCategory::updateOrCreate(['name' => 'Tools & Utilities'], ['slug' => 'tools-utilities']);
        $pCatOpenSource = ProjectCategory::updateOrCreate(['name' => 'Open Source & Libraries'], ['slug' => 'open-source']);

        $projects = [
            [
                'project_category_id' => $pCatEcommerce->id,
                'title' => 'Helmet - Motorcycle Helmet Store & E-Commerce System',
                'slug' => 'helmet-store-system',
                'summary' => 'Full-stack enterprise e-commerce store, motorcycle helmet catalog, inventory controller, and NBC Bakong KHQR digital payment system.',
                'description' => "A comprehensive e-commerce platform and inventory management system designed for motorcycle helmet and rider safety gear in Cambodia. Built with Vue 3, TypeScript, and Tailwind CSS.\n\nIntegrates NBC Bakong KHQR dynamic payment generation, shopping cart state management with Pinia, stock level alerts, and an intuitive customer checkout experience.",
                'thumbnail' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://github.com/puvy123/Helmet',
                'github_url' => 'https://github.com/puvy123/Helmet',
                'tags' => ['Vue 3', 'TypeScript', 'Tailwind CSS', 'Pinia', 'Bakong KHQR', 'E-Commerce', 'REST API'],
                'features' => [
                    'Dynamic NBC Bakong KHQR payment QR generation & validation',
                    'Interactive shopping cart & checkout flow with Pinia',
                    'Inventory stock tracking & low-stock warning alerts',
                    'Responsive motorcycle helmet catalog with category filters'
                ],
                'client' => 'VyCollection Helmets',
                'start_date' => '2024-04-01',
                'end_date' => '2024-08-15',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1
            ],
            [
                'project_category_id' => $pCatPOS->id,
                'title' => 'MiniMart Pro - Mini Mart POS & Retail Management System',
                'slug' => 'minimart-pos-system',
                'summary' => 'Production-ready Point of Sale (POS) and retail management system built for Cambodian retail stores with barcode scanning, cash/KHQR checkout, and inventory tracking.',
                'description' => "MINIMART PRO is a production-grade retail POS and inventory management solution engineered for convenience stores and supermarkets.\n\nFeatures rapid product barcode scanning, real-time total and tax computation, multi-currency support (USD / KHR), customer receipt printing, and automated stock deduction.",
                'thumbnail' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://github.com/puvy123/miniamrt',
                'github_url' => 'https://github.com/puvy123/miniamrt',
                'tags' => ['Vue 3', 'Vite', 'TypeScript', 'Tailwind CSS', 'Pinia', 'POS System', 'Retail', 'REST API'],
                'features' => [
                    'High-speed barcode scanner integration & quick product search',
                    'Dual currency handling (USD & KHR) with automated exchange rates',
                    'Instant thermal receipt formatting and printing',
                    'Real-time daily revenue and cashier shift reconciliation'
                ],
                'client' => 'MiniMart Retail Network',
                'start_date' => '2024-02-10',
                'end_date' => '2024-06-20',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2
            ],
            [
                'project_category_id' => $pCatWeb->id,
                'title' => 'Atlas Pulse - Real-Time GPS Location & Operations Tracker',
                'slug' => 'location-tracker-atlas',
                'summary' => 'Real-time location operations dashboard built with React, Vite, Leaflet, and OpenStreetMap for live GPS telemetry and fleet monitoring.',
                'description' => "Atlas Pulse is a high-performance interactive location operations dashboard.\n\nIt connects to GPS-enabled devices and geolocation APIs to plot real-time positions on Leaflet/OpenStreetMap tiles, render breadcrumb route histories, trigger geofence boundary alerts, and analyze vehicle speed and transit time metrics.",
                'thumbnail' => 'https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://github.com/puvy123/Location-Tracker',
                'github_url' => 'https://github.com/puvy123/Location-Tracker',
                'tags' => ['React', 'JavaScript', 'Leaflet', 'OpenStreetMap', 'Node.js', 'Vite', 'GPS & Geolocation'],
                'features' => [
                    'Smooth real-time coordinate streaming & live map pin animations',
                    'Custom OpenStreetMap layer styling with dark mode themes',
                    'Route history playback with timeline scrubber',
                    'Geofencing boundary detection & instant alert notifications'
                ],
                'client' => 'FleetOps Logistics',
                'start_date' => '2024-05-01',
                'end_date' => '2024-07-30',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3
            ],
            [
                'project_category_id' => $pCatTools->id,
                'title' => 'YouTube Downloader Pro - Video & Audio Stream Extractor',
                'slug' => 'youtube-downloader-pro',
                'summary' => 'Full-stack video metadata retriever and stream converter supporting multiple MP4 resolutions and audio extraction with real-time download progress.',
                'description' => "A modern, responsive full-stack utility designed to retrieve media metadata from video streams, provide quality selection (1080p, 720p, 480p, MP3 Audio), and manage safe process execution with automated temporary buffer garbage collection.\n\nBuilt with TypeScript, Node.js, Express, and Tailwind CSS.",
                'thumbnail' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://github.com/puvy123/Youtube-download',
                'github_url' => 'https://github.com/puvy123/Youtube-download',
                'tags' => ['TypeScript', 'Node.js', 'Express', 'Tailwind CSS', 'FFmpeg', 'Media Processing'],
                'features' => [
                    'Automated video stream resolution extraction (1080p to 360p & MP3)',
                    'Live conversion progress meter via server-sent events',
                    'Safe background process pooling and memory management',
                    'Automatic temporary file cleanup post download completion'
                ],
                'client' => 'Open Source Tool',
                'start_date' => '2024-06-01',
                'end_date' => '2024-08-01',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 4
            ],
            [
                'project_category_id' => $pCatWeb->id,
                'title' => 'PuvY Developer Portfolio & Headless Admin CMS',
                'slug' => 'puvy-developer-portfolio',
                'summary' => 'Production portfolio web application and content management system built with Vue 3 + TypeScript and Laravel 11 Sanctum RESTful API.',
                'description' => "The official developer portfolio and personal branding platform for PuvY.\n\nEngineered with a decoupled architecture featuring a Vue 3 + Vite + Tailwind CSS frontend deployed on Vercel, and a Laravel 11 RESTful API backend deployed with Sanctum authentication on Render. Features dark/light mode, live contact form handling, and comprehensive CRUD management.",
                'thumbnail' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://portfolio-puvy.vercel.app',
                'github_url' => 'https://github.com/puvy123/Portfolio',
                'tags' => ['Vue 3', 'TypeScript', 'Tailwind CSS', 'Laravel 11', 'Sanctum', 'Vercel', 'Render', 'SQLite'],
                'features' => [
                    'Decoupled SPA architecture with Vue 3 and TypeScript',
                    'Laravel 11 Sanctum authenticated administrative dashboard',
                    'Interactive developer CLI terminal emulator',
                    'Automated Git CI/CD deployment pipelines'
                ],
                'client' => 'Personal Brand Showcase',
                'start_date' => '2024-01-01',
                'end_date' => '2024-09-01',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 5
            ],
            [
                'project_category_id' => $pCatTools->id,
                'title' => 'CSS Style Generator & Frontend Design Playground',
                'slug' => 'css-generator-playground',
                'summary' => 'Interactive developer tool to configure, preview, and generate modern CSS animations, glassmorphism effects, gradients, and box shadows.',
                'description' => "An interactive frontend developer workbench that provides visual controls for customizing modern CSS styling rules.\n\nIncludes multi-color linear and radial gradients, glassmorphism blur and backdrop filters, multi-layer box shadows, border-radius morphing, and CSS keyframe animations with one-click copy to clipboard.",
                'thumbnail' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://github.com/puvy123/CSS-Generator',
                'github_url' => 'https://github.com/puvy123/CSS-Generator',
                'tags' => ['CSS3', 'JavaScript', 'HTML5', 'UI/UX Tools', 'Responsive Design'],
                'features' => [
                    'Visual gradient builder with multi-stop color pickers',
                    'Glassmorphism backdrop-filter & opacity adjusters',
                    'Multi-layered box-shadow depth simulator',
                    'Instant code generation with clean CSS snippet export'
                ],
                'client' => 'Frontend Developers Utility',
                'start_date' => '2023-11-01',
                'end_date' => '2024-01-15',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 6
            ],
            [
                'project_category_id' => $pCatPOS->id,
                'title' => 'Mini POS - Fast Desktop Cashier & Sales System',
                'slug' => 'mini-pos-checkout',
                'summary' => 'Lightweight, high-speed point of sale interface tailored for swift item addition, cashier transaction settlement, and sales records.',
                'description' => "A lightweight POS application designed for rapid checkout environments.\n\nFeatures instant keyboard hotkey navigation, barcode lookups, discount calculations, split payment options, and daily sales summary exports.",
                'thumbnail' => 'https://images.unsplash.com/photo-1556742049-0a67e5572263?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://github.com/puvy123/min-pos',
                'github_url' => 'https://github.com/puvy123/min-pos',
                'tags' => ['JavaScript', 'Vue.js', 'Tailwind CSS', 'POS Terminal', 'Database'],
                'features' => [
                    'Fast keyboard-driven cashier transaction workflow',
                    'Automated discount and item markup calculation',
                    'Transaction history logging & receipt reprint',
                    'Lightweight footprint optimized for low-spec POS hardware'
                ],
                'client' => 'Retail POS Systems',
                'start_date' => '2023-09-01',
                'end_date' => '2023-12-10',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 7
            ],
            [
                'project_category_id' => $pCatOpenSource->id,
                'title' => 'Element Plus Vue 3 Custom Themes & Components',
                'slug' => 'element-plus-custom',
                'summary' => 'Enterprise Vue.js 3 UI component toolkit customized with dark coder theme variables, customized dialogs, and table enhancements.',
                'description' => "Customization and extension of the Element Plus UI component library for Vue 3.\n\nTailored specifically for dark cyberpunk and modern coder UI palettes, providing seamless integration with Tailwind CSS utility classes and TypeScript interfaces.",
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://element-plus.org',
                'github_url' => 'https://github.com/puvy123/element-plus',
                'tags' => ['Vue 3', 'TypeScript', 'Element Plus', 'SCSS', 'Component Library'],
                'features' => [
                    'Custom SCSS design tokens & dark mode color variables',
                    'Optimized data table with virtual scroll and filtering',
                    'Modular dialog and notification component presets'
                ],
                'client' => 'Open Source Community',
                'start_date' => '2023-05-01',
                'end_date' => '2023-08-20',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 8
            ]
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(['slug' => $proj['slug']], $proj);
        }

        // 8. Work Experience
        $experiences = [
            [
                'role' => 'Senior IT Support & Full-Stack Developer',
                'company' => 'Vortex Systems & Tech Group',
                'location' => 'San Francisco, CA',
                'period' => '2023 - Present',
                'description' => 'Leading internal infrastructure operations while engineering high-availability client web applications with Vue 3 and Laravel.',
                'achievements' => [
                    'Reduced IT ticket resolution time by 35% through custom automated diagnostic scripts.',
                    'Engineered 4 enterprise web applications with 99.9% uptime on Linux servers.',
                    'Administered Active Directory, network firewall rules, and automated cloud backup protocols.'
                ],
                'technologies' => ['Vue 3', 'TypeScript', 'Laravel 11', 'MySQL', 'Linux SysAdmin', 'Tailwind CSS'],
                'is_current' => true,
                'sort_order' => 1
            ],
            [
                'role' => 'IT Support Specialist & Web Developer',
                'company' => 'PixelCraft Solutions',
                'location' => 'Austin, TX',
                'period' => '2021 - 2023',
                'description' => 'Provided tier 2/3 technical support for 250+ workstations and built bespoke web portals for commercial clients.',
                'achievements' => [
                    'Configured hardware, routers, switches, and remote access VPNs across 3 branch offices.',
                    'Developed custom responsive client dashboards utilizing Element Plus and REST APIs.',
                    'Migrated internal legacy MySQL databases to normalized structures with zero data loss.'
                ],
                'technologies' => ['Hardware Diagnostics', 'Windows Server', 'Laravel', 'Vue.js', 'MySQL', 'Network Troubleshooting'],
                'is_current' => false,
                'sort_order' => 2
            ],
            [
                'role' => 'Systems Support Technician',
                'company' => 'DataCore Networking Labs',
                'location' => 'San Jose, CA',
                'period' => '2019 - 2021',
                'description' => 'Delivered on-site hardware repairs, operating system installations, and routine network maintenance.',
                'achievements' => [
                    'Built automated OS image deployment workflows reducing setup time from 3 hours to 20 minutes.',
                    'Managed asset inventory of over 500 computers, servers, and network devices.'
                ],
                'technologies' => ['PC Hardware', 'Linux', 'TCP/IP', 'Active Directory', 'Bash Scripting'],
                'is_current' => false,
                'sort_order' => 3
            ]
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(['company' => $exp['company'], 'role' => $exp['role']], $exp);
        }

        // 9. Educations & Certifications
        $educations = [
            [
                'institution' => 'University of California, Berkeley',
                'degree' => 'Bachelor of Science',
                'field' => 'Computer Science & Information Technology',
                'start_date' => '2015-09-01',
                'end_date' => '2019-06-15',
                'description' => 'Specialized in Computer Systems Architecture, Relational Databases, Software Engineering, and Computer Networks.',
                'sort_order' => 1
            ]
        ];

        foreach ($educations as $edu) {
            Education::updateOrCreate(['institution' => $edu['institution'], 'degree' => $edu['degree']], $edu);
        }

        $certs = [
            [
                'name' => 'CompTIA Security+ (SY0-601)',
                'organization' => 'CompTIA',
                'credential_id' => 'COMP001020304',
                'issue_date' => '2023-04-15',
                'expiration_date' => '2026-04-15',
                'credential_url' => 'https://www.comptia.org/certifications/security',
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=400&q=80',
                'sort_order' => 1
            ],
            [
                'name' => 'CompTIA Network+ (N10-008)',
                'organization' => 'CompTIA',
                'credential_id' => 'COMP009988776',
                'issue_date' => '2022-08-10',
                'expiration_date' => '2025-08-10',
                'credential_url' => 'https://www.comptia.org/certifications/network',
                'image' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=400&q=80',
                'sort_order' => 2
            ],
            [
                'name' => 'AWS Certified Solutions Architect – Associate',
                'organization' => 'Amazon Web Services',
                'credential_id' => 'AWS-ASA-994812',
                'issue_date' => '2023-11-20',
                'expiration_date' => '2026-11-20',
                'credential_url' => 'https://aws.amazon.com/certification/certified-solutions-architect-associate/',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=400&q=80',
                'sort_order' => 3
            ]
        ];

        foreach ($certs as $c) {
            Certification::updateOrCreate(['name' => $c['name']], $c);
        }

        // 10. Blog Categories, Tags, and Posts
        $bCatDev = BlogCategory::updateOrCreate(['name' => 'Web Development'], ['slug' => 'web-development']);
        $bCatIT = BlogCategory::updateOrCreate(['name' => 'IT Infrastructure & Support'], ['slug' => 'it-support']);
        $bCatArch = BlogCategory::updateOrCreate(['name' => 'System Architecture'], ['slug' => 'system-architecture']);

        $tagVue = Tag::updateOrCreate(['name' => 'Vue 3'], ['slug' => 'vue-3']);
        $tagLaravel = Tag::updateOrCreate(['name' => 'Laravel'], ['slug' => 'laravel']);
        $tagNetworking = Tag::updateOrCreate(['name' => 'Networking'], ['slug' => 'networking']);
        $tagHardware = Tag::updateOrCreate(['name' => 'Hardware'], ['slug' => 'hardware']);

        $post1 = BlogPost::updateOrCreate(
            ['slug' => 'building-scalable-vue3-laravel-spas'],
            [
                'blog_category_id' => $bCatDev->id,
                'title' => 'Architecting Scalable Single Page Apps with Vue 3, TypeScript & Laravel 11',
                'featured_image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=900&q=80',
                'excerpt' => 'A practical blueprint for combining Vue 3 Composition API with TypeScript, Tailwind CSS, and Laravel Sanctum REST APIs.',
                'content' => "## Modern Full-Stack Architecture\n\nWhen developing enterprise-grade web applications, separating the frontend client and backend REST API provides immense flexibility.\n\n### Key Benefits:\n1. **Independent Scalability**: Scale the Vue SPA on high-performance CDN edges while keeping Laravel APIs behind load balancers.\n2. **Type Safety**: TypeScript interfaces ensure every payload returned from Laravel matches frontend expectations.\n3. **Modular Component Trees**: Using Tailwind CSS with headless component primitives creates consistent, maintainable UI tokens.\n\n### Authentication with Sanctum\nLaravel Sanctum provides an ultra-lightweight token authentication guard ideal for SPAs and mobile applications alike.",
                'author' => 'Puvy',
                'published_at' => '2026-07-15 10:00:00',
                'status' => 'published',
                'seo_title' => 'Vue 3 and Laravel 11 Full-Stack Architecture Guide',
                'seo_description' => 'Learn how to architect clean, maintainable web applications using Vue 3, TypeScript, and Laravel 11 REST APIs.',
                'seo_keywords' => 'vue 3, typescript, laravel 11, sanctum, tailwind css, rest api',
            ]
        );
        $post1->tags()->sync([$tagVue->id, $tagLaravel->id]);

        $post2 = BlogPost::updateOrCreate(
            ['slug' => 'network-troubleshooting-handbook-it-pros'],
            [
                'blog_category_id' => $bCatIT->id,
                'title' => 'Essential Network Diagnostics: From Physical Layer to DNS Resolution',
                'featured_image' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=900&q=80',
                'excerpt' => 'A step-by-step diagnostic workflow for IT engineers to resolve packet loss, DNS latency, and VLAN routing conflicts.',
                'content' => "## The IT Engineer's Network Diagnostic Playbook\n\nNetwork downtime halts business operations. Approaching connectivity issues methodically across the OSI model saves critical hours.\n\n### 1. Physical Layer & Link Status\nAlways verify cable integrity and port auto-negotiation first. A degraded CAT6 cable frequently drops down to 100Mbps half-duplex.\n\n### 2. ARP & IP Conflict Checks\nUse `arp -a` and ping broadcasts to identify duplicate IP assignments in static DHCP subnet pools.\n\n### 3. DNS Lookup & TTL Cache\nVerify that the client resolves internal domain names through the designated DNS resolver rather than public fallbacks.",
                'author' => 'Puvy',
                'published_at' => '2026-08-01 14:30:00',
                'status' => 'published',
                'seo_title' => 'Network Troubleshooting Handbook for IT Support Engineers',
                'seo_description' => 'Master network diagnostics: identify packet drops, resolve DHCP conflicts, and optimize WiFi mesh throughput.',
                'seo_keywords' => 'network troubleshooting, it support, dns, vlan, ping, sysadmin',
            ]
        );
        $post2->tags()->sync([$tagNetworking->id, $tagHardware->id]);

        // 11. Testimonials
        $testimonials = [
            [
                'client_name' => 'Marcus Vance',
                'company' => 'CloudMatrix Global',
                'role' => 'Chief Technology Officer',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
                'content' => 'Puvy transformed our chaotic office IT infrastructure and built an incredible custom monitoring dashboard. Having an engineer who understands both hardware diagnostics and full-stack software architecture is exceptionally rare!',
                'rating' => 5,
                'sort_order' => 1
            ],
            [
                'client_name' => 'Elena Rostova',
                'company' => 'NovaPay Systems',
                'role' => 'VP of Engineering',
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80',
                'content' => 'The REST API and Vue 3 frontend Puvy delivered was fast, securely protected with Sanctum, and beautifully designed. Highly recommended for any serious web development or system engineering project.',
                'rating' => 5,
                'sort_order' => 2
            ]
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['client_name' => $t['client_name']], $t);
        }
    }
}
