<template>
  <div class="space-y-24 pb-20">
    <!-- Hero Section -->
    <section class="relative min-h-[85vh] flex items-center justify-center pt-16 pb-12 overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          <!-- Hero Text -->
          <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border text-xs font-mono font-medium transition-colors"
              :class="store.isDark 
                ? 'bg-zinc-900 border-zinc-800 text-zinc-300' 
                : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
            >
              <Sparkles class="w-3.5 h-3.5 text-blue-500" /> Full-Stack Engineer & IT Specialist
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight"
              :class="store.isDark ? 'text-zinc-50' : 'text-zinc-900'"
            >
              Hi, I'm <span class="text-blue-600 dark:text-blue-400">{{ store.profile.name }}</span>
            </h1>

            <p class="text-lg sm:text-xl font-medium"
              :class="store.isDark ? 'text-zinc-300' : 'text-zinc-700'"
            >
              {{ store.profile.title }}
            </p>

            <p class="text-sm sm:text-base leading-relaxed max-w-2xl mx-auto lg:mx-0"
              :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'"
            >
              {{ store.profile.bio }}
            </p>

            <!-- CTA Action Buttons -->
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-3">
              <router-link
                to="/projects"
                class="px-5 py-3 rounded-xl font-semibold text-sm transition-all duration-150 flex items-center gap-2 cursor-pointer shadow-xs active:scale-98"
                :class="store.isDark
                  ? 'bg-white text-zinc-950 hover:bg-zinc-100'
                  : 'bg-zinc-900 text-white hover:bg-zinc-800'"
              >
                <FolderGit2 class="w-4 h-4" /> View Projects
              </router-link>

              <router-link
                to="/contact"
                class="px-5 py-3 rounded-xl border font-semibold text-sm transition-all duration-150 flex items-center gap-2 cursor-pointer active:scale-98"
                :class="store.isDark
                  ? 'bg-zinc-900 border-zinc-800 text-zinc-200 hover:bg-zinc-800'
                  : 'bg-white border-zinc-300 text-zinc-800 hover:bg-zinc-50'"
              >
                <Mail class="w-4 h-4 text-zinc-500" /> Contact Me
              </router-link>

              <a
                :href="store.profile.cv_url || '#'"
                target="_blank"
                class="px-5 py-3 rounded-xl border font-semibold text-sm transition-all duration-150 flex items-center gap-2 cursor-pointer active:scale-98"
                :class="store.isDark
                  ? 'bg-zinc-900 border-zinc-800 text-zinc-200 hover:bg-zinc-800'
                  : 'bg-white border-zinc-300 text-zinc-800 hover:bg-zinc-50'"
              >
                <Download class="w-4 h-4 text-zinc-500" /> Resume
              </a>
            </div>

            <!-- Social Links -->
            <div class="flex items-center justify-center lg:justify-start gap-2.5 pt-2">
              <a
                v-for="soc in store.socialLinks"
                :key="soc.id"
                :href="soc.url"
                target="_blank"
                class="p-2.5 rounded-xl border transition-colors duration-150"
                :class="store.isDark
                  ? 'bg-zinc-900 border-zinc-800 text-zinc-400 hover:text-white hover:border-zinc-700'
                  : 'bg-white border-zinc-200 text-zinc-600 hover:text-zinc-900 hover:border-zinc-300'"
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
              <!-- Floating Experience Badge (Top Right) -->
              <div class="absolute -top-3 -right-3 z-20 px-3 py-1.5 rounded-xl border text-xs font-mono shadow-sm flex items-center gap-2"
                :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-200' : 'bg-white border-zinc-200 text-zinc-800'"
              >
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                <span class="font-bold">{{ store.profile.stats.years_exp }} Experience</span>
              </div>

              <!-- Portrait Frame -->
              <div class="relative w-72 sm:w-80 h-[420px] rounded-2xl overflow-hidden border p-2 shadow-lg"
                :class="store.isDark ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-zinc-200'"
              >
                <img
                  :src="store.profile.avatar || '/profile.jpg'"
                  alt="Professional Portrait"
                  class="w-full h-full object-cover object-top rounded-xl"
                />

                <!-- Status Bar -->
                <div class="absolute bottom-4 left-4 right-4 p-3 rounded-xl border text-xs font-mono backdrop-blur-md"
                  :class="store.isDark ? 'bg-zinc-950/85 border-zinc-800 text-zinc-300' : 'bg-white/90 border-zinc-200 text-zinc-700'"
                >
                  <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 font-medium" :class="store.isDark ? 'text-emerald-400' : 'text-emerald-600'">
                      <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                      Available for Hire
                    </span>
                    <span class="text-[11px] opacity-70">{{ store.profile.location }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Key Statistics Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="p-6 rounded-2xl border text-center space-y-1 transition-colors"
          :class="store.isDark ? 'bg-zinc-900/50 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="text-3xl sm:text-4xl font-bold font-mono text-blue-600 dark:text-blue-400">{{ store.profile.stats.years_exp }}</div>
          <div class="text-xs sm:text-sm font-medium" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-500'">Experience</div>
        </div>
        <div class="p-6 rounded-2xl border text-center space-y-1 transition-colors"
          :class="store.isDark ? 'bg-zinc-900/50 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="text-3xl sm:text-4xl font-bold font-mono" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">{{ store.profile.stats.projects_completed }}</div>
          <div class="text-xs sm:text-sm font-medium" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-500'">Projects Done</div>
        </div>
        <div class="p-6 rounded-2xl border text-center space-y-1 transition-colors"
          :class="store.isDark ? 'bg-zinc-900/50 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="text-3xl sm:text-4xl font-bold font-mono text-emerald-600 dark:text-emerald-400">{{ store.profile.stats.happy_clients }}</div>
          <div class="text-xs sm:text-sm font-medium" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-500'">Happy Clients</div>
        </div>
        <div class="p-6 rounded-2xl border text-center space-y-1 transition-colors"
          :class="store.isDark ? 'bg-zinc-900/50 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="text-3xl sm:text-4xl font-bold font-mono" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">{{ store.profile.stats.technologies_count }}</div>
          <div class="text-xs sm:text-sm font-medium" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-500'">Tech Stack</div>
        </div>
      </div>
    </section>

    <!-- Services Highlight Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      <div class="text-center max-w-2xl mx-auto space-y-2">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
          :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
        >
          <Wrench class="w-3.5 h-3.5 text-blue-500" /> Services
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">IT Support & Software Services</h2>
        <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
          Providing comprehensive hardware diagnostics, system maintenance, and custom web application engineering.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="srv in store.services.slice(0, 3)"
          :key="srv.id"
          class="p-6 rounded-2xl border flex flex-col justify-between space-y-4 transition-all duration-150 group"
          :class="store.isDark
            ? 'bg-zinc-900/60 border-zinc-800 hover:border-zinc-700'
            : 'bg-white border-zinc-200 hover:border-zinc-300 shadow-xs'"
        >
          <div class="space-y-3">
            <div class="w-10 h-10 rounded-xl border flex items-center justify-center transition-transform group-hover:scale-105"
              :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-200' : 'bg-zinc-100 border-zinc-200 text-zinc-800'"
            >
              <Terminal class="w-5 h-5 text-blue-500" />
            </div>
            <h3 class="font-bold text-base transition-colors" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">{{ srv.title }}</h3>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">{{ srv.description }}</p>
          </div>

          <ul v-if="srv.features" class="space-y-1.5 text-xs font-mono pt-3 border-t"
            :class="store.isDark ? 'border-zinc-800 text-zinc-300' : 'border-zinc-100 text-zinc-600'"
          >
            <li v-for="(feat, idx) in srv.features.slice(0, 3)" :key="idx" class="flex items-center gap-2">
              <CheckCircle2 class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" />
              <span>{{ feat }}</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="text-center pt-2">
        <router-link
          to="/services"
          class="inline-flex items-center gap-1.5 text-xs font-mono font-semibold text-blue-600 dark:text-blue-400 hover:underline"
        >
          View All Services →
        </router-link>
      </div>
    </section>

    <!-- Interactive Terminal Component -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <DeveloperTerminal />
    </section>

    <!-- Testimonials Preview -->
    <section v-if="store.testimonials.length" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      <div class="text-center max-w-2xl mx-auto space-y-2">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
          :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
        >
          <Quote class="w-3.5 h-3.5 text-blue-500" /> Client Reviews
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">What Clients & Teams Say</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
          v-for="t in store.testimonials"
          :key="t.id"
          class="p-6 rounded-2xl border space-y-4"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="flex items-center gap-3">
            <img :src="t.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80'" class="w-10 h-10 rounded-full object-cover border" :class="store.isDark ? 'border-zinc-700' : 'border-zinc-200'" />
            <div>
              <div class="font-bold text-sm" :class="store.isDark ? 'text-zinc-200' : 'text-zinc-800'">{{ t.client_name }}</div>
              <div class="text-xs font-mono" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-500'">{{ t.role }} @ {{ t.company }}</div>
            </div>
          </div>
          <p class="text-xs sm:text-sm italic leading-relaxed" :class="store.isDark ? 'text-zinc-300' : 'text-zinc-600'">
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
