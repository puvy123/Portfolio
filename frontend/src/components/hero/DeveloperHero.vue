<template>
  <section id="hero" class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
    <!-- Ambient Glow Background -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-gradient-to-tr from-cyan-500/20 via-purple-500/20 to-blue-500/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <!-- Left Column: Intro & Bio -->
        <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
          
          <!-- Status Badge -->
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-cyan-500/30 bg-cyan-500/10 text-cyan-400 font-mono text-xs font-semibold">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
            Senior Developer • Vue 3 + TypeScript + Laravel 11
          </div>

          <!-- Headline -->
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
            Hi, I'm <span class="gradient-text-cyan-violet">{{ store.profile.name }}</span>
            <br />
            <span class="text-2xl sm:text-3xl lg:text-4xl text-slate-300 font-medium mt-2 block font-mono">
              Building <span class="text-cyan-400">{{ currentRole }}</span><span class="animate-blink">|</span>
            </span>
          </h1>

          <!-- Bio Description -->
          <p class="text-slate-400 text-base sm:text-lg max-w-2xl leading-relaxed">
            {{ store.profile.bio }}
          </p>

          <!-- Action Buttons -->
          <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
            <a
              href="#projects"
              class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-400 hover:to-indigo-500 text-white font-semibold text-sm shadow-lg shadow-cyan-500/25 transition-all hover:scale-105 active:scale-95 flex items-center gap-2"
            >
              <Code2 class="w-4 h-4" /> Explore Projects
            </a>

            <a
              href="#terminal"
              class="px-6 py-3 rounded-xl border border-slate-700 bg-slate-900/80 hover:bg-slate-800 text-cyan-400 font-mono text-sm font-semibold transition-all hover:scale-105 flex items-center gap-2"
            >
              <Terminal class="w-4 h-4" /> Launch CLI Shell
            </a>
          </div>

          <!-- Stats Grid -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 border-t border-slate-800/80">
            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800/60 text-center lg:text-left">
              <div class="text-2xl font-bold font-mono text-cyan-400">{{ store.profile.stats.years_exp }}</div>
              <div class="text-xs text-slate-400 mt-0.5">Experience</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800/60 text-center lg:text-left">
              <div class="text-2xl font-bold font-mono text-indigo-400">{{ store.profile.stats.projects_completed }}</div>
              <div class="text-xs text-slate-400 mt-0.5">Projects Built</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800/60 text-center lg:text-left">
              <div class="text-2xl font-bold font-mono text-emerald-400">{{ store.profile.stats.code_commits }}</div>
              <div class="text-xs text-slate-400 mt-0.5">Git Commits</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800/60 text-center lg:text-left">
              <div class="text-2xl font-bold font-mono text-amber-400">{{ store.profile.stats.coffee_cups }}</div>
              <div class="text-xs text-slate-400 mt-0.5">Coffee Cups</div>
            </div>
          </div>

        </div>

        <!-- Right Column: Interactive Code Visualizer -->
        <div class="lg:col-span-5">
          <div class="relative rounded-2xl border border-slate-800 bg-slate-950/90 shadow-2xl overflow-hidden cyber-glow-cyan">
            <!-- Code Window Header -->
            <div class="px-4 py-3 bg-slate-900 border-b border-slate-800 flex items-center justify-between">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
              </div>
              <div class="text-xs font-mono text-slate-400 flex items-center gap-1.5">
                <FileCode2 class="w-3.5 h-3.5 text-cyan-400" /> Developer.ts
              </div>
            </div>

            <!-- Code Content -->
            <div class="p-5 font-mono text-xs sm:text-sm text-slate-300 leading-relaxed overflow-x-auto space-y-2">
              <div><span class="text-purple-400">interface</span> <span class="text-amber-300">FullStackDeveloper</span> {</div>
              <div class="pl-4"><span class="text-cyan-400">name</span>: <span class="text-emerald-300">'{{ store.profile.name }}'</span>;</div>
              <div class="pl-4"><span class="text-cyan-400">frontend</span>: [<span class="text-emerald-300">'Vue 3'</span>, <span class="text-emerald-300">'TypeScript'</span>, <span class="text-emerald-300">'Shadcn-vue'</span>, <span class="text-emerald-300">'Element Plus'</span>];</div>
              <div class="pl-4"><span class="text-cyan-400">backend</span>: [<span class="text-emerald-300">'Laravel 11'</span>, <span class="text-emerald-300">'PHP 8.3'</span>, <span class="text-emerald-300">'REST API'</span>];</div>
              <div class="pl-4"><span class="text-cyan-400">database</span>: [<span class="text-emerald-300">'MySQL 8.0'</span>, <span class="text-emerald-300">'Redis'</span>];</div>
              <div class="pl-4"><span class="text-cyan-400">status</span>: <span class="text-emerald-300">'Ready for next big challenge'</span>;</div>
              <div>}</div>
              <br />
              <div><span class="text-purple-400">async function</span> <span class="text-blue-400">buildFuture</span>(): <span class="text-amber-300">Promise</span>&lt;<span class="text-emerald-300">App</span>&gt; {</div>
              <div class="pl-4"><span class="text-purple-400">return new</span> <span class="text-amber-300">Portfolio</span>({ quality: <span class="text-orange-400">100</span>, speed: <span class="text-orange-400">99</span> });</div>
              <div>}</div>
            </div>

            <!-- Footer Badge -->
            <div class="px-4 py-2 bg-slate-900/80 border-t border-slate-800 text-xs font-mono text-slate-400 flex items-center justify-between">
              <span class="text-emerald-400 flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-emerald-400"></span> Compiled successfully</span>
              <span>UTF-8</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { usePortfolioStore } from '../../store/portfolio';
import { Code2, Terminal, FileCode2 } from 'lucide-vue-next';

const store = usePortfolioStore();

const roles = [
  'Vue 3 & TypeScript Apps',
  'Laravel 11 RESTful APIs',
  'Shadcn & Element Plus UIs',
  'MySQL Database Schemas',
  'Full-Stack Web Systems',
];

const currentRole = ref('');
let roleIndex = 0;
let charIndex = 0;
let isDeleting = false;
let timer: any = null;

function typeEffect() {
  const target = roles[roleIndex];
  if (isDeleting) {
    currentRole.value = target.substring(0, charIndex - 1);
    charIndex--;
  } else {
    currentRole.value = target.substring(0, charIndex + 1);
    charIndex++;
  }

  let delay = isDeleting ? 50 : 100;

  if (!isDeleting && charIndex === target.length) {
    delay = 2000;
    isDeleting = true;
  } else if (isDeleting && charIndex === 0) {
    isDeleting = false;
    roleIndex = (roleIndex + 1) % roles.length;
    delay = 500;
  }

  timer = setTimeout(typeEffect, delay);
}

onMounted(() => {
  typeEffect();
});

onUnmounted(() => {
  if (timer) clearTimeout(timer);
});
</script>
