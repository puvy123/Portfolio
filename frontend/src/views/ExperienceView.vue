<template>
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12 font-mono">
    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
      >
        <Briefcase class="w-3.5 h-3.5 text-emerald-400" /> git log --career
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        <span class="text-emerald-400">&lt;</span>Work Experience <span class="text-emerald-400">/&gt;</span>
      </h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        // Engineering history, IT roles, and system administration milestones.
      </p>
    </div>

    <!-- Timeline Container -->
    <div class="relative border-l-2 ml-4 sm:ml-6 pl-6 sm:pl-8 space-y-8"
      :class="store.isDark ? 'border-emerald-500/30' : 'border-slate-300'"
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
            index === 0 ? 'bg-emerald-400 border-[#050811] ring-4 ring-emerald-500/20' : (store.isDark ? 'bg-slate-700 border-[#050811]' : 'bg-slate-400 border-white')
          ]"
        ></div>

        <!-- Experience Card -->
        <div class="p-5 sm:p-6 rounded-xl border space-y-3 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/40' : 'bg-white border-slate-300 shadow-xs'"
        >
          <div class="flex flex-wrap items-center justify-between gap-2">
            <div>
              <h3 class="text-base font-bold font-mono" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
                {{ exp.role }}
              </h3>
              <div class="text-xs font-mono text-emerald-400">
                @ {{ exp.company }} <span v-if="exp.location" class="text-slate-500 font-normal">({{ exp.location }})</span>
              </div>
            </div>

            <div class="px-2.5 py-0.5 rounded border text-xs font-mono"
              :class="store.isDark ? 'bg-[#050811] border-slate-800 text-slate-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
            >
              {{ exp.period }}
            </div>
          </div>

          <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-300' : 'text-slate-600'">
            {{ exp.description }}
          </p>

          <!-- Key Achievements -->
          <div v-if="exp.achievements && exp.achievements.length" class="space-y-1.5 pt-2">
            <span class="text-[10px] text-slate-500 uppercase tracking-wider">// milestones</span>
            <ul class="space-y-1 text-xs font-mono" :class="store.isDark ? 'text-slate-300' : 'text-slate-700'">
              <li v-for="(ach, idx) in exp.achievements" :key="idx" class="flex items-start gap-2">
                <CheckCircle2 class="w-3.5 h-3.5 text-emerald-400 flex-shrink-0 mt-0.5" />
                <span>{{ ach }}</span>
              </li>
            </ul>
          </div>

          <!-- Technologies Used -->
          <div v-if="exp.technologies && exp.technologies.length" class="flex flex-wrap gap-1.5 pt-3 border-t border-slate-800">
            <span
              v-for="tech in exp.technologies"
              :key="tech"
              class="px-2 py-0.5 rounded border text-[10px] font-mono"
              :class="store.isDark ? 'bg-[#050811] border-emerald-500/20 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
            >
              #{{ tech }}
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
