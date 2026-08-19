<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 flex flex-col md:flex-row font-sans">
    <!-- Sidebar Navigation -->
    <aside class="w-full md:w-64 bg-slate-900/90 border-r border-slate-800 flex flex-col justify-between flex-shrink-0">
      <div class="p-6 space-y-6">
        <!-- Logo -->
        <router-link to="/admin/dashboard" class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-cyan-500 to-indigo-600 flex items-center justify-center text-white font-mono font-bold text-base shadow-lg">
            &lt;/&gt;
          </div>
          <div>
            <span class="font-bold text-slate-100 text-sm tracking-tight block">Admin Console</span>
            <span class="text-[10px] font-mono text-cyan-400">Laravel 11 Sanctum</span>
          </div>
        </router-link>

        <!-- Nav Links -->
        <nav class="space-y-1 text-xs font-mono">
          <router-link
            to="/admin/dashboard"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            :class="$route.path === '/admin/dashboard' || $route.path === '/admin' ? 'bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <LayoutDashboard class="w-4 h-4" /> Overview
          </router-link>

          <router-link
            to="/admin/projects"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/projects' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <FolderGit2 class="w-4 h-4" /> Projects
          </router-link>

          <router-link
            to="/admin/skills"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/skills' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <Layers class="w-4 h-4" /> Skills Matrix
          </router-link>

          <router-link
            to="/admin/services"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/services' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <Wrench class="w-4 h-4" /> Services & IT
          </router-link>

          <router-link
            to="/admin/experience"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/experience' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <Briefcase class="w-4 h-4" /> Experience
          </router-link>

          <router-link
            to="/admin/education"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/education' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <GraduationCap class="w-4 h-4" /> Education
          </router-link>

          <router-link
            to="/admin/certifications"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/certifications' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <Award class="w-4 h-4" /> Certifications
          </router-link>

          <router-link
            to="/admin/blog"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/blog' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <BookOpen class="w-4 h-4" /> Blog Articles
          </router-link>

          <router-link
            to="/admin/testimonials"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/testimonials' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <Quote class="w-4 h-4" /> Testimonials
          </router-link>

          <router-link
            to="/admin/messages"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/messages' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <Mail class="w-4 h-4" /> Inquiries
          </router-link>

          <router-link
            to="/admin/settings"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all"
            active-class="bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold"
            :class="$route.path !== '/admin/settings' && 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'"
          >
            <Settings class="w-4 h-4" /> Settings & Bio
          </router-link>
        </nav>
      </div>

      <!-- User Profile & Logout -->
      <div class="p-6 border-t border-slate-800 space-y-3">
        <div class="flex items-center justify-between text-xs font-mono">
          <div class="truncate">
            <span class="font-bold text-slate-200 block truncate">{{ adminStore.user?.name || 'Puvy' }}</span>
            <span class="text-slate-500 text-[10px] truncate block">{{ adminStore.user?.email || 'admin@puvy.dev' }}</span>
          </div>

          <button
            @click="handleLogout"
            class="p-2 rounded-lg bg-slate-950 border border-slate-800 text-slate-400 hover:text-rose-400 hover:border-rose-500/30 transition-all"
            title="Logout"
          >
            <LogOut class="w-4 h-4" />
          </button>
        </div>

        <router-link
          to="/"
          class="w-full py-2 rounded-lg bg-slate-950 border border-slate-800 text-slate-400 hover:text-cyan-400 text-xs font-mono flex items-center justify-center gap-1.5 transition-colors"
        >
          <ExternalLink class="w-3.5 h-3.5" /> View Public Site
        </router-link>
      </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-6 sm:p-10 overflow-y-auto max-h-screen">
      <router-view />
    </main>
  </div>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router';
import { useAdminStore } from '../../store/admin';
import {
  LayoutDashboard,
  FolderGit2,
  Layers,
  Wrench,
  Briefcase,
  GraduationCap,
  Award,
  BookOpen,
  Quote,
  Mail,
  Settings,
  LogOut,
  ExternalLink
} from 'lucide-vue-next';

const router = useRouter();
const adminStore = useAdminStore();

async function handleLogout() {
  await adminStore.logout();
  router.push('/admin/login');
}
</script>
