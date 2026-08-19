<template>
  <div
    class="min-h-screen flex flex-col font-sans transition-colors duration-300 selection:bg-cyan-500 selection:text-slate-950"
    :class="portfolioStore.isDark ? 'bg-slate-950 text-slate-100 dark' : 'bg-slate-50 text-slate-900 light'"
  >
    <Navbar />

    <main class="flex-1">
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
  transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
