import { createRouter, createWebHistory } from 'vue-router';

// Public Layout & Views
import PublicLayout from '../views/PublicLayout.vue';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';
import ServicesView from '../views/ServicesView.vue';
import ProjectsView from '../views/ProjectsView.vue';
import ProjectDetailView from '../views/ProjectDetailView.vue';
import ExperienceView from '../views/ExperienceView.vue';
import CertificationsView from '../views/CertificationsView.vue';
import BlogView from '../views/BlogView.vue';
import BlogDetailView from '../views/BlogDetailView.vue';
import ContactView from '../views/ContactView.vue';

// Admin Views
import AdminLoginView from '../views/admin/AdminLoginView.vue';
import AdminLayout from '../views/admin/AdminLayout.vue';
import AdminOverviewView from '../views/admin/AdminOverviewView.vue';
import AdminProjectsView from '../views/admin/AdminProjectsView.vue';
import AdminSkillsView from '../views/admin/AdminSkillsView.vue';
import AdminServicesView from '../views/admin/AdminServicesView.vue';
import AdminExperiencesView from '../views/admin/AdminExperiencesView.vue';
import AdminEducationView from '../views/admin/AdminEducationView.vue';
import AdminCertificationsView from '../views/admin/AdminCertificationsView.vue';
import AdminBlogView from '../views/admin/AdminBlogView.vue';
import AdminTestimonialsView from '../views/admin/AdminTestimonialsView.vue';
import AdminContactsView from '../views/admin/AdminContactsView.vue';
import AdminSettingsView from '../views/admin/AdminSettingsView.vue';

const routes = [
  // Public Portfolio Experience
  {
    path: '/',
    component: PublicLayout,
    children: [
      { path: '', name: 'home', component: HomeView },
      { path: 'about', name: 'about', component: AboutView },
      { path: 'services', name: 'services', component: ServicesView },
      { path: 'projects', name: 'projects', component: ProjectsView },
      { path: 'projects/:slug', name: 'project-detail', component: ProjectDetailView },
      { path: 'experience', name: 'experience', component: ExperienceView },
      { path: 'certifications', name: 'certifications', component: CertificationsView },
      { path: 'blog', name: 'blog', component: BlogView },
      { path: 'blog/:slug', name: 'blog-detail', component: BlogDetailView },
      { path: 'contact', name: 'contact', component: ContactView },
    ]
  },

  // Admin Authentication
  {
    path: '/admin/login',
    name: 'admin-login',
    component: AdminLoginView,
  },

  // Admin Dashboard Experience
  {
    path: '/admin',
    component: AdminLayout,
    meta: { requiresAuth: true },
    children: [
      { path: '', redirect: '/admin/dashboard' },
      { path: 'dashboard', name: 'admin-dashboard', component: AdminOverviewView },
      { path: 'projects', name: 'admin-projects', component: AdminProjectsView },
      { path: 'skills', name: 'admin-skills', component: AdminSkillsView },
      { path: 'services', name: 'admin-services', component: AdminServicesView },
      { path: 'experience', name: 'admin-experience', component: AdminExperiencesView },
      { path: 'education', name: 'admin-education', component: AdminEducationView },
      { path: 'certifications', name: 'admin-certifications', component: AdminCertificationsView },
      { path: 'blog', name: 'admin-blog', component: AdminBlogView },
      { path: 'testimonials', name: 'admin-testimonials', component: AdminTestimonialsView },
      { path: 'messages', name: 'admin-messages', component: AdminContactsView },
      { path: 'settings', name: 'admin-settings', component: AdminSettingsView },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(_to, _from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    }
    return { top: 0, behavior: 'smooth' };
  },
});

// Authentication Guard
router.beforeEach((to, _from, next) => {
  const token = localStorage.getItem('puvy_admin_token');
  if (to.meta.requiresAuth && !token) {
    next({ name: 'admin-login' });
  } else if (to.name === 'admin-login' && token) {
    next({ name: 'admin-dashboard' });
  } else {
    next();
  }
});

export default router;
