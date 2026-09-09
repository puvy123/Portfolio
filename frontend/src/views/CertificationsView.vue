<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
      >
        <Award class="w-3.5 h-3.5 text-blue-500" /> Credentials
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Education & Certifications</h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
        Academic background and industry credentials.
      </p>
    </div>

    <!-- Certifications Grid -->
    <div class="space-y-6">
      <div class="flex items-center gap-2">
        <ShieldCheck class="w-5 h-5 text-blue-500" />
        <h2 class="text-xl sm:text-2xl font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Certifications</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="cert in store.certifications"
          :key="cert.id"
          class="p-6 rounded-2xl border flex flex-col justify-between space-y-4 transition-all duration-150"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800 hover:border-zinc-700' : 'bg-white border-zinc-200 hover:border-zinc-300 shadow-xs'"
        >
          <div class="space-y-3">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl border flex items-center justify-center flex-shrink-0"
                :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
              >
                <Award class="w-5 h-5 text-blue-500" />
              </div>
              <div>
                <h3 class="font-bold text-sm" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
                  {{ cert.name }}
                </h3>
                <span class="text-xs font-mono" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-500'">{{ cert.organization }}</span>
              </div>
            </div>

            <div class="space-y-1 text-xs font-mono pt-2 border-t"
              :class="store.isDark ? 'border-zinc-800 text-zinc-400' : 'border-zinc-100 text-zinc-500'"
            >
              <div v-if="cert.credential_id">ID: <span :class="store.isDark ? 'text-zinc-200' : 'text-zinc-700'">{{ cert.credential_id }}</span></div>
              <div v-if="cert.issue_date">Issued: <span :class="store.isDark ? 'text-zinc-200' : 'text-zinc-700'">{{ cert.issue_date }}</span></div>
              <div v-if="cert.expiration_date">Expires: <span :class="store.isDark ? 'text-zinc-200' : 'text-zinc-700'">{{ cert.expiration_date }}</span></div>
            </div>
          </div>

          <div v-if="cert.credential_url" class="pt-3 border-t" :class="store.isDark ? 'border-zinc-800' : 'border-zinc-100'">
            <a
              :href="cert.credential_url"
              target="_blank"
              class="w-full py-2 rounded-xl border font-mono text-xs font-medium transition-colors flex items-center justify-center gap-1.5 cursor-pointer"
              :class="store.isDark
                ? 'bg-zinc-950 border-zinc-800 text-zinc-300 hover:text-white'
                : 'bg-zinc-50 border-zinc-200 text-zinc-700 hover:text-zinc-900'"
            >
              Verify Certificate <ExternalLink class="w-3.5 h-3.5" />
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Education Section -->
    <div class="space-y-6 pt-4">
      <div class="flex items-center gap-2">
        <GraduationCap class="w-5 h-5 text-blue-500" />
        <h2 class="text-xl sm:text-2xl font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Academic Background</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
          v-for="edu in store.educations"
          :key="edu.id"
          class="p-6 rounded-2xl border space-y-3"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">{{ edu.institution }}</h3>
            <span class="text-xs font-mono px-2.5 py-0.5 rounded-md border"
              :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-400' : 'bg-zinc-50 border-zinc-200 text-zinc-600'"
            >
              {{ edu.start_date }} - {{ edu.end_date || 'Graduated' }}
            </span>
          </div>

          <div class="text-xs font-semibold font-mono text-blue-600 dark:text-blue-400">
            {{ edu.degree }} <span v-if="edu.field">in {{ edu.field }}</span>
          </div>

          <p v-if="edu.description" class="text-xs leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
            {{ edu.description }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../store/portfolio';
import { Award, ShieldCheck, GraduationCap, ExternalLink } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
