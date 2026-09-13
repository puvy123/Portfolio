import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import type { PortfolioData, Project, Skill, Experience, Education, Certification, Service, BlogPost, Testimonial, Profile, TerminalLog } from '../types';
import { fetchPortfolioData, fetchBlogPosts, fetchBlogPostBySlug, sendContactForm } from '../services/api';

export const usePortfolioStore = defineStore('portfolio', () => {
  const loading = ref(false);
  const cachedData = typeof window !== 'undefined' ? localStorage.getItem('puvy_portfolio_cache') : null;
  const data = ref<PortfolioData | null>(cachedData ? JSON.parse(cachedData) : null);
  const activeProjectTag = ref<string>('All');
  const activeSkillCategory = ref<string>('All');
  const selectedProject = ref<Project | null>(null);
  const isModalOpen = ref(false);
  const savedTheme = typeof window !== 'undefined' ? localStorage.getItem('portfolio_theme') : null;
  const isDark = ref(savedTheme ? savedTheme === 'dark' : true);
  if (typeof document !== 'undefined') {
    if (isDark.value) {
      document.documentElement.classList.add('dark');
      document.documentElement.classList.remove('light');
    } else {
      document.documentElement.classList.add('light');
      document.documentElement.classList.remove('dark');
    }
  }
  const isTerminalOpen = ref(false);

  // Blog State
  const blogPosts = ref<BlogPost[]>([]);
  const blogLoading = ref(false);
  const selectedArticle = ref<BlogPost | null>(null);
  const relatedArticles = ref<BlogPost[]>([]);

  // Terminal command logs
  const terminalLogs = ref<TerminalLog[]>([
    {
      id: '1',
      command: 'system --version',
      output: 'Developer CLI Engine v3.0 (Vue 3 + TypeScript + Laravel 11 API)',
      type: 'system',
      timestamp: new Date().toLocaleTimeString(),
    },
    {
      id: '2',
      command: 'help',
      output: 'Available commands: help, bio, skills, services, projects, experience, certs, contact, clear, theme, sudo hire-me',
      type: 'info',
      timestamp: new Date().toLocaleTimeString(),
    }
  ]);

  const profile = computed<Profile>(() => data.value?.profile || {
    name: 'PuvY',
    title: 'IT Support Specialist | Full-Stack Web & App Developer',
    bio: 'Building reliable infrastructure and high-performance full-stack applications.',
    about_me_text: 'Experienced IT Professional and Software Engineer.',
    avatar: '/profile.jpg',
    location: 'Cambodia, Tnaot Chum 4 Village, Boeung Tumpun Sangkat, Meanchey Khan, Phnom Penh',
    email: 'khounvyvy@gmail.com',
    github: 'https://github.com/puvy123',
    linkedin: 'https://www.linkedin.com/in/khonn-vy-498743389?utm_source=share_via&utm_content=profile&utm_medium=member_ios',
    cv_url: '/downloads/cv.pdf',
    available_for_hire: true,
    stats: {
      years_exp: '6+ Years',
      projects_completed: '54+ Completed',
      happy_clients: '48+ Clients',
      technologies_count: '28+ Techs',
      code_commits: '3,450+',
      coffee_cups: '1,890 Cups'
    }
  });

  const DEFAULT_PROJECTS: Project[] = [
    {
      id: 1,
      project_category_id: 1,
      category: { id: 1, name: 'E-Commerce & Retail', slug: 'ecommerce-retail' },
      title: 'Helmet - Motorcycle Helmet Store & E-Commerce System',
      slug: 'helmet-store-system',
      summary: 'Full-stack enterprise e-commerce store, motorcycle helmet catalog, inventory controller, and NBC Bakong KHQR digital payment system.',
      description: 'A comprehensive e-commerce platform and inventory management system designed for motorcycle helmet and rider safety gear in Cambodia. Built with Vue 3, TypeScript, and Tailwind CSS.\n\nIntegrates NBC Bakong KHQR dynamic payment generation, shopping cart state management with Pinia, stock level alerts, and an intuitive customer checkout experience.',
      thumbnail: 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=900&q=80',
      live_url: 'https://github.com/puvy123/Helmet',
      github_url: 'https://github.com/puvy123/Helmet',
      tags: ['Vue 3', 'TypeScript', 'Tailwind CSS', 'Pinia', 'Bakong KHQR', 'E-Commerce', 'REST API'],
      features: [
        'Dynamic NBC Bakong KHQR payment QR generation & validation',
        'Interactive shopping cart & checkout flow with Pinia',
        'Inventory stock tracking & low-stock warning alerts',
        'Responsive motorcycle helmet catalog with category filters'
      ],
      client: 'VyCollection Helmets',
      start_date: '2024-04-01',
      end_date: '2024-08-15',
      is_featured: true,
      is_published: true,
      sort_order: 1
    },
    {
      id: 2,
      project_category_id: 2,
      category: { id: 2, name: 'Point of Sale (POS)', slug: 'pos-systems' },
      title: 'MiniMart Pro - Mini Mart POS & Retail Management System',
      slug: 'minimart-pos-system',
      summary: 'Production-ready Point of Sale (POS) and retail management system built for Cambodian retail stores with barcode scanning, cash/KHQR checkout, and inventory tracking.',
      description: 'MINIMART PRO is a production-grade retail POS and inventory management solution engineered for convenience stores and supermarkets.\n\nFeatures rapid product barcode scanning, real-time total and tax computation, multi-currency support (USD / KHR), customer receipt printing, and automated stock deduction.',
      thumbnail: 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?auto=format&fit=crop&w=900&q=80',
      live_url: 'https://github.com/puvy123/miniamrt',
      github_url: 'https://github.com/puvy123/miniamrt',
      tags: ['Vue 3', 'Vite', 'TypeScript', 'Tailwind CSS', 'Pinia', 'POS System', 'Retail', 'REST API'],
      features: [
        'High-speed barcode scanner integration & quick product search',
        'Dual currency handling (USD & KHR) with automated exchange rates',
        'Instant thermal receipt formatting and printing',
        'Real-time daily revenue and cashier shift reconciliation'
      ],
      client: 'MiniMart Retail Network',
      start_date: '2024-02-10',
      end_date: '2024-06-20',
      is_featured: true,
      is_published: true,
      sort_order: 2
    },
    {
      id: 3,
      project_category_id: 3,
      category: { id: 3, name: 'Web Application', slug: 'web-application' },
      title: 'Atlas Pulse - Real-Time GPS Location & Operations Tracker',
      slug: 'location-tracker-atlas',
      summary: 'Real-time location operations dashboard built with React, Vite, Leaflet, and OpenStreetMap for live GPS telemetry and fleet monitoring.',
      description: 'Atlas Pulse is a high-performance interactive location operations dashboard.\n\nIt connects to GPS-enabled devices and geolocation APIs to plot real-time positions on Leaflet/OpenStreetMap tiles, render breadcrumb route histories, trigger geofence boundary alerts, and analyze vehicle speed and transit time metrics.',
      thumbnail: 'https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=900&q=80',
      live_url: 'https://github.com/puvy123/Location-Tracker',
      github_url: 'https://github.com/puvy123/Location-Tracker',
      tags: ['React', 'JavaScript', 'Leaflet', 'OpenStreetMap', 'Node.js', 'Vite', 'GPS & Geolocation'],
      features: [
        'Smooth real-time coordinate streaming & live map pin animations',
        'Custom OpenStreetMap layer styling with dark mode themes',
        'Route history playback with timeline scrubber',
        'Geofencing boundary detection & instant alert notifications'
      ],
      client: 'FleetOps Logistics',
      start_date: '2024-05-01',
      end_date: '2024-07-30',
      is_featured: true,
      is_published: true,
      sort_order: 3
    },
    {
      id: 4,
      project_category_id: 4,
      category: { id: 4, name: 'Tools & Utilities', slug: 'tools-utilities' },
      title: 'YouTube Downloader Pro - Video & Audio Stream Extractor',
      slug: 'youtube-downloader-pro',
      summary: 'Full-stack video metadata retriever and stream converter supporting multiple MP4 resolutions and audio extraction with real-time download progress.',
      description: 'A modern, responsive full-stack utility designed to retrieve media metadata from video streams, provide quality selection (1080p, 720p, 480p, MP3 Audio), and manage safe process execution with automated temporary buffer garbage collection.\n\nBuilt with TypeScript, Node.js, Express, and Tailwind CSS.',
      thumbnail: 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=900&q=80',
      live_url: 'https://github.com/puvy123/Youtube-download',
      github_url: 'https://github.com/puvy123/Youtube-download',
      tags: ['TypeScript', 'Node.js', 'Express', 'Tailwind CSS', 'FFmpeg', 'Media Processing'],
      features: [
        'Automated video stream resolution extraction (1080p to 360p & MP3)',
        'Live conversion progress meter via server-sent events',
        'Safe background process pooling and memory management',
        'Automatic temporary file cleanup post download completion'
      ],
      client: 'Open Source Tool',
      start_date: '2024-06-01',
      end_date: '2024-08-01',
      is_featured: true,
      is_published: true,
      sort_order: 4
    },
    {
      id: 5,
      project_category_id: 3,
      category: { id: 3, name: 'Web Application', slug: 'web-application' },
      title: 'PuvY Developer Portfolio & Headless Admin CMS',
      slug: 'puvy-developer-portfolio',
      summary: 'Production portfolio web application and content management system built with Vue 3 + TypeScript and Laravel 11 Sanctum RESTful API.',
      description: 'The official developer portfolio and personal branding platform for PuvY.\n\nEngineered with a decoupled architecture featuring a Vue 3 + Vite + Tailwind CSS frontend deployed on Vercel, and a Laravel 11 RESTful API backend deployed with Sanctum authentication on Render. Features dark/light mode, live contact form handling, and comprehensive CRUD management.',
      thumbnail: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=900&q=80',
      live_url: 'https://portfolio-puvy.vercel.app',
      github_url: 'https://github.com/puvy123/Portfolio',
      tags: ['Vue 3', 'TypeScript', 'Tailwind CSS', 'Laravel 11', 'Sanctum', 'Vercel', 'Render', 'SQLite'],
      features: [
        'Decoupled SPA architecture with Vue 3 and TypeScript',
        'Laravel 11 Sanctum authenticated administrative dashboard',
        'Interactive developer CLI terminal emulator',
        'Automated Git CI/CD deployment pipelines'
      ],
      client: 'Personal Brand Showcase',
      start_date: '2024-01-01',
      end_date: '2024-09-01',
      is_featured: true,
      is_published: true,
      sort_order: 5
    },
    {
      id: 6,
      project_category_id: 4,
      category: { id: 4, name: 'Tools & Utilities', slug: 'tools-utilities' },
      title: 'CSS Style Generator & Frontend Design Playground',
      slug: 'css-generator-playground',
      summary: 'Interactive developer tool to configure, preview, and generate modern CSS animations, glassmorphism effects, gradients, and box shadows.',
      description: 'An interactive frontend developer workbench that provides visual controls for customizing modern CSS styling rules.\n\nIncludes multi-color linear and radial gradients, glassmorphism blur and backdrop filters, multi-layer box shadows, border-radius morphing, and CSS keyframe animations with one-click copy to clipboard.',
      thumbnail: 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=900&q=80',
      live_url: 'https://github.com/puvy123/CSS-Generator',
      github_url: 'https://github.com/puvy123/CSS-Generator',
      tags: ['CSS3', 'JavaScript', 'HTML5', 'UI/UX Tools', 'Responsive Design'],
      features: [
        'Visual gradient builder with multi-stop color pickers',
        'Glassmorphism backdrop-filter & opacity adjusters',
        'Multi-layered box-shadow depth simulator',
        'Instant code generation with clean CSS snippet export'
      ],
      client: 'Frontend Developers Utility',
      start_date: '2023-11-01',
      end_date: '2024-01-15',
      is_featured: false,
      is_published: true,
      sort_order: 6
    },
    {
      id: 7,
      project_category_id: 2,
      category: { id: 2, name: 'Point of Sale (POS)', slug: 'pos-systems' },
      title: 'Mini POS - Fast Desktop Cashier & Sales System',
      slug: 'mini-pos-checkout',
      summary: 'Lightweight, high-speed point of sale interface tailored for swift item addition, cashier transaction settlement, and sales records.',
      description: 'A lightweight POS application designed for rapid checkout environments.\n\nFeatures instant keyboard hotkey navigation, barcode lookups, discount calculations, split payment options, and daily sales summary exports.',
      thumbnail: 'https://images.unsplash.com/photo-1556742049-0a67e5572263?auto=format&fit=crop&w=900&q=80',
      live_url: 'https://github.com/puvy123/min-pos',
      github_url: 'https://github.com/puvy123/min-pos',
      tags: ['JavaScript', 'Vue.js', 'Tailwind CSS', 'POS Terminal', 'Database'],
      features: [
        'Fast keyboard-driven cashier transaction workflow',
        'Automated discount and item markup calculation',
        'Transaction history logging & receipt reprint',
        'Lightweight footprint optimized for low-spec POS hardware'
      ],
      client: 'Retail POS Systems',
      start_date: '2023-09-01',
      end_date: '2023-12-10',
      is_featured: false,
      is_published: true,
      sort_order: 7
    },
    {
      id: 8,
      project_category_id: 5,
      category: { id: 5, name: 'Open Source & Libraries', slug: 'open-source' },
      title: 'Element Plus Vue 3 Custom Themes & Components',
      slug: 'element-plus-custom',
      summary: 'Enterprise Vue.js 3 UI component toolkit customized with dark coder theme variables, customized dialogs, and table enhancements.',
      description: 'Customization and extension of the Element Plus UI component library for Vue 3.\n\nTailored specifically for dark cyberpunk and modern coder UI palettes, providing seamless integration with Tailwind CSS utility classes and TypeScript interfaces.',
      thumbnail: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=900&q=80',
      live_url: 'https://element-plus.org',
      github_url: 'https://github.com/puvy123/element-plus',
      tags: ['Vue 3', 'TypeScript', 'Element Plus', 'SCSS', 'Component Library'],
      features: [
        'Custom SCSS design tokens & dark mode color variables',
        'Optimized data table with virtual scroll and filtering',
        'Modular dialog and notification component presets'
      ],
      client: 'Open Source Community',
      start_date: '2023-05-01',
      end_date: '2023-08-20',
      is_featured: false,
      is_published: true,
      sort_order: 8
    }
  ];

  const projects = computed<Project[]>(() => (data.value?.projects && data.value.projects.length > 0) ? data.value.projects : DEFAULT_PROJECTS);
  const skills = computed<Skill[]>(() => data.value?.skills || []);
  const services = computed<Service[]>(() => data.value?.services || []);
  const experiences = computed<Experience[]>(() => data.value?.experiences || []);
  const educations = computed<Education[]>(() => data.value?.educations || []);
  const certifications = computed<Certification[]>(() => data.value?.certifications || []);
  const testimonials = computed<Testimonial[]>(() => data.value?.testimonials || []);
  const socialLinks = computed(() => data.value?.social_links || []);

  // Filtered projects
  const projectCategories = computed<string[]>(() => {
    const set = new Set<string>(['All']);
    projects.value.forEach((p) => {
      if (p.category?.name) set.add(p.category.name);
      p.tags?.forEach((t) => set.add(t));
    });
    return Array.from(set);
  });

  const projectTags = projectCategories;

  const filteredProjects = computed<Project[]>(() => {
    if (activeProjectTag.value === 'All') return projects.value;
    return projects.value.filter((p) => 
      p.category?.name === activeProjectTag.value || p.tags?.includes(activeProjectTag.value)
    );
  });

  // Skill categories
  const skillCategories = computed<string[]>(() => {
    const set = new Set<string>(['All']);
    if (data.value?.skill_categories) {
      data.value.skill_categories.forEach((c) => set.add(c.name));
    }
    return Array.from(set);
  });

  const filteredSkills = computed<Skill[]>(() => {
    if (activeSkillCategory.value === 'All') return skills.value;
    return skills.value.filter((s) => {
      const catName = typeof s.category === 'object' ? s.category?.name : s.category;
      return catName === activeSkillCategory.value;
    });
  });

  async function loadPortfolio() {
    try {
      const res = await fetchPortfolioData();
      if (res && res.data) {
        data.value = res.data;
        if (typeof window !== 'undefined') {
          localStorage.setItem('puvy_portfolio_cache', JSON.stringify(res.data));
        }
      }
    } catch (err) {
      console.warn('Backend API warming up, using current state:', err);
    } finally {
      loading.value = false;
    }
  }

  async function loadBlog(params?: { category?: string; search?: string }) {
    blogLoading.value = true;
    try {
      const res = await fetchBlogPosts(params);
      blogPosts.value = res.data;
    } catch (err) {
      console.error('Failed to load blog posts:', err);
    } finally {
      blogLoading.value = false;
    }
  }

  async function loadArticle(slug: string) {
    blogLoading.value = true;
    try {
      const res = await fetchBlogPostBySlug(slug);
      selectedArticle.value = res.data;
      relatedArticles.value = res.related;
    } catch (err) {
      console.error('Failed to load article:', err);
    } finally {
      blogLoading.value = false;
    }
  }

  async function submitContact(payload: { name: string; email: string; subject?: string; message: string }) {
    return await sendContactForm(payload);
  }

  function openProjectModal(project: Project) {
    selectedProject.value = project;
    isModalOpen.value = true;
  }

  function closeProjectModal() {
    isModalOpen.value = false;
    selectedProject.value = null;
  }

  function toggleTheme() {
    isDark.value = !isDark.value;
    if (typeof document !== 'undefined') {
      if (isDark.value) {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
        localStorage.setItem('portfolio_theme', 'dark');
      } else {
        document.documentElement.classList.add('light');
        document.documentElement.classList.remove('dark');
        localStorage.setItem('portfolio_theme', 'light');
      }
    }
  }

  function executeTerminalCommand(input: string) {
    const cmd = input.trim().toLowerCase();
    const ts = new Date().toLocaleTimeString();

    if (!cmd) return;

    if (cmd === 'clear') {
      terminalLogs.value = [];
      return;
    }

    let output = '';
    let type: 'info' | 'success' | 'error' | 'warning' | 'system' = 'info';

    switch (cmd) {
      case 'help':
        output = `Command Index:\n  • bio          : Show developer background info\n  • skills       : Output core tech stack matrix\n  • services     : List IT Support & Web Dev services\n  • projects     : List key portfolio applications\n  • experience   : Display career milestones\n  • certs        : Show active professional certifications\n  • contact      : Print contact details & email\n  • theme        : Toggle dark/light aesthetic mode\n  • sudo hire-me : Priority recruitment request\n  • clear        : Clear console output`;
        type = 'info';
        break;
      case 'bio':
      case 'whoami':
        output = `${profile.value.name} - ${profile.value.title}\n${profile.value.bio}\nLocation: ${profile.value.location}`;
        type = 'success';
        break;
      case 'skills':
        output = skills.value.map((s) => `• ${s.name} (${s.proficiency}%)`).join('\n');
        type = 'success';
        break;
      case 'services':
        output = services.value.map((srv) => `[${srv.title}] - ${srv.description}`).join('\n');
        type = 'info';
        break;
      case 'projects':
        output = projects.value.map((p) => `• ${p.title} -> [${p.tags?.join(', ') || ''}]\n  Live: ${p.live_url || 'N/A'}`).join('\n\n');
        type = 'success';
        break;
      case 'experience':
        output = experiences.value.map((e) => `[${e.period}] ${e.role} @ ${e.company}\n  ${e.description}`).join('\n\n');
        type = 'info';
        break;
      case 'certs':
        output = certifications.value.map((c) => `🏅 ${c.name} (${c.organization})`).join('\n');
        type = 'success';
        break;
      case 'contact':
        output = `Email: ${profile.value.settings?.contact_email || profile.value.email || 'puvy.developer@example.com'}\nPhone: ${profile.value.settings?.contact_phone || '+1 (555) 234-5678'}\nTelegram: ${profile.value.settings?.telegram_username || '@puvydev'}\nStatus: Ready for new opportunities!`;
        type = 'success';
        break;
      case 'theme':
        toggleTheme();
        output = `Theme switched to ${isDark.value ? 'Cyber Dark' : 'Clean Light'} mode.`;
        type = 'system';
        break;
      case 'sudo hire-me':
      case 'hire':
        output = `🚀 [SUPERUSER ACCESS GRANTED]\nDirect Contact: ${profile.value.settings?.contact_email || profile.value.email || 'puvy.developer@example.com'}\nLet's build scalable systems together!`;
        type = 'warning';
        break;
      default:
        output = `command not found: "${input}". Type 'help' for available commands.`;
        type = 'error';
        break;
    }

    terminalLogs.value.push({
      id: Date.now().toString(),
      command: input,
      output,
      type,
      timestamp: ts,
    });
  }

  return {
    loading,
    data,
    profile,
    projects,
    skills,
    services,
    experiences,
    educations,
    certifications,
    testimonials,
    socialLinks,
    projectCategories,
    projectTags,
    activeProjectTag,
    filteredProjects,
    skillCategories,
    activeSkillCategory,
    filteredSkills,
    selectedProject,
    isModalOpen,
    isDark,
    isTerminalOpen,
    terminalLogs,
    blogPosts,
    blogLoading,
    selectedArticle,
    relatedArticles,
    loadPortfolio,
    loadBlog,
    loadArticle,
    submitContact,
    openProjectModal,
    closeProjectModal,
    toggleTheme,
    executeTerminalCommand,
  };
});
