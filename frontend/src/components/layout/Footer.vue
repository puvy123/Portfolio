<template>
  <footer
    class="border-t py-12 transition-colors duration-300"
    :class="store.isDark ? 'border-slate-800/80 bg-slate-950/90 text-slate-400' : 'border-slate-200 bg-slate-100/90 text-slate-600'"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <!-- Col 1: Bio -->
        <div class="space-y-4 md:col-span-2">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-cyan-500/20 border border-cyan-500/30 flex items-center justify-center text-cyan-400 font-mono font-bold">
              &lt;/&gt;
            </div>
            <span class="font-bold text-lg" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
              {{ store.profile.name }}
            </span>
          </div>
          <p class="text-xs sm:text-sm max-w-md leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
            {{ store.profile.title }}
          </p>
          <div class="flex items-center gap-3 pt-2">
            <a
              v-for="soc in store.socialLinks"
              :key="soc.id"
              :href="soc.url"
              target="_blank"
              class="p-2 rounded-xl border transition-all hover:scale-110"
              :class="store.isDark
                ? 'bg-slate-900 border-slate-800 text-slate-400 hover:text-cyan-400 hover:border-cyan-500/30'
                : 'bg-white border-slate-200 text-slate-600 hover:text-cyan-600 hover:border-cyan-400'"
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

        <!-- Col 2: Quick Links -->
        <div class="space-y-3">
          <h4 class="text-xs font-mono font-bold uppercase tracking-wider" :class="store.isDark ? 'text-slate-300' : 'text-slate-700'">
            Navigation
          </h4>
          <ul class="space-y-2 text-xs">
            <li><router-link to="/about" class="hover:text-cyan-400 transition-colors">About Me</router-link></li>
            <li><router-link to="/services" class="hover:text-cyan-400 transition-colors">IT Support & Services</router-link></li>
            <li><router-link to="/projects" class="hover:text-cyan-400 transition-colors">Portfolio Showcase</router-link></li>
            <li><router-link to="/experience" class="hover:text-cyan-400 transition-colors">Work Experience</router-link></li>
            <li><router-link to="/certifications" class="hover:text-cyan-400 transition-colors">Certifications</router-link></li>
            <li><router-link to="/blog" class="hover:text-cyan-400 transition-colors">Articles & Guides</router-link></li>
          </ul>
        </div>

        <!-- Col 3: Contact & Direct -->
        <div class="space-y-3">
          <h4 class="text-xs font-mono font-bold uppercase tracking-wider" :class="store.isDark ? 'text-slate-300' : 'text-slate-700'">
            Direct Inquiries
          </h4>
          <ul class="space-y-2 text-xs">
            <li class="flex items-center gap-2">
              <Mail class="w-3.5 h-3.5 text-cyan-400" />
              <a :href="'mailto:' + (store.profile.settings?.contact_email || 'puvy.developer@example.com')" class="hover:text-cyan-400 transition-colors">
                {{ store.profile.settings?.contact_email || 'puvy.developer@example.com' }}
              </a>
            </li>
            <li class="flex items-center gap-2">
              <Phone class="w-3.5 h-3.5 text-cyan-400" />
              <span>{{ store.profile.settings?.contact_phone || '+1 (555) 234-5678' }}</span>
            </li>
            <li class="flex items-center gap-2">
              <MapPin class="w-3.5 h-3.5 text-cyan-400" />
              <span>{{ store.profile.location }}</span>
            </li>
          </ul>
        </div>
      </div>

      <div
        class="border-t pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono"
        :class="store.isDark ? 'border-slate-900 text-slate-500' : 'border-slate-200 text-slate-500'"
      >
        <p>© {{ new Date().getFullYear() }} {{ store.profile.name }}. All Rights Reserved. Built with Vue 3, Tailwind CSS & Laravel 11.</p>
        <div class="flex items-center gap-4">
          <router-link to="/admin/login" class="hover:text-cyan-400 flex items-center gap-1 opacity-70 hover:opacity-100 transition-opacity">
            <Shield class="w-3 h-3" /> Admin Login
          </router-link>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../../store/portfolio';
import { Mail, Phone, MapPin, Shield, Github, Linkedin, Send, Twitter, Facebook, Globe, Share2 } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
