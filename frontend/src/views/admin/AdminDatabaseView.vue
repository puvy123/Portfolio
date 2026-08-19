<template>
  <div class="space-y-6">
    
    <!-- Page Header -->
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-extrabold text-slate-100 tracking-tight flex items-center gap-2">
          <Database class="w-6 h-6 text-emerald-400" /> Embedded Database Inspector
        </h1>
        <p class="text-xs text-slate-400 font-mono mt-1">Browse MySQL table schemas, inspect raw database rows, & view JSON payloads</p>
      </div>

      <div class="flex items-center gap-2 font-mono text-xs">
        <span class="px-3 py-1.5 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-400">
          DB: <span class="font-bold">developer_portfolio</span>
        </span>
        <span class="px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-slate-400">
          Engine: InnoDB / MySQL 8.0
        </span>
      </div>
    </div>

    <!-- Table Selection Tabs & Quick Search -->
    <div class="flex flex-wrap items-center justify-between gap-4 p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
      <!-- Select Table Tabs -->
      <div class="flex flex-wrap items-center gap-2 font-mono text-xs">
        <button
          v-for="tbl in ['projects', 'skills', 'experiences', 'contacts', 'settings']"
          :key="tbl"
          @click="selectedTable = tbl"
          class="px-3.5 py-2 rounded-xl font-bold transition-all flex items-center gap-2"
          :class="selectedTable === tbl
            ? 'bg-emerald-500 text-slate-950 shadow-lg shadow-emerald-500/20'
            : 'bg-slate-950 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-700'"
        >
          <Table class="w-3.5 h-3.5" /> {{ tbl }}
        </button>
      </div>

      <!-- Quick Search Bar -->
      <div class="w-full sm:w-64">
        <el-input v-model="searchQuery" placeholder="Search table records..." size="default" clearable>
          <template #prefix>
            <Search class="w-3.5 h-3.5 text-slate-400" />
          </template>
        </el-input>
      </div>
    </div>

    <!-- Table Structure & Records Viewer -->
    <div class="rounded-2xl bg-slate-900/90 border border-slate-800 overflow-hidden p-5 space-y-4">
      
      <div class="flex items-center justify-between border-b border-slate-800 pb-3">
        <div class="flex items-center gap-2 font-mono text-xs">
          <span class="text-slate-400">SELECT * FROM</span>
          <span class="text-emerald-400 font-bold">`{{ selectedTable }}`</span>
          <span class="text-slate-500">({{ currentTableRecords.length }} rows returned)</span>
        </div>

        <button
          @click="showRawJson = !showRawJson"
          class="px-3 py-1 rounded-lg bg-slate-800 text-slate-300 hover:text-cyan-400 font-mono text-xs transition-colors"
        >
          {{ showRawJson ? 'View Table Grid' : 'View Raw JSON Payload' }}
        </button>
      </div>

      <!-- Raw JSON Mode -->
      <div v-if="showRawJson" class="p-4 rounded-xl bg-slate-950 font-mono text-xs text-cyan-300 overflow-x-auto max-h-96">
        <pre>{{ JSON.stringify(currentTableRecords, null, 2) }}</pre>
      </div>

      <!-- Table Grid Mode -->
      <div v-else class="overflow-x-auto">
        <el-table :data="filteredTableRecords" style="width: 100%" size="default">
          <el-table-column
            v-for="col in currentColumns"
            :key="col"
            :prop="col"
            :label="col"
            min-width="140"
          >
            <template #default="{ row }">
              <div class="truncate text-xs font-mono text-slate-300 max-w-xs">
                {{ formatCell(row[col]) }}
              </div>
            </template>
          </el-table-column>
        </el-table>
      </div>

    </div>

  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { usePortfolioStore } from '../../store/portfolio';
import { useAdminStore } from '../../store/admin';
import { Database, Table, Search } from 'lucide-vue-next';

const portfolioStore = usePortfolioStore();
const adminStore = useAdminStore();

const selectedTable = ref('projects');
const searchQuery = ref('');
const showRawJson = ref(false);

const currentTableRecords = computed(() => {
  switch (selectedTable.value) {
    case 'projects':
      return portfolioStore.projects;
    case 'skills':
      return portfolioStore.skills;
    case 'experiences':
      return portfolioStore.experiences;
    case 'contacts':
      return adminStore.contactMessages;
    case 'settings':
      return [
        { key: 'profile_name', value: portfolioStore.profile.name },
        { key: 'profile_title', value: portfolioStore.profile.title },
        { key: 'profile_bio', value: portfolioStore.profile.bio },
        { key: 'profile_location', value: portfolioStore.profile.location },
        { key: 'profile_email', value: portfolioStore.profile.email },
        { key: 'available_for_hire', value: portfolioStore.profile.available_for_hire ? 'true' : 'false' },
      ];
    default:
      return [];
  }
});

const filteredTableRecords = computed(() => {
  if (!searchQuery.value.trim()) return currentTableRecords.value;
  const q = searchQuery.value.toLowerCase();
  return currentTableRecords.value.filter((row: any) =>
    JSON.stringify(row).toLowerCase().includes(q)
  );
});

const currentColumns = computed(() => {
  if (!currentTableRecords.value.length) return [];
  return Object.keys(currentTableRecords.value[0]);
});

function formatCell(val: any): string {
  if (val === null || val === undefined) return 'NULL';
  if (typeof val === 'object') return JSON.stringify(val);
  return String(val);
}
</script>
