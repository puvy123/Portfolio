<template>
  <div class="max-w-4xl space-y-8">
    <div>
      <h1 class="text-2xl font-bold text-slate-100">Site Settings & Bio Configuration</h1>
      <p class="text-xs text-slate-400 font-mono mt-1">Update profile information, live statistics counters, and contact channels</p>
    </div>

    <!-- Profile & Bio Form -->
    <div class="p-8 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-6">
      <h2 class="text-lg font-bold text-slate-100 flex items-center gap-2">
        <User class="w-5 h-5 text-cyan-400" /> Developer Profile Details
      </h2>

      <el-form :model="profileForm" label-position="top" class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <el-form-item label="Full Name" required>
            <el-input v-model="profileForm.name" />
          </el-form-item>

          <el-form-item label="Professional Title" required>
            <el-input v-model="profileForm.title" />
          </el-form-item>
        </div>

        <el-form-item label="Short Introduction (Hero Tagline)">
          <el-input v-model="profileForm.bio" type="textarea" :rows="2" />
        </el-form-item>

        <el-form-item label="Detailed About Me Narrative">
          <el-input v-model="profileForm.about_me_text" type="textarea" :rows="4" />
        </el-form-item>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <el-form-item label="Avatar Image URL">
            <el-input v-model="profileForm.avatar" />
          </el-form-item>

          <el-form-item label="Location">
            <el-input v-model="profileForm.location" />
          </el-form-item>
        </div>

        <!-- Live Statistics Counters -->
        <h3 class="text-sm font-bold font-mono text-cyan-400 pt-4 border-t border-slate-800">
          Editable Statistics Counters
        </h3>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
          <el-form-item label="Years Exp">
            <el-input-number v-model="profileForm.experience_years" :min="0" style="width: 100%" />
          </el-form-item>

          <el-form-item label="Projects">
            <el-input-number v-model="profileForm.projects_completed" :min="0" style="width: 100%" />
          </el-form-item>

          <el-form-item label="Happy Clients">
            <el-input-number v-model="profileForm.happy_clients" :min="0" style="width: 100%" />
          </el-form-item>

          <el-form-item label="Technologies">
            <el-input-number v-model="profileForm.technologies_count" :min="0" style="width: 100%" />
          </el-form-item>
        </div>

        <div class="pt-4 flex justify-end">
          <el-button type="primary" :loading="savingProfile" @click="handleSaveProfile">
            Save Profile & Stats
          </el-button>
        </div>
      </el-form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useAdminStore } from '../../store/admin';
import { User } from 'lucide-vue-next';
import { ElMessage } from 'element-plus';

const adminStore = useAdminStore();
const savingProfile = ref(false);

const profileForm = ref({
  name: '',
  title: '',
  bio: '',
  about_me_text: '',
  avatar: '',
  location: '',
  experience_years: 6,
  projects_completed: 54,
  happy_clients: 48,
  technologies_count: 28,
  available_for_hire: true,
});

onMounted(async () => {
  await adminStore.loadSettingsAndProfile();
  if (adminStore.profile) {
    profileForm.value = { ...profileForm.value, ...adminStore.profile };
  }
});

async function handleSaveProfile() {
  savingProfile.value = true;
  try {
    await adminStore.saveProfile(profileForm.value);
    ElMessage.success('Profile details and statistics saved successfully');
  } catch (e: any) {
    ElMessage.error('Failed to save profile');
  } finally {
    savingProfile.value = false;
  }
}
</script>
