<template>
  <div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-slate-100">Testimonials & Client Feedback</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Manage ratings, client recommendations, and endorsements</p>
      </div>

      <button
        @click="openDialog()"
        class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs font-mono shadow-md flex items-center gap-2"
      >
        <Plus class="w-4 h-4" /> Add Testimonial
      </button>
    </div>

    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden">
      <el-table :data="adminStore.testimonials" style="width: 100%" v-loading="adminStore.loading">
        <el-table-column prop="client_name" label="Client / Reviewer" min-width="160">
          <template #default="{ row }">
            <span class="font-bold text-slate-200 block">{{ row.client_name }}</span>
            <span class="text-[10px] font-mono text-slate-500">{{ row.role }} @ {{ row.company }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="content" label="Review Content" min-width="250" show-overflow-tooltip />

        <el-table-column prop="rating" label="Rating" width="120">
          <template #default="{ row }">
            <span class="text-amber-400 font-mono text-xs">★ {{ row.rating }}/5</span>
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
      :title="editingId ? 'Edit Testimonial' : 'Add Testimonial'"
      width="500px"
      destroy-on-close
    >
      <el-form :model="form" label-position="top" class="space-y-3">
        <el-form-item label="Client / Reviewer Name" required>
          <el-input v-model="form.client_name" placeholder="Marcus Vance" />
        </el-form-item>

        <div class="grid grid-cols-2 gap-4">
          <el-form-item label="Company">
            <el-input v-model="form.company" placeholder="CloudMatrix Global" />
          </el-form-item>

          <el-form-item label="Role / Title">
            <el-input v-model="form.role" placeholder="CTO / Director of IT" />
          </el-form-item>
        </div>

        <el-form-item label="Rating (1-5)">
          <el-input-number v-model="form.rating" :min="1" :max="5" style="width: 100%" />
        </el-form-item>

        <el-form-item label="Testimonial / Review Text" required>
          <el-input v-model="form.content" type="textarea" :rows="4" placeholder="Client feedback..." />
        </el-form-item>
      </el-form>

      <template #footer>
        <div class="flex justify-end gap-2">
          <el-button @click="dialogVisible = false">Cancel</el-button>
          <el-button type="primary" :loading="saving" @click="handleSave">Save Review</el-button>
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
import type { Testimonial } from '../../types';

const adminStore = useAdminStore();
const dialogVisible = ref(false);
const editingId = ref<number | null>(null);
const saving = ref(false);

const form = ref<Partial<Testimonial>>({
  client_name: '',
  company: '',
  role: '',
  content: '',
  rating: 5,
  sort_order: 0,
});

onMounted(() => {
  adminStore.loadTestimonials();
});

function openDialog(item?: Testimonial) {
  if (item) {
    editingId.value = item.id;
    form.value = { ...item };
  } else {
    editingId.value = null;
    form.value = {
      client_name: '',
      company: '',
      role: '',
      avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
      content: '',
      rating: 5,
      sort_order: adminStore.testimonials.length + 1,
    };
  }
  dialogVisible.value = true;
}

async function handleSave() {
  saving.value = true;
  try {
    await adminStore.saveTestimonial(form.value);
    ElMessage.success('Testimonial saved');
    dialogVisible.value = false;
  } catch (err: any) {
    ElMessage.error('Failed to save testimonial');
  } finally {
    saving.value = false;
  }
}

async function handleDelete(id: number) {
  try {
    await ElMessageBox.confirm('Are you sure you want to delete this testimonial?', 'Warning', {
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      type: 'warning',
    });
    await adminStore.deleteTestimonial(id);
    ElMessage.success('Testimonial deleted');
  } catch (e) {
    // Cancelled
  }
}
</script>
