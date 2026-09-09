<template>
  <section id="terminal" class="py-12 relative font-mono">
    <div class="max-w-4xl mx-auto">
      
      <!-- Section Header -->
      <div class="text-center max-w-2xl mx-auto space-y-2 mb-8">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
          :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400 shadow-sm shadow-emerald-500/10' : 'bg-slate-100 border-slate-300 text-slate-700'"
        >
          <Terminal class="w-3.5 h-3.5 text-emerald-400" /> CLI Terminal v2.0
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
          Interactive Shell & Diagnostics
        </h2>
        <p class="text-xs sm:text-sm" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
          Execute bash commands or click quick shortcuts to query live system data.
        </p>
      </div>

      <!-- Quick Command Buttons -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-4 font-mono text-xs">
        <button
          v-for="cmd in ['help', 'bio', 'skills', 'projects', 'experience', 'contact', 'theme', 'sudo hire-me']"
          :key="cmd"
          @click="handleQuickCommand(cmd)"
          class="px-2.5 py-1 rounded-md border transition-all duration-150 cursor-pointer"
          :class="store.isDark
            ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400 hover:bg-emerald-500/10 hover:border-emerald-400'
            : 'bg-white border-slate-300 text-slate-700 hover:border-emerald-500 hover:text-emerald-700 shadow-xs'"
        >
          $&nbsp;{{ cmd }}
        </button>
      </div>

      <!-- Terminal Window Box -->
      <div class="rounded-xl border bg-[#050811] shadow-2xl overflow-hidden coder-glow-emerald"
        :class="store.isDark ? 'border-emerald-500/30' : 'border-slate-800'"
      >
        
        <!-- Header Bar -->
        <div class="px-4 py-2.5 bg-[#0b1120] border-b border-slate-800 flex items-center justify-between font-mono text-xs">
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-rose-500"></span>
            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
            <span class="ml-2 text-slate-400 hidden sm:inline">bash - puvy@dev-portfolio:~</span>
          </div>
          <button
            @click="store.executeTerminalCommand('clear')"
            class="text-slate-400 hover:text-rose-400 transition-colors flex items-center gap-1 cursor-pointer"
            title="Clear Terminal Output"
          >
            <Trash2 class="w-3.5 h-3.5" /> clear
          </button>
        </div>

        <!-- Terminal Logs Area -->
        <div
          ref="terminalLogContainer"
          class="p-6 font-mono text-xs sm:text-sm max-h-80 overflow-y-auto space-y-3 text-slate-300 leading-relaxed bg-[#050811]"
        >
          <div v-for="log in store.terminalLogs" :key="log.id" class="space-y-1">
            <!-- Command prompt line -->
            <div class="flex items-center gap-2 text-slate-400">
              <span class="text-emerald-400 font-bold">puvy@portfolio</span>:<span class="text-cyan-400">~</span>$&nbsp;
              <span class="text-slate-100 font-bold">{{ log.command }}</span>
              <span class="text-[10px] text-slate-600 ml-auto">{{ log.timestamp }}</span>
            </div>

            <!-- Output block -->
            <pre
              class="whitespace-pre-wrap font-mono p-3 rounded-lg text-xs"
              :class="getLogStyle(log.type)"
            >{{ log.output }}</pre>
          </div>
        </div>

        <!-- Input Line -->
        <form @submit.prevent="submitCommand" class="p-3 bg-[#0b1120] border-t border-slate-800 flex items-center gap-3">
          <span class="text-emerald-400 font-mono font-bold text-xs sm:text-sm">puvy@portfolio:~$</span>
          <input
            v-model="inputCommand"
            type="text"
            placeholder="Type 'help', 'skills', 'projects', 'sudo hire-me'..."
            class="flex-1 bg-transparent border-none outline-none font-mono text-xs sm:text-sm text-emerald-300 placeholder-slate-600 focus:ring-0"
          />
          <button
            type="submit"
            class="px-3.5 py-1.5 rounded bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-mono font-bold text-xs transition-colors cursor-pointer"
          >
            Execute ↵
          </button>
        </form>

      </div>

    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, nextTick } from 'vue';
import { usePortfolioStore } from '../../store/portfolio';
import { Terminal, Trash2 } from 'lucide-vue-next';

const store = usePortfolioStore();
const inputCommand = ref('');
const terminalLogContainer = ref<HTMLElement | null>(null);

function submitCommand() {
  if (!inputCommand.value.trim()) return;
  store.executeTerminalCommand(inputCommand.value);
  inputCommand.value = '';
  scrollToBottom();
}

function handleQuickCommand(cmd: string) {
  store.executeTerminalCommand(cmd);
  scrollToBottom();
}

function scrollToBottom() {
  nextTick(() => {
    if (terminalLogContainer.value) {
      terminalLogContainer.value.scrollTop = terminalLogContainer.value.scrollHeight;
    }
  });
}

function getLogStyle(type: string) {
  switch (type) {
    case 'success':
      return 'bg-emerald-950/40 border border-emerald-500/30 text-emerald-300';
    case 'warning':
      return 'bg-amber-950/40 border border-amber-500/30 text-amber-300';
    case 'error':
      return 'bg-rose-950/40 border border-rose-500/30 text-rose-300';
    case 'system':
      return 'bg-cyan-950/40 border border-cyan-500/30 text-cyan-300';
    default:
      return 'bg-[#050811] border border-slate-800 text-slate-300';
  }
}
</script>
