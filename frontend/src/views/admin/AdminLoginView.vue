<template>
  <div class="min-h-screen bg-slate-950 flex items-center justify-center p-4 sm:p-6 relative overflow-hidden font-sans selection:bg-cyan-500 selection:text-slate-950">
    <!-- Ambient Background Glow -->
    <div class="absolute w-[500px] h-[500px] bg-cyan-500/10 rounded-full blur-[140px] pointer-events-none -top-24 -left-24"></div>
    <div class="absolute w-[400px] h-[400px] bg-indigo-500/10 rounded-full blur-[130px] pointer-events-none -bottom-24 -right-24"></div>

    <!-- Login Card -->
    <div class="w-full max-w-md bg-slate-900/60 backdrop-blur-xl border border-slate-800/80 rounded-3xl p-8 sm:p-10 shadow-2xl relative z-10 space-y-8">
      
      <!-- Brand & Header -->
      <div class="text-center space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-cyan-500 to-blue-600 flex items-center justify-center text-white font-mono font-bold text-lg mx-auto shadow-lg shadow-cyan-500/20">
          &lt;/&gt;
        </div>
        <div class="space-y-1">
          <h1 class="text-2xl font-bold text-slate-100 tracking-tight">Admin Portal</h1>
          <p class="text-xs text-slate-400 font-mono">Sign in to manage your portfolio</p>
        </div>
      </div>

      <!-- Login Form -->
      <form @submit.prevent="handleLogin" class="space-y-5">
        
        <!-- Email Field -->
        <div class="space-y-2">
          <label class="block text-xs font-mono font-medium text-slate-300">
            Email or Username
          </label>
          <div class="relative flex items-center">
            <div class="absolute left-4 pointer-events-none text-slate-500">
              <User class="w-4 h-4" />
            </div>
            <input
              v-model="email"
              type="text"
              required
              autocomplete="username"
              class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-slate-950/70 border border-slate-800 text-slate-100 text-sm font-sans outline-none transition-all duration-200 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 hover:border-slate-700"
            />
          </div>
        </div>

        <!-- Password Field -->
        <div class="space-y-2">
          <label class="block text-xs font-mono font-medium text-slate-300">
            Password
          </label>
          <div class="relative flex items-center">
            <div class="absolute left-4 pointer-events-none text-slate-500">
              <Lock class="w-4 h-4" />
            </div>
            <input
              v-model="password"
              :type="showPassword ? 'text' : 'password'"
              required
              autocomplete="current-password"
              class="w-full pl-11 pr-11 py-3.5 rounded-2xl bg-slate-950/70 border border-slate-800 text-slate-100 text-sm font-sans outline-none transition-all duration-200 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 hover:border-slate-700"
            />
            <button
              type="button"
              @click="showPassword = !showPassword"
              class="absolute right-4 text-slate-500 hover:text-slate-300 transition-colors"
              tabindex="-1"
            >
              <EyeOff v-if="showPassword" class="w-4 h-4" />
              <Eye v-else class="w-4 h-4" />
            </button>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
          <button
            :disabled="loading"
            type="submit"
            class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-semibold text-sm shadow-lg shadow-cyan-500/25 transition-all duration-200 flex items-center justify-center gap-2 hover:scale-[1.01] active:scale-[0.99] disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer"
          >
            <Loader2 v-if="loading" class="w-4 h-4 animate-spin" />
            <LogIn v-else class="w-4 h-4" />
            <span>{{ loading ? 'Signing in...' : 'Sign In' }}</span>
          </button>
        </div>
      </form>

      <!-- Footer Link -->
      <div class="text-center pt-2 border-t border-slate-800/60">
        <router-link
          to="/"
          class="text-xs text-slate-400 hover:text-cyan-400 font-mono transition-colors inline-flex items-center gap-1.5"
        >
          <span>←</span> Back to Website
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
import { User, Lock, Eye, EyeOff, LogIn, Loader2 } from 'lucide-vue-next';

const router = useRouter();
const adminStore = useAdminStore();

const email = ref('admin@puvy.dev');
const password = ref('password123');
const showPassword = ref(false);
const loading = ref(false);

async function handleLogin() {
  if (!email.value || !password.value) return;
  
  loading.value = true;
  try {
    const success = await adminStore.login(email.value, password.value);
    if (success) {
      ElNotification({
        title: 'Authenticated',
        message: 'Welcome back to Admin Control Center!',
        type: 'success',
        duration: 3000,
      });
      router.push('/admin/dashboard');
    } else {
      ElNotification({
        title: 'Authentication Failed',
        message: 'Invalid credentials. Please verify your email and password.',
        type: 'error',
        duration: 4000,
      });
    }
  } catch (err: any) {
    ElNotification({
      title: 'Server Error',
      message: 'Unable to reach backend API. Please try again.',
      type: 'error',
      duration: 4000,
    });
  } finally {
    loading.value = false;
  }
}
</script>
