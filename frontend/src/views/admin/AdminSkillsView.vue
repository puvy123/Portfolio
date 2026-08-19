<template>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-extrabold text-slate-100 tracking-tight">Skill Matrix Manager</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Manage technical proficiencies across IT support and software engineering</p>
      </div>

      <button
        @click="openCreateDialog"
        class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-lg shadow-cyan-500/20 transition-all flex items-center gap-2"
      >
        <Plus class="w-4 h-4" /> Add Skill
      </button>
    </div>

    <!-- Skills Table -->
    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden p-4">
      <el-table :data="adminStore.skills" style="width: 100%" size="large" v-loading="adminStore.loading">
        <el-table-column prop="name" label="Skill Name" min-width="180">
          <template #default="{ row }">
            <span class="font-bold text-slate-100">{{ row.name }}</span>
          </template>
        </el-table-column>

        <el-table-column label="Category" width="160">
          <template #default="{ row }">
            <span class="px-2.5 py-1 rounded bg-slate-800 text-cyan-400 font-mono text-xs border border-slate-700">
              {{ typeof row.category === 'object' ? row.category?.name : row.category || 'General' }}
            </span>
          </template>
        </el-table-column>

        <el-table-column label="Proficiency Level" min-width="200">
          <template #default="{ row }">
            <div class="flex items-center gap-3">
              <div class="flex-1 bg-slate-800 h-2 rounded-full overflow-hidden">
                <div class="h-full bg-cyan-500 rounded-full" :style="{ width: `${row.proficiency}%` }"></div>
              </div>
              <span class="font-mono text-xs font-bold text-cyan-300 w-10 text-right">{{ row.proficiency }}%</span>
            </div>
          </template>
        </el-table-column>

        <el-table-column prop="experience_years" label="Experience" width="120" />

        <el-table-column label="Actions" width="120" align="right">
          <template #default="{ row }">
            <div class="flex items-center justify-end gap-2">
              <button
                @click="openEditDialog(row)"
                class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-cyan-400 transition-colors"
              >
                <Pencil class="w-3.5 h-3.5" />
              </button>
              <button
                @click="handleDelete(row.id)"
                class="p-2 rounded-lg bg-slate-800 hover:bg-rose-500/20 text-rose-400 transition-colors"
              >
                <Trash2 class="w-3.5 h-3.5" />
              </button>
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <!-- Create/Edit Modal -->
    <el-dialog
      v-model="dialogVisible"
      :title="editingId ? 'Edit Skill' : 'Add New Skill'"
      width="90%"
      style="max-width: 500px;"
      align-center
    >
      <el-form label-position="top" class="space-y-4">
        <el-form-item label="Skill Name" required>
          <el-input v-model="form.name" placeholder="e.g. Vue 3 Composition API" />
        </el-form-item>

        <el-form-item label="Proficiency (0 - 100%)">
          <el-slider v-model="form.proficiency" :min="10" :max="100" />
        </el-form-item>

        <el-form-item label="Experience Duration" required>
          <el-input v-model="form.experience_years" placeholder="e.g. 4+ yrs" />
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
            Save Skill
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
import type { Skill } from '../../types';

const adminStore = useAdminStore();

const dialogVisible = ref(false);
const editingId = ref<number | null>(null);

const form = reactive<Partial<Skill>>({
  name: '',
  proficiency: 85,
  experience_years: '3+ yrs',
});

onMounted(() => {
  adminStore.loadSkills();
});

function openCreateDialog() {
  editingId.value = null;
  form.name = '';
  form.proficiency = 90;
  form.experience_years = '3+ yrs';
  dialogVisible.value = true;
}

function openEditDialog(skill: Skill) {
  editingId.value = skill.id;
  form.name = skill.name;
  form.proficiency = skill.proficiency;
  form.experience_years = skill.experience_years;
  dialogVisible.value = true;
}

async function handleSave() {
  await adminStore.saveSkill({
    ...form,
    id: editingId.value || undefined,
  });

  ElNotification({
    title: 'Saved',
    message: editingId.value ? 'Skill updated!' : 'New skill added!',
    type: 'success',
  });
  dialogVisible.value = false;
}

function handleDelete(id: number) {
  ElMessageBox.confirm('Are you sure you want to delete this skill?', 'Confirm Delete', {
    confirmButtonText: 'Delete',
    cancelButtonText: 'Cancel',
    type: 'warning',
  }).then(async () => {
    await adminStore.deleteSkill(id);
    ElNotification({ title: 'Deleted', message: 'Skill removed.', type: 'info' });
  }).catch(() => {});
}
</script>
