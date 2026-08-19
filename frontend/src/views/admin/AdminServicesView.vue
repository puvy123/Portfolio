<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-slate-100">Services & IT Support Management</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Configure hardware diagnostics, system support & software engineering offerings</p>
      </div>

      <button
        @click="openDialog()"
        class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-md flex items-center gap-2"
      >
        <Plus class="w-4 h-4" /> Add New Service
      </button>
    </div>

    <!-- Data Table -->
    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden">
      <el-table :data="adminStore.services" style="width: 100%" v-loading="adminStore.loading">
        <el-table-column prop="title" label="Service Title" min-width="180">
          <template #default="{ row }">
            <span class="font-bold text-slate-200">{{ row.title }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="description" label="Description" min-width="250" show-overflow-tooltip />

        <el-table-column prop="price" label="Base Price" width="120">
          <template #default="{ row }">
            <span class="font-mono text-emerald-400 font-bold">${{ row.price || '0' }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="is_active" label="Active" width="100">
          <template #default="{ row }">
            <el-tag :type="row.is_active ? 'success' : 'info'" size="small">
              {{ row.is_active ? 'Active' : 'Inactive' }}
            </el-tag>
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

    <!-- Modal Form Dialog -->
    <el-dialog
      v-model="dialogVisible"
      :title="editingId ? 'Edit Service' : 'Add New Service'"
      width="550px"
      destroy-on-close
    >
      <el-form :model="form" label-position="top" class="space-y-3">
        <el-form-item label="Service Title" required>
          <el-input v-model="form.title" placeholder="e.g. Network Diagnostics & VLAN Setup" />
        </el-form-item>

        <el-form-item label="Description" required>
          <el-input v-model="form.description" type="textarea" :rows="3" placeholder="Detailed service description..." />
        </el-form-item>

        <div class="grid grid-cols-2 gap-4">
          <el-form-item label="Starting Price ($)">
            <el-input-number v-model="form.price" :min="0" style="width: 100%" />
          </el-form-item>

          <el-form-item label="Sort Order">
            <el-input-number v-model="form.sort_order" :min="0" style="width: 100%" />
          </el-form-item>
        </div>

        <el-form-item label="Features / Deliverables (Comma separated)">
          <el-input v-model="featuresInput" placeholder="Feature 1, Feature 2, Feature 3" />
        </el-form-item>

        <el-form-item>
          <el-checkbox v-model="form.is_active">Service is active & published</el-checkbox>
        </el-form-item>
      </el-form>

      <template #footer>
        <div class="flex justify-end gap-2">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" :loading="saving" @click="handleSave">Save Service</el-button>
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
import type { Service } from '../../types';

const adminStore = useAdminStore();
const dialogVisible = ref(false);
const editingId = ref<number | null>(null);
const saving = ref(false);
const featuresInput = ref('');

const form = ref<Partial<Service>>({
  title: '',
  description: '',
  icon: '',
  price: 0,
  is_active: true,
  sort_order: 0,
  features: [],
});

onMounted(() => {
  adminStore.loadServices();
});

function openDialog(item?: Service) {
  if (item) {
    editingId.value = item.id;
    form.value = { ...item };
    featuresInput.value = item.features?.join(', ') || '';
  } else {
    editingId.value = null;
    form.value = {
      title: '',
      description: '',
      icon: '',
      price: 100,
      is_active: true,
      sort_order: adminStore.services.length + 1,
      features: [],
    };
    featuresInput.value = '';
  }
  dialogVisible.value = true;
}

async function handleSave() {
  saving.value = true;
  try {
    form.value.features = featuresInput.value.split(',').map((s) => s.trim()).filter(Boolean);
    await adminStore.saveService(form.value);
    ElMessage.success('Service saved successfully');
    dialogVisible.value = false;
  } catch (err: any) {
    ElMessage.error(err.response?.data?.message || 'Failed to save service');
  } finally {
    saving.value = false;
  }
}

async function handleDelete(id: number) {
  try {
    await ElMessageBox.confirm('Are you sure you want to delete this service?', 'Warning', {
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      type: 'warning',
    });
    await adminStore.deleteService(id);
    ElMessage.success('Service deleted');
  } catch (e) {
    // Cancelled
  }
}
</script>
