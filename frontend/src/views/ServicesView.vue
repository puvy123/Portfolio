<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
      >
        <Wrench class="w-3.5 h-3.5 text-blue-500" /> Professional Capabilities
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">IT Support & Services</h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
        Delivering end-to-end technical solutions — from component-level hardware diagnostics to scalable cloud web applications.
      </p>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
      <div
        v-for="srv in store.services"
        :key="srv.id"
        class="p-6 sm:p-8 rounded-2xl border flex flex-col justify-between space-y-6 transition-all duration-150 group"
        :class="store.isDark
          ? 'bg-zinc-900/60 border-zinc-800 hover:border-zinc-700'
          : 'bg-white border-zinc-200 hover:border-zinc-300 shadow-xs'"
      >
        <div class="space-y-4">
          <div class="w-12 h-12 rounded-xl border flex items-center justify-center transition-transform group-hover:scale-105"
            :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
          >
            <Terminal v-if="srv.title.includes('OS') || srv.title.includes('Linux')" class="w-6 h-6 text-blue-500" />
            <Network v-else-if="srv.title.includes('Network')" class="w-6 h-6 text-blue-500" />
            <Globe v-else-if="srv.title.includes('Web')" class="w-6 h-6 text-blue-500" />
            <Server v-else-if="srv.title.includes('API') || srv.title.includes('Backend')" class="w-6 h-6 text-blue-500" />
            <LayoutDashboard v-else-if="srv.title.includes('Dashboard')" class="w-6 h-6 text-blue-500" />
            <Database v-else-if="srv.title.includes('Database')" class="w-6 h-6 text-blue-500" />
            <ShieldCheck v-else-if="srv.title.includes('Backup') || srv.title.includes('Asset')" class="w-6 h-6 text-blue-500" />
            <Wrench v-else class="w-6 h-6 text-blue-500" />
          </div>

          <div class="space-y-2">
            <div class="flex items-center justify-between">
              <h3 class="text-lg font-bold transition-colors" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">{{ srv.title }}</h3>
              <span v-if="srv.price" class="text-xs font-mono font-medium px-2 py-0.5 rounded-md border"
                :class="store.isDark ? 'bg-emerald-950/40 border-emerald-800 text-emerald-300' : 'bg-emerald-50 border-emerald-200 text-emerald-700'"
              >
                From ${{ srv.price }}
              </span>
            </div>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">{{ srv.description }}</p>
          </div>

          <div v-if="srv.features && srv.features.length" class="space-y-2 pt-4 border-t"
            :class="store.isDark ? 'border-zinc-800' : 'border-zinc-100'"
          >
            <span class="text-[10px] font-mono uppercase tracking-wider" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Deliverables</span>
            <ul class="space-y-1.5 text-xs font-mono" :class="store.isDark ? 'text-zinc-300' : 'text-zinc-600'">
              <li v-for="(feat, idx) in srv.features" :key="idx" class="flex items-center gap-2">
                <CheckCircle2 class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" />
                <span>{{ feat }}</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="pt-4 border-t" :class="store.isDark ? 'border-zinc-800' : 'border-zinc-100'">
          <router-link
            :to="{ path: '/contact', query: { service: srv.title } }"
            class="w-full py-2.5 rounded-xl border font-mono text-xs font-semibold transition-all flex items-center justify-center gap-2 cursor-pointer"
            :class="store.isDark
              ? 'bg-zinc-950 border-zinc-800 text-zinc-300 hover:text-white hover:border-zinc-700'
              : 'bg-zinc-50 border-zinc-200 text-zinc-700 hover:text-zinc-900 hover:border-zinc-300'"
          >
            Inquire About Service →
          </router-link>
        </div>
      </div>
    </div>

    <!-- Help Banner -->
    <div class="p-8 sm:p-12 rounded-2xl border text-center space-y-4"
      :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
    >
      <h2 class="text-2xl font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Need Custom IT Support or Software Engineering?</h2>
      <p class="text-xs sm:text-sm max-w-xl mx-auto" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
        Have an urgent hardware outage, server migration, or custom application build? Let's discuss your requirements.
      </p>
      <div class="pt-2">
        <router-link
          to="/contact"
          class="px-6 py-3 rounded-xl font-semibold text-xs font-mono transition-all inline-flex items-center gap-2 cursor-pointer active:scale-98"
          :class="store.isDark ? 'bg-white text-zinc-950 hover:bg-zinc-100' : 'bg-zinc-900 text-white hover:bg-zinc-800'"
        >
          <Mail class="w-4 h-4" /> Get in Touch
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
