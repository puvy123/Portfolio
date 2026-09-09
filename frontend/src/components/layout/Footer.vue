<template>
  <footer
    class="border-t py-12 transition-colors duration-200"
    :class="store.isDark ? 'border-zinc-800/80 bg-zinc-950 text-zinc-400' : 'border-zinc-200 bg-zinc-50 text-zinc-600'"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <!-- Col 1: Bio -->
        <div class="space-y-4 md:col-span-2">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center font-mono font-bold text-xs"
              :class="store.isDark ? 'bg-white text-zinc-950' : 'bg-zinc-900 text-white'"
            >
              &lt;/&gt;
            </div>
            <span class="font-bold text-base" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
              {{ store.profile.name }}
            </span>
          </div>
          <p class="text-xs sm:text-sm max-w-md leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
            {{ store.profile.title }}
          </p>
          <div class="flex items-center gap-2.5 pt-1">
            <a
              v-for="soc in store.socialLinks"
              :key="soc.id"
              :href="soc.url"
              target="_blank"
              class="p-2 rounded-xl border transition-colors duration-150"
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

        <!-- Col 2: Quick Links -->
        <div class="space-y-3">
          <h4 class="text-xs font-mono font-bold uppercase tracking-wider" :class="store.isDark ? 'text-zinc-300' : 'text-zinc-700'">
            Navigation
          </h4>
          <ul class="space-y-2 text-xs">
            <li><router-link to="/about" class="hover:text-blue-500 transition-colors">About Me</router-link></li>
            <li><router-link to="/services" class="hover:text-blue-500 transition-colors">Services</router-link></li>
            <li><router-link to="/projects" class="hover:text-blue-500 transition-colors">Projects</router-link></li>
            <li><router-link to="/experience" class="hover:text-blue-500 transition-colors">Experience</router-link></li>
            <li><router-link to="/certifications" class="hover:text-blue-500 transition-colors">Certifications</router-link></li>
            <li><router-link to="/blog" class="hover:text-blue-500 transition-colors">Blog</router-link></li>
          </ul>
        </div>

        <!-- Col 3: Contact & Direct -->
        <div class="space-y-3">
          <h4 class="text-xs font-mono font-bold uppercase tracking-wider" :class="store.isDark ? 'text-zinc-300' : 'text-zinc-700'">
            Contact
          </h4>
          <ul class="space-y-2 text-xs">
            <li class="flex items-center gap-2">
              <Mail class="w-3.5 h-3.5 text-zinc-500" />
              <a :href="'mailto:' + (store.profile.settings?.contact_email || 'khounvyvy@gmail.com')" class="hover:text-blue-500 transition-colors">
                {{ store.profile.settings?.contact_email || 'khounvyvy@gmail.com' }}
              </a>
            </li>
            <li class="flex items-center gap-2">
              <Phone class="w-3.5 h-3.5 text-zinc-500" />
              <span>{{ store.profile.settings?.contact_phone || '+855 963454358' }}</span>
            </li>
            <li class="flex items-center gap-2">
              <MapPin class="w-3.5 h-3.5 text-zinc-500" />
              <span>{{ store.profile.location }}</span>
            </li>
          </ul>
        </div>
      </div>

      <div
        class="border-t pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono"
        :class="store.isDark ? 'border-zinc-900 text-zinc-500' : 'border-zinc-200 text-zinc-500'"
      >
        <p>© {{ new Date().getFullYear() }} {{ store.profile.name }}. All Rights Reserved.</p>
        <div class="flex items-center gap-4 text-[11px] text-zinc-500">
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
