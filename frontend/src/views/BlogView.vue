<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12 font-mono">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
      >
        <BookOpen class="w-3.5 h-3.5 text-emerald-400" /> blog.fetchLatest()
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        <span class="text-emerald-400">&lt;</span>Articles & Notes <span class="text-emerald-400">/&gt;</span>
      </h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        // IT infrastructure, network diagnostics, full-stack web architecture, and developer notes.
      </p>
    </div>

    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 max-w-4xl mx-auto">
      <div class="relative w-full sm:w-80">
        <Search class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-emerald-400" />
        <input
          v-model="searchQuery"
          @input="handleSearch"
          type="text"
          placeholder="grep -i 'search term'..."
          class="w-full pl-10 pr-4 py-2 rounded-lg border text-xs font-mono outline-none transition-colors"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800 text-emerald-300 focus:border-emerald-500' : 'bg-white border-slate-300 text-slate-900 focus:border-emerald-500 shadow-xs'"
        />
      </div>

      <div class="flex flex-wrap items-center gap-2">
        <button
          @click="selectCategory('')"
          class="px-3 py-1 rounded-lg text-xs font-mono transition-all duration-150 cursor-pointer"
          :class="!activeCategory
            ? (store.isDark ? 'bg-emerald-500 text-slate-950 font-bold' : 'bg-slate-900 text-emerald-400 font-bold')
            : (store.isDark ? 'bg-[#0b1120] border border-slate-800 text-slate-400 hover:text-emerald-400' : 'bg-white border border-slate-300 text-slate-600 hover:text-slate-900 shadow-xs')"
        >
          $ all_topics
        </button>
        <button
          v-for="cat in categories"
          :key="cat.id"
          @click="selectCategory(cat.slug)"
          class="px-3 py-1 rounded-lg text-xs font-mono transition-all duration-150 cursor-pointer"
          :class="activeCategory === cat.slug
            ? (store.isDark ? 'bg-emerald-500 text-slate-950 font-bold' : 'bg-slate-900 text-emerald-400 font-bold')
            : (store.isDark ? 'bg-[#0b1120] border border-slate-800 text-slate-400 hover:text-emerald-400' : 'bg-white border border-slate-300 text-slate-600 hover:text-slate-900 shadow-xs')"
        >
          {{ cat.name }}
        </button>
      </div>
    </div>

    <!-- Articles Grid -->
    <div v-if="store.blogLoading" class="text-center py-20 font-mono text-xs text-slate-500">
      $ loading articles from database...
    </div>

    <div v-else-if="store.blogPosts.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <article
        v-for="post in store.blogPosts"
        :key="post.id"
        class="rounded-xl border overflow-hidden flex flex-col justify-between coder-card group"
        :class="store.isDark ? 'bg-[#0b1120] border-slate-800 hover:border-emerald-500/50' : 'bg-white border-slate-300 hover:border-emerald-500 shadow-xs'"
      >
        <div>
          <!-- Cover Image -->
          <div class="relative aspect-video overflow-hidden border-b border-slate-800 bg-[#050811]">
            <img
              :src="post.featured_image || 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80'"
              :alt="post.title"
              class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-300"
            />
            <div class="absolute top-3 left-3 px-2 py-0.5 rounded border text-[10px] font-mono backdrop-blur-md"
              :class="store.isDark ? 'bg-[#050811]/90 border-emerald-500/30 text-emerald-400' : 'bg-white/90 border-slate-300 text-slate-800'"
            >
              {{ post.category?.name || 'General' }}
            </div>
          </div>

          <!-- Content -->
          <div class="p-5 space-y-3">
            <div class="flex items-center gap-2 text-[10px] font-mono text-slate-500">
              <span>{{ post.author || 'Puvy' }}</span>
              <span>•</span>
              <span>{{ post.published_at ? new Date(post.published_at).toLocaleDateString() : 'Recent' }}</span>
            </div>

            <h3 class="text-base font-bold line-clamp-2 font-mono group-hover:text-emerald-400 transition-colors"
              :class="store.isDark ? 'text-slate-100' : 'text-slate-900'"
            >
              {{ post.title }}
            </h3>

            <p class="text-xs line-clamp-3 leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
              {{ post.excerpt }}
            </p>

            <div v-if="post.tags && post.tags.length" class="flex flex-wrap gap-1.5 pt-1">
              <span
                v-for="tag in post.tags"
                :key="tag.id"
                class="px-2 py-0.5 rounded border text-[10px] font-mono"
                :class="store.isDark ? 'bg-[#050811] border-emerald-500/20 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
              >
                #{{ tag.name }}
              </span>
            </div>
          </div>
        </div>

        <div class="p-5 pt-0 border-t border-slate-800">
          <router-link
            :to="'/blog/' + post.slug"
            class="w-full py-2 rounded-lg border font-mono text-xs font-bold transition-all flex items-center justify-center gap-1.5 cursor-pointer"
            :class="store.isDark
              ? 'bg-[#050811] border-emerald-500/30 text-emerald-400 hover:bg-emerald-500 hover:text-slate-950'
              : 'bg-slate-100 border-slate-300 text-slate-700 hover:bg-slate-900 hover:text-emerald-400'"
          >
            $ read article →
          </router-link>
        </div>
      </article>
    </div>

    <div v-else class="text-center py-20 font-mono text-xs text-slate-500">
      $ 0 articles found matching query.
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
