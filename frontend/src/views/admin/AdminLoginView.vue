<template>
  <div class="min-h-screen bg-slate-950 flex items-center justify-center p-4 relative overflow-hidden font-sans">
    <!-- Ambient Lighting Glow -->
    <div class="absolute w-96 h-96 bg-cyan-500/10 blur-[120px] rounded-full top-1/3 left-1/2 -translate-x-1/2 pointer-events-none"></div>

    <div class="w-full max-w-md bg-slate-900/90 border border-slate-800 rounded-2xl p-8 shadow-2xl relative z-10 space-y-6">
      
      <!-- Logo & Title Header -->
      <div class="text-center space-y-2">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-cyan-500 to-indigo-600 flex items-center justify-center text-white font-mono font-bold text-xl mx-auto shadow-lg">
          &lt;/&gt;
        </div>
        <h1 class="text-2xl font-extrabold text-slate-100 tracking-tight">Admin Portal</h1>
        <p class="text-xs text-slate-400 font-mono">Sign in to manage Portfolio Content & Database</p>
      </div>

      <!-- Quick Credentials Badge -->
      <div class="p-3.5 rounded-xl bg-slate-950 border border-cyan-500/30 text-xs font-mono space-y-1">
        <div class="text-cyan-400 font-bold flex items-center gap-1.5">
          <Key class="w-3.5 h-3.5" /> Demo Admin Access:
        </div>
        <div class="text-slate-300">Email: <span class="text-emerald-400 font-bold">admin@puvy.dev</span></div>
        <div class="text-slate-300">Password: <span class="text-emerald-400 font-bold">password123</span></div>
      </div>

      <!-- Login Form -->
      <el-form @submit.prevent="handleLogin" label-position="top">
        <el-form-item label="Email Address">
          <el-input v-model="email" placeholder="admin@puvy.dev" size="large">
            <template #prefix>
              <User class="w-4 h-4 text-slate-400" />
            </template>
          </el-input>
        </el-form-item>

        <el-form-item label="Password">
          <el-input v-model="password" type="password" show-password placeholder="••••••••" size="large">
            <template #prefix>
              <Lock class="w-4 h-4 text-slate-400" />
            </template>
          </el-input>
        </el-form-item>

        <div class="pt-2">
          <button
            :disabled="loading"
            type="submit"
            class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-400 hover:to-indigo-500 text-white font-bold text-sm shadow-lg shadow-cyan-500/25 transition-all active:scale-95 flex items-center justify-center gap-2 disabled:opacity-50"
          >
            <LogIn v-if="!loading" class="w-4 h-4" />
            <span>{{ loading ? 'Authenticating with Sanctum API...' : 'Authenticate & Access Admin' }}</span>
          </button>
        </div>
      </el-form>

      <!-- Back to Public Portfolio Link -->
      <div class="text-center pt-2">
        <router-link to="/" class="text-xs text-slate-400 hover:text-cyan-400 font-mono transition-colors">
          ← Return to Public Portfolio Website
        </router-link>
      </div>

    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAdminStore } from '../../store/admin';
import { ElNotification } from 'element-plus';
import { User, Lock, Key, LogIn } from 'lucide-vue-next';

const router = useRouter();
const adminStore = useAdminStore();

const email = ref('admin@puvy.dev');
const password = ref('password123');
const loading = ref(false);

async function handleLogin() {
  loading.value = true;
  try {
    const success = await adminStore.login(email.value, password.value);
    if (success) {
      ElNotification({
        title: 'Authenticated',
        message: 'Welcome back to Admin Control Center!',
        type: 'success',
      });
      router.push('/admin/dashboard');
    } else {
      ElNotification({
        title: 'Authentication Failed',
        message: 'Invalid credentials. Please verify your email and password.',
        type: 'error',
      });
    }
  } finally {
    loading.value = false;
  }
}
</script>
