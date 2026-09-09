<template>
  <header
    class="sticky top-0 left-0 right-0 z-50 transition-colors duration-200 border-b backdrop-blur-md"
    :class="store.isDark ? 'bg-[#050811]/90 border-emerald-500/20' : 'bg-white/90 border-slate-200 shadow-sm'"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <!-- Coder Brand Logo -->
      <router-link to="/" class="flex items-center gap-3 group">
        <img
          src="/logo.png"
          alt="PuvY Logo"
          class="w-9 h-9 object-contain rounded-lg transition-transform duration-200 group-hover:scale-105"
        />
        <div>
          <span class="font-mono font-bold text-base tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
            PuvY<span class="text-emerald-400">.dev</span>
          </span>
          <div class="flex items-center gap-1.5 text-[11px] font-mono text-emerald-400">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            status: 'available'
          </div>
        </div>
      </router-link>

      <!-- Desktop Nav Links (Coder Style) -->
      <nav
        class="hidden lg:flex items-center gap-6 text-xs font-mono font-medium transition-colors"
        :class="store.isDark ? 'text-slate-400' : 'text-slate-600'"
      >
        <router-link to="/" class="hover:text-emerald-400 transition-colors py-1" active-class="text-emerald-400 font-bold border-b-2 border-emerald-400">~/home</router-link>
        <router-link to="/about" class="hover:text-emerald-400 transition-colors py-1" active-class="text-emerald-400 font-bold border-b-2 border-emerald-400">~/about</router-link>
        <router-link to="/services" class="hover:text-emerald-400 transition-colors py-1" active-class="text-emerald-400 font-bold border-b-2 border-emerald-400">~/services</router-link>
        <router-link to="/projects" class="hover:text-emerald-400 transition-colors py-1" active-class="text-emerald-400 font-bold border-b-2 border-emerald-400">~/projects</router-link>
        <router-link to="/experience" class="hover:text-emerald-400 transition-colors py-1" active-class="text-emerald-400 font-bold border-b-2 border-emerald-400">~/experience</router-link>
        <router-link to="/certifications" class="hover:text-emerald-400 transition-colors py-1" active-class="text-emerald-400 font-bold border-b-2 border-emerald-400">~/certs</router-link>
        <router-link to="/blog" class="hover:text-emerald-400 transition-colors py-1" active-class="text-emerald-400 font-bold border-b-2 border-emerald-400">~/blog</router-link>
        <router-link to="/contact" class="hover:text-emerald-400 transition-colors py-1" active-class="text-emerald-400 font-bold border-b-2 border-emerald-400">~/contact</router-link>
      </nav>

      <!-- Action & Theme Buttons -->
      <div class="flex items-center gap-2.5">
        <!-- Theme Toggle -->
        <button
          @click="store.toggleTheme"
          class="p-2 rounded-lg border transition-all duration-200 flex items-center justify-center gap-1.5 text-xs font-mono cursor-pointer"
          :class="store.isDark
            ? 'bg-[#0b1120] border-emerald-500/30 text-amber-300 hover:border-emerald-400'
            : 'bg-slate-100 border-slate-300 text-slate-700 hover:border-slate-400'"
          :title="store.isDark ? 'Switch to Light Theme' : 'Switch to Dark Theme'"
          aria-label="Toggle Theme"
        >
          <Sun v-if="store.isDark" class="w-4 h-4" />
          <Moon v-else class="w-4 h-4" />
        </button>

        <!-- CTA Resume -->
        <a
          :href="store.profile.cv_url || '#'"
          target="_blank"
          class="hidden sm:flex items-center gap-1.5 px-3.5 py-2 text-xs font-mono font-bold rounded-lg border transition-all duration-200 cursor-pointer"
          :class="store.isDark
            ? 'bg-emerald-500/10 border-emerald-500/40 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950 shadow-sm shadow-emerald-500/20'
            : 'bg-emerald-600 text-white hover:bg-emerald-700'"
        >
          <Download class="w-3.5 h-3.5" /> $ cv.pdf
        </a>

        <!-- Mobile Menu Toggle Button -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          class="lg:hidden p-2 rounded-lg border transition-colors cursor-pointer"
          :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
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
      class="lg:hidden border-b px-4 pt-2 pb-6 space-y-2 transition-colors font-mono"
      :class="store.isDark ? 'border-emerald-500/20 bg-[#050811]/95 backdrop-blur-xl' : 'border-slate-200 bg-white/95 backdrop-blur-xl'"
    >
      <nav
        class="flex flex-col space-y-1 text-xs"
        :class="store.isDark ? 'text-slate-300' : 'text-slate-700'"
      >
        <router-link @click="mobileMenuOpen = false" to="/" class="p-2 rounded hover:text-emerald-400" :class="store.isDark ? 'hover:bg-[#0b1120]' : 'hover:bg-slate-100'">~/home</router-link>
        <router-link @click="mobileMenuOpen = false" to="/about" class="p-2 rounded hover:text-emerald-400" :class="store.isDark ? 'hover:bg-[#0b1120]' : 'hover:bg-slate-100'">~/about</router-link>
        <router-link @click="mobileMenuOpen = false" to="/services" class="p-2 rounded hover:text-emerald-400" :class="store.isDark ? 'hover:bg-[#0b1120]' : 'hover:bg-slate-100'">~/services</router-link>
        <router-link @click="mobileMenuOpen = false" to="/projects" class="p-2 rounded hover:text-emerald-400" :class="store.isDark ? 'hover:bg-[#0b1120]' : 'hover:bg-slate-100'">~/projects</router-link>
        <router-link @click="mobileMenuOpen = false" to="/experience" class="p-2 rounded hover:text-emerald-400" :class="store.isDark ? 'hover:bg-[#0b1120]' : 'hover:bg-slate-100'">~/experience</router-link>
        <router-link @click="mobileMenuOpen = false" to="/certifications" class="p-2 rounded hover:text-emerald-400" :class="store.isDark ? 'hover:bg-[#0b1120]' : 'hover:bg-slate-100'">~/certifications</router-link>
        <router-link @click="mobileMenuOpen = false" to="/blog" class="p-2 rounded hover:text-emerald-400" :class="store.isDark ? 'hover:bg-[#0b1120]' : 'hover:bg-slate-100'">~/blog</router-link>
        <router-link @click="mobileMenuOpen = false" to="/contact" class="p-2 rounded hover:text-emerald-400" :class="store.isDark ? 'hover:bg-[#0b1120]' : 'hover:bg-slate-100'">~/contact</router-link>
      </nav>

      <div class="pt-2 flex flex-col gap-2">
        <a
          :href="store.profile.cv_url || '#'"
          target="_blank"
          class="w-full flex items-center justify-center gap-2 py-2 text-xs font-mono font-bold rounded-lg border"
          :class="store.isDark ? 'bg-emerald-500 text-slate-950 font-bold' : 'bg-emerald-600 text-white font-bold'"
        >
          <Download class="w-4 h-4" /> $ download cv.pdf
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
