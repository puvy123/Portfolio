<template>
  <div class="space-y-20 pb-20">
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center justify-center pt-24 pb-16 overflow-hidden">
      <!-- Ambient Background Glows -->
      <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-cyan-500/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
      <div class="absolute bottom-10 right-10 w-[450px] h-[450px] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none -z-10"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          <!-- Hero Text -->
          <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
              <Sparkles class="w-3.5 h-3.5" /> Full-Stack Engineer & IT Specialist
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-100 leading-tight">
              Hi, I'm <span class="bg-gradient-to-r from-cyan-400 via-teal-300 to-indigo-400 bg-clip-text text-transparent">{{ store.profile.name }}</span>
            </h1>

            <p class="text-xl sm:text-2xl font-mono text-cyan-300 font-semibold">
              {{ store.profile.title }}
            </p>

            <p class="text-slate-400 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto lg:mx-0">
              {{ store.profile.bio }}
            </p>

            <!-- CTA Action Buttons -->
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-4">
              <router-link
                to="/projects"
                class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-sm shadow-lg shadow-cyan-500/25 transition-all hover:scale-105 active:scale-95 flex items-center gap-2"
              >
                <FolderGit2 class="w-4 h-4" /> View My Work
              </router-link>

              <router-link
                to="/contact"
                class="px-6 py-3.5 rounded-xl bg-slate-900/90 hover:bg-slate-800 border border-slate-800 hover:border-slate-700 text-slate-200 font-semibold text-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2"
              >
                <Mail class="w-4 h-4 text-cyan-400" /> Contact Me
              </router-link>

              <a
                :href="store.profile.cv_url || '#'"
                target="_blank"
                class="px-6 py-3.5 rounded-xl bg-slate-900/90 hover:bg-slate-800 border border-slate-800 hover:border-slate-700 text-slate-200 font-semibold text-sm transition-all hover:scale-105 active:scale-95 flex items-center gap-2"
              >
                <Download class="w-4 h-4 text-cyan-400" /> Download CV
              </a>
            </div>

            <!-- Social Links -->
            <div class="flex items-center justify-center lg:justify-start gap-3 pt-2">
              <a
                v-for="soc in store.socialLinks"
                :key="soc.id"
                :href="soc.url"
                target="_blank"
                class="p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-slate-400 hover:text-cyan-400 hover:border-cyan-500/30 transition-all hover:scale-110"
                :title="soc.platform"
              >
                <Globe v-if="soc.platform === 'Portfolio'" class="w-4 h-4" />
                <Github v-else-if="soc.platform.toLowerCase().includes('git')" class="w-4 h-4" />
                <Linkedin v-else-if="soc.platform.toLowerCase().includes('link')" class="w-4 h-4" />
                <Send v-else-if="soc.platform.toLowerCase().includes('tele')" class="w-4 h-4" />
                <Twitter v-else-if="soc.platform.toLowerCase().includes('twit') || soc.platform.toLowerCase().includes('x')" class="w-4 h-4" />
                <Facebook v-else-if="soc.platform.toLowerCase().includes('face')" class="w-4 h-4" />
                <Share2 v-else class="w-4 h-4" />
              </a>
            </div>
          </div>

          <!-- Hero Avatar / Visual Card -->
          <div class="lg:col-span-5 flex justify-center">
            <div class="relative group">
              <!-- Ambient Subtle Glowing Background Ring -->
              <div class="absolute -inset-2 bg-gradient-to-r from-cyan-500/30 via-indigo-500/30 to-blue-600/30 rounded-3xl blur-xl opacity-75 group-hover:opacity-100 transition duration-700"></div>
              
              <!-- Floating Experience Badge (Top Right) -->
              <div class="absolute -top-4 -right-4 z-20 px-3.5 py-1.5 rounded-xl bg-slate-900/90 backdrop-blur-md border border-cyan-500/40 text-xs font-mono shadow-xl flex items-center gap-2 animate-bounce">
                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                <span class="font-bold text-slate-200">{{ store.profile.stats.years_exp }}</span>
              </div>

              <!-- Floating Tech Badge (Bottom Left) -->
              <div class="absolute -bottom-4 -left-4 z-20 px-3.5 py-1.5 rounded-xl bg-slate-900/90 backdrop-blur-md border border-indigo-500/40 text-xs font-mono shadow-xl flex items-center gap-2">
                <span class="text-indigo-400 font-bold">IT Specialist & Dev</span>
              </div>

              <!-- Portrait Frame -->
              <div class="relative w-72 sm:w-80 h-[430px] rounded-3xl overflow-hidden bg-slate-900 border border-slate-800/90 p-2 shadow-2xl">
                <img
                  :src="store.profile.avatar || '/profile.jpg'"
                  alt="Professional Portrait"
                  class="w-full h-full object-cover object-top rounded-2xl group-hover:scale-[1.03] transition-transform duration-700"
                />

                <!-- Glassmorphic Status Bar -->
                <div class="absolute bottom-4 left-4 right-4 p-3 rounded-2xl bg-slate-950/85 backdrop-blur-md border border-slate-800 text-xs font-mono shadow-lg">
                  <div class="flex items-center justify-between text-slate-300">
                    <span class="flex items-center gap-2 text-emerald-400 font-bold">
                      <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                      </span>
                      Available for Hire
                    </span>
                    <span class="text-slate-400 text-[11px]">{{ store.profile.location }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Key Statistics Banner (Editable from Admin) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 backdrop-blur-md text-center space-y-1 hover:border-cyan-500/40 transition-all">
          <div class="text-3xl sm:text-4xl font-extrabold font-mono text-cyan-400">{{ store.profile.stats.years_exp }}</div>
          <div class="text-xs sm:text-sm text-slate-400 font-mono">Experience</div>
        </div>
        <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 backdrop-blur-md text-center space-y-1 hover:border-cyan-500/40 transition-all">
          <div class="text-3xl sm:text-4xl font-extrabold font-mono text-indigo-400">{{ store.profile.stats.projects_completed }}</div>
          <div class="text-xs sm:text-sm text-slate-400 font-mono">Projects Done</div>
        </div>
        <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 backdrop-blur-md text-center space-y-1 hover:border-cyan-500/40 transition-all">
          <div class="text-3xl sm:text-4xl font-extrabold font-mono text-emerald-400">{{ store.profile.stats.happy_clients }}</div>
          <div class="text-xs sm:text-sm text-slate-400 font-mono">Happy Clients</div>
        </div>
        <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 backdrop-blur-md text-center space-y-1 hover:border-cyan-500/40 transition-all">
          <div class="text-3xl sm:text-4xl font-extrabold font-mono text-purple-400">{{ store.profile.stats.technologies_count }}</div>
          <div class="text-xs sm:text-sm text-slate-400 font-mono">Tech Stack</div>
        </div>
      </div>
    </section>

    <!-- Services Highlight Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      <div class="text-center max-w-2xl mx-auto space-y-3">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs">
          <Wrench class="w-3.5 h-3.5" /> What I Do
        </div>
        <h2 class="text-3xl font-extrabold text-slate-100">IT Support & Software Services</h2>
        <p class="text-slate-400 text-sm">Providing comprehensive hardware diagnostics, system maintenance, and custom web application engineering.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="srv in store.services.slice(0, 3)"
          :key="srv.id"
          class="p-6 rounded-2xl bg-slate-900/70 border border-slate-800 hover:border-cyan-500/40 transition-all flex flex-col justify-between space-y-4 group"
        >
          <div class="space-y-3">
            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 group-hover:scale-110 transition-transform">
              <Terminal class="w-6 h-6" />
            </div>
            <h3 class="font-bold text-slate-100 text-lg group-hover:text-cyan-400 transition-colors">{{ srv.title }}</h3>
            <p class="text-xs text-slate-400 leading-relaxed">{{ srv.description }}</p>
          </div>

          <ul v-if="srv.features" class="space-y-1.5 text-xs text-slate-300 font-mono pt-2 border-t border-slate-800/80">
            <li v-for="(feat, idx) in srv.features.slice(0, 3)" :key="idx" class="flex items-center gap-2">
              <CheckCircle2 class="w-3.5 h-3.5 text-emerald-400 flex-shrink-0" />
              <span>{{ feat }}</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="text-center pt-4">
        <router-link
          to="/services"
          class="inline-flex items-center gap-2 text-xs font-mono font-bold text-cyan-400 hover:text-cyan-300 hover:underline"
        >
          View All IT Support & Development Services →
        </router-link>
      </div>
    </section>

    <!-- Interactive Developer CLI Terminal Component -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <DeveloperTerminal />
    </section>

    <!-- Testimonials Preview -->
    <section v-if="store.testimonials.length" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      <div class="text-center max-w-2xl mx-auto space-y-3">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs">
          <Quote class="w-3.5 h-3.5" /> Client Reviews
        </div>
        <h2 class="text-3xl font-extrabold text-slate-100">What Clients & Teams Say</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
          v-for="t in store.testimonials"
          :key="t.id"
          class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 space-y-4"
        >
          <div class="flex items-center gap-3">
            <img :src="t.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80'" class="w-12 h-12 rounded-full object-cover border border-cyan-500/30" />
            <div>
              <div class="font-bold text-slate-200 text-sm">{{ t.client_name }}</div>
              <div class="text-xs text-slate-400 font-mono">{{ t.role }} @ {{ t.company }}</div>
            </div>
          </div>
          <p class="text-xs sm:text-sm text-slate-300 italic leading-relaxed">
            "{{ t.content }}"
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../store/portfolio';
import DeveloperTerminal from '../components/terminal/DeveloperTerminal.vue';
import { 
  Sparkles, 
  FolderGit2, 
  Mail, 
  Download, 
  Wrench, 
  Terminal, 
  CheckCircle2, 
  Quote, 
  Github, 
  Linkedin, 
  Send, 
  Twitter, 
  Facebook, 
  Globe, 
  Share2 
} from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
