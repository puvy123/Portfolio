<template>
  <section id="terminal" class="py-20 bg-slate-950/70 relative">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto space-y-4 mb-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
          <Terminal class="w-3.5 h-3.5" /> Developer Shell
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
          Interactive <span class="gradient-text-cyan-violet">CLI Terminal</span>
        </h2>
        <p class="text-slate-400 text-base">
          Prefer command-line interfaces? Type commands below or click quick shortcuts to inspect portfolio details.
        </p>
      </div>

      <!-- Quick Command Buttons -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-6 font-mono text-xs">
        <button
          v-for="cmd in ['help', 'bio', 'skills', 'projects', 'experience', 'contact', 'theme', 'sudo hire-me']"
          :key="cmd"
          @click="handleQuickCommand(cmd)"
          class="px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-cyan-400 hover:border-cyan-500/50 hover:bg-slate-800 transition-all cursor-pointer"
        >
          $&nbsp;{{ cmd }}
        </button>
      </div>

      <!-- Terminal Window Box -->
      <div class="rounded-2xl border border-slate-800 bg-slate-950 shadow-2xl overflow-hidden cyber-glow-cyan">
        
        <!-- Header Bar -->
        <div class="px-4 py-3 bg-slate-900 border-b border-slate-800 flex items-center justify-between font-mono text-xs">
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-rose-500"></span>
            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
            <span class="ml-2 text-slate-400 hidden sm:inline">bash - puvy@portfolio:~</span>
          </div>
          <button
            @click="store.executeTerminalCommand('clear')"
            class="text-slate-400 hover:text-rose-400 transition-colors flex items-center gap-1"
            title="Clear Terminal Output"
          >
            <Trash2 class="w-3.5 h-3.5" /> clear
          </button>
        </div>

        <!-- Terminal Logs Area -->
        <div
          ref="terminalLogContainer"
          class="p-6 font-mono text-xs sm:text-sm max-h-96 overflow-y-auto space-y-4 text-slate-300 leading-relaxed"
        >
          <div v-for="log in store.terminalLogs" :key="log.id" class="space-y-1">
            <!-- Command prompt line -->
            <div class="flex items-center gap-2 text-slate-400">
              <span class="text-emerald-400">puvy@portfolio</span>:<span class="text-cyan-400">~</span>$&nbsp;
              <span class="text-slate-100 font-bold">{{ log.command }}</span>
              <span class="text-[10px] text-slate-600 ml-auto">{{ log.timestamp }}</span>
            </div>

            <!-- Output block -->
            <pre
              class="whitespace-pre-wrap font-mono p-3 rounded-xl text-xs"
              :class="getLogStyle(log.type)"
            >{{ log.output }}</pre>
          </div>
        </div>

        <!-- Input Line -->
        <form @submit.prevent="submitCommand" class="p-4 bg-slate-900/90 border-t border-slate-800 flex items-center gap-3">
          <span class="text-emerald-400 font-mono font-bold text-sm">puvy@portfolio:~$</span>
          <input
            v-model="inputCommand"
            type="text"
            placeholder="Type 'help', 'skills', 'projects', 'contact'..."
            class="flex-1 bg-transparent border-none outline-none font-mono text-sm text-cyan-300 placeholder-slate-600 focus:ring-0"
          />
          <button
            type="submit"
            class="px-4 py-1.5 rounded-lg bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-mono font-bold text-xs transition-colors"
          >
            Run ↵
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
      return 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-300';
    case 'warning':
      return 'bg-amber-500/10 border border-amber-500/20 text-amber-300';
    case 'error':
      return 'bg-rose-500/10 border border-rose-500/20 text-rose-300';
    case 'system':
      return 'bg-indigo-500/10 border border-indigo-500/20 text-indigo-300';
    default:
      return 'bg-slate-900 border border-slate-800 text-slate-300';
  }
}
</script>
