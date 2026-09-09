<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16 font-mono">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
      >
        <Award class="w-3.5 h-3.5 text-emerald-400" /> credentials.verify()
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        <span class="text-emerald-400">&lt;</span>Education & Certs <span class="text-emerald-400">/&gt;</span>
      </h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        // Academic degrees, verified cloud architectures, and IT certifications.
      </p>
    </div>

    <!-- Certifications Grid -->
    <div class="space-y-6">
      <div class="flex items-center gap-2">
        <ShieldCheck class="w-5 h-5 text-emerald-400" />
        <h2 class="text-xl font-bold" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">// Verified Certifications</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="cert in store.certifications"
          :key="cert.id"
          class="p-6 rounded-xl border flex flex-col justify-between space-y-4 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/40' : 'bg-white border-slate-300 shadow-xs'"
        >
          <div class="space-y-3">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg border flex items-center justify-center flex-shrink-0"
                :class="store.isDark ? 'bg-[#050811] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
              >
                <Award class="w-5 h-5 text-emerald-400" />
              </div>
              <div>
                <h3 class="font-bold text-sm" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
                  {{ cert.name }}
                </h3>
                <span class="text-xs text-emerald-400 font-mono">{{ cert.organization }}</span>
              </div>
            </div>

            <div class="space-y-1 text-xs font-mono pt-2 border-t border-slate-800 text-slate-400">
              <div v-if="cert.credential_id">ID: <span class="text-slate-300">{{ cert.credential_id }}</span></div>
              <div v-if="cert.issue_date">Issued: <span class="text-slate-300">{{ cert.issue_date }}</span></div>
              <div v-if="cert.expiration_date">Expires: <span class="text-slate-300">{{ cert.expiration_date }}</span></div>
            </div>
          </div>

          <div v-if="cert.credential_url" class="pt-3 border-t border-slate-800">
            <a
              :href="cert.credential_url"
              target="_blank"
              class="w-full py-2 rounded-lg border font-mono text-xs font-bold transition-colors flex items-center justify-center gap-1.5 cursor-pointer"
              :class="store.isDark
                ? 'bg-[#050811] border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950'
                : 'bg-slate-100 border-slate-300 text-slate-700 hover:bg-slate-900 hover:text-emerald-400'"
            >
              $ verify_cert() <ExternalLink class="w-3.5 h-3.5" />
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Education Section -->
    <div class="space-y-6 pt-4">
      <div class="flex items-center gap-2">
        <GraduationCap class="w-5 h-5 text-emerald-400" />
        <h2 class="text-xl font-bold" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">// Academic Degrees</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
          v-for="edu in store.educations"
          :key="edu.id"
          class="p-6 rounded-xl border space-y-3 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
        >
          <div class="flex items-center justify-between">
            <h3 class="text-base font-bold" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">{{ edu.institution }}</h3>
            <span class="text-xs font-mono px-2 py-0.5 rounded border"
              :class="store.isDark ? 'bg-[#050811] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
            >
              {{ edu.start_date }} - {{ edu.end_date || 'Graduated' }}
            </span>
          </div>

          <div class="text-xs font-mono font-bold text-emerald-400">
            {{ edu.degree }} <span v-if="edu.field">in {{ edu.field }}</span>
          </div>

          <p v-if="edu.description" class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
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
