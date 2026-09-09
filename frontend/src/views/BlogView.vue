<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
      >
        <BookOpen class="w-3.5 h-3.5 text-blue-500" /> Technical Writings
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Articles & Guides</h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
        IT infrastructure, network diagnostics, full-stack web architecture, and developer notes.
      </p>
    </div>

    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 max-w-4xl mx-auto">
      <div class="relative w-full sm:w-80">
        <Search class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500" />
        <input
          v-model="searchQuery"
          @input="handleSearch"
          type="text"
          placeholder="Search articles..."
          class="w-full pl-10 pr-4 py-2 rounded-xl border text-xs font-mono outline-none transition-colors"
          :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-200 focus:border-blue-500' : 'bg-white border-zinc-300 text-zinc-900 focus:border-blue-600 shadow-xs'"
        />
      </div>

      <div class="flex flex-wrap items-center gap-2">
        <button
          @click="selectCategory('')"
          class="px-3.5 py-1.5 rounded-xl text-xs font-mono transition-colors duration-150 cursor-pointer"
          :class="!activeCategory
            ? (store.isDark ? 'bg-white text-zinc-950 font-bold' : 'bg-zinc-900 text-white font-bold')
            : (store.isDark ? 'bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-zinc-200' : 'bg-white border border-zinc-200 text-zinc-600 hover:text-zinc-900 shadow-xs')"
        >
          All Topics
        </button>
        <button
          v-for="cat in categories"
          :key="cat.id"
          @click="selectCategory(cat.slug)"
          class="px-3.5 py-1.5 rounded-xl text-xs font-mono transition-colors duration-150 cursor-pointer"
          :class="activeCategory === cat.slug
            ? (store.isDark ? 'bg-white text-zinc-950 font-bold' : 'bg-zinc-900 text-white font-bold')
            : (store.isDark ? 'bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-zinc-200' : 'bg-white border border-zinc-200 text-zinc-600 hover:text-zinc-900 shadow-xs')"
        >
          {{ cat.name }}
        </button>
      </div>
    </div>

    <!-- Articles Grid -->
    <div v-if="store.blogLoading" class="text-center py-20 font-mono text-xs" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">
      Loading published articles...
    </div>

    <div v-else-if="store.blogPosts.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
      <article
        v-for="post in store.blogPosts"
        :key="post.id"
        class="rounded-2xl border overflow-hidden flex flex-col justify-between transition-all duration-150 group"
        :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800 hover:border-zinc-700' : 'bg-white border-zinc-200 hover:border-zinc-300 shadow-xs'"
      >
        <div>
          <!-- Cover Image -->
          <div class="relative aspect-video overflow-hidden border-b" :class="store.isDark ? 'bg-zinc-950 border-zinc-800' : 'bg-zinc-100 border-zinc-200'">
            <img
              :src="post.featured_image || 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80'"
              :alt="post.title"
              class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-300"
            />
            <div class="absolute top-3 left-3 px-2.5 py-1 rounded-md border text-[10px] font-mono backdrop-blur-md"
              :class="store.isDark ? 'bg-zinc-950/80 border-zinc-800 text-zinc-300' : 'bg-white/90 border-zinc-200 text-zinc-700'"
            >
              {{ post.category?.name || 'General' }}
            </div>
          </div>

          <!-- Content -->
          <div class="p-5 space-y-3">
            <div class="flex items-center gap-2 text-[11px] font-mono" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">
              <span>{{ post.author || 'Puvy' }}</span>
              <span>•</span>
              <span>{{ post.published_at ? new Date(post.published_at).toLocaleDateString() : 'Recent' }}</span>
            </div>

            <h3 class="text-lg font-bold line-clamp-2" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
              {{ post.title }}
            </h3>

            <p class="text-xs line-clamp-3 leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
              {{ post.excerpt }}
            </p>

            <div v-if="post.tags && post.tags.length" class="flex flex-wrap gap-1.5 pt-1">
              <span
                v-for="tag in post.tags"
                :key="tag.id"
                class="px-2 py-0.5 rounded-md border text-[10px] font-mono"
                :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-400' : 'bg-zinc-50 border-zinc-200 text-zinc-600'"
              >
                #{{ tag.name }}
              </span>
            </div>
          </div>
        </div>

        <div class="p-5 pt-0 border-t" :class="store.isDark ? 'border-zinc-800' : 'border-zinc-100'">
          <router-link
            :to="'/blog/' + post.slug"
            class="w-full py-2 rounded-xl border font-mono text-xs font-semibold transition-colors flex items-center justify-center gap-1.5 cursor-pointer"
            :class="store.isDark
              ? 'bg-zinc-950 border-zinc-800 text-zinc-300 hover:text-white hover:border-zinc-700'
              : 'bg-zinc-50 border-zinc-200 text-zinc-700 hover:text-zinc-900 hover:border-zinc-300'"
          >
            Read Article →
          </router-link>
        </div>
      </article>
    </div>

    <div v-else class="text-center py-20 font-mono text-xs" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">
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
