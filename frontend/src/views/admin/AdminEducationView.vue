<template>
  <div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-slate-100">Education Background</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Manage degrees, colleges, universities, and academic timeline</p>
      </div>

      <button
        @click="openDialog()"
        class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-md flex items-center gap-2"
      >
        <Plus class="w-4 h-4" /> Add Degree
      </button>
    </div>

    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden">
      <el-table :data="adminStore.educations" style="width: 100%" v-loading="adminStore.loading">
        <el-table-column prop="institution" label="Institution" min-width="180">
          <template #default="{ row }">
            <span class="font-bold text-slate-200">{{ row.institution }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="degree" label="Degree & Field" min-width="180">
          <template #default="{ row }">
            <span class="text-cyan-400 font-mono text-xs">{{ row.degree }} in {{ row.field }}</span>
          </template>
        </el-table-column>

        <el-table-column label="Dates" width="180">
          <template #default="{ row }">
            <span class="text-slate-400 text-xs font-mono">{{ row.start_date }} → {{ row.end_date || 'Present' }}</span>
          </template>
        </el-table-column>

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
      :title="editingId ? 'Edit Education' : 'Add Education'"
      width="500px"
      destroy-on-close
    >
      <el-form :model="form" label-position="top" class="space-y-3">
        <el-form-item label="Institution Name" required>
          <el-input v-model="form.institution" placeholder="University of California, Berkeley" />
        </el-form-item>

        <div class="grid grid-cols-2 gap-4">
          <el-form-item label="Degree" required>
            <el-input v-model="form.degree" placeholder="Bachelor of Science" />
          </el-form-item>

          <el-form-item label="Field of Study">
            <el-input v-model="form.field" placeholder="Computer Science" />
          </el-form-item>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <el-form-item label="Start Date">
            <el-input v-model="form.start_date" placeholder="YYYY-MM-DD" />
          </el-form-item>

          <el-form-item label="End Date">
            <el-input v-model="form.end_date" placeholder="YYYY-MM-DD" />
          </el-form-item>
        </div>

        <el-form-item label="Description & Major Focus">
          <el-input v-model="form.description" type="textarea" :rows="3" placeholder="Specialization in databases & systems..." />
        </el-form-item>
      </el-form>

      <template #footer>
        <div class="flex justify-end gap-2">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" :loading="saving" @click="handleSave">Save Record</el-button>
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
import type { Education } from '../../types';

const adminStore = useAdminStore();
const dialogVisible = ref(false);
const editingId = ref<number | null>(null);
const saving = ref(false);

const form = ref<Partial<Education>>({
  institution: '',
  degree: '',
  field: '',
  start_date: '',
  end_date: '',
  description: '',
  sort_order: 0,
});

onMounted(() => {
  adminStore.loadEducations();
});

function openDialog(item?: Education) {
  if (item) {
    editingId.value = item.id;
    form.value = { ...item };
  } else {
    editingId.value = null;
    form.value = {
      institution: '',
      degree: '',
      field: '',
      start_date: '',
      end_date: '',
      description: '',
      sort_order: adminStore.educations.length + 1,
    };
  }
  dialogVisible.value = true;
}

async function handleSave() {
  saving.value = true;
  try {
    await adminStore.saveEducation(form.value);
    ElMessage.success('Education record saved');
    dialogVisible.value = false;
  } catch (err: any) {
    ElMessage.error('Failed to save education record');
  } finally {
    saving.value = false;
  }
}

async function handleDelete(id: number) {
  try {
    await ElMessageBox.confirm('Are you sure you want to delete this record?', 'Warning', {
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      type: 'warning',
    });
    await adminStore.deleteEducation(id);
    ElMessage.success('Record deleted');
  } catch (e) {
    // Cancelled
  }
}
</script>
