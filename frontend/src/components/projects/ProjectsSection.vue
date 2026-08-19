<template>
  <section id="projects" class="py-20 bg-slate-950/50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto space-y-4 mb-14">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
          <FolderGit2 class="w-3.5 h-3.5" /> Featured Work
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
          Portfolio & <span class="gradient-text-cyan-violet">Projects Showcase</span>
        </h2>
        <p class="text-slate-400 text-base">
          Explore real-world web applications built with Vue 3 TS, Element Plus, Shadcn-vue, Laravel 11, and MySQL.
        </p>
      </div>

      <!-- Tag Filter Buttons -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
        <button
          v-for="tag in store.projectTags"
          :key="tag"
          @click="store.activeProjectTag = tag"
          class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold font-mono transition-all"
          :class="store.activeProjectTag === tag
            ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg shadow-cyan-500/20 scale-105'
            : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-700'"
        >
          {{ tag }}
        </button>
      </div>

      <!-- Projects Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="project in store.filteredProjects"
          :key="project.id"
          class="group rounded-2xl bg-slate-900/80 border border-slate-800/90 overflow-hidden flex flex-col hover:border-cyan-500/50 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-cyan-500/10"
        >
          <!-- Thumbnail Image Container -->
          <div class="relative h-48 overflow-hidden bg-slate-950">
            <img
              :src="project.thumbnail"
              :alt="project.title"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-80"></div>
            
            <div class="absolute top-3 right-3 flex items-center gap-2">
              <span
                v-if="project.is_featured"
                class="px-2.5 py-1 rounded-full text-xs font-mono font-semibold bg-cyan-500/90 text-slate-950 shadow-md"
              >
                ★ Featured
              </span>
            </div>
          </div>

          <!-- Content Body -->
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div>
              <h3 class="text-xl font-bold text-slate-100 group-hover:text-cyan-400 transition-colors">
                {{ project.title }}
              </h3>
              <p class="text-slate-400 text-sm mt-2 leading-relaxed line-clamp-2">
                {{ project.summary }}
              </p>
            </div>

            <!-- Tech Badges -->
            <div class="flex flex-wrap gap-1.5">
              <span
                v-for="t in project.tags"
                :key="t"
                class="px-2.5 py-0.5 rounded-md text-xs font-mono bg-slate-800/90 text-cyan-300 border border-slate-700/60"
              >
                {{ t }}
              </span>
            </div>

            <!-- Actions Row -->
            <div class="pt-4 border-t border-slate-800/80 flex items-center justify-between">
              <button
                @click="store.openProjectModal(project)"
                class="text-xs font-semibold font-mono text-cyan-400 hover:text-cyan-300 flex items-center gap-1 group-hover:underline"
              >
                Inspect Details <ExternalLink class="w-3.5 h-3.5" />
              </button>

              <div class="flex items-center gap-3">
                <a
                  v-if="project.github_url"
                  :href="project.github_url"
                  target="_blank"
                  class="text-slate-400 hover:text-white transition-colors"
                  title="View GitHub Source"
                >
                  <Github class="w-4 h-4" />
                </a>
                <a
                  v-if="project.live_url"
                  :href="project.live_url"
                  target="_blank"
                  class="text-slate-400 hover:text-cyan-400 transition-colors"
                  title="View Live Demo"
                >
                  <Globe class="w-4 h-4" />
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../../store/portfolio';
import { FolderGit2, ExternalLink, Github, Globe } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
