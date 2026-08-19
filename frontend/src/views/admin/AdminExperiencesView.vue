<template>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-extrabold text-slate-100 tracking-tight">Experiences Manager</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Manage work history, company milestones, and roles</p>
      </div>

      <button
        @click="openCreateDialog"
        class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-lg shadow-cyan-500/20 transition-all flex items-center gap-2"
      >
        <Plus class="w-4 h-4" /> Add Experience Position
      </button>
    </div>

    <!-- Experiences List Cards -->
    <div class="space-y-4" v-loading="adminStore.loading">
      <div
        v-for="exp in adminStore.experiences"
        :key="exp.id"
        class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4"
      >
        <div class="space-y-1">
          <div class="flex items-center gap-2">
            <h3 class="font-bold text-slate-100 text-base">{{ exp.role }}</h3>
            <span class="text-xs font-mono text-cyan-400">@ {{ exp.company }}</span>
            <span v-if="exp.is_current" class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
              Current
            </span>
          </div>
          <div class="text-xs text-slate-400 font-mono">{{ exp.period }} • {{ exp.location }}</div>
          <p class="text-xs text-slate-300 max-w-2xl pt-1">{{ exp.description }}</p>
        </div>

        <div class="flex items-center gap-2 self-end md:self-center">
          <button
            @click="openEditDialog(exp)"
            class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-cyan-400 transition-colors"
          >
            <Pencil class="w-3.5 h-3.5" />
          </button>
          <button
            @click="handleDelete(exp.id)"
            class="p-2 rounded-lg bg-slate-800 hover:bg-rose-500/20 text-rose-400 transition-colors"
          >
            <Trash2 class="w-3.5 h-3.5" />
          </button>
        </div>
      </div>
    </div>

    <!-- Create/Edit Modal -->
    <el-dialog
      v-model="dialogVisible"
      :title="editingId ? 'Edit Experience' : 'Add Experience'"
      width="90%"
      style="max-width: 600px;"
      align-center
    >
      <el-form label-position="top" class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <el-form-item label="Role Title" required>
            <el-input v-model="form.role" placeholder="Senior Full-Stack Engineer" />
          </el-form-item>
          <el-form-item label="Company Name" required>
            <el-input v-model="form.company" placeholder="Vortex Tech Systems" />
          </el-form-item>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <el-form-item label="Period" required>
            <el-input v-model="form.period" placeholder="2023 - Present" />
          </el-form-item>
          <el-form-item label="Location">
            <el-input v-model="form.location" placeholder="San Francisco, CA" />
          </el-form-item>
        </div>

        <el-form-item label="Role Description" required>
          <el-input v-model="form.description" type="textarea" :rows="3" placeholder="Summary of engineering responsibilities..." />
        </el-form-item>

        <el-form-item label="Tech Stack Used (Comma separated)">
          <el-input v-model="techString" placeholder="Vue 3, TypeScript, Laravel, MySQL" />
        </el-form-item>

        <el-form-item label="Current Employer">
          <el-switch v-model="form.is_current" />
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
            Save Experience
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
import type { Experience } from '../../types';

const adminStore = useAdminStore();

const dialogVisible = ref(false);
const editingId = ref<number | null>(null);
const techString = ref('');

const form = reactive<Partial<Experience>>({
  role: '',
  company: '',
  location: '',
  period: '',
  description: '',
  is_current: false,
});

onMounted(() => {
  adminStore.loadExperiences();
});

function openCreateDialog() {
  editingId.value = null;
  form.role = '';
  form.company = '';
  form.location = 'San Francisco, CA';
  form.period = '2024 - Present';
  form.description = '';
  form.is_current = true;
  techString.value = 'Vue 3, TypeScript, Laravel, MySQL';
  dialogVisible.value = true;
}

function openEditDialog(exp: Experience) {
  editingId.value = exp.id;
  form.role = exp.role;
  form.company = exp.company;
  form.location = exp.location;
  form.period = exp.period;
  form.description = exp.description;
  form.is_current = exp.is_current;
  techString.value = exp.technologies ? exp.technologies.join(', ') : '';
  dialogVisible.value = true;
}

async function handleSave() {
  const technologies = techString.value.split(',').map((t) => t.trim()).filter(Boolean);
  await adminStore.saveExperience({
    ...form,
    id: editingId.value || undefined,
    technologies,
  });

  ElNotification({
    title: 'Saved',
    message: editingId.value ? 'Experience updated!' : 'Experience added!',
    type: 'success',
  });
  dialogVisible.value = false;
}

function handleDelete(id: number) {
  ElMessageBox.confirm('Are you sure you want to delete this experience entry?', 'Confirm Delete', {
    confirmButtonText: 'Delete',
    cancelButtonText: 'Cancel',
    type: 'warning',
  }).then(async () => {
    await adminStore.deleteExperience(id);
    ElNotification({ title: 'Deleted', message: 'Experience entry removed.', type: 'info' });
  }).catch(() => {});
}
</script>
