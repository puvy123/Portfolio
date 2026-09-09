<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12 font-mono">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
      >
        <FolderGit2 class="w-3.5 h-3.5 text-emerald-400" /> git status --all-repos
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        <span class="text-emerald-400">&lt;</span>Projects & Systems <span class="text-emerald-400">/&gt;</span>
      </h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        // Production web apps, mobile tools, IT monitoring dashboards, and REST APIs.
      </p>
    </div>

    <!-- Category / Tag Filter Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-2">
      <button
        v-for="tag in store.projectCategories"
        :key="tag"
        @click="store.activeProjectTag = tag"
        class="px-3.5 py-1.5 rounded-lg text-xs font-mono transition-all duration-150 cursor-pointer"
        :class="store.activeProjectTag === tag
          ? (store.isDark ? 'bg-emerald-500 text-slate-950 font-bold' : 'bg-slate-900 text-emerald-400 font-bold')
          : (store.isDark ? 'bg-[#0b1120] border border-slate-800 text-slate-400 hover:text-emerald-400' : 'bg-white border border-slate-300 text-slate-600 hover:text-slate-900 shadow-xs')"
      >
        {{ tag }}
      </button>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="project in store.filteredProjects"
        :key="project.id"
        class="rounded-xl border overflow-hidden flex flex-col justify-between coder-card group"
        :class="store.isDark
          ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/50'
          : 'bg-white border-slate-300 hover:border-emerald-500 shadow-sm'"
      >
        <div>
          <!-- Terminal Title Bar -->
          <div class="px-3 py-2 bg-[#050811] border-b border-slate-800 flex items-center justify-between text-[11px] font-mono text-slate-400">
            <div class="flex items-center gap-1.5">
              <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
              <span class="text-slate-300 font-bold">{{ project.slug }}</span>
            </div>
            <span v-if="project.category" class="text-emerald-400 text-[10px]">{{ project.category.name }}</span>
          </div>

          <!-- Thumbnail Image -->
          <div class="relative aspect-video overflow-hidden border-b border-slate-800 bg-[#050811]">
            <img
              :src="project.thumbnail"
              :alt="project.title"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            />
          </div>

          <!-- Content Body -->
          <div class="p-5 space-y-3">
            <h3 class="text-base font-bold group-hover:text-emerald-400 transition-colors font-mono"
              :class="store.isDark ? 'text-slate-100' : 'text-slate-900'"
            >
              {{ project.title }}
            </h3>
            <p class="text-xs line-clamp-2 leading-relaxed"
              :class="store.isDark ? 'text-slate-400' : 'text-slate-600'"
            >
              {{ project.summary }}
            </p>

            <!-- Tech Badges -->
            <div class="flex flex-wrap gap-1.5 pt-1">
              <span
                v-for="tech in project.tags"
                :key="tech"
                class="px-2 py-0.5 rounded border text-[10px] font-mono"
                :class="store.isDark ? 'bg-[#050811] border-emerald-500/20 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
              >
                #{{ tech }}
              </span>
            </div>
          </div>
        </div>

        <!-- Action Links -->
        <div class="p-5 pt-0 space-y-2">
          <div class="flex items-center gap-2">
            <router-link
              :to="'/projects/' + project.slug"
              class="flex-1 py-2 rounded-lg font-bold text-xs font-mono transition-all text-center cursor-pointer"
              :class="store.isDark
                ? 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950'
                : 'bg-slate-900 text-emerald-400 hover:bg-slate-800'"
            >
              $ view details
            </router-link>

            <a
              v-if="project.live_url"
              :href="project.live_url"
              target="_blank"
              class="p-2 rounded-lg border transition-colors cursor-pointer"
              :class="store.isDark ? 'bg-[#050811] border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500' : 'bg-white border-slate-300 text-slate-600 hover:text-slate-900'"
              title="Live Preview"
            >
              <ExternalLink class="w-4 h-4" />
            </a>

            <a
              v-if="project.github_url"
              :href="project.github_url"
              target="_blank"
              class="p-2 rounded-lg border transition-colors cursor-pointer"
              :class="store.isDark ? 'bg-[#050811] border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500' : 'bg-white border-slate-300 text-slate-600 hover:text-slate-900'"
              title="Source Code"
            >
              <Github class="w-4 h-4" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../store/portfolio';
import { FolderGit2, ExternalLink, Github } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
