<template>
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
        <Briefcase class="w-3.5 h-3.5" /> Career History
      </div>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-100 tracking-tight">Work Experience</h1>
      <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
        Engineering milestones, IT support roles, and systems administration history in reverse chronological order.
      </p>
    </div>

    <!-- Timeline Container -->
    <div class="relative border-l-2 border-slate-800 ml-4 sm:ml-8 pl-6 sm:pl-10 space-y-12">
      <div
        v-for="(exp, index) in store.experiences"
        :key="exp.id"
        class="relative space-y-4 group"
      >
        <!-- Timeline Marker Dot -->
        <div
          class="absolute -left-[31px] sm:-left-[47px] top-1.5 w-4 h-4 rounded-full border-2 border-slate-950 transition-transform group-hover:scale-125"
          :class="index === 0 ? 'bg-cyan-400 ring-4 ring-cyan-500/20' : 'bg-slate-700'"
        ></div>

        <!-- Experience Card -->
        <div class="p-6 sm:p-8 rounded-3xl bg-slate-900/70 border border-slate-800 hover:border-cyan-500/40 transition-all space-y-4 shadow-lg">
          <div class="flex flex-wrap items-center justify-between gap-2">
            <div>
              <h3 class="text-xl font-bold text-slate-100 group-hover:text-cyan-400 transition-colors">
                {{ exp.role }}
              </h3>
              <div class="text-xs sm:text-sm font-mono text-cyan-300 font-semibold">
                {{ exp.company }} <span v-if="exp.location" class="text-slate-500 font-normal">({{ exp.location }})</span>
              </div>
            </div>

            <div class="px-3 py-1 rounded-full bg-slate-950 border border-slate-800 text-xs font-mono text-slate-400">
              {{ exp.period }}
            </div>
          </div>

          <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
            {{ exp.description }}
          </p>

          <!-- Key Achievements -->
          <div v-if="exp.achievements && exp.achievements.length" class="space-y-2 pt-2">
            <span class="text-[11px] font-mono uppercase text-slate-500 tracking-wider">Key Milestones & Impact:</span>
            <ul class="space-y-1.5 text-xs text-slate-300 font-mono">
              <li v-for="(ach, idx) in exp.achievements" :key="idx" class="flex items-start gap-2">
                <CheckCircle2 class="w-4 h-4 text-emerald-400 flex-shrink-0 mt-0.5" />
                <span>{{ ach }}</span>
              </li>
            </ul>
          </div>

          <!-- Technologies Used -->
          <div v-if="exp.technologies && exp.technologies.length" class="flex flex-wrap gap-2 pt-4 border-t border-slate-800/80">
            <span
              v-for="tech in exp.technologies"
              :key="tech"
              class="px-2.5 py-1 rounded-lg bg-slate-950 border border-slate-800 text-[11px] font-mono text-cyan-400"
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
