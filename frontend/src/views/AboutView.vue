<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16 font-mono">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
      >
        <User class="w-3.5 h-3.5 text-emerald-400" /> cat /etc/profile
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        <span class="text-emerald-400">&lt;</span>About Me <span class="text-emerald-400">/&gt;</span>
      </h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        // IT Support Specialist, Systems Administrator, and Full-Stack Web & App Developer.
      </p>
    </div>

    <!-- Main About Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
      <!-- Profile Card -->
      <div class="lg:col-span-5 space-y-6">
        <div class="p-6 rounded-2xl border space-y-6"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800 shadow-xl' : 'bg-white border-slate-300 shadow-xs'"
        >
          <!-- Terminal Title Header for Photo -->
          <div class="rounded-xl overflow-hidden border border-slate-800 bg-[#050811]">
            <div class="px-3 py-2 bg-[#050811] border-b border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
              <div class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
              </div>
              <span>avatar.png</span>
            </div>
            <div class="aspect-[3/4] overflow-hidden">
              <img :src="store.profile.avatar || '/profile.jpg'" alt="Avatar" class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500" />
            </div>
          </div>

          <div class="space-y-1">
            <h2 class="text-xl font-bold" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">{{ store.profile.name }}</h2>
            <div class="text-xs text-emerald-400 font-bold">&gt; {{ store.profile.title }}</div>
            <p class="text-xs" :class="store.isDark ? 'text-slate-400' : 'text-slate-500'">{{ store.profile.location }}</p>
          </div>

          <!-- Quick Stats List -->
          <div class="grid grid-cols-2 gap-3 pt-4 border-t text-xs font-mono"
            :class="store.isDark ? 'border-slate-800' : 'border-slate-200'"
          >
            <div class="p-3 rounded-lg border" :class="store.isDark ? 'bg-[#050811] border-slate-800' : 'bg-slate-50 border-slate-300'">
              <span class="block text-[10px] text-slate-500">// experience</span>
              <span class="font-bold text-sm text-emerald-400">{{ store.profile.stats.years_exp }}</span>
            </div>
            <div class="p-3 rounded-lg border" :class="store.isDark ? 'bg-[#050811] border-slate-800' : 'bg-slate-50 border-slate-300'">
              <span class="block text-[10px] text-slate-500">// projects</span>
              <span class="font-bold text-sm text-cyan-400">{{ store.profile.stats.projects_completed }}</span>
            </div>
            <div class="p-3 rounded-lg border" :class="store.isDark ? 'bg-[#050811] border-slate-800' : 'bg-slate-50 border-slate-300'">
              <span class="block text-[10px] text-slate-500">// clients</span>
              <span class="font-bold text-sm text-teal-400">{{ store.profile.stats.happy_clients }}</span>
            </div>
            <div class="p-3 rounded-lg border" :class="store.isDark ? 'bg-[#050811] border-slate-800' : 'bg-slate-50 border-slate-300'">
              <span class="block text-[10px] text-slate-500">// tech_stack</span>
              <span class="font-bold text-sm text-indigo-400">{{ store.profile.stats.technologies_count }}</span>
            </div>
          </div>

          <div class="pt-2">
            <a
              :href="store.profile.cv_url || '#'"
              target="_blank"
              class="w-full py-2.5 rounded-lg font-bold text-xs font-mono flex items-center justify-center gap-2 transition-all cursor-pointer"
              :class="store.isDark ? 'bg-emerald-500 text-slate-950 hover:bg-emerald-400' : 'bg-slate-900 text-emerald-400 hover:bg-slate-800'"
            >
              <Download class="w-4 h-4" /> $ download resume.pdf
            </a>
          </div>
        </div>
      </div>

      <!-- Narrative & Experience Areas -->
      <div class="lg:col-span-7 space-y-6">
        <div class="p-6 sm:p-8 rounded-2xl border space-y-3"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
        >
          <h3 class="text-base font-bold flex items-center gap-2 text-emerald-400">
            <Code2 class="w-5 h-5 text-emerald-400" /> // Professional Summary
          </h3>
          <p class="text-xs sm:text-sm leading-relaxed whitespace-pre-line" :class="store.isDark ? 'text-slate-300' : 'text-slate-700'">
            {{ store.profile.about_me_text || store.profile.bio }}
          </p>
        </div>

        <!-- Experience Domains -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="p-5 rounded-xl border space-y-2 coder-card"
            :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
          >
            <div class="w-9 h-9 rounded-lg border flex items-center justify-center"
              :class="store.isDark ? 'bg-[#050811] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-emerald-600'"
            >
              <Wrench class="w-4 h-4 text-emerald-400" />
            </div>
            <h4 class="font-bold text-sm" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">IT Support & Diagnostics</h4>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
              Hardware troubleshooting, Windows/Linux operating system deployment, active directory administration, and peripheral maintenance.
            </p>
          </div>

          <div class="p-5 rounded-xl border space-y-2 coder-card"
            :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
          >
            <div class="w-9 h-9 rounded-lg border flex items-center justify-center"
              :class="store.isDark ? 'bg-[#050811] border-cyan-500/30 text-cyan-400' : 'bg-slate-100 border-slate-300 text-cyan-600'"
            >
              <Globe class="w-4 h-4 text-cyan-400" />
            </div>
            <h4 class="font-bold text-sm" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">Web Application Engineering</h4>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
              Modern frontend SPAs utilizing Vue 3 Composition API, TypeScript, Tailwind CSS, Pinia, and Element Plus.
            </p>
          </div>

          <div class="p-5 rounded-xl border space-y-2 coder-card"
            :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
          >
            <div class="w-9 h-9 rounded-lg border flex items-center justify-center"
              :class="store.isDark ? 'bg-[#050811] border-teal-500/30 text-teal-400' : 'bg-slate-100 border-slate-300 text-teal-600'"
            >
              <Server class="w-4 h-4 text-teal-400" />
            </div>
            <h4 class="font-bold text-sm" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">Backend & REST APIs</h4>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
              Robust PHP 8+ / Laravel RESTful APIs, Sanctum token authentication, rate limiting, and structured JSON responses.
            </p>
          </div>

          <div class="p-5 rounded-xl border space-y-2 coder-card"
            :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
          >
            <div class="w-9 h-9 rounded-lg border flex items-center justify-center"
              :class="store.isDark ? 'bg-[#050811] border-indigo-500/30 text-indigo-400' : 'bg-slate-100 border-slate-300 text-indigo-600'"
            >
              <Database class="w-4 h-4 text-indigo-400" />
            </div>
            <h4 class="font-bold text-sm" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">Database & SysAdmin</h4>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
              Normalized MySQL/SQLite schemas, query optimization, indexing, 3-2-1 backup solutions, and disaster recovery validation.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Skills Matrix Section -->
    <div class="space-y-6 pt-4">
      <div class="text-center max-w-2xl mx-auto space-y-2">
        <h2 class="text-2xl sm:text-3xl font-bold" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
          <span class="text-emerald-400">skills</span>.map(proficiency)
        </h2>
        <p class="text-xs sm:text-sm" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
          // Frontend, Backend, IT Support, Database Management & System Administration
        </p>
      </div>

      <!-- Skill Category Filter Buttons -->
      <div class="flex flex-wrap items-center justify-center gap-2">
        <button
          v-for="cat in store.skillCategories"
          :key="cat"
          @click="store.activeSkillCategory = cat"
          class="px-3 py-1.5 rounded-lg text-xs font-mono transition-all duration-150 cursor-pointer"
          :class="store.activeSkillCategory === cat
            ? (store.isDark ? 'bg-emerald-500 text-slate-950 font-bold' : 'bg-slate-900 text-emerald-400 font-bold')
            : (store.isDark ? 'bg-[#0b1120] border border-slate-800 text-slate-400 hover:text-emerald-400' : 'bg-white border border-slate-300 text-slate-600 hover:text-slate-900 shadow-xs')"
        >
          {{ cat }}
        </button>
      </div>

      <!-- Skills Grid with Matrix Green Progress Bars -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <div
          v-for="skill in store.filteredSkills"
          :key="skill.id"
          class="p-5 rounded-xl border space-y-3 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
        >
          <div class="flex items-center justify-between">
            <span class="font-bold text-xs" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">{{ skill.name }}</span>
            <span class="text-xs font-mono font-bold text-emerald-400">{{ skill.proficiency }}%</span>
          </div>

          <!-- Progress Bar in Matrix Green -->
          <div class="w-full h-1.5 rounded-full overflow-hidden bg-[#050811] border border-slate-800">
            <div
              class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-teal-400 transition-all duration-700"
              :style="{ width: skill.proficiency + '%' }"
            ></div>
          </div>

          <div class="flex items-center justify-between text-[11px] font-mono text-slate-500">
            <span>{{ typeof skill.category === 'object' ? skill.category?.name : skill.category }}</span>
            <span>{{ skill.experience_years }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../store/portfolio';
import { User, Download, Code2, Wrench, Globe, Server, Database } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
