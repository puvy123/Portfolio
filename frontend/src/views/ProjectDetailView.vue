<template>
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">
    <!-- Back Button -->
    <div>
      <router-link
        to="/projects"
        class="inline-flex items-center gap-2 text-xs font-poppins font-medium text-emerald-400 hover:underline"
      >
        <ArrowLeft class="w-4 h-4" /> Back to All Projects
      </router-link>
    </div>

    <div v-if="project" class="space-y-8">
      <!-- Header -->
      <div class="space-y-4">
        <div class="flex flex-wrap items-center gap-3 text-xs font-poppins">
          <span v-if="project.category" class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-medium">
            {{ project.category.name }}
          </span>
          <span v-if="project.client" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
            Client / Context: <strong :class="store.isDark ? 'text-slate-200' : 'text-slate-900'">{{ project.client }}</strong>
          </span>
          <span v-if="project.start_date" :class="store.isDark ? 'text-slate-500' : 'text-slate-400'">
            Timeline: {{ project.start_date }} → {{ project.end_date || 'Present' }}
          </span>
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-poppins tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
          {{ project.title }}
        </h1>
        <p class="text-sm sm:text-base font-poppins leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
          {{ project.summary }}
        </p>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-wrap items-center gap-4">
        <a
          v-if="project.live_url"
          :href="project.live_url"
          target="_blank"
          class="px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs font-poppins shadow-md flex items-center gap-2 transition-all hover:scale-105 cursor-pointer"
        >
          <ExternalLink class="w-4 h-4" /> Visit Live / Demo
        </a>
        <a
          v-if="project.github_url"
          :href="project.github_url"
          target="_blank"
          class="px-6 py-3 rounded-xl border text-xs font-poppins font-semibold flex items-center gap-2 transition-all hover:scale-105 cursor-pointer"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800 text-slate-200 hover:border-emerald-500/50' : 'bg-white border-slate-300 text-slate-800 hover:border-emerald-500'"
        >
          <Github class="w-4 h-4" /> View on GitHub
        </a>
      </div>

      <!-- Main Thumbnail -->
      <div class="rounded-2xl overflow-hidden border shadow-2xl" :class="store.isDark ? 'bg-[#050811] border-slate-800' : 'bg-slate-100 border-slate-200'">
        <img :src="project.thumbnail" :alt="project.title" class="w-full max-h-[500px] object-cover" />
      </div>

      <!-- Gallery (if present) -->
      <div v-if="project.images && project.images.length" class="space-y-4">
        <h3 class="text-lg font-bold font-poppins" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">Screenshots & Visuals</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
          <div
            v-for="img in project.images"
            :key="img.id"
            class="rounded-xl overflow-hidden border"
            :class="store.isDark ? 'border-slate-800 bg-[#050811]' : 'border-slate-200 bg-white'"
          >
            <img :src="img.image_path" class="w-full h-40 object-cover hover:scale-105 transition-transform" />
          </div>
        </div>
      </div>

      <!-- Narrative & Architecture Description -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-8 p-6 sm:p-8 rounded-2xl border space-y-5" :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-200 shadow-xs'">
          <h3 class="text-xl font-bold font-poppins" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">System Architecture & Overview</h3>
          <p class="text-sm font-poppins leading-relaxed whitespace-pre-line" :class="store.isDark ? 'text-slate-300' : 'text-slate-700'">
            {{ project.description }}
          </p>

          <div v-if="project.features && project.features.length" class="space-y-3 pt-6 border-t" :class="store.isDark ? 'border-slate-800' : 'border-slate-200'">
            <h4 class="text-sm font-bold font-poppins" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">Key Features & Engineering Highlights</h4>
            <ul class="space-y-2.5 text-xs font-poppins" :class="store.isDark ? 'text-slate-300' : 'text-slate-700'">
              <li v-for="(feat, idx) in project.features" :key="idx" class="flex items-start gap-2.5">
                <CheckCircle2 class="w-4 h-4 text-emerald-400 flex-shrink-0 mt-0.5" />
                <span>{{ feat }}</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Tech Stack Sidebar -->
        <div class="lg:col-span-4 p-6 rounded-2xl border space-y-4" :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-200 shadow-xs'">
          <h4 class="text-sm font-bold font-poppins uppercase tracking-wider" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">Technologies Used</h4>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="t in project.tags"
              :key="t"
              class="px-3 py-1.5 rounded-lg border text-xs font-mono font-medium"
              :class="store.isDark ? 'bg-[#050811] border-emerald-500/20 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-800'"
            >
              #{{ t }}
            </span>
          </div>

          <div class="pt-4 border-t space-y-2" :class="store.isDark ? 'border-slate-800' : 'border-slate-200'">
            <a
              v-if="project.github_url"
              :href="project.github_url"
              target="_blank"
              class="w-full py-2.5 rounded-xl border text-xs font-poppins font-medium flex items-center justify-center gap-2 transition-colors cursor-pointer"
              :class="store.isDark ? 'bg-[#050811] border-slate-800 text-slate-300 hover:text-emerald-400 hover:border-emerald-500/40' : 'bg-slate-100 border-slate-300 text-slate-800 hover:text-slate-950'"
            >
              <Github class="w-4 h-4" /> Open GitHub Repo
            </a>
          </div>
        </div>
      </div>
    </div>

    <div v-else class="text-center py-20 space-y-4">
      <h2 class="text-2xl font-bold font-poppins" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">Project Not Found</h2>
      <router-link to="/projects" class="text-emerald-400 font-poppins text-xs hover:underline">
        ← Return to Projects Catalog
      </router-link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import { usePortfolioStore } from '../store/portfolio';
import { ArrowLeft, ExternalLink, Github, CheckCircle2 } from 'lucide-vue-next';
import type { Project } from '../types';

const route = useRoute();
const store = usePortfolioStore();

const project = computed(() => {
  const slug = route.params.slug as string;
  return store.projects.find((p: Project) => p.slug === slug);
});
</script>
