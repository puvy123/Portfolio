<template>
  <div class="space-y-24 pb-20 font-mono">
    <!-- Hero Section -->
    <section class="relative min-h-[85vh] flex items-center justify-center pt-16 pb-12 overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          <!-- Hero Text -->
          <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
            <!-- Coder Status Tag -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg border text-xs font-mono font-medium backdrop-blur-md transition-colors"
              :class="store.isDark 
                ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400 shadow-sm shadow-emerald-500/10' 
                : 'bg-white border-slate-300 text-emerald-700 shadow-xs'"
            >
              <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
              </span>
              <span>// Full-Stack Engineer & IT Specialist</span>
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight"
              :class="store.isDark ? 'text-slate-100' : 'text-slate-900'"
            >
              <span class="text-emerald-400">&gt;</span> const dev = "<span class="gradient-text-coder">{{ store.profile.name }}</span>";
            </h1>

            <p class="text-lg sm:text-xl font-semibold text-emerald-400/90 font-mono">
              <span class="text-slate-500">/*</span> {{ store.profile.title }} <span class="text-slate-500">*/</span>
            </p>

            <p class="text-xs sm:text-sm leading-relaxed max-w-2xl mx-auto lg:mx-0"
              :class="store.isDark ? 'text-slate-400' : 'text-slate-600'"
            >
              {{ store.profile.bio }}
            </p>

            <!-- Coder Action Buttons -->
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-2">
              <router-link
                to="/projects"
                class="group px-5 py-3 rounded-lg font-bold text-xs bg-emerald-500 hover:bg-emerald-400 text-slate-950 shadow-lg shadow-emerald-500/25 transition-all duration-200 flex items-center gap-2 cursor-pointer hover:scale-[1.02] active:scale-[0.98]"
              >
                <Terminal class="w-4 h-4" />
                <span>$ view projects</span>
                <ArrowRight class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" />
              </router-link>

              <router-link
                to="/contact"
                class="px-5 py-3 rounded-lg border font-semibold text-xs transition-all duration-200 flex items-center gap-2 cursor-pointer hover:scale-[1.02] active:scale-[0.98]"
                :class="store.isDark
                  ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400 hover:bg-emerald-500/10 hover:border-emerald-400'
                  : 'bg-white border-slate-300 text-slate-800 hover:bg-slate-100'"
              >
                <Mail class="w-4 h-4 text-emerald-400" />
                <span>$ contact --init</span>
              </router-link>

              <a
                :href="store.profile.cv_url || '#'"
                target="_blank"
                class="px-5 py-3 rounded-lg border font-semibold text-xs transition-all duration-200 flex items-center gap-2 cursor-pointer hover:scale-[1.02] active:scale-[0.98]"
                :class="store.isDark
                  ? 'bg-[#0b1120] border-slate-800 text-slate-300 hover:border-slate-700 hover:text-white'
                  : 'bg-white border-slate-300 text-slate-800 hover:bg-slate-100'"
              >
                <Download class="w-4 h-4 text-cyan-400" />
                <span>cat resume.pdf</span>
              </a>
            </div>

            <!-- Social Links (Terminal styled) -->
            <div class="flex items-center justify-center lg:justify-start gap-2 pt-2">
              <a
                v-for="soc in store.socialLinks"
                :key="soc.id"
                :href="soc.url"
                target="_blank"
                class="p-2.5 rounded-lg border transition-all duration-200 hover:scale-110"
                :class="store.isDark
                  ? 'bg-[#0b1120] border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/50'
                  : 'bg-white border-slate-300 text-slate-600 hover:text-emerald-600 hover:border-emerald-400 shadow-xs'"
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

          <!-- Hero Avatar with Code Terminal Frame -->
          <div class="lg:col-span-5 flex justify-center">
            <div class="relative group">
              <!-- Terminal Ambient Glow -->
              <div class="absolute -inset-2 bg-gradient-to-r from-emerald-500/20 via-cyan-500/20 to-teal-500/20 rounded-2xl blur-xl opacity-75 group-hover:opacity-100 transition duration-700"></div>

              <!-- Floating Experience Badge (Top Right) -->
              <div class="absolute -top-3 -right-3 z-20 px-3 py-1.5 rounded-lg border text-xs font-mono shadow-lg flex items-center gap-1.5"
                :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/40 text-emerald-400' : 'bg-white border-slate-300 text-emerald-700'"
              >
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>exp = "{{ store.profile.stats.years_exp }}"</span>
              </div>

              <!-- Portrait Frame with Terminal Window -->
              <div class="relative w-72 sm:w-80 h-[440px] rounded-2xl overflow-hidden border shadow-2xl transition-transform duration-500 group-hover:scale-[1.01] flex flex-col"
                :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30' : 'bg-slate-900 border-slate-800 text-white'"
              >
                <!-- Terminal Header Bar -->
                <div class="px-3 py-2 bg-[#050811] border-b border-slate-800 flex items-center justify-between text-[11px] font-mono text-slate-400">
                  <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                  </div>
                  <span>profile.vue</span>
                </div>

                <!-- Portrait Photo -->
                <div class="relative flex-1 overflow-hidden p-2">
                  <img
                    :src="store.profile.avatar || '/profile.jpg'"
                    alt="Professional Portrait"
                    class="w-full h-full object-cover object-top rounded-xl group-hover:scale-105 transition-transform duration-700"
                  />

                  <!-- Floating Bottom Status Bar -->
                  <div class="absolute bottom-4 left-4 right-4 p-2.5 rounded-xl border text-xs font-mono backdrop-blur-md shadow-lg"
                    :class="store.isDark ? 'bg-[#050811]/90 border-emerald-500/40 text-slate-300' : 'bg-slate-950/90 border-slate-800 text-slate-200'"
                  >
                    <div class="flex items-center justify-between">
                      <span class="flex items-center gap-1.5 font-bold text-emerald-400 text-[11px]">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        deploy: 'production'
                      </span>
                      <span class="text-[10px] text-slate-400">{{ store.profile.location }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Key Statistics Section (Coder JSON Matrix) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="p-5 rounded-xl border space-y-1 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
        >
          <div class="text-xs text-slate-500 font-mono">// experience_years</div>
          <div class="text-2xl sm:text-3xl font-bold font-mono text-emerald-400">{{ store.profile.stats.years_exp }}</div>
        </div>
        <div class="p-5 rounded-xl border space-y-1 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
        >
          <div class="text-xs text-slate-500 font-mono">// projects_shipped</div>
          <div class="text-2xl sm:text-3xl font-bold font-mono text-cyan-400">{{ store.profile.stats.projects_completed }}</div>
        </div>
        <div class="p-5 rounded-xl border space-y-1 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
        >
          <div class="text-xs text-slate-500 font-mono">// happy_clients</div>
          <div class="text-2xl sm:text-3xl font-bold font-mono text-teal-400">{{ store.profile.stats.happy_clients }}</div>
        </div>
        <div class="p-5 rounded-xl border space-y-1 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-xs'"
        >
          <div class="text-xs text-slate-500 font-mono">// tech_stack_count</div>
          <div class="text-2xl sm:text-3xl font-bold font-mono text-indigo-400">{{ store.profile.stats.technologies_count }}</div>
        </div>
      </div>
    </section>

    <!-- Featured Projects Showcase Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div class="space-y-1">
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
            :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
          >
            <FolderGit2 class="w-3.5 h-3.5 text-emerald-400" /> git log --featured
          </div>
          <h2 class="text-2xl sm:text-3xl font-bold font-mono" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
            Featured Repositories & Builds
          </h2>
        </div>

        <router-link
          to="/projects"
          class="inline-flex items-center gap-1.5 text-xs font-mono font-bold text-emerald-400 hover:text-emerald-300 transition-colors"
        >
          $ ls -la all_projects ({{ store.projects.length }}) →
        </router-link>
      </div>

      <!-- Project Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="project in store.projects.slice(0, 3)"
          :key="project.id"
          class="rounded-xl border overflow-hidden flex flex-col justify-between coder-card group"
          :class="store.isDark
            ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/50'
            : 'bg-white border-slate-300 hover:border-emerald-500 shadow-sm'"
        >
          <div>
            <!-- Terminal Title Bar -->
            <div class="px-3 py-2 bg-[#050811] border-b border-slate-800 flex items-center justify-between text-[11px] font-mono text-slate-400">
              <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-slate-300 font-bold">{{ project.slug }}.app</span>
              </div>
              <span v-if="project.category" class="text-emerald-400 text-[10px]">{{ project.category.name }}</span>
            </div>

            <!-- Thumbnail Image -->
            <div class="relative aspect-video overflow-hidden border-b border-slate-800 bg-[#050811]">
              <img
                :src="project.thumbnail"
                :alt="project.title"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
              />
            </div>

            <!-- Content Body -->
            <div class="p-5 space-y-3">
              <h3 class="text-base font-bold group-hover:text-emerald-400 transition-colors font-mono"
                :class="store.isDark ? 'text-slate-100' : 'text-slate-900'"
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
                  class="px-2 py-0.5 rounded border text-[10px] font-mono"
                  :class="store.isDark ? 'bg-[#050811] border-emerald-500/20 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
                >
                  #{{ tech }}
                </span>
              </div>
            </div>
          </div>

          <!-- Action Links -->
          <div class="p-5 pt-0">
            <router-link
              :to="'/projects/' + project.slug"
              class="w-full py-2 rounded-lg font-bold text-xs font-mono transition-all flex items-center justify-center gap-1.5 cursor-pointer"
              :class="store.isDark
                ? 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950'
                : 'bg-slate-900 text-emerald-400 hover:bg-slate-800'"
            >
              <span>$ inspect case-study</span>
              <ArrowRight class="w-3.5 h-3.5" />
            </router-link>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Highlight Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
      <div class="text-center max-w-2xl mx-auto space-y-2">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
          :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
        >
          <Wrench class="w-3.5 h-3.5 text-emerald-400" /> system.services()
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold font-mono" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
          IT Support & Software Engineering
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="srv in store.services.slice(0, 3)"
          :key="srv.id"
          class="p-6 rounded-xl border flex flex-col justify-between space-y-4 coder-card group"
          :class="store.isDark
            ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/40'
            : 'bg-white border-slate-300 hover:border-emerald-500 shadow-sm'"
        >
          <div class="space-y-3">
            <div class="w-10 h-10 rounded-lg border flex items-center justify-center transition-transform group-hover:scale-105"
              :class="store.isDark ? 'bg-[#050811] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-emerald-600'"
            >
              <Terminal class="w-5 h-5" />
            </div>
            <h3 class="font-bold text-base group-hover:text-emerald-400 transition-colors font-mono"
              :class="store.isDark ? 'text-slate-100' : 'text-slate-900'"
            >
              {{ srv.title }}
            </h3>
            <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">{{ srv.description }}</p>
          </div>

          <ul v-if="srv.features" class="space-y-1.5 text-xs font-mono pt-3 border-t border-slate-800">
            <li v-for="(feat, idx) in srv.features.slice(0, 3)" :key="idx" class="flex items-center gap-2">
              <CheckCircle2 class="w-3.5 h-3.5 text-emerald-400 flex-shrink-0" />
              <span :class="store.isDark ? 'text-slate-300' : 'text-slate-700'">{{ feat }}</span>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Interactive Developer CLI Terminal Component -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <DeveloperTerminal />
    </section>

    <!-- Testimonials Preview -->
    <section v-if="store.testimonials.length" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
      <div class="text-center max-w-2xl mx-auto space-y-2">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
          :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
        >
          <Quote class="w-3.5 h-3.5 text-emerald-400" /> reviews.log
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold font-mono" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
          Client & Team Feedback
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
          v-for="t in store.testimonials"
          :key="t.id"
          class="p-6 rounded-xl border space-y-3 coder-card"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800' : 'bg-white border-slate-300 shadow-sm'"
        >
          <div class="flex items-center gap-3">
            <img :src="t.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80'" class="w-10 h-10 rounded-full object-cover border border-emerald-500/40" />
            <div>
              <div class="font-bold text-xs font-mono text-emerald-400">{{ t.client_name }}</div>
              <div class="text-[11px] font-mono text-slate-500">{{ t.role }} @ {{ t.company }}</div>
            </div>
          </div>
          <p class="text-xs font-mono leading-relaxed" :class="store.isDark ? 'text-slate-300' : 'text-slate-600'">
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
