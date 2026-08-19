<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
        <User class="w-3.5 h-3.5" /> Professional Profile
      </div>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-100 tracking-tight">About Me</h1>
      <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
        IT Support Specialist, Systems Administrator, and Full-Stack Web & App Developer.
      </p>
    </div>

    <!-- Main About Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
      <!-- Profile Card -->
      <div class="lg:col-span-5 space-y-6">
        <div class="p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-6 shadow-xl">
          <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-slate-950 border border-slate-800 shadow-inner">
            <img :src="store.profile.avatar || '/profile.jpg'" alt="Avatar" class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500" />
          </div>

          <div class="space-y-2">
            <h2 class="text-2xl font-bold text-slate-100">{{ store.profile.name }}</h2>
            <div class="text-xs font-mono text-cyan-400 font-semibold">{{ store.profile.title }}</div>
            <p class="text-xs text-slate-400 leading-relaxed">{{ store.profile.location }}</p>
          </div>

          <!-- Quick Stats List -->
          <div class="grid grid-cols-2 gap-3 pt-4 border-t border-slate-800 text-xs font-mono">
            <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800">
              <span class="text-slate-500 block text-[10px]">Experience</span>
              <span class="text-cyan-400 font-bold text-sm">{{ store.profile.stats.years_exp }}</span>
            </div>
            <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800">
              <span class="text-slate-500 block text-[10px]">Projects</span>
              <span class="text-indigo-400 font-bold text-sm">{{ store.profile.stats.projects_completed }}</span>
            </div>
            <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800">
              <span class="text-slate-500 block text-[10px]">Happy Clients</span>
              <span class="text-emerald-400 font-bold text-sm">{{ store.profile.stats.happy_clients }}</span>
            </div>
            <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800">
              <span class="text-slate-500 block text-[10px]">Technologies</span>
              <span class="text-purple-400 font-bold text-sm">{{ store.profile.stats.technologies_count }}</span>
            </div>
          </div>

          <div class="pt-2">
            <a
              :href="store.profile.cv_url || '#'"
              target="_blank"
              class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs font-mono shadow-md flex items-center justify-center gap-2 transition-all hover:scale-105"
            >
              <Download class="w-4 h-4" /> Download Official CV
            </a>
          </div>
        </div>
      </div>

      <!-- Narrative & Experience Areas -->
      <div class="lg:col-span-7 space-y-8">
        <div class="p-8 rounded-3xl bg-slate-900/60 border border-slate-800 space-y-4">
          <h3 class="text-xl font-bold text-slate-100 flex items-center gap-2">
            <Code2 class="w-5 h-5 text-cyan-400" /> Professional Summary
          </h3>
          <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">
            {{ store.profile.about_me_text || store.profile.bio }}
          </p>
        </div>

        <!-- Experience Domains -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 space-y-2.5">
            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
              <Wrench class="w-5 h-5" />
            </div>
            <h4 class="font-bold text-slate-100 text-sm">IT Support & Diagnostics</h4>
            <p class="text-xs text-slate-400 leading-relaxed">
              Hardware troubleshooting, Windows/Linux operating system deployment, active directory administration, and peripheral maintenance.
            </p>
          </div>

          <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 space-y-2.5">
            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
              <Globe class="w-5 h-5" />
            </div>
            <h4 class="font-bold text-slate-100 text-sm">Web Application Engineering</h4>
            <p class="text-xs text-slate-400 leading-relaxed">
              Modern frontend SPAs utilizing Vue 3 Composition API, TypeScript, Tailwind CSS, shadcn/ui, and Element Plus.
            </p>
          </div>

          <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 space-y-2.5">
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
              <Server class="w-5 h-5" />
            </div>
            <h4 class="font-bold text-slate-100 text-sm">Backend & REST APIs</h4>
            <p class="text-xs text-slate-400 leading-relaxed">
              Robust PHP 8+ / Laravel RESTful APIs, Sanctum token authentication, rate limiting, and structured JSON responses.
            </p>
          </div>

          <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 space-y-2.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
              <Database class="w-5 h-5" />
            </div>
            <h4 class="font-bold text-slate-100 text-sm">Database & SysAdmin</h4>
            <p class="text-xs text-slate-400 leading-relaxed">
              Normalized MySQL schemas, query optimization, indexing, 3-2-1 backup solutions, and disaster recovery validation.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Skills Matrix Section -->
    <div class="space-y-8 pt-8">
      <div class="text-center max-w-2xl mx-auto space-y-3">
        <h2 class="text-3xl font-extrabold text-slate-100">Technical Skills & Proficiency</h2>
        <p class="text-slate-400 text-xs sm:text-sm font-mono">
          Across Frontend, Backend, IT Support, Database Management & Systems
        </p>
      </div>

      <!-- Skill Category Filter Buttons -->
      <div class="flex flex-wrap items-center justify-center gap-2">
        <button
          v-for="cat in store.skillCategories"
          :key="cat"
          @click="store.activeSkillCategory = cat"
          class="px-4 py-2 rounded-xl text-xs font-mono transition-all"
          :class="store.activeSkillCategory === cat
            ? 'bg-cyan-500 text-slate-950 font-bold shadow-md shadow-cyan-500/20'
            : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-slate-200'"
        >
          {{ cat }}
        </button>
      </div>

      <!-- Skills Grid with Progress Bars -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="skill in store.filteredSkills"
          :key="skill.id"
          class="p-5 rounded-2xl bg-slate-900/60 border border-slate-800 space-y-3 hover:border-cyan-500/40 transition-all"
        >
          <div class="flex items-center justify-between">
            <span class="font-bold text-slate-200 text-sm">{{ skill.name }}</span>
            <span class="text-xs font-mono text-cyan-400 font-semibold">{{ skill.proficiency }}%</span>
          </div>

          <!-- Progress Bar -->
          <div class="w-full h-2 rounded-full bg-slate-800 overflow-hidden">
            <div
              class="h-full rounded-full bg-gradient-to-r from-cyan-500 to-indigo-500 transition-all duration-1000"
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
