import { defineStore } from 'pinia';
import { ref } from 'vue';
import { 
  adminLogin, 
  adminLogout, 
  fetchAdminDashboard, 
  fetchAdminResource, 
  createAdminResource, 
  updateAdminResource, 
  deleteAdminResource, 
  toggleMessageReadStatus,
  updateAdminProfile,
  saveAdminSettings
} from '../services/api';
import type { Project, Skill, Service, Experience, Education, Certification, BlogPost, Testimonial, ContactMessage } from '../types';

export const useAdminStore = defineStore('admin', () => {
  const token = ref<string | null>(localStorage.getItem('puvy_admin_token'));
  const user = ref(JSON.parse(localStorage.getItem('puvy_admin_user') || '{"name":"Puvy Admin","email":"admin@puvy.dev"}'));
  const dashboardStats = ref<any>({
    stats: {
      total_projects: 0,
      total_blog_posts: 0,
      total_messages: 0,
      unread_messages: 0,
      total_services: 0,
      total_skills: 0,
      total_experiences: 0,
      total_certifications: 0,
    },
    recent_messages: [],
    recent_projects: [],
  });

  const projects = ref<Project[]>([]);
  const skills = ref<Skill[]>([]);
  const services = ref<Service[]>([]);
  const experiences = ref<Experience[]>([]);
  const educations = ref<Education[]>([]);
  const certifications = ref<Certification[]>([]);
  const blogPosts = ref<BlogPost[]>([]);
  const testimonials = ref<Testimonial[]>([]);
  const contactMessages = ref<ContactMessage[]>([]);
  const settings = ref<Record<string, any>>({});
  const profile = ref<any>({});
  const loading = ref(false);

  function clearPublicCache() {
    if (typeof window !== 'undefined') {
      localStorage.removeItem('puvy_portfolio_cache');
    }
  }

  // Authentication
  async function login(email: string, pass: string): Promise<boolean> {
    try {
      const res = await adminLogin(email, pass);
      if (res.token) {
        token.value = res.token;
        user.value = res.user;
        localStorage.setItem('puvy_admin_token', res.token);
        localStorage.setItem('puvy_admin_user', JSON.stringify(res.user));
        return true;
      }
      return false;
    } catch (err) {
      console.error('Login failed:', err);
      return false;
    }
  }

  async function logout() {
    try {
      await adminLogout();
    } catch (e) {
      // Ignore
    } finally {
      token.value = null;
      localStorage.removeItem('puvy_admin_token');
      localStorage.removeItem('puvy_admin_user');
    }
  }

  // Dashboard Overview
  async function loadDashboard() {
    loading.value = true;
    try {
      const res = await fetchAdminDashboard();
      dashboardStats.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  // Projects CRUD
  async function loadProjects() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<Project>('projects');
      projects.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveProject(project: Partial<Project>) {
    if (project.id) {
      await updateAdminResource('projects', project.id, project);
    } else {
      await createAdminResource('projects', project);
    }
    clearPublicCache();
    await loadProjects();
  }

  async function deleteProject(id: number) {
    await deleteAdminResource('projects', id);
    clearPublicCache();
    await loadProjects();
  }

  // Skills CRUD
  async function loadSkills() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<Skill>('skills');
      skills.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveSkill(skill: Partial<Skill>) {
    if (skill.id) {
      await updateAdminResource('skills', skill.id, skill);
    } else {
      await createAdminResource('skills', skill);
    }
    clearPublicCache();
    await loadSkills();
  }

  async function deleteSkill(id: number) {
    await deleteAdminResource('skills', id);
    clearPublicCache();
    await loadSkills();
  }

  // Services CRUD
  async function loadServices() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<Service>('services');
      services.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveService(service: Partial<Service>) {
    if (service.id) {
      await updateAdminResource('services', service.id, service);
    } else {
      await createAdminResource('services', service);
    }
    clearPublicCache();
    await loadServices();
  }

  async function deleteService(id: number) {
    await deleteAdminResource('services', id);
    clearPublicCache();
    await loadServices();
  }

  // Experiences CRUD
  async function loadExperiences() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<Experience>('experiences');
      experiences.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveExperience(exp: Partial<Experience>) {
    if (exp.id) {
      await updateAdminResource('experiences', exp.id, exp);
    } else {
      await createAdminResource('experiences', exp);
    }
    clearPublicCache();
    await loadExperiences();
  }

  async function deleteExperience(id: number) {
    await deleteAdminResource('experiences', id);
    clearPublicCache();
    await loadExperiences();
  }

  // Education CRUD
  async function loadEducations() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<Education>('educations');
      educations.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveEducation(edu: Partial<Education>) {
    if (edu.id) {
      await updateAdminResource('educations', edu.id, edu);
    } else {
      await createAdminResource('educations', edu);
    }
    clearPublicCache();
    await loadEducations();
  }

  async function deleteEducation(id: number) {
    await deleteAdminResource('educations', id);
    clearPublicCache();
    await loadEducations();
  }

  // Certifications CRUD
  async function loadCertifications() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<Certification>('certifications');
      certifications.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveCertification(cert: Partial<Certification>) {
    if (cert.id) {
      await updateAdminResource('certifications', cert.id, cert);
    } else {
      await createAdminResource('certifications', cert);
    }
    clearPublicCache();
    await loadCertifications();
  }

  async function deleteCertification(id: number) {
    await deleteAdminResource('certifications', id);
    clearPublicCache();
    await loadCertifications();
  }

  // Blog CRUD
  async function loadBlogPosts() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<BlogPost>('blog');
      blogPosts.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveBlogPost(post: Partial<BlogPost>) {
    if (post.id) {
      await updateAdminResource('blog', post.id, post);
    } else {
      await createAdminResource('blog', post);
    }
    clearPublicCache();
    await loadBlogPosts();
  }

  async function deleteBlogPost(id: number) {
    await deleteAdminResource('blog', id);
    clearPublicCache();
    await loadBlogPosts();
  }

  // Testimonials CRUD
  async function loadTestimonials() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<Testimonial>('testimonials');
      testimonials.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveTestimonial(t: Partial<Testimonial>) {
    if (t.id) {
      await updateAdminResource('testimonials', t.id, t);
    } else {
      await createAdminResource('testimonials', t);
    }
    clearPublicCache();
    await loadTestimonials();
  }

  async function deleteTestimonial(id: number) {
    await deleteAdminResource('testimonials', id);
    clearPublicCache();
    await loadTestimonials();
  }

  // Messages Inbox
  async function loadMessages() {
    loading.value = true;
    try {
      const res = await fetchAdminResource<ContactMessage>('messages');
      contactMessages.value = res.data;
    } finally {
      loading.value = false;
    }
  }

  async function toggleMessageRead(id: number) {
    await toggleMessageReadStatus(id);
    await loadMessages();
  }

  async function deleteMessage(id: number) {
    await deleteAdminResource('messages', id);
    await loadMessages();
  }

  // Settings & Profile
  async function loadSettingsAndProfile() {
    loading.value = true;
    try {
      const [settRes, profRes] = await Promise.all([
        fetchAdminResource('settings'),
        fetchAdminResource('profile')
      ]);
      settings.value = settRes.data;
      profile.value = profRes.data;
    } finally {
      loading.value = false;
    }
  }

  async function saveProfile(payload: any) {
    await updateAdminProfile(payload);
    clearPublicCache();
    await loadSettingsAndProfile();
  }

  async function saveSettings(payload: Record<string, any>) {
    await saveAdminSettings(payload);
    clearPublicCache();
    await loadSettingsAndProfile();
  }

  return {
    token,
    user,
    loading,
    dashboardStats,
    projects,
    skills,
    services,
    experiences,
    educations,
    certifications,
    blogPosts,
    testimonials,
    contactMessages,
    settings,
    profile,
    login,
    logout,
    loadDashboard,
    loadProjects,
    saveProject,
    deleteProject,
    loadSkills,
    saveSkill,
    deleteSkill,
    loadServices,
    saveService,
    deleteService,
    loadExperiences,
    saveExperience,
    deleteExperience,
    loadEducations,
    saveEducation,
    deleteEducation,
    loadCertifications,
    saveCertification,
    deleteCertification,
    loadBlogPosts,
    saveBlogPost,
    deleteBlogPost,
    loadTestimonials,
    saveTestimonial,
    deleteTestimonial,
    loadMessages,
    toggleMessageRead,
    deleteMessage,
    loadSettingsAndProfile,
    saveProfile,
    saveSettings,
  };
});
