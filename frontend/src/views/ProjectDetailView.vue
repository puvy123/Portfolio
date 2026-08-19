<template>
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Back Button -->
    <div>
      <router-link
        to="/projects"
        class="inline-flex items-center gap-2 text-xs font-mono text-cyan-400 hover:underline"
      >
        <ArrowLeft class="w-4 h-4" /> Back to All Projects
      </router-link>
    </div>

    <div v-if="project" class="space-y-8">
      <!-- Header -->
      <div class="space-y-4">
        <div class="flex flex-wrap items-center gap-3 text-xs font-mono">
          <span v-if="project.category" class="px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400">
            {{ project.category.name }}
          </span>
          <span v-if="project.client" class="text-slate-400">
            Client: <strong class="text-slate-200">{{ project.client }}</strong>
          </span>
          <span v-if="project.start_date" class="text-slate-500">
            Timeline: {{ project.start_date }} → {{ project.end_date || 'Present' }}
          </span>
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-100 tracking-tight">
          {{ project.title }}
        </h1>
        <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
          {{ project.summary }}
        </p>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-wrap items-center gap-4">
        <a
          v-if="project.live_url"
          :href="project.live_url"
          target="_blank"
          class="px-6 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-md flex items-center gap-2 transition-all hover:scale-105"
        >
          <ExternalLink class="w-4 h-4" /> Visit Live Deployment
        </a>
        <a
          v-if="project.github_url"
          :href="project.github_url"
          target="_blank"
          class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 text-slate-200 font-semibold text-xs font-mono flex items-center gap-2 transition-all hover:scale-105"
        >
          <Github class="w-4 h-4" /> View GitHub Repository
        </a>
      </div>

      <!-- Main Thumbnail -->
      <div class="rounded-3xl overflow-hidden bg-slate-950 border border-slate-800 shadow-2xl">
        <img :src="project.thumbnail" :alt="project.title" class="w-full max-h-[500px] object-cover" />
      </div>

      <!-- Gallery (if present) -->
      <div v-if="project.images && project.images.length" class="space-y-4">
        <h3 class="text-lg font-bold text-slate-200">System Screenshots & Gallery</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
          <div
            v-for="img in project.images"
            :key="img.id"
            class="rounded-xl overflow-hidden border border-slate-800 bg-slate-950"
          >
            <img :src="img.image_path" class="w-full h-40 object-cover hover:scale-105 transition-transform" />
          </div>
        </div>
      </div>

      <!-- Narrative & Architecture Description -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-8 p-8 rounded-3xl bg-slate-900/60 border border-slate-800 space-y-4">
          <h3 class="text-xl font-bold text-slate-100">Architecture & Overview</h3>
          <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">
            {{ project.description }}
          </p>

          <div v-if="project.features && project.features.length" class="space-y-3 pt-6 border-t border-slate-800">
            <h4 class="text-sm font-bold font-mono text-slate-200">Key Features & Technical Implementations</h4>
            <ul class="space-y-2 text-xs text-slate-300 font-mono">
              <li v-for="(feat, idx) in project.features" :key="idx" class="flex items-center gap-2">
                <CheckCircle2 class="w-4 h-4 text-cyan-400 flex-shrink-0" />
                <span>{{ feat }}</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Tech Stack Sidebar -->
        <div class="lg:col-span-4 p-6 rounded-3xl bg-slate-900/60 border border-slate-800 space-y-4">
          <h4 class="text-sm font-bold font-mono text-slate-200 uppercase tracking-wider">Technologies Used</h4>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="t in project.tags"
              :key="t"
              class="px-3 py-1.5 rounded-lg bg-slate-950 border border-slate-800 text-xs font-mono text-cyan-300 font-semibold"
            >
              {{ t }}
            </span>
          </div>
        </div>
      </div>
    </div>

    <div v-else class="text-center py-20 space-y-4">
      <h2 class="text-2xl font-bold text-slate-200">Project Not Found</h2>
      <router-link to="/projects" class="text-cyan-400 font-mono text-xs hover:underline">
        ← Return to Portfolio Catalog
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
