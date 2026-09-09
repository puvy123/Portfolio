<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16 font-mono">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
      >
        <Wrench class="w-3.5 h-3.5 text-emerald-400" /> system.getServices()
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        <span class="text-emerald-400">&lt;</span>Services & Support <span class="text-emerald-400">/&gt;</span>
      </h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        // Hardware diagnostics, OS deployment, network configuration, and custom web application engineering.
      </p>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="srv in store.services"
        :key="srv.id"
        class="p-6 rounded-xl border flex flex-col justify-between space-y-6 coder-card group"
        :class="store.isDark
          ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/50'
          : 'bg-white border-slate-300 hover:border-emerald-500 shadow-sm'"
      >
        <div class="space-y-4">
          <div class="w-10 h-10 rounded-lg border flex items-center justify-center transition-transform group-hover:scale-105"
            :class="store.isDark ? 'bg-[#050811] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-emerald-600'"
          >
            <Terminal v-if="srv.title.includes('OS') || srv.title.includes('Linux')" class="w-5 h-5 text-emerald-400" />
            <Network v-else-if="srv.title.includes('Network')" class="w-5 h-5 text-emerald-400" />
            <Globe v-else-if="srv.title.includes('Web')" class="w-5 h-5 text-emerald-400" />
            <Server v-else-if="srv.title.includes('API') || srv.title.includes('Backend')" class="w-5 h-5 text-emerald-400" />
            <LayoutDashboard v-else-if="srv.title.includes('Dashboard')" class="w-5 h-5 text-emerald-400" />
            <Database v-else-if="srv.title.includes('Database')" class="w-5 h-5 text-emerald-400" />
            <ShieldCheck v-else-if="srv.title.includes('Backup') || srv.title.includes('Asset')" class="w-5 h-5 text-emerald-400" />
            <Wrench v-else class="w-5 h-5 text-emerald-400" />
          </div>

          <div class="space-y-2">
            <div class="flex items-center justify-between">
              <h3 class="text-base font-bold transition-colors font-mono" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">{{ srv.title }}</h3>
              <span v-if="srv.price" class="text-xs font-mono font-bold text-emerald-400 px-2 py-0.5 rounded border"
                :class="store.isDark ? 'bg-[#050811] border-emerald-500/30' : 'bg-emerald-50 border-emerald-200 text-emerald-700'"
              >
                ${{ srv.price }}+
              </span>
            </div>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">{{ srv.description }}</p>
          </div>

          <div v-if="srv.features && srv.features.length" class="space-y-2 pt-3 border-t border-slate-800">
            <span class="text-[10px] uppercase text-slate-500 tracking-wider">// deliverables</span>
            <ul class="space-y-1.5 text-xs text-slate-300 font-mono">
              <li v-for="(feat, idx) in srv.features" :key="idx" class="flex items-center gap-2">
                <CheckCircle2 class="w-3.5 h-3.5 text-emerald-400 flex-shrink-0" />
                <span :class="store.isDark ? 'text-slate-300' : 'text-slate-700'">{{ feat }}</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="pt-3 border-t border-slate-800">
          <router-link
            :to="{ path: '/contact', query: { service: srv.title } }"
            class="w-full py-2 rounded-lg font-mono text-xs font-bold transition-all flex items-center justify-center gap-2 cursor-pointer border"
            :class="store.isDark
              ? 'bg-[#050811] border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950'
              : 'bg-slate-100 border-slate-300 text-slate-700 hover:bg-slate-900 hover:text-emerald-400'"
          >
            $ request_service(srv) →
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../store/portfolio';
import { 
  Wrench, 
  Terminal, 
  Network, 
  Globe, 
  Server, 
  LayoutDashboard, 
  Database, 
  ShieldCheck, 
  CheckCircle2 
} from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
