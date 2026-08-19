<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
        <Wrench class="w-3.5 h-3.5" /> Professional Capabilities
      </div>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-100 tracking-tight">IT Support & Development Services</h1>
      <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
        Delivering end-to-end technical solutions — from component-level hardware repairs and network configuration to scalable cloud web applications.
      </p>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div
        v-for="srv in store.services"
        :key="srv.id"
        class="p-8 rounded-3xl bg-slate-900/70 border border-slate-800 hover:border-cyan-500/40 transition-all flex flex-col justify-between space-y-6 group hover:shadow-2xl hover:shadow-cyan-500/5"
      >
        <div class="space-y-4">
          <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-cyan-500/20 to-indigo-500/20 border border-cyan-500/30 flex items-center justify-center text-cyan-400 group-hover:scale-110 transition-transform">
            <Terminal v-if="srv.title.includes('OS') || srv.title.includes('Linux')" class="w-7 h-7" />
            <Network v-else-if="srv.title.includes('Network')" class="w-7 h-7" />
            <Globe v-else-if="srv.title.includes('Web')" class="w-7 h-7" />
            <Server v-else-if="srv.title.includes('API') || srv.title.includes('Backend')" class="w-7 h-7" />
            <LayoutDashboard v-else-if="srv.title.includes('Dashboard')" class="w-7 h-7" />
            <Database v-else-if="srv.title.includes('Database')" class="w-7 h-7" />
            <ShieldCheck v-else-if="srv.title.includes('Backup') || srv.title.includes('Asset')" class="w-7 h-7" />
            <Wrench v-else class="w-7 h-7" />
          </div>

          <div class="space-y-2">
            <div class="flex items-center justify-between">
              <h3 class="text-xl font-bold text-slate-100 group-hover:text-cyan-400 transition-colors">{{ srv.title }}</h3>
              <span v-if="srv.price" class="text-xs font-mono font-bold text-emerald-400 px-2 py-1 rounded-md bg-emerald-500/10 border border-emerald-500/20">
                From ${{ srv.price }}
              </span>
            </div>
            <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">{{ srv.description }}</p>
          </div>

          <div v-if="srv.features && srv.features.length" class="space-y-2 pt-4 border-t border-slate-800/80">
            <span class="text-[11px] font-mono uppercase text-slate-500 tracking-wider">Key Deliverables</span>
            <ul class="space-y-2 text-xs text-slate-300 font-mono">
              <li v-for="(feat, idx) in srv.features" :key="idx" class="flex items-center gap-2">
                <CheckCircle2 class="w-4 h-4 text-cyan-400 flex-shrink-0" />
                <span>{{ feat }}</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="pt-4 border-t border-slate-800/80">
          <router-link
            :to="{ path: '/contact', query: { service: srv.title } }"
            class="w-full py-3 rounded-xl bg-slate-950 hover:bg-cyan-500 text-slate-300 hover:text-slate-950 border border-slate-800 hover:border-cyan-400 font-mono text-xs font-bold transition-all flex items-center justify-center gap-2 group-hover:border-cyan-500/30"
          >
            Inquire About Service →
          </router-link>
        </div>
      </div>
    </div>

    <!-- Help Banner -->
    <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-cyan-950/40 via-slate-900/60 to-indigo-950/40 border border-slate-800 text-center space-y-6">
      <h2 class="text-2xl sm:text-3xl font-bold text-slate-100">Need Custom IT Support or Software Engineering?</h2>
      <p class="text-slate-400 text-xs sm:text-sm max-w-xl mx-auto">
        Have an urgent hardware outage, legacy server migration, or custom application build? Let's discuss your technical requirements.
      </p>
      <div>
        <router-link
          to="/contact"
          class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-sm shadow-lg shadow-cyan-500/25 transition-all inline-flex items-center gap-2 hover:scale-105"
        >
          <Mail class="w-4 h-4" /> Get in Touch Today
        </router-link>
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
  CheckCircle2, 
  Mail 
} from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
