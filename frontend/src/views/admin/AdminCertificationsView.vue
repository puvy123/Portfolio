<template>
  <div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-slate-100">Certifications & Licenses</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Manage CompTIA, AWS, Microsoft, and specialized technical certifications</p>
      </div>

      <button
        @click="openDialog()"
        class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-md flex items-center gap-2"
      >
        <Plus class="w-4 h-4" /> Add Certification
      </button>
    </div>

    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden">
      <el-table :data="adminStore.certifications" style="width: 100%" v-loading="adminStore.loading">
        <el-table-column prop="name" label="Certification" min-width="180">
          <template #default="{ row }">
            <span class="font-bold text-slate-200">{{ row.name }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="organization" label="Issuing Body" width="160">
          <template #default="{ row }">
            <span class="text-indigo-400 font-mono text-xs">{{ row.organization }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="credential_id" label="Credential ID" width="150" />

        <el-table-column label="Dates" width="160">
          <template #default="{ row }">
            <span class="text-slate-400 text-xs font-mono">{{ row.issue_date }}</span>
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
      :title="editingId ? 'Edit Certification' : 'Add Certification'"
      width="500px"
      destroy-on-close
    >
      <el-form :model="form" label-position="top" class="space-y-3">
        <el-form-item label="Certification Name" required>
          <el-input v-model="form.name" placeholder="CompTIA Security+ (SY0-601)" />
        </el-form-item>

        <div class="grid grid-cols-2 gap-4">
          <el-form-item label="Issuing Organization" required>
            <el-input v-model="form.organization" placeholder="CompTIA / AWS" />
          </el-form-item>

          <el-form-item label="Credential ID">
            <el-input v-model="form.credential_id" placeholder="COMP0012345" />
          </el-form-item>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <el-form-item label="Issue Date">
            <el-input v-model="form.issue_date" placeholder="YYYY-MM-DD" />
          </el-form-item>

          <el-form-item label="Expiration Date">
            <el-input v-model="form.expiration_date" placeholder="YYYY-MM-DD" />
          </el-form-item>
        </div>

        <el-form-item label="Verification URL">
          <el-input v-model="form.credential_url" placeholder="https://www.credly.com/..." />
        </el-form-item>
      </el-form>

      <template #footer>
        <div class="flex justify-end gap-2">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" :loading="saving" @click="handleSave">Save Certificate</el-button>
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
import type { Certification } from '../../types';

const adminStore = useAdminStore();
const dialogVisible = ref(false);
const editingId = ref<number | null>(null);
const saving = ref(false);

const form = ref<Partial<Certification>>({
  name: '',
  organization: '',
  credential_id: '',
  issue_date: '',
  expiration_date: '',
  credential_url: '',
  sort_order: 0,
});

onMounted(() => {
  adminStore.loadCertifications();
});

function openDialog(item?: Certification) {
  if (item) {
    editingId.value = item.id;
    form.value = { ...item };
  } else {
    editingId.value = null;
    form.value = {
      name: '',
      organization: '',
      credential_id: '',
      issue_date: '',
      expiration_date: '',
      credential_url: '',
      sort_order: adminStore.certifications.length + 1,
    };
  }
  dialogVisible.value = true;
}

async function handleSave() {
  saving.value = true;
  try {
    await adminStore.saveCertification(form.value);
    ElMessage.success('Certification saved');
    dialogVisible.value = false;
  } catch (err: any) {
    ElMessage.error('Failed to save certification');
  } finally {
    saving.value = false;
  }
}

async function handleDelete(id: number) {
  try {
    await ElMessageBox.confirm('Are you sure you want to delete this certification?', 'Warning', {
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      type: 'warning',
    });
    await adminStore.deleteCertification(id);
    ElMessage.success('Certification deleted');
  } catch (e) {
    // Cancelled
  }
}
</script>
