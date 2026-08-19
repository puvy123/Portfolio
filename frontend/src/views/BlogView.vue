<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
        <BookOpen class="w-3.5 h-3.5" /> Technical Writings
      </div>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-100 tracking-tight">Articles & Engineering Notes</h1>
      <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
        Deep dives into IT infrastructure, network diagnostics, full-stack web architecture, and developer tooling.
      </p>
    </div>

    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 max-w-4xl mx-auto">
      <div class="relative w-full sm:w-80">
        <Search class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500" />
        <input
          v-model="searchQuery"
          @input="handleSearch"
          type="text"
          placeholder="Search articles..."
          class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-900 border border-slate-800 focus:border-cyan-500 text-slate-200 text-xs font-mono outline-none transition-colors"
        />
      </div>

      <div class="flex flex-wrap items-center gap-2">
        <button
          @click="selectCategory('')"
          class="px-3.5 py-1.5 rounded-xl text-xs font-mono transition-all"
          :class="!activeCategory ? 'bg-cyan-500 text-slate-950 font-bold' : 'bg-slate-900 border border-slate-800 text-slate-400'"
        >
          All Topics
        </button>
        <button
          v-for="cat in categories"
          :key="cat.id"
          @click="selectCategory(cat.slug)"
          class="px-3.5 py-1.5 rounded-xl text-xs font-mono transition-all"
          :class="activeCategory === cat.slug ? 'bg-cyan-500 text-slate-950 font-bold' : 'bg-slate-900 border border-slate-800 text-slate-400'"
        >
          {{ cat.name }}
        </button>
      </div>
    </div>

    <!-- Articles Grid -->
    <div v-if="store.blogLoading" class="text-center py-20 text-slate-500 font-mono text-xs">
      Loading published articles...
    </div>

    <div v-else-if="store.blogPosts.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <article
        v-for="post in store.blogPosts"
        :key="post.id"
        class="rounded-3xl bg-slate-900/70 border border-slate-800 overflow-hidden flex flex-col justify-between hover:border-cyan-500/40 transition-all group hover:shadow-2xl hover:shadow-cyan-500/5"
      >
        <div>
          <!-- Cover Image -->
          <div class="relative aspect-video overflow-hidden bg-slate-950">
            <img
              :src="post.featured_image || 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80'"
              :alt="post.title"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            />
            <div class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-slate-950/80 backdrop-blur-md border border-slate-800 text-[10px] font-mono text-cyan-400">
              {{ post.category?.name || 'General' }}
            </div>
          </div>

          <!-- Content -->
          <div class="p-6 space-y-3">
            <div class="flex items-center gap-2 text-[11px] font-mono text-slate-500">
              <span>{{ post.author || 'Puvy' }}</span>
              <span>•</span>
              <span>{{ post.published_at ? new Date(post.published_at).toLocaleDateString() : 'Recent' }}</span>
            </div>

            <h3 class="text-xl font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-2">
              {{ post.title }}
            </h3>

            <p class="text-xs text-slate-400 line-clamp-3 leading-relaxed">
              {{ post.excerpt }}
            </p>

            <div v-if="post.tags && post.tags.length" class="flex flex-wrap gap-1.5 pt-2">
              <span
                v-for="tag in post.tags"
                :key="tag.id"
                class="px-2 py-0.5 rounded-md bg-slate-950 border border-slate-800 text-[10px] font-mono text-slate-400"
              >
                #{{ tag.name }}
              </span>
            </div>
          </div>
        </div>

        <div class="p-6 pt-0 border-t border-slate-800/80">
          <router-link
            :to="'/blog/' + post.slug"
            class="w-full py-2.5 rounded-xl bg-slate-950 hover:bg-cyan-500 text-slate-300 hover:text-slate-950 border border-slate-800 hover:border-cyan-400 font-mono text-xs font-bold transition-all flex items-center justify-center gap-2"
          >
            Read Article →
          </router-link>
        </div>
      </article>
    </div>

    <div v-else class="text-center py-20 text-slate-500 font-mono text-xs">
      No articles found matching your criteria.
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { usePortfolioStore } from '../store/portfolio';
import { fetchBlogPosts } from '../services/api';
import { BookOpen, Search } from 'lucide-vue-next';
import type { BlogCategory } from '../types';

const store = usePortfolioStore();
const searchQuery = ref('');
const activeCategory = ref('');
const categories = ref<BlogCategory[]>([]);

async function loadData() {
  const res = await fetchBlogPosts({ category: activeCategory.value, search: searchQuery.value });
  store.blogPosts = res.data;
  categories.value = res.categories;
}

function selectCategory(slug: string) {
  activeCategory.value = slug;
  loadData();
}

let timeout: any = null;
function handleSearch() {
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    loadData();
  }, 300);
}

onMounted(() => {
  loadData();
});
</script>
