<template>
  <div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-slate-100">Inquiries & Contact Inbox</h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Review, mark as read, and manage client requests sent from the contact form</p>
      </div>

      <el-button size="small" @click="adminStore.loadMessages()">
        <RefreshCw class="w-3.5 h-3.5 mr-1" /> Refresh Inbox
      </el-button>
    </div>

    <div class="rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden">
      <el-table :data="adminStore.contactMessages" style="width: 100%" v-loading="adminStore.loading">
        <el-table-column prop="is_read" label="Status" width="100">
          <template #default="{ row }">
            <el-tag :type="row.is_read ? 'info' : 'warning'" size="small">
              {{ row.is_read ? 'Read' : 'Unread' }}
            </el-tag>
          </template>
        </el-table-column>

        <el-table-column prop="name" label="Sender" min-width="160">
          <template #default="{ row }">
            <span class="font-bold text-slate-200 block">{{ row.name }}</span>
            <span class="text-[10px] font-mono text-cyan-400">{{ row.email }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="subject" label="Subject" min-width="150">
          <template #default="{ row }">
            <span class="font-semibold text-slate-300 text-xs">{{ row.subject || 'No Subject' }}</span>
          </template>
        </el-table-column>

        <el-table-column prop="message" label="Message" min-width="250" show-overflow-tooltip />

        <el-table-column label="Received" width="150">
          <template #default="{ row }">
            <span class="text-slate-500 text-xs font-mono">{{ new Date(row.created_at).toLocaleDateString() }}</span>
          </template>
        </el-table-column>

        <el-table-column label="Actions" width="160" align="right">
          <template #default="{ row }">
            <div class="flex items-center justify-end gap-2">
              <el-button
                size="small"
                :type="row.is_read ? 'default' : 'success'"
                plain
                @click="adminStore.toggleMessageRead(row.id)"
              >
                {{ row.is_read ? 'Unread' : 'Mark Read' }}
              </el-button>
              <el-button size="small" type="danger" plain @click="handleDelete(row.id)">Delete</el-button>
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { useAdminStore } from '../../store/admin';
import { RefreshCw } from 'lucide-vue-next';
import { ElMessageBox, ElMessage } from 'element-plus';

const adminStore = useAdminStore();

onMounted(() => {
  adminStore.loadMessages();
});

async function handleDelete(id: number) {
  try {
    await ElMessageBox.confirm('Permanently delete this message?', 'Warning', {
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      type: 'warning',
    });
    await adminStore.deleteMessage(id);
    ElMessage.success('Message deleted');
  } catch (e) {
    // Cancelled
  }
}
</script>
