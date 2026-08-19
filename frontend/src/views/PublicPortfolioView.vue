<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 flex flex-col font-sans selection:bg-cyan-500 selection:text-slate-950">
    <Navbar />

    <main class="flex-1">
      <DeveloperHero />
      <SkillMatrix />
      <ProjectsSection />
      <ExperienceTimeline />
      <DeveloperTerminal />
      <ContactSection />
    </main>

    <ProjectDetailModal />
    <Footer />
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { usePortfolioStore } from '../store/portfolio';
import Navbar from '../components/layout/Navbar.vue';
import DeveloperHero from '../components/hero/DeveloperHero.vue';
import SkillMatrix from '../components/skills/SkillMatrix.vue';
import ProjectsSection from '../components/projects/ProjectsSection.vue';
import ProjectDetailModal from '../components/projects/ProjectDetailModal.vue';
import ExperienceTimeline from '../components/experience/ExperienceTimeline.vue';
import DeveloperTerminal from '../components/terminal/DeveloperTerminal.vue';
import ContactSection from '../components/contact/ContactSection.vue';
import Footer from '../components/layout/Footer.vue';

const store = usePortfolioStore();

onMounted(() => {
  store.loadPortfolio();
});
</script>
