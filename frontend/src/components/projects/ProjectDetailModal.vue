<template>
  <el-dialog
    v-model="store.isModalOpen"
    :title="store.selectedProject?.title || 'Project Details'"
    width="90%"
    style="max-width: 720px;"
    :before-close="store.closeProjectModal"
    align-center
  >
    <div v-if="store.selectedProject" class="space-y-6 text-slate-200 font-poppins">
      
      <!-- Project Image Banner -->
      <div class="relative rounded-xl overflow-hidden h-56 border border-slate-800 bg-[#050811]">
        <img
          :src="store.selectedProject.thumbnail"
          :alt="store.selectedProject.title"
          class="w-full h-full object-cover"
        />
      </div>

      <!-- Tech Stack Badges -->
      <div class="flex flex-wrap gap-2">
        <span
          v-for="tag in store.selectedProject.tags"
          :key="tag"
          class="px-3 py-1 rounded-md text-xs font-mono font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/30"
        >
          #{{ tag }}
        </span>
      </div>

      <!-- Detailed Description -->
      <div class="space-y-2">
        <h4 class="text-xs font-semibold font-mono text-emerald-400 uppercase tracking-wider">// Project Overview</h4>
        <p class="text-slate-300 text-xs sm:text-sm leading-relaxed whitespace-pre-line">
          {{ store.selectedProject.description }}
        </p>
      </div>

      <!-- Features List -->
      <div v-if="store.selectedProject.features?.length" class="space-y-2">
        <h4 class="text-xs font-semibold font-mono text-emerald-400 uppercase tracking-wider">// Key Architectural Features</h4>
        <ul class="space-y-2 text-xs sm:text-sm text-slate-300">
          <li
            v-for="(feat, idx) in store.selectedProject.features"
            :key="idx"
            class="flex items-start gap-2"
          >
            <span class="text-emerald-400 font-mono font-bold">✓</span>
            <span>{{ feat }}</span>
          </li>
        </ul>
      </div>

      <!-- Action Links -->
      <div class="pt-4 border-t border-slate-800 flex flex-wrap items-center justify-end gap-3">
        <a
          v-if="store.selectedProject.github_url"
          :href="store.selectedProject.github_url"
          target="_blank"
          class="px-4 py-2 rounded-lg bg-[#0b1120] border border-slate-700 hover:border-emerald-500 text-white text-xs font-poppins font-medium flex items-center gap-2 transition-colors cursor-pointer"
        >
          <Github class="w-4 h-4" /> View GitHub Repository
        </a>
        <a
          v-if="store.selectedProject.live_url"
          :href="store.selectedProject.live_url"
          target="_blank"
          class="px-4 py-2 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs font-poppins flex items-center gap-2 shadow-lg shadow-emerald-500/20 transition-all cursor-pointer"
        >
          <Globe class="w-4 h-4" /> Open Application
        </a>
      </div>

    </div>
  </el-dialog>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../../store/portfolio';
import { Github, Globe } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
