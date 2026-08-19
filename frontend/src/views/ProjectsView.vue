<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
        <FolderGit2 class="w-3.5 h-3.5" /> Engineering Portfolio
      </div>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-100 tracking-tight">Featured Projects & Systems</h1>
      <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
        Production-ready web applications, mobile tools, IT monitoring dashboards, and high-performance REST APIs.
      </p>
    </div>

    <!-- Category / Tag Filter Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-2">
      <button
        v-for="tag in store.projectCategories"
        :key="tag"
        @click="store.activeProjectTag = tag"
        class="px-4 py-2 rounded-xl text-xs font-mono transition-all"
        :class="store.activeProjectTag === tag
          ? 'bg-cyan-500 text-slate-950 font-bold shadow-md shadow-cyan-500/20'
          : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-slate-200'"
      >
        {{ tag }}
      </button>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div
        v-for="project in store.filteredProjects"
        :key="project.id"
        class="rounded-3xl bg-slate-900/70 border border-slate-800 overflow-hidden flex flex-col justify-between hover:border-cyan-500/40 transition-all group hover:shadow-2xl hover:shadow-cyan-500/5"
      >
        <div>
          <!-- Thumbnail Image -->
          <div class="relative aspect-video overflow-hidden bg-slate-950">
            <img
              :src="project.thumbnail"
              :alt="project.title"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-80"></div>
            
            <div v-if="project.category" class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-slate-950/80 backdrop-blur-md border border-slate-800 text-[10px] font-mono text-cyan-400">
              {{ project.category.name }}
            </div>
          </div>

          <!-- Content Body -->
          <div class="p-6 space-y-4">
            <div class="space-y-1">
              <h3 class="text-xl font-bold text-slate-100 group-hover:text-cyan-400 transition-colors">
                {{ project.title }}
              </h3>
              <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                {{ project.summary }}
              </p>
            </div>

            <!-- Tech Badges -->
            <div class="flex flex-wrap gap-1.5 pt-2">
              <span
                v-for="tech in project.tags"
                :key="tech"
                class="px-2 py-0.5 rounded-md bg-slate-950 border border-slate-800 text-[11px] font-mono text-slate-300"
              >
                {{ tech }}
              </span>
            </div>
          </div>
        </div>

        <!-- Action Links -->
        <div class="p-6 pt-0 space-y-3">
          <div class="flex items-center gap-2">
            <router-link
              :to="'/projects/' + project.slug"
              class="flex-1 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-md transition-all text-center"
            >
              View Details
            </router-link>

            <a
              v-if="project.live_url"
              :href="project.live_url"
              target="_blank"
              class="p-2.5 rounded-xl bg-slate-950 hover:bg-slate-800 border border-slate-800 text-slate-300 hover:text-cyan-400 transition-all"
              title="Live Preview"
            >
              <ExternalLink class="w-4 h-4" />
            </a>

            <a
              v-if="project.github_url"
              :href="project.github_url"
              target="_blank"
              class="p-2.5 rounded-xl bg-slate-950 hover:bg-slate-800 border border-slate-800 text-slate-300 hover:text-cyan-400 transition-all"
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
