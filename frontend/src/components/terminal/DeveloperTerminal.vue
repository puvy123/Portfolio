<template>
  <section id="terminal" class="py-12 relative">
    <div class="max-w-4xl mx-auto">
      
      <!-- Section Header -->
      <div class="text-center max-w-2xl mx-auto space-y-2 mb-8">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
          :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
        >
          <Terminal class="w-3.5 h-3.5 text-blue-500" /> CLI Terminal
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
          Interactive Shell
        </h2>
        <p class="text-xs sm:text-sm" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
          Prefer command-line interfaces? Type commands below or click quick shortcuts.
        </p>
      </div>

      <!-- Quick Command Buttons -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-4 font-mono text-xs">
        <button
          v-for="cmd in ['help', 'bio', 'skills', 'projects', 'experience', 'contact', 'theme', 'sudo hire-me']"
          :key="cmd"
          @click="handleQuickCommand(cmd)"
          class="px-2.5 py-1 rounded-lg border transition-colors duration-150 cursor-pointer"
          :class="store.isDark
            ? 'bg-zinc-900 border-zinc-800 text-zinc-300 hover:border-zinc-700 hover:text-white'
            : 'bg-white border-zinc-200 text-zinc-700 hover:border-zinc-300 hover:text-zinc-900 shadow-xs'"
        >
          $&nbsp;{{ cmd }}
        </button>
      </div>

      <!-- Terminal Window Box -->
      <div class="rounded-2xl border bg-zinc-950 shadow-xl overflow-hidden"
        :class="store.isDark ? 'border-zinc-800' : 'border-zinc-300'"
      >
        
        <!-- Header Bar -->
        <div class="px-4 py-3 bg-zinc-900 border-b border-zinc-800 flex items-center justify-between font-mono text-xs">
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
            <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
            <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
            <span class="ml-2 text-zinc-400 hidden sm:inline">bash - puvy@portfolio:~</span>
          </div>
          <button
            @click="store.executeTerminalCommand('clear')"
            class="text-zinc-400 hover:text-red-400 transition-colors flex items-center gap-1 cursor-pointer"
            title="Clear Terminal Output"
          >
            <Trash2 class="w-3.5 h-3.5" /> clear
          </button>
        </div>

        <!-- Terminal Logs Area -->
        <div
          ref="terminalLogContainer"
          class="p-6 font-mono text-xs sm:text-sm max-h-80 overflow-y-auto space-y-3 text-zinc-300 leading-relaxed"
        >
          <div v-for="log in store.terminalLogs" :key="log.id" class="space-y-1">
            <!-- Command prompt line -->
            <div class="flex items-center gap-2 text-zinc-400">
              <span class="text-emerald-400">puvy@portfolio</span>:<span class="text-blue-400">~</span>$&nbsp;
              <span class="text-zinc-100 font-bold">{{ log.command }}</span>
              <span class="text-[10px] text-zinc-600 ml-auto">{{ log.timestamp }}</span>
            </div>

            <!-- Output block -->
            <pre
              class="whitespace-pre-wrap font-mono p-3 rounded-xl text-xs"
              :class="getLogStyle(log.type)"
            >{{ log.output }}</pre>
          </div>
        </div>

        <!-- Input Line -->
        <form @submit.prevent="submitCommand" class="p-3.5 bg-zinc-900/90 border-t border-zinc-800 flex items-center gap-3">
          <span class="text-emerald-400 font-mono font-bold text-xs sm:text-sm">puvy@portfolio:~$</span>
          <input
            v-model="inputCommand"
            type="text"
            placeholder="Type 'help', 'skills', 'projects', 'contact'..."
            class="flex-1 bg-transparent border-none outline-none font-mono text-xs sm:text-sm text-zinc-200 placeholder-zinc-600 focus:ring-0"
          />
          <button
            type="submit"
            class="px-3 py-1.5 rounded-lg bg-white text-zinc-950 hover:bg-zinc-200 font-mono font-bold text-xs transition-colors cursor-pointer"
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
      return 'bg-emerald-950/40 border border-emerald-800/40 text-emerald-300';
    case 'warning':
      return 'bg-amber-950/40 border border-amber-800/40 text-amber-300';
    case 'error':
      return 'bg-red-950/40 border border-red-800/40 text-red-300';
    case 'system':
      return 'bg-blue-950/40 border border-blue-800/40 text-blue-300';
    default:
      return 'bg-zinc-900/80 border border-zinc-800 text-zinc-300';
  }
}
</script>
