<template>
  <section id="experience" class="py-20 relative">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto space-y-4 mb-14">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-mono text-xs font-semibold">
          <Briefcase class="w-3.5 h-3.5" /> Career Journey
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
          Work & <span class="gradient-text-emerald-cyan">Experience Timeline</span>
        </h2>
        <p class="text-slate-400 text-base">
          Proven track record of engineering scalable frontend & backend web systems for tech enterprises.
        </p>
      </div>

      <!-- Timeline Container -->
      <div class="relative border-l-2 border-slate-800 ml-4 sm:ml-8 pl-6 sm:pl-10 space-y-12">
        <div
          v-for="exp in store.experiences"
          :key="exp.id"
          class="relative group"
        >
          <!-- Glowing Timeline Dot -->
          <div
            class="absolute -left-[31px] sm:-left-[47px] top-1.5 w-5 h-5 rounded-full border-4 transition-all duration-300 group-hover:scale-125"
            :class="exp.is_current
              ? 'bg-emerald-400 border-slate-950 shadow-lg shadow-emerald-400/50'
              : 'bg-cyan-500 border-slate-950'"
          ></div>

          <!-- Card Content -->
          <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-cyan-500/40 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/5 space-y-4">
            
            <div class="flex flex-wrap items-center justify-between gap-2">
              <div>
                <h3 class="text-xl font-bold text-slate-100 group-hover:text-cyan-400 transition-colors">
                  {{ exp.role }}
                </h3>
                <div class="text-sm font-semibold text-slate-300 font-mono">
                  {{ exp.company }} <span v-if="exp.location" class="text-slate-500">• {{ exp.location }}</span>
                </div>
              </div>

              <span
                class="px-3 py-1 rounded-full text-xs font-mono font-bold"
                :class="exp.is_current
                  ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40'
                  : 'bg-slate-800 text-slate-400 border border-slate-700'"
              >
                {{ exp.period }}
              </span>
            </div>

            <p class="text-slate-300 text-sm leading-relaxed">
              {{ exp.description }}
            </p>

            <!-- Key Achievements -->
            <div v-if="exp.achievements?.length" class="space-y-1.5 pt-2">
              <div
                v-for="(ach, idx) in exp.achievements"
                :key="idx"
                class="text-xs text-slate-400 flex items-start gap-2"
              >
                <span class="text-emerald-400 font-mono font-bold">›</span>
                <span>{{ ach }}</span>
              </div>
            </div>

            <!-- Tech Badges -->
            <div v-if="exp.technologies?.length" class="flex flex-wrap gap-1.5 pt-3 border-t border-slate-800/60">
              <span
                v-for="tech in exp.technologies"
                :key="tech"
                class="px-2.5 py-0.5 rounded text-xs font-mono bg-slate-800/90 text-cyan-300 border border-slate-700/60"
              >
                {{ tech }}
              </span>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../../store/portfolio';
import { Briefcase } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
