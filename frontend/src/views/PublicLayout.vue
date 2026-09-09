<template>
  <div
    class="min-h-screen flex flex-col font-sans transition-colors duration-200 selection:bg-blue-600 selection:text-white"
    :class="portfolioStore.isDark ? 'bg-zinc-950 text-zinc-100 dark' : 'bg-zinc-50/50 text-zinc-900 light'"
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
  transition: opacity 0.15s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
