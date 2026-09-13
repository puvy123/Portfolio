<template>
  <section id="projects" class="py-20 relative" :class="store.isDark ? 'bg-[#050811]/60' : 'bg-slate-50/70'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto space-y-4 mb-12">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full border font-poppins text-xs font-semibold"
          :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-white border-slate-300 text-slate-700 shadow-xs'"
        >
          <FolderGit2 class="w-3.5 h-3.5 text-emerald-400" /> Featured Repositories
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold font-poppins tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
          Portfolio & <span class="text-emerald-400">Projects Showcase</span>
        </h2>
        <p class="font-poppins text-sm sm:text-base leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
          Production e-commerce platforms, retail POS systems, GPS tracking dashboards, and media tools built with Vue 3, TypeScript, and Laravel.
        </p>
      </div>

      <!-- Tag Filter Buttons -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
        <button
          v-for="tag in store.projectTags"
          :key="tag"
          @click="store.activeProjectTag = tag"
          class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold font-poppins transition-all cursor-pointer"
          :class="store.activeProjectTag === tag
            ? (store.isDark ? 'bg-emerald-500 text-slate-950 font-bold shadow-lg shadow-emerald-500/20' : 'bg-slate-900 text-emerald-400 font-bold shadow-md')
            : (store.isDark ? 'bg-[#0b1120] border border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/30' : 'bg-white border border-slate-300 text-slate-600 hover:text-slate-900 shadow-xs')"
        >
          {{ tag }}
        </button>
      </div>

      <!-- Projects Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="project in store.filteredProjects"
          :key="project.id"
          class="group rounded-2xl border overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl coder-card"
          :class="store.isDark
            ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/50 hover:shadow-emerald-500/10'
            : 'bg-white border-slate-300 hover:border-emerald-500 shadow-sm'"
        >
          <!-- Thumbnail Image Container -->
          <div class="relative h-48 overflow-hidden bg-[#050811]">
            <img
              :src="project.thumbnail"
              :alt="project.title"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-[#050811] via-transparent to-transparent opacity-70"></div>
            
            <div class="absolute top-3 right-3 flex items-center gap-2">
              <span
                v-if="project.is_featured"
                class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-emerald-500 text-slate-950 shadow-md"
              >
                ★ FEATURED
              </span>
            </div>
          </div>

          <!-- Content Body -->
          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div>
              <h3 class="text-lg font-bold font-poppins group-hover:text-emerald-400 transition-colors"
                :class="store.isDark ? 'text-slate-100' : 'text-slate-900'"
              >
                {{ project.title }}
              </h3>
              <p class="text-xs font-poppins mt-2 leading-relaxed line-clamp-2"
                :class="store.isDark ? 'text-slate-400' : 'text-slate-600'"
              >
                {{ project.summary }}
              </p>
            </div>

            <!-- Tech Badges -->
            <div class="flex flex-wrap gap-1.5">
              <span
                v-for="t in project.tags"
                :key="t"
                class="px-2 py-0.5 rounded text-[10px] font-mono border"
                :class="store.isDark ? 'bg-[#050811] border-emerald-500/20 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
              >
                #{{ t }}
              </span>
            </div>

            <!-- Actions Row -->
            <div class="pt-4 border-t flex items-center justify-between" :class="store.isDark ? 'border-slate-800/80' : 'border-slate-200'">
              <router-link
                :to="'/projects/' + project.slug"
                class="text-xs font-semibold font-poppins text-emerald-400 hover:text-emerald-300 flex items-center gap-1 group-hover:underline"
              >
                Details <ExternalLink class="w-3.5 h-3.5" />
              </router-link>

              <div class="flex items-center gap-3">
                <a
                  v-if="project.github_url"
                  :href="project.github_url"
                  target="_blank"
                  class="p-1.5 rounded-lg border transition-colors cursor-pointer"
                  :class="store.isDark ? 'border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/50' : 'border-slate-300 text-slate-600 hover:text-slate-950'"
                  title="View GitHub Repository"
                >
                  <Github class="w-4 h-4" />
                </a>
                <a
                  v-if="project.live_url"
                  :href="project.live_url"
                  target="_blank"
                  class="p-1.5 rounded-lg border transition-colors cursor-pointer"
                  :class="store.isDark ? 'border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/50' : 'border-slate-300 text-slate-600 hover:text-slate-950'"
                  title="View Live Demo"
                >
                  <Globe class="w-4 h-4" />
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- View All Projects Button -->
      <div class="text-center mt-12">
        <router-link
          to="/projects"
          class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-poppins font-bold text-xs shadow-lg shadow-emerald-500/20 transition-all hover:scale-105"
        >
          <FolderGit2 class="w-4 h-4" /> Explore All GitHub Projects
        </router-link>
      </div>

    </div>
  </section>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../../store/portfolio';
import { FolderGit2, ExternalLink, Github, Globe } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
