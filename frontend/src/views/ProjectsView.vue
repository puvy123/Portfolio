<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
      >
        <FolderGit2 class="w-3.5 h-3.5 text-blue-500" /> Engineering Portfolio
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Featured Projects</h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
        Production-ready web applications, mobile tools, IT monitoring dashboards, and high-performance REST APIs.
      </p>
    </div>

    <!-- Category / Tag Filter Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-2">
      <button
        v-for="tag in store.projectCategories"
        :key="tag"
        @click="store.activeProjectTag = tag"
        class="px-3.5 py-1.5 rounded-xl text-xs font-mono transition-colors duration-150 cursor-pointer"
        :class="store.activeProjectTag === tag
          ? (store.isDark ? 'bg-white text-zinc-950 font-bold' : 'bg-zinc-900 text-white font-bold')
          : (store.isDark ? 'bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-zinc-200' : 'bg-white border border-zinc-200 text-zinc-600 hover:text-zinc-900 shadow-xs')"
      >
        {{ tag }}
      </button>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
      <div
        v-for="project in store.filteredProjects"
        :key="project.id"
        class="rounded-2xl border overflow-hidden flex flex-col justify-between transition-all duration-150 group"
        :class="store.isDark
          ? 'bg-zinc-900/60 border-zinc-800 hover:border-zinc-700'
          : 'bg-white border-zinc-200 hover:border-zinc-300 shadow-xs'"
      >
        <div>
          <!-- Thumbnail Image -->
          <div class="relative aspect-video overflow-hidden border-b" :class="store.isDark ? 'bg-zinc-950 border-zinc-800' : 'bg-zinc-100 border-zinc-200'">
            <img
              :src="project.thumbnail"
              :alt="project.title"
              class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-300"
            />
            <div v-if="project.category" class="absolute top-3 left-3 px-2.5 py-1 rounded-md border text-[10px] font-mono backdrop-blur-md"
              :class="store.isDark ? 'bg-zinc-950/80 border-zinc-800 text-zinc-300' : 'bg-white/90 border-zinc-200 text-zinc-700'"
            >
              {{ project.category.name }}
            </div>
          </div>

          <!-- Content Body -->
          <div class="p-5 space-y-3">
            <div class="space-y-1">
              <h3 class="text-lg font-bold transition-colors" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
                {{ project.title }}
              </h3>
              <p class="text-xs line-clamp-2 leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
                {{ project.summary }}
              </p>
            </div>

            <!-- Tech Badges -->
            <div class="flex flex-wrap gap-1.5 pt-1">
              <span
                v-for="tech in project.tags"
                :key="tech"
                class="px-2 py-0.5 rounded-md border text-[11px] font-mono"
                :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-400' : 'bg-zinc-50 border-zinc-200 text-zinc-600'"
              >
                {{ tech }}
              </span>
            </div>
          </div>
        </div>

        <!-- Action Links -->
        <div class="p-5 pt-0 space-y-3">
          <div class="flex items-center gap-2">
            <router-link
              :to="'/projects/' + project.slug"
              class="flex-1 py-2 rounded-xl font-semibold text-xs font-mono transition-all text-center cursor-pointer"
              :class="store.isDark ? 'bg-white text-zinc-950 hover:bg-zinc-100' : 'bg-zinc-900 text-white hover:bg-zinc-800'"
            >
              View Details
            </router-link>

            <a
              v-if="project.live_url"
              :href="project.live_url"
              target="_blank"
              class="p-2 rounded-xl border transition-colors cursor-pointer"
              :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-white' : 'bg-white border-zinc-200 text-zinc-600 hover:text-zinc-900'"
              title="Live Preview"
            >
              <ExternalLink class="w-4 h-4" />
            </a>

            <a
              v-if="project.github_url"
              :href="project.github_url"
              target="_blank"
              class="p-2 rounded-xl border transition-colors cursor-pointer"
              :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-white' : 'bg-white border-zinc-200 text-zinc-600 hover:text-zinc-900'"
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
