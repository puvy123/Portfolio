<template>
  <footer
    class="border-t py-12 transition-colors duration-200 font-mono"
    :class="store.isDark ? 'border-emerald-500/20 bg-[#050811] text-slate-400' : 'border-slate-200 bg-slate-100 text-slate-600'"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <!-- Col 1: Bio -->
        <div class="space-y-4 md:col-span-2">
          <div class="flex items-center gap-3">
            <img
              src="/logo.png"
              alt="PuvY Logo"
              class="w-8 h-8 object-contain rounded-lg"
            />
            <span class="font-bold text-base font-mono" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
              PuvY<span class="text-emerald-400">.dev</span>
            </span>
          </div>
          <p class="text-xs max-w-md leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
            // {{ store.profile.title }}
          </p>
          <div class="flex items-center gap-2 pt-1">
            <a
              v-for="soc in store.socialLinks"
              :key="soc.id"
              :href="soc.url"
              target="_blank"
              class="p-2 rounded-lg border transition-colors duration-150"
              :class="store.isDark
                ? 'bg-[#0b1120] border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/40'
                : 'bg-white border-slate-300 text-slate-600 hover:text-slate-900'"
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
          <h4 class="text-xs font-mono font-bold text-emerald-400">
            // navigation
          </h4>
          <ul class="space-y-2 text-xs">
            <li><router-link to="/about" class="hover:text-emerald-400 transition-colors">~/about</router-link></li>
            <li><router-link to="/services" class="hover:text-emerald-400 transition-colors">~/services</router-link></li>
            <li><router-link to="/projects" class="hover:text-emerald-400 transition-colors">~/projects</router-link></li>
            <li><router-link to="/experience" class="hover:text-emerald-400 transition-colors">~/experience</router-link></li>
            <li><router-link to="/certifications" class="hover:text-emerald-400 transition-colors">~/certs</router-link></li>
            <li><router-link to="/blog" class="hover:text-emerald-400 transition-colors">~/blog</router-link></li>
          </ul>
        </div>

        <!-- Col 3: Contact & Direct -->
        <div class="space-y-3">
          <h4 class="text-xs font-mono font-bold text-emerald-400">
            // endpoints
          </h4>
          <ul class="space-y-2 text-xs">
            <li class="flex items-center gap-2">
              <Mail class="w-3.5 h-3.5 text-emerald-400" />
              <a :href="'mailto:' + (store.profile.settings?.contact_email || 'khounvyvy@gmail.com')" class="hover:text-emerald-400 transition-colors">
                {{ store.profile.settings?.contact_email || 'khounvyvy@gmail.com' }}
              </a>
            </li>
            <li class="flex items-center gap-2">
              <Phone class="w-3.5 h-3.5 text-emerald-400" />
              <span>{{ store.profile.settings?.contact_phone || '+855 963454358' }}</span>
            </li>
            <li class="flex items-center gap-2">
              <MapPin class="w-3.5 h-3.5 text-emerald-400" />
              <span>{{ store.profile.location }}</span>
            </li>
          </ul>
        </div>
      </div>

      <div
        class="border-t pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono"
        :class="store.isDark ? 'border-slate-800 text-slate-500' : 'border-slate-200 text-slate-500'"
      >
        <p>/* © {{ new Date().getFullYear() }} {{ store.profile.name }}.dev — system: active */</p>
        <div class="flex items-center gap-4 text-[11px] text-emerald-400">
          <span>Cambodia 🇰🇭</span>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { usePortfolioStore } from '../../store/portfolio';
import { Mail, Phone, MapPin, Github, Linkedin, Send, Twitter, Facebook, Globe, Share2 } from 'lucide-vue-next';

const store = usePortfolioStore();
</script>
