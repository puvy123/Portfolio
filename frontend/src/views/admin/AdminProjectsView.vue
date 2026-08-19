<template>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-extrabold text-slate-100 tracking-tight">Projects Manager</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Add, edit, or remove portfolio showcase applications</p>
      </div>

      <button
        @click="openCreateDialog"
        class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-lg shadow-cyan-500/20 transition-all flex items-center gap-2"
      >
        <Plus class="w-4 h-4" /> Create New Project
      </button>
    </div>

    <!-- Element Plus Projects Table -->
    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden p-4">
      <el-table :data="adminStore.projects" style="width: 100%" size="large" v-loading="adminStore.loading">
        <el-table-column label="Thumbnail" width="100">
          <template #default="{ row }">
            <img :src="row.thumbnail" :alt="row.title" class="w-14 h-10 object-cover rounded-lg border border-slate-700" />
          </template>
        </el-table-column>

        <el-table-column prop="title" label="Title & Summary" min-width="220">
          <template #default="{ row }">
            <div class="font-bold text-slate-100 text-sm">{{ row.title }}</div>
            <div class="text-xs text-slate-400 truncate max-w-xs">{{ row.summary }}</div>
          </template>
        </el-table-column>

        <el-table-column label="Tags" min-width="180">
          <template #default="{ row }">
            <div class="flex flex-wrap gap-1">
              <span v-for="t in row.tags" :key="t" class="px-2 py-0.5 rounded text-[10px] font-mono bg-slate-800 text-cyan-300">
                {{ t }}
              </span>
            </div>
          </template>
        </el-table-column>

        <el-table-column label="Featured" width="100" align="center">
          <template #default="{ row }">
            <el-switch v-model="row.is_featured" @change="adminStore.saveProject(row)" />
          </template>
        </el-table-column>

        <el-table-column label="Actions" width="140" align="right">
          <template #default="{ row }">
            <div class="flex items-center justify-end gap-2">
              <button
                @click="openEditDialog(row)"
                class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-cyan-400 transition-colors"
                title="Edit Project"
              >
                <Pencil class="w-3.5 h-3.5" />
              </button>
              <button
                @click="handleDelete(row.id)"
                class="p-2 rounded-lg bg-slate-800 hover:bg-rose-500/20 text-rose-400 transition-colors"
                title="Delete Project"
              >
                <Trash2 class="w-3.5 h-3.5" />
              </button>
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <!-- Create / Edit Dialog Modal -->
    <el-dialog
      v-model="dialogVisible"
      :title="editingId ? 'Edit Project' : 'Create New Project'"
      width="90%"
      style="max-width: 650px;"
      align-center
    >
      <el-form label-position="top" class="space-y-4">
        <el-form-item label="Project Title" required>
          <el-input v-model="form.title" placeholder="e.g. Nexus Cloud Operations" />
        </el-form-item>

        <el-form-item label="Summary" required>
          <el-input v-model="form.summary" placeholder="Short 1-line description" />
        </el-form-item>

        <el-form-item label="Full Description" required>
          <el-input v-model="form.description" type="textarea" :rows="3" placeholder="Detailed architectural description" />
        </el-form-item>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <el-form-item label="Live URL">
            <el-input v-model="form.live_url" placeholder="https://example.com" />
          </el-form-item>
          <el-form-item label="GitHub Repo URL">
            <el-input v-model="form.github_url" placeholder="https://github.com/..." />
          </el-form-item>
        </div>

        <el-form-item label="Thumbnail Image URL">
          <el-input v-model="form.thumbnail" placeholder="https://images.unsplash.com/..." />
        </el-form-item>

        <el-form-item label="Tech Stack Tags (Comma separated)">
          <el-input v-model="tagsString" placeholder="Vue 3, TypeScript, Laravel, MySQL" />
        </el-form-item>

        <el-form-item label="Featured Status">
          <el-switch v-model="form.is_featured" />
        </el-form-item>

        <div class="pt-4 flex justify-end gap-3 border-t border-slate-800">
          <button
            type="button"
            @click="dialogVisible = false"
            class="px-4 py-2 rounded-xl bg-slate-800 text-slate-300 text-xs font-mono"
          >
            Cancel
          </button>
          <button
            type="button"
            @click="handleSave"
            class="px-5 py-2 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-md"
          >
            Save Project
          </button>
        </div>
      </el-form>
    </el-dialog>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue';
import { useAdminStore } from '../../store/admin';
import { ElNotification, ElMessageBox } from 'element-plus';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';
import type { Project } from '../../types';

const adminStore = useAdminStore();

const dialogVisible = ref(false);
const editingId = ref<number | null>(null);
const tagsString = ref('');

const form = reactive<Partial<Project>>({
  title: '',
  summary: '',
  description: '',
  thumbnail: '',
  live_url: '',
  github_url: '',
  tags: [],
  is_featured: false,
});

onMounted(() => {
  adminStore.loadProjects();
});

function openCreateDialog() {
  editingId.value = null;
  form.title = '';
  form.summary = '';
  form.description = '';
  form.thumbnail = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80';
  form.live_url = '';
  form.github_url = '';
  form.is_featured = true;
  tagsString.value = 'Vue 3, TypeScript, Laravel, MySQL';
  dialogVisible.value = true;
}

function openEditDialog(project: Project) {
  editingId.value = project.id;
  form.title = project.title;
  form.summary = project.summary;
  form.description = project.description;
  form.thumbnail = project.thumbnail;
  form.live_url = project.live_url;
  form.github_url = project.github_url;
  form.is_featured = project.is_featured;
  tagsString.value = project.tags?.join(', ') || '';
  dialogVisible.value = true;
}

async function handleSave() {
  const tags = tagsString.value.split(',').map((t) => t.trim()).filter(Boolean);
  await adminStore.saveProject({
    ...form,
    id: editingId.value || undefined,
    tags,
  });

  ElNotification({
    title: 'Saved',
    message: editingId.value ? 'Project updated successfully!' : 'New project created successfully!',
    type: 'success',
  });
  dialogVisible.value = false;
}

function handleDelete(id: number) {
  ElMessageBox.confirm('Are you sure you want to delete this project?', 'Confirm Delete', {
    confirmButtonText: 'Delete',
    cancelButtonText: 'Cancel',
    type: 'warning',
  }).then(async () => {
    await adminStore.deleteProject(id);
    ElNotification({ title: 'Deleted', message: 'Project removed.', type: 'info' });
  }).catch(() => {});
}
</script>
