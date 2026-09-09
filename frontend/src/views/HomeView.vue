<template>
  <div class="space-y-24 pb-20">
    <!-- Hero Section -->
    <section class="relative min-h-[85vh] flex items-center justify-center pt-16 pb-12 overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          <!-- Hero Text -->
          <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border text-xs font-mono font-medium backdrop-blur-md shadow-xs transition-colors"
              :class="store.isDark 
                ? 'bg-slate-900/80 border-slate-800 text-slate-300' 
                : 'bg-white/90 border-slate-200 text-slate-700'"
            >
              <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
              </span>
              <span>Available for Hire & Projects</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.15]"
              :class="store.isDark ? 'text-white' : 'text-slate-900'"
            >
              Hi, I'm <span class="gradient-text-hero">{{ store.profile.name }}</span>
            </h1>

            <p class="text-xl sm:text-2xl font-semibold tracking-tight"
              :class="store.isDark ? 'text-slate-300' : 'text-slate-700'"
            >
              {{ store.profile.title }}
            </p>

            <p class="text-sm sm:text-base leading-relaxed max-w-2xl mx-auto lg:mx-0"
              :class="store.isDark ? 'text-slate-400' : 'text-slate-600'"
            >
              {{ store.profile.bio }}
            </p>

            <!-- CTA Action Buttons -->
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3.5 pt-2">
              <router-link
                to="/projects"
                class="group px-6 py-3.5 rounded-xl font-semibold text-sm bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-500 hover:to-indigo-500 text-white shadow-lg shadow-blue-500/25 transition-all duration-200 flex items-center gap-2 cursor-pointer hover:scale-[1.02] active:scale-[0.98]"
              >
                <FolderGit2 class="w-4 h-4" />
                <span>Explore Projects</span>
                <ArrowRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
              </router-link>

              <router-link
                to="/contact"
                class="px-5 py-3.5 rounded-xl border font-semibold text-sm transition-all duration-200 flex items-center gap-2 cursor-pointer hover:scale-[1.02] active:scale-[0.98] backdrop-blur-md"
                :class="store.isDark
                  ? 'bg-slate-900/80 border-slate-800 text-slate-200 hover:bg-slate-800 hover:border-slate-700'
                  : 'bg-white/90 border-slate-200 text-slate-800 hover:bg-slate-100'"
              >
                <Mail class="w-4 h-4 text-blue-500" />
                <span>Get in Touch</span>
              </router-link>

              <a
                :href="store.profile.cv_url || '#'"
                target="_blank"
                class="px-5 py-3.5 rounded-xl border font-semibold text-sm transition-all duration-200 flex items-center gap-2 cursor-pointer hover:scale-[1.02] active:scale-[0.98] backdrop-blur-md"
                :class="store.isDark
                  ? 'bg-slate-900/80 border-slate-800 text-slate-200 hover:bg-slate-800 hover:border-slate-700'
                  : 'bg-white/90 border-slate-200 text-slate-800 hover:bg-slate-100'"
              >
                <Download class="w-4 h-4 text-indigo-500" />
                <span>Download CV</span>
              </a>
            </div>

            <!-- Social Links -->
            <div class="flex items-center justify-center lg:justify-start gap-2.5 pt-3">
              <a
                v-for="soc in store.socialLinks"
                :key="soc.id"
                :href="soc.url"
                target="_blank"
                class="p-2.5 rounded-xl border transition-all duration-200 hover:scale-110"
                :class="store.isDark
                  ? 'bg-slate-900/80 border-slate-800 text-slate-400 hover:text-white hover:border-blue-500/50 hover:bg-slate-800'
                  : 'bg-white border-slate-200 text-slate-600 hover:text-blue-600 hover:border-blue-300 shadow-xs'"
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

          <!-- Hero Avatar Card -->
          <div class="lg:col-span-5 flex justify-center">
            <div class="relative group">
              <!-- Subtle Ambient Aura -->
              <div class="absolute -inset-2 bg-gradient-to-r from-blue-500/20 via-indigo-500/20 to-purple-500/20 rounded-3xl blur-2xl opacity-75 group-hover:opacity-100 transition duration-700"></div>

              <!-- Floating Experience Badge (Top Right) -->
              <div class="absolute -top-3 -right-3 z-20 px-3.5 py-1.5 rounded-xl border text-xs font-mono shadow-lg flex items-center gap-2 backdrop-blur-md"
                :class="store.isDark ? 'bg-slate-900/90 border-slate-800 text-slate-200' : 'bg-white/95 border-slate-200 text-slate-800'"
              >
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="font-bold">{{ store.profile.stats.years_exp }} Experience</span>
              </div>

              <!-- Portrait Frame -->
              <div class="relative w-72 sm:w-80 h-[430px] rounded-3xl overflow-hidden border p-2 shadow-2xl transition-transform duration-500 group-hover:scale-[1.01]"
                :class="store.isDark ? 'bg-slate-900/90 border-slate-800' : 'bg-white border-slate-200'"
              >
                <img
                  :src="store.profile.avatar || '/profile.jpg'"
                  alt="Professional Portrait"
                  class="w-full h-full object-cover object-top rounded-2xl group-hover:scale-105 transition-transform duration-700"
                />

                <!-- Floating Bottom Status Bar -->
                <div class="absolute bottom-4 left-4 right-4 p-3 rounded-2xl border text-xs font-mono backdrop-blur-md shadow-lg"
                  :class="store.isDark ? 'bg-slate-950/85 border-slate-800 text-slate-300' : 'bg-white/95 border-slate-200 text-slate-700'"
                >
                  <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5 font-bold" :class="store.isDark ? 'text-emerald-400' : 'text-emerald-600'">
                      <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                      Ready for Work
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
        <div class="p-6 rounded-2xl border text-center space-y-1.5 modern-card"
          :class="store.isDark ? 'bg-slate-900/60 border-slate-800/80 hover:border-blue-500/40' : 'bg-white border-slate-200 hover:border-blue-300 shadow-sm'"
        >
          <div class="text-3xl sm:text-4xl font-extrabold font-mono text-blue-500">{{ store.profile.stats.years_exp }}</div>
          <div class="text-xs sm:text-sm font-medium" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">Years Experience</div>
        </div>
        <div class="p-6 rounded-2xl border text-center space-y-1.5 modern-card"
          :class="store.isDark ? 'bg-slate-900/60 border-slate-800/80 hover:border-indigo-500/40' : 'bg-white border-slate-200 hover:border-indigo-300 shadow-sm'"
        >
          <div class="text-3xl sm:text-4xl font-extrabold font-mono text-indigo-400">{{ store.profile.stats.projects_completed }}</div>
          <div class="text-xs sm:text-sm font-medium" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">Completed Projects</div>
        </div>
        <div class="p-6 rounded-2xl border text-center space-y-1.5 modern-card"
          :class="store.isDark ? 'bg-slate-900/60 border-slate-800/80 hover:border-emerald-500/40' : 'bg-white border-slate-200 hover:border-emerald-300 shadow-sm'"
        >
          <div class="text-3xl sm:text-4xl font-extrabold font-mono text-emerald-400">{{ store.profile.stats.happy_clients }}</div>
          <div class="text-xs sm:text-sm font-medium" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">Satisfied Clients</div>
        </div>
        <div class="p-6 rounded-2xl border text-center space-y-1.5 modern-card"
          :class="store.isDark ? 'bg-slate-900/60 border-slate-800/80 hover:border-purple-500/40' : 'bg-white border-slate-200 hover:border-purple-300 shadow-sm'"
        >
          <div class="text-3xl sm:text-4xl font-extrabold font-mono text-purple-400">{{ store.profile.stats.technologies_count }}</div>
          <div class="text-xs sm:text-sm font-medium" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">Tools & Tech Stack</div>
        </div>
      </div>
    </section>

    <!-- Featured Projects Showcase Section (Inviting visitors to explore!) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="space-y-2">
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
            :class="store.isDark ? 'bg-slate-900 border-slate-800 text-slate-300' : 'bg-slate-100 border-slate-200 text-slate-700'"
          >
            <FolderGit2 class="w-3.5 h-3.5 text-blue-500" /> Featured Work
          </div>
          <h2 class="text-2xl sm:text-3xl font-extrabold" :class="store.isDark ? 'text-white' : 'text-slate-900'">
            Selected Projects & Builds
          </h2>
        </div>

        <router-link
          to="/projects"
          class="inline-flex items-center gap-1.5 text-xs font-mono font-bold text-blue-500 hover:text-blue-400 transition-colors"
        >
          View all {{ store.projects.length }} projects <ArrowRight class="w-3.5 h-3.5" />
        </router-link>
      </div>

      <!-- Project Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        <div
          v-for="project in store.projects.slice(0, 3)"
          :key="project.id"
          class="rounded-3xl border overflow-hidden flex flex-col justify-between modern-card group"
          :class="store.isDark
            ? 'bg-slate-900/70 border-slate-800/80 hover:border-blue-500/50 shadow-xl'
            : 'bg-white border-slate-200 hover:border-blue-300 shadow-md'"
        >
          <div>
            <!-- Thumbnail Image with Hover Zoom -->
            <div class="relative aspect-video overflow-hidden border-b"
              :class="store.isDark ? 'bg-slate-950 border-slate-800' : 'bg-slate-100 border-slate-200'"
            >
              <img
                :src="project.thumbnail"
                :alt="project.title"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-60"></div>
              
              <div v-if="project.category" class="absolute top-3 left-3 px-2.5 py-1 rounded-md border text-[10px] font-mono backdrop-blur-md"
                :class="store.isDark ? 'bg-slate-950/80 border-slate-800 text-blue-400' : 'bg-white/90 border-slate-200 text-blue-600'"
              >
                {{ project.category.name }}
              </div>
            </div>

            <!-- Content Body -->
            <div class="p-6 space-y-3">
              <h3 class="text-lg font-bold group-hover:text-blue-500 transition-colors"
                :class="store.isDark ? 'text-white' : 'text-slate-900'"
              >
                {{ project.title }}
              </h3>
              <p class="text-xs line-clamp-2 leading-relaxed"
                :class="store.isDark ? 'text-slate-400' : 'text-slate-600'"
              >
                {{ project.summary }}
              </p>

              <!-- Tech Badges -->
              <div class="flex flex-wrap gap-1.5 pt-1">
                <span
                  v-for="tech in project.tags.slice(0, 4)"
                  :key="tech"
                  class="px-2 py-0.5 rounded-md border text-[10px] font-mono"
                  :class="store.isDark ? 'bg-slate-950/80 border-slate-800 text-slate-300' : 'bg-slate-100 border-slate-200 text-slate-700'"
                >
                  {{ tech }}
                </span>
              </div>
            </div>
          </div>

          <!-- Action Links -->
          <div class="p-6 pt-0">
            <router-link
              :to="'/projects/' + project.slug"
              class="w-full py-2.5 rounded-xl font-semibold text-xs font-mono transition-all flex items-center justify-center gap-1.5 cursor-pointer"
              :class="store.isDark
                ? 'bg-blue-600 hover:bg-blue-500 text-white'
                : 'bg-slate-900 hover:bg-slate-800 text-white'"
            >
              <span>View Case Study</span>
              <ArrowRight class="w-3.5 h-3.5" />
            </router-link>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Highlight Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      <div class="text-center max-w-2xl mx-auto space-y-2">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
          :class="store.isDark ? 'bg-slate-900 border-slate-800 text-slate-300' : 'bg-slate-100 border-slate-200 text-slate-700'"
        >
          <Wrench class="w-3.5 h-3.5 text-blue-500" /> Professional Services
        </div>
        <h2 class="text-2xl sm:text-3xl font-extrabold" :class="store.isDark ? 'text-white' : 'text-slate-900'">
          IT Support & Custom Engineering
        </h2>
        <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
          Hardware diagnostics, operating system deployment, active directory, and full-stack software development.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="srv in store.services.slice(0, 3)"
          :key="srv.id"
          class="p-6 sm:p-7 rounded-3xl border flex flex-col justify-between space-y-6 modern-card group"
          :class="store.isDark
            ? 'bg-slate-900/70 border-slate-800/80 hover:border-blue-500/40 shadow-xl'
            : 'bg-white border-slate-200 hover:border-blue-300 shadow-sm'"
        >
          <div class="space-y-4">
            <div class="w-12 h-12 rounded-2xl border flex items-center justify-center transition-transform group-hover:scale-105"
              :class="store.isDark ? 'bg-slate-800 border-slate-700 text-blue-400' : 'bg-blue-50 border-blue-200 text-blue-600'"
            >
              <Terminal class="w-6 h-6" />
            </div>
            <h3 class="font-bold text-lg group-hover:text-blue-500 transition-colors"
              :class="store.isDark ? 'text-white' : 'text-slate-900'"
            >
              {{ srv.title }}
            </h3>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">{{ srv.description }}</p>
          </div>

          <ul v-if="srv.features" class="space-y-1.5 text-xs font-mono pt-3 border-t"
            :class="store.isDark ? 'border-slate-800 text-slate-300' : 'border-slate-100 text-slate-600'"
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
          class="inline-flex items-center gap-1.5 text-xs font-mono font-bold text-blue-500 hover:text-blue-400 transition-colors"
        >
          View All Services & Capabilities →
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
          :class="store.isDark ? 'bg-slate-900 border-slate-800 text-slate-300' : 'bg-slate-100 border-slate-200 text-slate-700'"
        >
          <Quote class="w-3.5 h-3.5 text-blue-500" /> Testimonials
        </div>
        <h2 class="text-2xl sm:text-3xl font-extrabold" :class="store.isDark ? 'text-white' : 'text-slate-900'">
          Client & Team Feedback
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
          v-for="t in store.testimonials"
          :key="t.id"
          class="p-6 rounded-3xl border space-y-4 modern-card"
          :class="store.isDark ? 'bg-slate-900/70 border-slate-800/80 shadow-xl' : 'bg-white border-slate-200 shadow-sm'"
        >
          <div class="flex items-center gap-3">
            <img :src="t.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80'" class="w-11 h-11 rounded-full object-cover border" :class="store.isDark ? 'border-slate-700' : 'border-slate-200'" />
            <div>
              <div class="font-bold text-sm" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">{{ t.client_name }}</div>
              <div class="text-xs font-mono" :class="store.isDark ? 'text-slate-400' : 'text-slate-500'">{{ t.role }} @ {{ t.company }}</div>
            </div>
          </div>
          <p class="text-xs sm:text-sm italic leading-relaxed" :class="store.isDark ? 'text-slate-300' : 'text-slate-600'">
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
  Share2,
  ArrowRight
} from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
