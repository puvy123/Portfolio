<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
        <Send class="w-3.5 h-3.5" /> Direct Transmission
      </div>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-100 tracking-tight">Let's Connect</h1>
      <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
        Whether you have an urgent IT support requirement, an enterprise system migration, or an innovative web app build — send a message below.
      </p>
    </div>

    <!-- Contact Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
      <!-- Contact Information Cards -->
      <div class="lg:col-span-5 space-y-6">
        <div class="p-8 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-6 shadow-xl">
          <h3 class="text-xl font-bold text-slate-100">Contact Information</h3>
          <p class="text-xs text-slate-400 leading-relaxed">
            I respond within 24 hours to all client inquiries, contract opportunities, and IT consultations.
          </p>

          <div class="space-y-4 text-xs font-mono">
            <div class="flex items-center gap-3 p-3.5 rounded-xl bg-slate-950/60 border border-slate-800">
              <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                <Mail class="w-4 h-4" />
              </div>
              <div>
                <span class="text-slate-500 block text-[10px]">Email Address</span>
                <a :href="'mailto:' + (store.profile.settings?.contact_email || 'puvy.developer@example.com')" class="text-slate-200 font-semibold hover:text-cyan-400 transition-colors">
                  {{ store.profile.settings?.contact_email || 'puvy.developer@example.com' }}
                </a>
              </div>
            </div>

            <div class="flex items-center gap-3 p-3.5 rounded-xl bg-slate-950/60 border border-slate-800">
              <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
                <Phone class="w-4 h-4" />
              </div>
              <div>
                <span class="text-slate-500 block text-[10px]">Phone / WhatsApp</span>
                <span class="text-slate-200 font-semibold">
                  {{ store.profile.settings?.contact_phone || '+1 (555) 234-5678' }}
                </span>
              </div>
            </div>

            <div class="flex items-center gap-3 p-3.5 rounded-xl bg-slate-950/60 border border-slate-800">
              <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
                <MapPin class="w-4 h-4" />
              </div>
              <div>
                <span class="text-slate-500 block text-[10px]">Location & Availability</span>
                <span class="text-slate-200 font-semibold">{{ store.profile.location }}</span>
              </div>
            </div>

            <div v-if="store.profile.settings?.telegram_username" class="flex items-center gap-3 p-3.5 rounded-xl bg-slate-950/60 border border-slate-800">
              <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                <Send class="w-4 h-4" />
              </div>
              <div>
                <span class="text-slate-500 block text-[10px]">Telegram Direct</span>
                <span class="text-slate-200 font-semibold">{{ store.profile.settings?.telegram_username }}</span>
              </div>
            </div>
          </div>

          <!-- Social Links Grid -->
          <div class="pt-4 border-t border-slate-800 space-y-3">
            <span class="text-[11px] font-mono uppercase text-slate-500 tracking-wider">Social Networks</span>
            <div class="flex flex-wrap gap-2">
              <a
                v-for="soc in store.socialLinks"
                :key="soc.id"
                :href="soc.url"
                target="_blank"
                class="px-3 py-1.5 rounded-xl bg-slate-950 border border-slate-800 text-xs font-mono text-slate-300 hover:text-cyan-400 hover:border-cyan-500/30 transition-all flex items-center gap-1.5"
              >
                {{ soc.platform }} ↗
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Message Form -->
      <div class="lg:col-span-7">
        <div class="p-8 sm:p-10 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-6 shadow-xl">
          <h3 class="text-xl font-bold text-slate-100">Send a Message</h3>

          <!-- Alert Notification -->
          <div
            v-if="statusMessage"
            class="p-4 rounded-xl text-xs font-mono border"
            :class="isSuccess ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400' : 'bg-rose-500/10 border-rose-500/30 text-rose-400'"
          >
            {{ statusMessage }}
          </div>

          <form @submit.prevent="handleSubmit" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="space-y-1.5">
                <label class="text-xs font-mono text-slate-400">Your Full Name *</label>
                <input
                  v-model="form.name"
                  required
                  type="text"
                  placeholder="Jane Doe"
                  class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-cyan-500 text-slate-200 text-xs font-mono outline-none transition-colors"
                />
              </div>

              <div class="space-y-1.5">
                <label class="text-xs font-mono text-slate-400">Your Email Address *</label>
                <input
                  v-model="form.email"
                  required
                  type="email"
                  placeholder="jane@example.com"
                  class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-cyan-500 text-slate-200 text-xs font-mono outline-none transition-colors"
                />
              </div>
            </div>

            <div class="space-y-1.5">
              <label class="text-xs font-mono text-slate-400">Subject / Topic</label>
              <input
                v-model="form.subject"
                type="text"
                placeholder="e.g. IT Support Consultation or Web Development Inquiry"
                class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-cyan-500 text-slate-200 text-xs font-mono outline-none transition-colors"
              />
            </div>

            <div class="space-y-1.5">
              <label class="text-xs font-mono text-slate-400">Message Details *</label>
              <textarea
                v-model="form.message"
                required
                rows="5"
                placeholder="Describe your requirements, timeline, or system specifications..."
                class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 focus:border-cyan-500 text-slate-200 text-xs font-mono outline-none transition-colors resize-none"
              ></textarea>
            </div>

            <button
              :disabled="submitting"
              type="submit"
              class="w-full py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs font-mono shadow-lg shadow-cyan-500/25 transition-all flex items-center justify-center gap-2 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50"
            >
              <Send v-if="!submitting" class="w-4 h-4" />
              <span>{{ submitting ? 'Transmitting...' : 'Send Message to Laravel API' }}</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { usePortfolioStore } from '../store/portfolio';
import { Mail, Phone, MapPin, Send } from 'lucide-vue-next';

const route = useRoute();
const store = usePortfolioStore();

const form = ref({
  name: '',
  email: '',
  subject: '',
  message: '',
});

const submitting = ref(false);
const statusMessage = ref('');
const isSuccess = ref(false);

onMounted(() => {
  if (route.query.service) {
    form.value.subject = `Inquiry regarding: ${route.query.service}`;
  }
});

async function handleSubmit() {
  submitting.value = true;
  statusMessage.value = '';
  try {
    const res = await store.submitContact(form.value);
    isSuccess.value = true;
    statusMessage.value = res.message || 'Thank you! Your message was delivered successfully.';
    form.value = { name: '', email: '', subject: '', message: '' };
  } catch (err: any) {
    isSuccess.value = false;
    statusMessage.value = 'Failed to submit message. Please try again.';
  } finally {
    submitting.value = false;
  }
}
</script>
