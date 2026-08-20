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
    name: 'PUVY',
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

  const projects = computed<Project[]>(() => data.value?.projects || []);
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
