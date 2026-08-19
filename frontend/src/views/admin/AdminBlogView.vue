<template>
  <div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-slate-100">Articles & Blog CMS</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Write, edit, and publish technical guides, tutorials, and IT knowledge base articles</p>
      </div>

      <button
        @click="openDialog()"
        class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-md flex items-center gap-2"
      >
        <Plus class="w-4 h-4" /> Write New Article
      </button>
    </div>

    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden">
      <el-table :data="adminStore.blogPosts" style="width: 100%" v-loading="adminStore.loading">
        <el-table-column prop="title" label="Title" min-width="220">
          <template #default="{ row }">
            <span class="font-bold text-slate-200 block">{{ row.title }}</span>
            <span class="text-[10px] font-mono text-cyan-400">/blog/{{ row.slug }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="status" label="Status" width="110">
          <template #default="{ row }">
            <el-tag :type="row.status === 'published' ? 'success' : 'info'" size="small">
              {{ row.status }}
            </el-tag>
          </template>
        </el-table-column>

        <el-table-column prop="author" label="Author" width="120" />

        <el-table-column label="Actions" width="140" align="right">
          <template #default="{ row }">
            <div class="flex items-center justify-end gap-2">
              <el-button size="small" type="primary" plain @click="openDialog(row)">Edit</el-button>
              <el-button size="small" type="danger" plain @click="handleDelete(row.id)">Delete</el-button>
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <!-- Dialog -->
    <el-dialog
      v-model="dialogVisible"
      :title="editingId ? 'Edit Article' : 'Write New Article'"
      width="700px"
      destroy-on-close
    >
      <el-form :model="form" label-position="top" class="space-y-3">
        <el-form-item label="Article Title" required>
          <el-input v-model="form.title" placeholder="e.g. Modern Full-Stack Vue 3 & Laravel 11 Architecture" />
        </el-form-item>

        <div class="grid grid-cols-2 gap-4">
          <el-form-item label="Status" required>
            <el-select v-model="form.status" style="width: 100%">
              <el-option label="Published" value="published" />
              <el-option label="Draft" value="draft" />
            </el-select>
          </el-form-item>

          <el-form-item label="Author">
            <el-input v-model="form.author" placeholder="Puvy" />
          </el-form-item>
        </div>

        <el-form-item label="Featured Image URL">
          <el-input v-model="form.featured_image" placeholder="https://images.unsplash.com/..." />
        </el-form-item>

        <el-form-item label="Short Excerpt">
          <el-input v-model="form.excerpt" type="textarea" :rows="2" placeholder="Brief 1-2 sentence preview..." />
        </el-form-item>

        <el-form-item label="Full Article Content (Markdown / Text)" required>
          <el-input v-model="form.content" type="textarea" :rows="8" placeholder="## Section 1&#10;&#10;Write content here..." />
        </el-form-item>

        <div class="grid grid-cols-2 gap-4 pt-2 border-t border-slate-800">
          <el-form-item label="SEO Meta Title">
            <el-input v-model="form.seo_title" placeholder="SEO optimized title..." />
          </el-form-item>

          <el-form-item label="SEO Meta Keywords">
            <el-input v-model="form.seo_keywords" placeholder="vue3, laravel, mysql" />
          </el-form-item>
        </div>
      </el-form>

      <template #footer>
        <div class="flex justify-end gap-2">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" :loading="saving" @click="handleSave">Save Article</el-button>
        </div>
      </template>
    </el-dialog>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useAdminStore } from '../../store/admin';
import { Plus } from 'lucide-vue-next';
import { ElMessageBox, ElMessage } from 'element-plus';
import type { BlogPost } from '../../types';

const adminStore = useAdminStore();
const dialogVisible = ref(false);
const editingId = ref<number | null>(null);
const saving = ref(false);

const form = ref<Partial<BlogPost>>({
  title: '',
  featured_image: '',
  excerpt: '',
  content: '',
  author: 'Puvy',
  status: 'published',
  seo_title: '',
  seo_description: '',
  seo_keywords: '',
});

onMounted(() => {
  adminStore.loadBlogPosts();
});

function openDialog(item?: BlogPost) {
  if (item) {
    editingId.value = item.id;
    form.value = { ...item };
  } else {
    editingId.value = null;
    form.value = {
      title: '',
      featured_image: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
      excerpt: '',
      content: '## Overview\n\nWrite your guide here...',
      author: 'Puvy',
      status: 'published',
      published_at: new Date().toISOString(),
      seo_title: '',
      seo_description: '',
      seo_keywords: '',
    };
  }
  dialogVisible.value = true;
}

async function handleSave() {
  saving.value = true;
  try {
    await adminStore.saveBlogPost(form.value);
    ElMessage.success('Article saved');
    dialogVisible.value = false;
  } catch (err: any) {
    ElMessage.error('Failed to save article');
  } finally {
    saving.value = false;
  }
}

async function handleDelete(id: number) {
  try {
    await ElMessageBox.confirm('Are you sure you want to delete this article?', 'Warning', {
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      type: 'warning',
    });
    await adminStore.deleteBlogPost(id);
    ElMessage.success('Article deleted');
  } catch (e) {
    // Cancelled
  }
}
</script>
