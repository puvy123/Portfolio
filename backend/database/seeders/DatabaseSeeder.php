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
                'name' => 'Khonn Vy (Puvy)',
                'title' => 'IT Support Specialist | Full-Stack Web & App Developer',
                'bio' => 'I am an IT Support Specialist and Full-Stack Developer passionate about building reliable, scalable, and user-friendly digital solutions. I specialize in IT support, web applications, backend systems, REST APIs, database management, and modern frontend development.',
                'about_me_text' => 'With extensive hands-on experience spanning enterprise IT infrastructure, hardware troubleshooting, network administration, and modern software development, I bridge the gap between technical operations and elegant software engineering. Whether diagnosing server bottlenecks, configuring secure local and cloud networks, or architecting responsive full-stack applications with Vue 3, TypeScript, and Laravel, I focus on stability, security, and exceptional user experience.',
                'avatar' => '/profile.jpg',
                'location' => 'Cambodia, Tnaot Chum 4 Village, Boeung Tumpun Sangkat, Meanchey Khan, Phnom Penh',
                'cv_url' => '/downloads/puvy-cv.pdf',
                'experience_years' => 6,
                'happy_clients' => 48,
                'projects_completed' => 54,
                'technologies_count' => 28,
                'available_for_hire' => true,
            ]
        );

        // 3. Settings
        $settings = [
            'site_name' => 'Khonn Vy - IT Specialist & Full-Stack Developer',
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
            ['skill_category_id' => $catFrontend->id, 'name' => 'JavaScript (ES6+)', 'icon' => 'FileCode2', 'proficiency' => 95, 'experience_years' => '6+ yrs', 'is_featured' => false, 'sort_order' => 5],
            ['skill_category_id' => $catFrontend->id, 'name' => 'HTML5 / CSS3 / Responsive Design', 'icon' => 'Globe', 'proficiency' => 99, 'experience_years' => '6+ yrs', 'is_featured' => false, 'sort_order' => 6],
            
            // Backend
            ['skill_category_id' => $catBackend->id, 'name' => 'PHP 8+ & Laravel', 'icon' => 'Server', 'proficiency' => 95, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 1],
            ['skill_category_id' => $catBackend->id, 'name' => 'RESTful API & Sanctum Auth', 'icon' => 'KeyRound', 'proficiency' => 94, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 2],
            ['skill_category_id' => $catBackend->id, 'name' => 'Eloquent ORM & Migrations', 'icon' => 'Database', 'proficiency' => 92, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 3],
            ['skill_category_id' => $catBackend->id, 'name' => 'Node.js & Express', 'icon' => 'Cpu', 'proficiency' => 84, 'experience_years' => '3+ yrs', 'is_featured' => false, 'sort_order' => 4],

            // IT Support
            ['skill_category_id' => $catIT->id, 'name' => 'Hardware & Peripheral Diagnostics', 'icon' => 'Wrench', 'proficiency' => 96, 'experience_years' => '6+ yrs', 'is_featured' => true, 'sort_order' => 1],
            ['skill_category_id' => $catIT->id, 'name' => 'Windows & Linux SysAdmin', 'icon' => 'Terminal', 'proficiency' => 92, 'experience_years' => '6+ yrs', 'is_featured' => true, 'sort_order' => 2],
            ['skill_category_id' => $catIT->id, 'name' => 'Network Troubleshooting & VLANs', 'icon' => 'Network', 'proficiency' => 88, 'experience_years' => '5+ yrs', 'is_featured' => true, 'sort_order' => 3],
            ['skill_category_id' => $catIT->id, 'name' => 'Remote Desktop & User Management', 'icon' => 'MonitorPlay', 'proficiency' => 95, 'experience_years' => '6+ yrs', 'is_featured' => false, 'sort_order' => 4],
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
        $pCatMobile = ProjectCategory::updateOrCreate(['name' => 'Mobile Application'], ['slug' => 'mobile-application']);
        $pCatIT = ProjectCategory::updateOrCreate(['name' => 'IT System & Admin'], ['slug' => 'it-system']);
        $pCatAPI = ProjectCategory::updateOrCreate(['name' => 'REST API & Backend'], ['slug' => 'api-backend']);

        $projects = [
            [
                'project_category_id' => $pCatIT->id,
                'title' => 'Nexus Cloud Operations & SysAdmin Dashboard',
                'slug' => 'nexus-cloud-ops',
                'summary' => 'Real-time enterprise server health, CPU/RAM telemetry, active session tracking, and network latency monitoring system.',
                'description' => 'Nexus Cloud Ops is an enterprise dashboard designed for IT infrastructure engineers to monitor Linux & Windows servers, track container health, diagnose network bottlenecks, and dispatch incident alerts in real-time. Built with Vue 3, Element Plus, and Laravel REST APIs.',
                'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://demo-nexus.example.com',
                'github_url' => 'https://github.com/example/nexus-cloud',
                'tags' => ['Vue 3', 'TypeScript', 'Element Plus', 'Laravel', 'MySQL', 'System Administration'],
                'features' => ['Real-time hardware metric streams', 'SSH remote session diagnostics', 'Role-based permission hierarchy', 'Automated incident dispatch webhooks'],
                'client' => 'CloudScale Infrastructure Inc.',
                'start_date' => '2024-01-15',
                'end_date' => '2024-06-30',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1
            ],
            [
                'project_category_id' => $pCatWeb->id,
                'title' => 'OmniFlow SaaS Task & Project Hub',
                'slug' => 'omniflow-project-hub',
                'summary' => 'Collaborative task management platform with Kanban workflows, sprint analytics, and real-time notifications.',
                'description' => 'A scalable project tracking platform supporting multi-tenant teams, drag-and-drop Kanban boards, team permission policies, and time tracking. The frontend utilizes shadcn/ui and Tailwind CSS with Pinia for responsive user interactions.',
                'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://demo-omniflow.example.com',
                'github_url' => 'https://github.com/example/omniflow',
                'tags' => ['Vue 3', 'Tailwind CSS', 'shadcn/ui', 'Laravel', 'Sanctum', 'MySQL'],
                'features' => ['Interactive drag-and-drop Kanban board', 'Sprint velocity & burndown charts', 'File attachment & S3 storage', 'Instant email & WebSocket notifications'],
                'client' => 'Apex Digital Solutions',
                'start_date' => '2023-08-01',
                'end_date' => '2023-12-20',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2
            ],
            [
                'project_category_id' => $pCatAPI->id,
                'title' => 'SecureGate Identity & REST API Gateway',
                'slug' => 'securegate-api',
                'summary' => 'High-throughput authentication gateway providing Sanctum token authorization, rate-limiting, and audit logging.',
                'description' => 'Engineered a centralized API gateway that verifies client signatures, provides OAuth2 & Sanctum token lifecycle handling, inspects malicious payload signatures, and logs every incoming request for compliance auditing.',
                'thumbnail' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://api-docs.example.com',
                'github_url' => 'https://github.com/example/securegate',
                'tags' => ['PHP 8', 'Laravel 11', 'Sanctum', 'REST API', 'Redis', 'MySQL'],
                'features' => ['Sub-15ms response latency', 'Dynamic IP rate limiting & ban rules', 'Granular token permission abilities', 'Automated OpenAPI 3.0 specs'],
                'client' => 'FinSecure Technologies',
                'start_date' => '2023-02-10',
                'end_date' => '2023-07-15',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3
            ],
            [
                'project_category_id' => $pCatMobile->id,
                'title' => 'FieldTech IT Dispatch Mobile Companion',
                'slug' => 'fieldtech-mobile',
                'summary' => 'Mobile field support application for on-site technicians to log repair tickets, scan asset barcodes, and capture signatures.',
                'description' => 'Cross-platform progressive app enabling IT support specialists in the field to view assigned tickets, diagnose network devices, scan QR asset codes, and sync offline resolution notes with the central Laravel server.',
                'thumbnail' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=900&q=80',
                'live_url' => 'https://fieldtech.example.com',
                'github_url' => 'https://github.com/example/fieldtech',
                'tags' => ['Vue 3', 'TypeScript', 'Tailwind CSS', 'PWA', 'REST API'],
                'features' => ['Offline ticket storage & auto-sync', 'Camera barcode / QR code scanner', 'GPS job check-in validation', 'Digital customer sign-off pad'],
                'client' => 'OmniSupport Field Operations',
                'start_date' => '2024-03-01',
                'end_date' => '2024-07-10',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 4
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
