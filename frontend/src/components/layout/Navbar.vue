<template>
  <header
    class="sticky top-0 left-0 right-0 z-50 transition-colors duration-200 border-b backdrop-blur-md"
    :class="store.isDark ? 'bg-zinc-950/80 border-zinc-800/80' : 'bg-white/80 border-zinc-200 shadow-xs'"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <!-- Brand Logo -->
      <router-link to="/" class="flex items-center gap-3 group">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center font-mono font-bold text-sm transition-transform duration-200 group-hover:scale-105"
          :class="store.isDark ? 'bg-white text-zinc-950 shadow-xs' : 'bg-zinc-900 text-white shadow-xs'"
        >
          &lt;/&gt;
        </div>
        <div>
          <span class="font-bold text-base tracking-tight" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
            {{ store.profile.name }}
          </span>
          <div class="flex items-center gap-1.5 text-[11px] font-mono" :class="store.isDark ? 'text-emerald-400' : 'text-emerald-600'">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
            Available for hire
          </div>
        </div>
      </router-link>

      <!-- Desktop Nav Links -->
      <nav
        class="hidden lg:flex items-center gap-6 text-sm font-medium transition-colors"
        :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'"
      >
        <router-link to="/" class="hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors py-1" active-class="text-blue-600 dark:text-blue-400 font-semibold">Home</router-link>
        <router-link to="/about" class="hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors py-1" active-class="text-blue-600 dark:text-blue-400 font-semibold">About</router-link>
        <router-link to="/services" class="hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors py-1" active-class="text-blue-600 dark:text-blue-400 font-semibold">Services</router-link>
        <router-link to="/projects" class="hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors py-1" active-class="text-blue-600 dark:text-blue-400 font-semibold">Projects</router-link>
        <router-link to="/experience" class="hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors py-1" active-class="text-blue-600 dark:text-blue-400 font-semibold">Experience</router-link>
        <router-link to="/certifications" class="hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors py-1" active-class="text-blue-600 dark:text-blue-400 font-semibold">Certifications</router-link>
        <router-link to="/blog" class="hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors py-1" active-class="text-blue-600 dark:text-blue-400 font-semibold">Blog</router-link>
        <router-link to="/contact" class="hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors py-1" active-class="text-blue-600 dark:text-blue-400 font-semibold">Contact</router-link>
      </nav>

      <!-- Action & Theme Buttons -->
      <div class="flex items-center gap-2.5">
        <!-- Light / Dark Mode Toggle Button -->
        <button
          @click="store.toggleTheme"
          class="p-2 rounded-xl border transition-all duration-200 flex items-center justify-center gap-1.5 text-xs font-mono cursor-pointer"
          :class="store.isDark
            ? 'bg-zinc-900 border-zinc-800 text-zinc-300 hover:bg-zinc-800 hover:text-white'
            : 'bg-zinc-100 border-zinc-200 text-zinc-700 hover:bg-zinc-200 hover:text-zinc-900'"
          :title="store.isDark ? 'Switch to Light Theme' : 'Switch to Dark Theme'"
          aria-label="Toggle Theme"
        >
          <Sun v-if="store.isDark" class="w-4 h-4 text-amber-400" />
          <Moon v-else class="w-4 h-4 text-zinc-700" />
          <span class="hidden sm:inline text-[11px] font-medium">
            {{ store.isDark ? 'Light' : 'Dark' }}
          </span>
        </button>

        <!-- CTA Resume -->
        <a
          :href="store.profile.cv_url || '#'"
          target="_blank"
          class="hidden sm:flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-xl transition-all duration-200 hover:opacity-90 active:scale-98"
          :class="store.isDark
            ? 'bg-white text-zinc-950 hover:bg-zinc-100'
            : 'bg-zinc-900 text-white hover:bg-zinc-800'"
        >
          <Download class="w-3.5 h-3.5" /> Download CV
        </a>

        <!-- Mobile Menu Toggle Button -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          class="lg:hidden p-2 rounded-xl border transition-colors cursor-pointer"
          :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
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
      :class="store.isDark ? 'border-zinc-800 bg-zinc-950/95 backdrop-blur-xl' : 'border-zinc-200 bg-white/95 backdrop-blur-xl'"
    >
      <nav
        class="flex flex-col space-y-1 text-sm font-medium"
        :class="store.isDark ? 'text-zinc-300' : 'text-zinc-700'"
      >
        <router-link @click="mobileMenuOpen = false" to="/" class="p-2.5 rounded-lg hover:text-blue-500" :class="store.isDark ? 'hover:bg-zinc-900' : 'hover:bg-zinc-100'">Home</router-link>
        <router-link @click="mobileMenuOpen = false" to="/about" class="p-2.5 rounded-lg hover:text-blue-500" :class="store.isDark ? 'hover:bg-zinc-900' : 'hover:bg-zinc-100'">About Me</router-link>
        <router-link @click="mobileMenuOpen = false" to="/services" class="p-2.5 rounded-lg hover:text-blue-500" :class="store.isDark ? 'hover:bg-zinc-900' : 'hover:bg-zinc-100'">Services</router-link>
        <router-link @click="mobileMenuOpen = false" to="/projects" class="p-2.5 rounded-lg hover:text-blue-500" :class="store.isDark ? 'hover:bg-zinc-900' : 'hover:bg-zinc-100'">Projects</router-link>
        <router-link @click="mobileMenuOpen = false" to="/experience" class="p-2.5 rounded-lg hover:text-blue-500" :class="store.isDark ? 'hover:bg-zinc-900' : 'hover:bg-zinc-100'">Experience</router-link>
        <router-link @click="mobileMenuOpen = false" to="/certifications" class="p-2.5 rounded-lg hover:text-blue-500" :class="store.isDark ? 'hover:bg-zinc-900' : 'hover:bg-zinc-100'">Certifications</router-link>
        <router-link @click="mobileMenuOpen = false" to="/blog" class="p-2.5 rounded-lg hover:text-blue-500" :class="store.isDark ? 'hover:bg-zinc-900' : 'hover:bg-zinc-100'">Blog</router-link>
        <router-link @click="mobileMenuOpen = false" to="/contact" class="p-2.5 rounded-lg hover:text-blue-500" :class="store.isDark ? 'hover:bg-zinc-900' : 'hover:bg-zinc-100'">Contact</router-link>
      </nav>

      <div class="pt-2 flex flex-col gap-2">
        <button
          @click="store.toggleTheme"
          class="w-full flex items-center justify-center gap-2 py-2 text-xs font-mono rounded-xl border cursor-pointer"
          :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
        >
          <Sun v-if="store.isDark" class="w-4 h-4 text-amber-400" />
          <Moon v-else class="w-4 h-4 text-zinc-700" />
          <span>Switch to {{ store.isDark ? 'Light' : 'Dark' }} Mode</span>
        </button>

        <a
          :href="store.profile.cv_url || '#'"
          target="_blank"
          class="w-full flex items-center justify-center gap-2 py-2.5 text-xs font-semibold rounded-xl"
          :class="store.isDark ? 'bg-white text-zinc-950 font-bold' : 'bg-zinc-900 text-white font-bold'"
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
