<template>
  <header
    class="sticky top-0 left-0 right-0 z-50 transition-all duration-300 border-b backdrop-blur-md"
    :class="store.isDark ? 'bg-slate-950/80 border-slate-800/60' : 'bg-white/80 border-slate-200 shadow-sm'"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <!-- Brand Logo -->
      <router-link to="/" class="flex items-center gap-3 group">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 to-indigo-600 flex items-center justify-center text-white font-mono font-bold text-lg shadow-lg group-hover:scale-105 transition-transform">
          &lt;/&gt;
        </div>
        <div>
          <span class="font-bold text-lg tracking-tight bg-gradient-to-r from-cyan-400 via-indigo-300 to-purple-400 bg-clip-text text-transparent">
            {{ store.profile.name }}
          </span>
          <div class="flex items-center gap-1.5 text-xs text-emerald-400 font-mono">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            Available for hire
          </div>
        </div>
      </router-link>

      <!-- Desktop Nav Links -->
      <nav
        class="hidden lg:flex items-center gap-6 text-sm font-medium transition-colors"
        :class="store.isDark ? 'text-slate-300' : 'text-slate-600'"
      >
        <router-link to="/" class="hover:text-cyan-400 transition-colors" active-class="text-cyan-400 font-bold">Home</router-link>
        <router-link to="/about" class="hover:text-cyan-400 transition-colors" active-class="text-cyan-400 font-bold">About</router-link>
        <router-link to="/services" class="hover:text-cyan-400 transition-colors" active-class="text-cyan-400 font-bold">Services</router-link>
        <router-link to="/projects" class="hover:text-cyan-400 transition-colors" active-class="text-cyan-400 font-bold">Projects</router-link>
        <router-link to="/experience" class="hover:text-cyan-400 transition-colors" active-class="text-cyan-400 font-bold">Experience</router-link>
        <router-link to="/certifications" class="hover:text-cyan-400 transition-colors" active-class="text-cyan-400 font-bold">Certifications</router-link>
        <router-link to="/blog" class="hover:text-cyan-400 transition-colors" active-class="text-cyan-400 font-bold">Blog</router-link>
        <router-link to="/contact" class="hover:text-cyan-400 transition-colors" active-class="text-cyan-400 font-bold">Contact</router-link>
      </nav>

      <!-- Action & Theme Buttons -->
      <div class="flex items-center gap-3">
        <!-- Light / Dark Mode Toggle Button -->
        <button
          @click="store.toggleTheme"
          class="p-2.5 rounded-xl border transition-all duration-300 flex items-center justify-center gap-1.5 text-xs font-mono"
          :class="store.isDark
            ? 'bg-slate-900 border-slate-800 text-amber-300 hover:border-amber-400/40 hover:bg-slate-800'
            : 'bg-slate-100 border-slate-300 text-indigo-600 hover:border-indigo-400/40 hover:bg-slate-200'"
          :title="store.isDark ? 'Switch to Light Theme' : 'Switch to Dark Theme'"
          aria-label="Toggle Theme"
        >
          <Sun v-if="store.isDark" class="w-4 h-4" />
          <Moon v-else class="w-4 h-4" />
          <span class="hidden sm:inline text-[11px] font-semibold">
            {{ store.isDark ? 'Light' : 'Dark' }}
          </span>
        </button>

        <!-- CTA Resume -->
        <a
          :href="store.profile.cv_url || '#'"
          target="_blank"
          class="hidden sm:flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white shadow-md shadow-cyan-500/20 transition-all hover:scale-105 active:scale-95"
        >
          <Download class="w-3.5 h-3.5" /> Download CV
        </a>

        <!-- Mobile Menu Toggle Button -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          class="lg:hidden p-2 rounded-xl border transition-colors"
          :class="store.isDark ? 'bg-slate-900 border-slate-800 text-slate-300 hover:text-cyan-400' : 'bg-slate-100 border-slate-300 text-slate-700 hover:text-cyan-500'"
          aria-label="Toggle menu"
        >
          <Menu v-if="!mobileMenuOpen" class="w-5 h-5" />
          <X v-else class="w-5 h-5" />
        </button>
      </div>
    </div>

    <!-- Mobile Drawer -->
    <div
      v-if="mobileMenuOpen"
      class="lg:hidden border-b px-4 pt-2 pb-6 space-y-3 transition-colors"
      :class="store.isDark ? 'border-slate-800 bg-slate-950/95 backdrop-blur-xl' : 'border-slate-200 bg-white/95 backdrop-blur-xl'"
    >
      <nav
        class="flex flex-col space-y-2 text-sm font-medium"
        :class="store.isDark ? 'text-slate-300' : 'text-slate-700'"
      >
        <router-link @click="mobileMenuOpen = false" to="/" class="p-2 rounded-lg hover:text-cyan-400" :class="store.isDark ? 'hover:bg-slate-900' : 'hover:bg-slate-100'">Home</router-link>
        <router-link @click="mobileMenuOpen = false" to="/about" class="p-2 rounded-lg hover:text-cyan-400" :class="store.isDark ? 'hover:bg-slate-900' : 'hover:bg-slate-100'">About Me</router-link>
        <router-link @click="mobileMenuOpen = false" to="/services" class="p-2 rounded-lg hover:text-cyan-400" :class="store.isDark ? 'hover:bg-slate-900' : 'hover:bg-slate-100'">Services & IT Support</router-link>
        <router-link @click="mobileMenuOpen = false" to="/projects" class="p-2 rounded-lg hover:text-cyan-400" :class="store.isDark ? 'hover:bg-slate-900' : 'hover:bg-slate-100'">Projects Portfolio</router-link>
        <router-link @click="mobileMenuOpen = false" to="/experience" class="p-2 rounded-lg hover:text-cyan-400" :class="store.isDark ? 'hover:bg-slate-900' : 'hover:bg-slate-100'">Work Experience</router-link>
        <router-link @click="mobileMenuOpen = false" to="/certifications" class="p-2 rounded-lg hover:text-cyan-400" :class="store.isDark ? 'hover:bg-slate-900' : 'hover:bg-slate-100'">Certifications & Education</router-link>
        <router-link @click="mobileMenuOpen = false" to="/blog" class="p-2 rounded-lg hover:text-cyan-400" :class="store.isDark ? 'hover:bg-slate-900' : 'hover:bg-slate-100'">Blog & Articles</router-link>
        <router-link @click="mobileMenuOpen = false" to="/contact" class="p-2 rounded-lg hover:text-cyan-400" :class="store.isDark ? 'hover:bg-slate-900' : 'hover:bg-slate-100'">Contact</router-link>
      </nav>

      <div class="pt-2 flex flex-col gap-2">
        <button
          @click="store.toggleTheme"
          class="w-full flex items-center justify-center gap-2 py-2 text-xs font-mono rounded-xl border"
          :class="store.isDark ? 'bg-slate-900 border-slate-800 text-amber-300' : 'bg-slate-100 border-slate-300 text-indigo-600'"
        >
          <Sun v-if="store.isDark" class="w-4 h-4" />
          <Moon v-else class="w-4 h-4" />
          <span>Switch to {{ store.isDark ? 'Light' : 'Dark' }} Theme</span>
        </button>

        <a
          :href="store.profile.cv_url || '#'"
          target="_blank"
          class="w-full flex items-center justify-center gap-2 py-2.5 text-xs font-semibold rounded-xl bg-cyan-500 text-slate-950 font-bold"
        >
          <Download class="w-4 h-4" /> Download CV
        </a>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { usePortfolioStore } from '../../store/portfolio';
import { Download, Menu, X, Sun, Moon } from 'lucide-vue-next';

const store = usePortfolioStore();
const mobileMenuOpen = ref(false);
</script>
