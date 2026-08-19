<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
        <Award class="w-3.5 h-3.5" /> Verified Credentials
      </div>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-100 tracking-tight">Education & Certifications</h1>
      <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
        Accredited academic degrees, industry IT certifications, and cloud architecture credentials.
      </p>
    </div>

    <!-- Certifications Grid -->
    <div class="space-y-8">
      <div class="flex items-center gap-2">
        <ShieldCheck class="w-5 h-5 text-cyan-400" />
        <h2 class="text-2xl font-bold text-slate-100">Professional Certifications</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="cert in store.certifications"
          :key="cert.id"
          class="p-6 rounded-3xl bg-slate-900/70 border border-slate-800 hover:border-cyan-500/40 transition-all flex flex-col justify-between space-y-6 group hover:shadow-2xl hover:shadow-cyan-500/5"
        >
          <div class="space-y-4">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 flex-shrink-0">
                <Award class="w-6 h-6" />
              </div>
              <div>
                <h3 class="font-bold text-slate-100 text-base group-hover:text-cyan-400 transition-colors">
                  {{ cert.name }}
                </h3>
                <span class="text-xs font-mono text-cyan-300">{{ cert.organization }}</span>
              </div>
            </div>

            <div class="space-y-1.5 text-xs font-mono text-slate-400 pt-2 border-t border-slate-800/80">
              <div v-if="cert.credential_id">Credential ID: <span class="text-slate-300">{{ cert.credential_id }}</span></div>
              <div v-if="cert.issue_date">Issued: <span class="text-slate-300">{{ cert.issue_date }}</span></div>
              <div v-if="cert.expiration_date">Expires: <span class="text-slate-300">{{ cert.expiration_date }}</span></div>
            </div>
          </div>

          <div v-if="cert.credential_url" class="pt-4 border-t border-slate-800/80">
            <a
              :href="cert.credential_url"
              target="_blank"
              class="w-full py-2.5 rounded-xl bg-slate-950 hover:bg-cyan-500 text-slate-300 hover:text-slate-950 border border-slate-800 hover:border-cyan-400 font-mono text-xs font-bold transition-all flex items-center justify-center gap-2"
            >
              Verify Certificate <ExternalLink class="w-3.5 h-3.5" />
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Education Section -->
    <div class="space-y-8 pt-8">
      <div class="flex items-center gap-2">
        <GraduationCap class="w-5 h-5 text-indigo-400" />
        <h2 class="text-2xl font-bold text-slate-100">Academic Background</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
          v-for="edu in store.educations"
          :key="edu.id"
          class="p-8 rounded-3xl bg-slate-900/70 border border-slate-800 space-y-4 hover:border-indigo-500/40 transition-all"
        >
          <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-slate-100">{{ edu.institution }}</h3>
            <span class="text-xs font-mono text-indigo-400 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/30">
              {{ edu.start_date }} - {{ edu.end_date || 'Graduated' }}
            </span>
          </div>

          <div class="text-sm font-semibold text-cyan-300 font-mono">
            {{ edu.degree }} <span v-if="edu.field">in {{ edu.field }}</span>
          </div>

          <p v-if="edu.description" class="text-xs sm:text-sm text-slate-400 leading-relaxed">
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
