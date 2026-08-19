<template>
  <div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-100 tracking-tight">System Dashboard</h1>
        <p class="text-slate-400 text-xs sm:text-sm font-mono mt-1">
          Laravel 11 REST API & MySQL Database Connected
        </p>
      </div>

      <div class="flex items-center gap-3">
        <router-link
          to="/admin/projects"
          class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-lg shadow-cyan-500/20 transition-all flex items-center gap-2"
        >
          <Plus class="w-4 h-4" /> Add Project
        </router-link>
        <router-link
          to="/admin/blog"
          class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs font-mono shadow-lg shadow-indigo-600/20 transition-all flex items-center gap-2"
        >
          <Plus class="w-4 h-4" /> New Article
        </router-link>
      </div>
    </div>

    <!-- Stats Matrix Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-2">
        <div class="flex items-center justify-between text-slate-400">
          <span class="text-xs font-mono">Total Projects</span>
          <FolderGit2 class="w-5 h-5 text-cyan-400" />
        </div>
        <div class="text-3xl font-bold font-mono text-cyan-400">
          {{ adminStore.dashboardStats?.stats?.total_projects ?? 0 }}
        </div>
        <div class="text-[11px] text-slate-500 font-mono">Published in portfolio showcase</div>
      </div>

      <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-2">
        <div class="flex items-center justify-between text-slate-400">
          <span class="text-xs font-mono">Skill Matrix</span>
          <Layers class="w-5 h-5 text-indigo-400" />
        </div>
        <div class="text-3xl font-bold font-mono text-indigo-400">
          {{ adminStore.dashboardStats?.stats?.total_skills ?? 0 }}
        </div>
        <div class="text-[11px] text-slate-500 font-mono">Across Dev & IT Support</div>
      </div>

      <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-2">
        <div class="flex items-center justify-between text-slate-400">
          <span class="text-xs font-mono">Active Services</span>
          <Wrench class="w-5 h-5 text-emerald-400" />
        </div>
        <div class="text-3xl font-bold font-mono text-emerald-400">
          {{ adminStore.dashboardStats?.stats?.total_services ?? 0 }}
        </div>
        <div class="text-[11px] text-slate-500 font-mono">IT Diagnostics & Engineering</div>
      </div>

      <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-2">
        <div class="flex items-center justify-between text-slate-400">
          <span class="text-xs font-mono">Inquiries</span>
          <Mail class="w-5 h-5 text-amber-400" />
        </div>
        <div class="text-3xl font-bold font-mono text-amber-400">
          {{ adminStore.dashboardStats?.stats?.unread_messages ?? 0 }} / {{ adminStore.dashboardStats?.stats?.total_messages ?? 0 }}
        </div>
        <div class="text-[11px] text-slate-500 font-mono">Unread / Total Messages</div>
      </div>
    </div>

    <!-- Recent Activity & Inquiries -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      <!-- Recent Messages Panel -->
      <div class="lg:col-span-7 p-6 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-4">
        <div class="flex items-center justify-between">
          <h3 class="font-bold text-slate-100 text-sm font-mono flex items-center gap-2">
            <Mail class="w-4 h-4 text-cyan-400" /> Recent Client Inquiries
          </h3>
          <router-link to="/admin/messages" class="text-xs font-mono text-cyan-400 hover:underline">
            View All →
          </router-link>
        </div>

        <div v-if="adminStore.dashboardStats?.recent_messages?.length" class="space-y-3">
          <div
            v-for="msg in adminStore.dashboardStats.recent_messages"
            :key="msg.id"
            class="p-4 rounded-xl border transition-all"
            :class="msg.is_read ? 'bg-slate-950/60 border-slate-800' : 'bg-cyan-500/5 border-cyan-500/30'"
          >
            <div class="flex items-center justify-between text-xs font-mono mb-1">
              <span class="font-bold text-slate-200">{{ msg.name }} &lt;{{ msg.email }}&gt;</span>
              <span class="text-slate-500 text-[10px]">{{ new Date(msg.created_at).toLocaleDateString() }}</span>
            </div>
            <div class="text-xs font-semibold text-slate-300">{{ msg.subject || 'No Subject' }}</div>
            <p class="text-xs text-slate-400 line-clamp-1 mt-1">{{ msg.message }}</p>
          </div>
        </div>
        <div v-else class="text-xs text-slate-500 font-mono py-8 text-center">
          No inquiries received yet.
        </div>
      </div>

      <!-- Recent Projects -->
      <div class="lg:col-span-5 p-6 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-4">
        <div class="flex items-center justify-between">
          <h3 class="font-bold text-slate-100 text-sm font-mono flex items-center gap-2">
            <FolderGit2 class="w-4 h-4 text-indigo-400" /> Recent Projects
          </h3>
          <router-link to="/admin/projects" class="text-xs font-mono text-cyan-400 hover:underline">
            Manage →
          </router-link>
        </div>

        <div v-if="adminStore.dashboardStats?.recent_projects?.length" class="space-y-3">
          <div
            v-for="proj in adminStore.dashboardStats.recent_projects"
            :key="proj.id"
            class="p-3 rounded-xl bg-slate-950/60 border border-slate-800 flex items-center gap-3"
          >
            <img :src="proj.thumbnail" class="w-12 h-12 rounded-lg object-cover bg-slate-900" />
            <div class="flex-1 truncate">
              <h4 class="text-xs font-bold text-slate-200 truncate">{{ proj.title }}</h4>
              <span class="text-[10px] font-mono text-cyan-400">{{ proj.category?.name || 'General' }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { useAdminStore } from '../../store/admin';
import { Plus, FolderGit2, Layers, Wrench, Mail } from 'lucide-vue-next';

const adminStore = useAdminStore();

onMounted(() => {
  adminStore.loadDashboard();
});
</script>
