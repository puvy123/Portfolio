<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">
    <!-- Header & GitHub Hub -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
      >
        <FolderGit2 class="w-4 h-4 text-emerald-400" />
        <span>git status --all-repos ({{ filteredProjects.length }} Projects)</span>
      </div>

      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-poppins tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        <span class="text-emerald-400">&lt;</span>Projects & Systems <span class="text-emerald-400">/&gt;</span>
      </h1>

      <p class="text-sm sm:text-base leading-relaxed font-poppins" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        Explore my open-source tools, e-commerce platforms, retail POS systems, GPS tracking dashboards, and full-stack web applications on GitHub.
      </p>

      <!-- GitHub Profile Quick Link -->
      <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
        <a
          href="https://github.com/puvy123"
          target="_blank"
          class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-poppins font-semibold border transition-all duration-200"
          :class="store.isDark
            ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950 hover:border-emerald-400'
            : 'bg-slate-900 text-emerald-400 hover:bg-slate-800'"
        >
          <Github class="w-4 h-4" />
          <span>github.com/puvy123</span>
          <ExternalLink class="w-3 h-3 opacity-70" />
        </a>
      </div>
    </div>

    <!-- Search & Category Filters Bar -->
    <div class="space-y-4 max-w-4xl mx-auto">
      <!-- Search Input -->
      <div class="relative">
        <Search class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2" :class="store.isDark ? 'text-slate-500' : 'text-slate-400'" />
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search repositories by name, tech stack (#Vue, #TypeScript, #POS), or keyword..."
          class="w-full pl-10 pr-10 py-2.5 rounded-xl border text-xs sm:text-sm font-poppins transition-all focus:outline-hidden"
          :class="store.isDark
            ? 'bg-[#0b1120] border-slate-800 text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500'
            : 'bg-white border-slate-300 text-slate-900 placeholder-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-xs'"
        />
        <button
          v-if="searchQuery"
          @click="searchQuery = ''"
          class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-mono text-slate-400 hover:text-slate-200"
        >
          [clear]
        </button>
      </div>

      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2">
        <button
          v-for="cat in availableCategories"
          :key="cat"
          @click="selectedCategory = cat"
          class="px-3.5 py-1.5 rounded-lg text-xs font-poppins font-medium transition-all duration-150 cursor-pointer"
          :class="selectedCategory === cat
            ? (store.isDark ? 'bg-emerald-500 text-slate-950 font-bold shadow-xs shadow-emerald-500/20' : 'bg-slate-900 text-emerald-400 font-bold')
            : (store.isDark ? 'bg-[#0b1120] border border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/40' : 'bg-white border border-slate-300 text-slate-600 hover:text-slate-900 shadow-xs')"
        >
          {{ cat }}
          <span class="ml-1 opacity-70 text-[10px]">
            ({{ getCategoryCount(cat) }})
          </span>
        </button>
      </div>
    </div>

    <!-- Projects Grid -->
    <div v-if="filteredProjects.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="project in filteredProjects"
        :key="project.id"
        class="rounded-xl border overflow-hidden flex flex-col justify-between coder-card group transition-all duration-200"
        :class="store.isDark
          ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/50'
          : 'bg-white border-slate-300 hover:border-emerald-500 shadow-sm'"
      >
        <div>
          <!-- Terminal Title Bar -->
          <div class="px-3 py-2 bg-[#050811] border-b border-slate-800 flex items-center justify-between text-[11px] font-mono text-slate-400">
            <div class="flex items-center gap-1.5">
              <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
              <span class="text-slate-300 font-bold font-mono">{{ project.slug }}</span>
            </div>
            <span v-if="project.category" class="text-emerald-400 text-[10px] font-poppins font-semibold">{{ project.category.name }}</span>
          </div>

          <!-- Thumbnail Image -->
          <div class="relative aspect-video overflow-hidden border-b border-slate-800 bg-[#050811]">
            <img
              :src="project.thumbnail"
              :alt="project.title"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            />
            <div v-if="project.is_featured" class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-md bg-emerald-500/90 text-slate-950 font-bold text-[10px] font-mono shadow-md">
              ★ FEATURED
            </div>
          </div>

          <!-- Content Body -->
          <div class="p-5 space-y-3">
            <h3 class="text-base font-bold font-poppins group-hover:text-emerald-400 transition-colors"
              :class="store.isDark ? 'text-slate-100' : 'text-slate-900'"
            >
              {{ project.title }}
            </h3>
            <p class="text-xs font-poppins line-clamp-2 leading-relaxed"
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
              class="flex-1 py-2 rounded-lg font-bold text-xs font-poppins transition-all text-center cursor-pointer"
              :class="store.isDark
                ? 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950'
                : 'bg-slate-900 text-emerald-400 hover:bg-slate-800'"
            >
              View Details
            </router-link>

            <a
              v-if="project.live_url"
              :href="project.live_url"
              target="_blank"
              class="p-2 rounded-lg border transition-colors cursor-pointer"
              :class="store.isDark ? 'bg-[#050811] border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500' : 'bg-white border-slate-300 text-slate-600 hover:text-slate-900'"
              title="Live Preview / Demo"
            >
              <ExternalLink class="w-4 h-4" />
            </a>

            <a
              v-if="project.github_url"
              :href="project.github_url"
              target="_blank"
              class="p-2 rounded-lg border transition-colors cursor-pointer"
              :class="store.isDark ? 'bg-[#050811] border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500' : 'bg-white border-slate-300 text-slate-600 hover:text-slate-900'"
              title="View GitHub Repository"
            >
              <Github class="w-4 h-4" />
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Empty Search State -->
    <div v-else class="text-center py-16 space-y-4 border rounded-2xl p-8" :class="store.isDark ? 'border-slate-800 bg-[#0b1120]' : 'border-slate-200 bg-white'">
      <FolderGit2 class="w-10 h-10 text-emerald-400 mx-auto opacity-70" />
      <h3 class="text-lg font-bold font-poppins" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">No projects matched your search</h3>
      <p class="text-xs font-poppins text-slate-400 max-w-md mx-auto">
        Try searching with different terms or select "All" categories to view all GitHub repositories.
      </p>
      <button
        @click="searchQuery = ''; selectedCategory = 'All'"
        class="px-4 py-2 rounded-lg bg-emerald-500 text-slate-950 font-poppins font-bold text-xs cursor-pointer"
      >
        Reset Filter
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { usePortfolioStore } from '../store/portfolio';
import { FolderGit2, ExternalLink, Github, Search } from 'lucide-vue-next';
import type { Project } from '../types';

const store = usePortfolioStore();

const searchQuery = ref('');
const selectedCategory = ref('All');

const availableCategories = computed(() => {
  const set = new Set<string>(['All']);
  store.projects.forEach((p: Project) => {
    if (p.category?.name) set.add(p.category.name);
  });
  return Array.from(set);
});

function getCategoryCount(cat: string): number {
  if (cat === 'All') return store.projects.length;
  return store.projects.filter((p: Project) => p.category?.name === cat).length;
}

const filteredProjects = computed(() => {
  let list = store.projects;

  if (selectedCategory.value !== 'All') {
    list = list.filter((p: Project) => p.category?.name === selectedCategory.value);
  }

  if (searchQuery.value.trim()) {
    const q = searchQuery.value.toLowerCase().trim();
    list = list.filter((p: Project) =>
      p.title.toLowerCase().includes(q) ||
      p.slug.toLowerCase().includes(q) ||
      p.summary.toLowerCase().includes(q) ||
      p.description.toLowerCase().includes(q) ||
      p.tags.some((t: string) => t.toLowerCase().includes(q))
    );
  }

  return list;
});
</script>
