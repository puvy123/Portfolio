<template>
  <section id="skills" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto space-y-4 mb-14">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 font-mono text-xs font-semibold">
          <Layers class="w-3.5 h-3.5" /> Technical Expertise
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
          Tech Stack & <span class="gradient-text-cyan-violet">Skills Matrix</span>
        </h2>
        <p class="text-slate-400 text-base">
          Proven proficiency in front-end micro-interfaces, back-end REST architectures, and optimized database storage.
        </p>
      </div>

      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
        <button
          v-for="cat in store.skillCategories"
          :key="cat"
          @click="store.activeSkillCategory = cat"
          class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold font-mono transition-all"
          :class="store.activeSkillCategory === cat
            ? 'bg-cyan-500 text-white shadow-lg shadow-cyan-500/25 scale-105'
            : 'bg-slate-900/80 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-700'"
        >
          {{ cat }}
        </button>
      </div>

      <!-- Skill Grid Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="skill in store.filteredSkills"
          :key="skill.id"
          class="p-5 rounded-2xl bg-slate-900/70 border border-slate-800/80 hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-500/5 group"
        >
          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 font-mono font-bold group-hover:scale-110 transition-transform">
                &lt;/&gt;
              </div>
              <div>
                <h3 class="font-semibold text-slate-100 text-base group-hover:text-cyan-400 transition-colors">
                  {{ skill.name }}
                </h3>
                <span class="text-xs text-slate-400 font-mono">{{ skill.category }} • {{ skill.experience_years }}</span>
              </div>
            </div>
            
            <span class="text-xs font-mono font-bold px-2 py-1 rounded bg-slate-800 text-cyan-300 border border-slate-700">
              {{ skill.proficiency }}%
            </span>
          </div>

          <!-- Progress Bar (Element Plus / Custom hybrid) -->
          <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden mt-4">
            <div
              class="h-full bg-gradient-to-r from-cyan-500 to-indigo-500 rounded-full transition-all duration-1000"
              :style="{ width: `${skill.proficiency}%` }"
            ></div>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../../store/portfolio';
import { Layers } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
