<template>
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Back Button -->
    <div>
      <router-link
        to="/blog"
        class="inline-flex items-center gap-2 text-xs font-mono text-cyan-400 hover:underline"
      >
        <ArrowLeft class="w-4 h-4" /> Back to All Articles
      </router-link>
    </div>

    <div v-if="store.blogLoading" class="text-center py-20 text-slate-500 font-mono text-xs">
      Loading article...
    </div>

    <article v-else-if="store.selectedArticle" class="space-y-8">
      <!-- Article Header -->
      <div class="space-y-4">
        <div class="flex items-center gap-3 text-xs font-mono">
          <span v-if="store.selectedArticle.category" class="px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400">
            {{ store.selectedArticle.category.name }}
          </span>
          <span class="text-slate-500">
            {{ store.selectedArticle.published_at ? new Date(store.selectedArticle.published_at).toLocaleDateString() : 'Recent' }}
          </span>
          <span class="text-slate-500">•</span>
          <span class="text-slate-400 font-semibold">{{ store.selectedArticle.author || 'Puvy' }}</span>
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-100 tracking-tight leading-tight">
          {{ store.selectedArticle.title }}
        </h1>
        <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
          {{ store.selectedArticle.excerpt }}
        </p>
      </div>

      <!-- Featured Image -->
      <div class="rounded-3xl overflow-hidden bg-slate-950 border border-slate-800 shadow-2xl">
        <img
          :src="store.selectedArticle.featured_image || 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80'"
          :alt="store.selectedArticle.title"
          class="w-full max-h-[450px] object-cover"
        />
      </div>

      <!-- Article Content Body -->
      <div class="p-8 sm:p-12 rounded-3xl bg-slate-900/60 border border-slate-800 space-y-6">
        <div class="prose prose-invert prose-cyan max-w-none text-slate-300 text-sm sm:text-base leading-relaxed whitespace-pre-line">
          {{ store.selectedArticle.content }}
        </div>

        <!-- Tags -->
        <div v-if="store.selectedArticle.tags && store.selectedArticle.tags.length" class="pt-6 border-t border-slate-800 flex flex-wrap gap-2">
          <span
            v-for="tag in store.selectedArticle.tags"
            :key="tag.id"
            class="px-3 py-1 rounded-lg bg-slate-950 border border-slate-800 text-xs font-mono text-cyan-400"
          >
            #{{ tag.name }}
          </span>
        </div>
      </div>

      <!-- Related Articles -->
      <div v-if="store.relatedArticles.length" class="space-y-6 pt-12 border-t border-slate-800">
        <h3 class="text-2xl font-bold text-slate-100">Related Articles</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <router-link
            v-for="rel in store.relatedArticles"
            :key="rel.id"
            :to="'/blog/' + rel.slug"
            class="p-6 rounded-2xl bg-slate-900/70 border border-slate-800 hover:border-cyan-500/40 transition-all space-y-2 group"
          >
            <span class="text-[10px] font-mono text-cyan-400 uppercase tracking-wider">{{ rel.category?.name }}</span>
            <h4 class="font-bold text-slate-100 text-base group-hover:text-cyan-400 transition-colors line-clamp-2">
              {{ rel.title }}
            </h4>
            <p class="text-xs text-slate-400 line-clamp-2">{{ rel.excerpt }}</p>
          </router-link>
        </div>
      </div>
    </article>

    <div v-else class="text-center py-20 space-y-4">
      <h2 class="text-2xl font-bold text-slate-200">Article Not Found</h2>
      <router-link to="/blog" class="text-cyan-400 font-mono text-xs hover:underline">
        ← Return to Articles Catalog
      </router-link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { watch, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { usePortfolioStore } from '../store/portfolio';
import { ArrowLeft } from 'lucide-vue-next';

const route = useRoute();
const store = usePortfolioStore();

function loadCurrentArticle() {
  const slug = route.params.slug as string;
  if (slug) {
    store.loadArticle(slug);
  }
}

watch(() => route.params.slug, () => {
  loadCurrentArticle();
});

onMounted(() => {
  loadCurrentArticle();
});
</script>
