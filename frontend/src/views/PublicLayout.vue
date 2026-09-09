<template>
  <div
    class="min-h-screen flex flex-col font-mono transition-colors duration-200 selection:bg-emerald-500 selection:text-slate-950 relative bg-coder-grid overflow-x-hidden"
    :class="portfolioStore.isDark ? 'bg-[#050811] text-slate-100 dark' : 'bg-slate-50 text-slate-900 light'"
  >
    <!-- Ambient Terminal Matrix Glows -->
    <div class="fixed top-0 left-1/3 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="fixed bottom-10 right-1/4 w-[450px] h-[450px] bg-cyan-500/10 rounded-full blur-[130px] pointer-events-none -z-10"></div>

    <Navbar />

    <main class="flex-1 relative z-10">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </main>

    <Footer />
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { usePortfolioStore } from '../store/portfolio';
import Navbar from '../components/layout/Navbar.vue';
import Footer from '../components/layout/Footer.vue';

const portfolioStore = usePortfolioStore();

onMounted(() => {
  portfolioStore.loadPortfolio();
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.15s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
