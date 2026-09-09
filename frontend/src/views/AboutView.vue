<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
      >
        <User class="w-3.5 h-3.5 text-blue-500" /> Professional Profile
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">About Me</h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
        IT Support Specialist, Systems Administrator, and Full-Stack Web & App Developer.
      </p>
    </div>

    <!-- Main About Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
      <!-- Profile Card -->
      <div class="lg:col-span-5 space-y-6">
        <div class="p-6 rounded-2xl border space-y-6"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="aspect-[3/4] rounded-xl overflow-hidden border"
            :class="store.isDark ? 'bg-zinc-950 border-zinc-800' : 'bg-zinc-100 border-zinc-200'"
          >
            <img :src="store.profile.avatar || '/profile.jpg'" alt="Avatar" class="w-full h-full object-cover object-top" />
          </div>

          <div class="space-y-1">
            <h2 class="text-xl font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">{{ store.profile.name }}</h2>
            <div class="text-xs font-medium text-blue-600 dark:text-blue-400">{{ store.profile.title }}</div>
            <p class="text-xs" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-500'">{{ store.profile.location }}</p>
          </div>

          <!-- Quick Stats List -->
          <div class="grid grid-cols-2 gap-3 pt-4 border-t text-xs font-mono"
            :class="store.isDark ? 'border-zinc-800' : 'border-zinc-100'"
          >
            <div class="p-3 rounded-xl border" :class="store.isDark ? 'bg-zinc-950/60 border-zinc-800' : 'bg-zinc-50 border-zinc-200'">
              <span class="block text-[10px]" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Experience</span>
              <span class="font-bold text-sm text-blue-600 dark:text-blue-400">{{ store.profile.stats.years_exp }}</span>
            </div>
            <div class="p-3 rounded-xl border" :class="store.isDark ? 'bg-zinc-950/60 border-zinc-800' : 'bg-zinc-50 border-zinc-200'">
              <span class="block text-[10px]" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Projects</span>
              <span class="font-bold text-sm" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">{{ store.profile.stats.projects_completed }}</span>
            </div>
            <div class="p-3 rounded-xl border" :class="store.isDark ? 'bg-zinc-950/60 border-zinc-800' : 'bg-zinc-50 border-zinc-200'">
              <span class="block text-[10px]" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Happy Clients</span>
              <span class="font-bold text-sm text-emerald-600 dark:text-emerald-400">{{ store.profile.stats.happy_clients }}</span>
            </div>
            <div class="p-3 rounded-xl border" :class="store.isDark ? 'bg-zinc-950/60 border-zinc-800' : 'bg-zinc-50 border-zinc-200'">
              <span class="block text-[10px]" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Technologies</span>
              <span class="font-bold text-sm" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">{{ store.profile.stats.technologies_count }}</span>
            </div>
          </div>

          <div class="pt-2">
            <a
              :href="store.profile.cv_url || '#'"
              target="_blank"
              class="w-full py-2.5 rounded-xl font-semibold text-xs font-mono flex items-center justify-center gap-2 transition-all cursor-pointer"
              :class="store.isDark ? 'bg-white text-zinc-950 hover:bg-zinc-100' : 'bg-zinc-900 text-white hover:bg-zinc-800'"
            >
              <Download class="w-4 h-4" /> Download Official CV
            </a>
          </div>
        </div>
      </div>

      <!-- Narrative & Experience Areas -->
      <div class="lg:col-span-7 space-y-6">
        <div class="p-6 sm:p-8 rounded-2xl border space-y-3"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <h3 class="text-lg font-bold flex items-center gap-2" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
            <Code2 class="w-5 h-5 text-blue-500" /> Professional Summary
          </h3>
          <p class="text-xs sm:text-sm leading-relaxed whitespace-pre-line" :class="store.isDark ? 'text-zinc-300' : 'text-zinc-600'">
            {{ store.profile.about_me_text || store.profile.bio }}
          </p>
        </div>

        <!-- Experience Domains -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="p-5 rounded-2xl border space-y-2"
            :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
          >
            <div class="w-9 h-9 rounded-xl border flex items-center justify-center"
              :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
            >
              <Wrench class="w-4 h-4 text-blue-500" />
            </div>
            <h4 class="font-bold text-sm" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">IT Support & Diagnostics</h4>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
              Hardware troubleshooting, Windows/Linux operating system deployment, active directory administration, and peripheral maintenance.
            </p>
          </div>

          <div class="p-5 rounded-2xl border space-y-2"
            :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
          >
            <div class="w-9 h-9 rounded-xl border flex items-center justify-center"
              :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
            >
              <Globe class="w-4 h-4 text-blue-500" />
            </div>
            <h4 class="font-bold text-sm" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Web Application Engineering</h4>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
              Modern frontend SPAs utilizing Vue 3 Composition API, TypeScript, Tailwind CSS, shadcn/ui, and Element Plus.
            </p>
          </div>

          <div class="p-5 rounded-2xl border space-y-2"
            :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
          >
            <div class="w-9 h-9 rounded-xl border flex items-center justify-center"
              :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
            >
              <Server class="w-4 h-4 text-blue-500" />
            </div>
            <h4 class="font-bold text-sm" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Backend & REST APIs</h4>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
              Robust PHP 8+ / Laravel RESTful APIs, Sanctum token authentication, rate limiting, and structured JSON responses.
            </p>
          </div>

          <div class="p-5 rounded-2xl border space-y-2"
            :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
          >
            <div class="w-9 h-9 rounded-xl border flex items-center justify-center"
              :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
            >
              <Database class="w-4 h-4 text-blue-500" />
            </div>
            <h4 class="font-bold text-sm" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Database & SysAdmin</h4>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
              Normalized MySQL schemas, query optimization, indexing, 3-2-1 backup solutions, and disaster recovery validation.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Skills Matrix Section -->
    <div class="space-y-6 pt-4">
      <div class="text-center max-w-2xl mx-auto space-y-2">
        <h2 class="text-2xl sm:text-3xl font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Technical Skills & Proficiency</h2>
        <p class="text-xs sm:text-sm font-mono" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
          Across Frontend, Backend, IT Support, Database Management & Systems
        </p>
      </div>

      <!-- Skill Category Filter Buttons -->
      <div class="flex flex-wrap items-center justify-center gap-2">
        <button
          v-for="cat in store.skillCategories"
          :key="cat"
          @click="store.activeSkillCategory = cat"
          class="px-3.5 py-1.5 rounded-xl text-xs font-mono transition-colors duration-150 cursor-pointer"
          :class="store.activeSkillCategory === cat
            ? (store.isDark ? 'bg-white text-zinc-950 font-bold' : 'bg-zinc-900 text-white font-bold')
            : (store.isDark ? 'bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-zinc-200' : 'bg-white border border-zinc-200 text-zinc-600 hover:text-zinc-900 shadow-xs')"
        >
          {{ cat }}
        </button>
      </div>

      <!-- Skills Grid with Progress Bars -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <div
          v-for="skill in store.filteredSkills"
          :key="skill.id"
          class="p-5 rounded-2xl border space-y-3 transition-colors"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="flex items-center justify-between">
            <span class="font-semibold text-sm" :class="store.isDark ? 'text-zinc-200' : 'text-zinc-800'">{{ skill.name }}</span>
            <span class="text-xs font-mono font-medium" :class="store.isDark ? 'text-blue-400' : 'text-blue-600'">{{ skill.proficiency }}%</span>
          </div>

          <!-- Progress Bar -->
          <div class="w-full h-1.5 rounded-full overflow-hidden" :class="store.isDark ? 'bg-zinc-800' : 'bg-zinc-100'">
            <div
              class="h-full rounded-full transition-all duration-700"
              :class="store.isDark ? 'bg-blue-500' : 'bg-blue-600'"
              :style="{ width: skill.proficiency + '%' }"
            ></div>
          </div>

          <div class="flex items-center justify-between text-[11px] font-mono" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">
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
