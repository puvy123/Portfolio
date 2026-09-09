<template>
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
      >
        <Briefcase class="w-3.5 h-3.5 text-blue-500" /> Career History
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Work Experience</h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
        Engineering milestones, IT support roles, and systems administration history.
      </p>
    </div>

    <!-- Timeline Container -->
    <div class="relative border-l-2 ml-4 sm:ml-6 pl-6 sm:pl-8 space-y-8"
      :class="store.isDark ? 'border-zinc-800' : 'border-zinc-200'"
    >
      <div
        v-for="(exp, index) in store.experiences"
        :key="exp.id"
        class="relative space-y-3 group"
      >
        <!-- Timeline Marker Dot -->
        <div
          class="absolute -left-[31px] sm:-left-[39px] top-2 w-3.5 h-3.5 rounded-full border-2 transition-transform group-hover:scale-125"
          :class="[
            index === 0 ? 'bg-blue-600 border-white dark:border-zinc-950 ring-2 ring-blue-500/20' : (store.isDark ? 'bg-zinc-700 border-zinc-950' : 'bg-zinc-400 border-white')
          ]"
        ></div>

        <!-- Experience Card -->
        <div class="p-5 sm:p-6 rounded-2xl border space-y-3 transition-all duration-150"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800 hover:border-zinc-700' : 'bg-white border-zinc-200 hover:border-zinc-300 shadow-xs'"
        >
          <div class="flex flex-wrap items-center justify-between gap-2">
            <div>
              <h3 class="text-lg font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
                {{ exp.role }}
              </h3>
              <div class="text-xs font-medium text-blue-600 dark:text-blue-400">
                {{ exp.company }} <span v-if="exp.location" class="opacity-70 font-normal">({{ exp.location }})</span>
              </div>
            </div>

            <div class="px-2.5 py-1 rounded-md border text-xs font-mono"
              :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-400' : 'bg-zinc-50 border-zinc-200 text-zinc-600'"
            >
              {{ exp.period }}
            </div>
          </div>

          <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-300' : 'text-zinc-600'">
            {{ exp.description }}
          </p>

          <!-- Key Achievements -->
          <div v-if="exp.achievements && exp.achievements.length" class="space-y-1.5 pt-2">
            <span class="text-[10px] font-mono uppercase tracking-wider" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Milestones & Impact</span>
            <ul class="space-y-1 text-xs font-mono" :class="store.isDark ? 'text-zinc-300' : 'text-zinc-600'">
              <li v-for="(ach, idx) in exp.achievements" :key="idx" class="flex items-start gap-2">
                <CheckCircle2 class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0 mt-0.5" />
                <span>{{ ach }}</span>
              </li>
            </ul>
          </div>

          <!-- Technologies Used -->
          <div v-if="exp.technologies && exp.technologies.length" class="flex flex-wrap gap-1.5 pt-3 border-t"
            :class="store.isDark ? 'border-zinc-800' : 'border-zinc-100'"
          >
            <span
              v-for="tech in exp.technologies"
              :key="tech"
              class="px-2 py-0.5 rounded-md border text-[11px] font-mono"
              :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-400' : 'bg-zinc-50 border-zinc-200 text-zinc-600'"
            >
              {{ tech }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../store/portfolio';
import { Briefcase, CheckCircle2 } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
