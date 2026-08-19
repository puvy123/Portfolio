<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
        <Send class="w-3.5 h-3.5" /> Direct Transmission
      </div>
      <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        Let's Connect
      </h1>
      <p class="text-xs sm:text-sm sm:text-base leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        Whether you have an urgent IT support requirement, an enterprise system migration, or a custom web app build — send a message below to reach my inbox directly.
      </p>
    </div>

    <!-- Contact Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
      <!-- Contact Information Cards -->
      <div class="lg:col-span-5 space-y-6">
        <div
          class="p-8 rounded-3xl border space-y-6 shadow-xl transition-colors"
          :class="store.isDark ? 'bg-slate-900/80 border-slate-800' : 'bg-white border-slate-200'"
        >
          <h3 class="text-xl font-bold" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">Contact Information</h3>
          <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
            I respond within 24 hours to all client inquiries, contract opportunities, and IT consultations.
          </p>

          <div class="space-y-4 text-xs font-mono">
            <div
              class="flex items-center gap-3 p-3.5 rounded-xl border transition-colors"
              :class="store.isDark ? 'bg-slate-950/60 border-slate-800' : 'bg-slate-50 border-slate-200'"
            >
              <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                <Mail class="w-4 h-4" />
              </div>
              <div class="truncate">
                <span class="text-slate-500 block text-[10px]">Direct Gmail Address</span>
                <a :href="'mailto:' + contactEmail" class="font-semibold hover:text-cyan-400 transition-colors" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">
                  {{ contactEmail }}
                </a>
              </div>
            </div>

            <div
              class="flex items-center gap-3 p-3.5 rounded-xl border transition-colors"
              :class="store.isDark ? 'bg-slate-950/60 border-slate-800' : 'bg-slate-50 border-slate-200'"
            >
              <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
                <Phone class="w-4 h-4" />
              </div>
              <div>
                <span class="text-slate-500 block text-[10px]">Phone & Telegram</span>
                <a :href="'tel:+855963454358'" class="font-semibold hover:text-cyan-400 transition-colors" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">
                  +855 963454358
                </a>
              </div>
            </div>

            <div
              class="flex items-center gap-3 p-3.5 rounded-xl border transition-colors"
              :class="store.isDark ? 'bg-slate-950/60 border-slate-800' : 'bg-slate-50 border-slate-200'"
            >
              <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
                <MapPin class="w-4 h-4" />
              </div>
              <div>
                <span class="text-slate-500 block text-[10px]">Location & Availability</span>
                <span class="font-semibold" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">
                  {{ store.profile.location }}
                </span>
              </div>
            </div>
          </div>

          <!-- Social Links Grid -->
          <div class="pt-4 border-t space-y-3" :class="store.isDark ? 'border-slate-800' : 'border-slate-200'">
            <span class="text-[11px] font-mono uppercase text-slate-500 tracking-wider">Social Networks</span>
            <div class="flex flex-wrap gap-2">
              <a
                v-for="soc in store.socialLinks"
                :key="soc.id"
                :href="soc.url"
                target="_blank"
                class="px-3 py-1.5 rounded-xl border text-xs font-mono transition-all flex items-center gap-1.5"
                :class="store.isDark
                  ? 'bg-slate-950 border-slate-800 text-slate-300 hover:text-cyan-400 hover:border-cyan-500/30'
                  : 'bg-slate-100 border-slate-300 text-slate-700 hover:text-cyan-600 hover:border-cyan-400'"
              >
                {{ soc.platform }} ↗
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Message Form -->
      <div class="lg:col-span-7">
        <div
          class="p-8 sm:p-10 rounded-3xl border space-y-6 shadow-xl transition-colors"
          :class="store.isDark ? 'bg-slate-900/80 border-slate-800' : 'bg-white border-slate-200'"
        >
          <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
              Send a Direct Message
            </h3>
            <span class="text-[11px] font-mono text-cyan-400 flex items-center gap-1">
              <Mail class="w-3 h-3" /> To: {{ contactEmail }}
            </span>
          </div>

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
                <label class="text-xs font-mono" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">Your Full Name *</label>
                <input
                  v-model="form.name"
                  required
                  type="text"
                  placeholder="Jane Doe"
                  class="w-full px-4 py-3 rounded-xl border focus:border-cyan-500 text-xs font-mono outline-none transition-colors"
                  :class="store.isDark ? 'bg-slate-950 border-slate-800 text-slate-200' : 'bg-slate-50 border-slate-300 text-slate-900'"
                />
              </div>

              <div class="space-y-1.5">
                <label class="text-xs font-mono" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">Your Email Address *</label>
                <input
                  v-model="form.email"
                  required
                  type="email"
                  placeholder="jane@example.com"
                  class="w-full px-4 py-3 rounded-xl border focus:border-cyan-500 text-xs font-mono outline-none transition-colors"
                  :class="store.isDark ? 'bg-slate-950 border-slate-800 text-slate-200' : 'bg-slate-50 border-slate-300 text-slate-900'"
                />
              </div>
            </div>

            <div class="space-y-1.5">
              <label class="text-xs font-mono" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">Subject / Topic</label>
              <input
                v-model="form.subject"
                type="text"
                placeholder="e.g. IT Support Consultation or Web Development Inquiry"
                class="w-full px-4 py-3 rounded-xl border focus:border-cyan-500 text-xs font-mono outline-none transition-colors"
                :class="store.isDark ? 'bg-slate-950 border-slate-800 text-slate-200' : 'bg-slate-50 border-slate-300 text-slate-900'"
              />
            </div>

            <div class="space-y-1.5">
              <label class="text-xs font-mono" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">Message Details *</label>
              <textarea
                v-model="form.message"
                required
                rows="5"
                placeholder="Describe your requirements, timeline, or system specifications..."
                class="w-full px-4 py-3 rounded-xl border focus:border-cyan-500 text-xs font-mono outline-none transition-colors resize-none"
                :class="store.isDark ? 'bg-slate-950 border-slate-800 text-slate-200' : 'bg-slate-50 border-slate-300 text-slate-900'"
              ></textarea>
            </div>

            <div class="space-y-3 pt-2">
              <button
                :disabled="submitting"
                type="submit"
                class="w-full py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs font-mono shadow-lg shadow-cyan-500/25 transition-all flex items-center justify-center gap-2 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50"
              >
                <Send v-if="!submitting" class="w-4 h-4" />
                <span>{{ submitting ? 'Transmitting to Gmail...' : 'Send Direct Message to Gmail' }}</span>
              </button>

              <div class="text-center">
                <a
                  :href="mailtoLink"
                  class="text-[11px] font-mono text-cyan-400 hover:underline inline-flex items-center gap-1 opacity-85 hover:opacity-100"
                >
                  <Mail class="w-3 h-3" /> Or click to open your Gmail / Email client directly
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { usePortfolioStore } from '../store/portfolio';
import { Mail, Phone, MapPin, Send } from 'lucide-vue-next';

const route = useRoute();
const store = usePortfolioStore();

const contactEmail = 'khounvyvy@gmail.com';

const form = ref({
  name: '',
  email: '',
  subject: '',
  message: '',
});

const submitting = ref(false);
const statusMessage = ref('');
const isSuccess = ref(false);

const mailtoLink = computed(() => {
  const subj = encodeURIComponent(form.value.subject || 'Portfolio Inquiry');
  const body = encodeURIComponent(
    `Name: ${form.value.name}\nEmail: ${form.value.email}\n\nMessage:\n${form.value.message}`
  );
  return `mailto:${contactEmail}?subject=${subj}&body=${body}`;
});

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
    statusMessage.value = res.message || `Thank you! Your message has been sent directly to ${contactEmail}.`;
    form.value = { name: '', email: '', subject: '', message: '' };
  } catch (err: any) {
    // If backend is offline or static on Vercel, open direct mailto fallback seamlessly
    window.location.href = mailtoLink.value;
    isSuccess.value = true;
    statusMessage.value = `Opening your email client to send directly to ${contactEmail}...`;
  } finally {
    submitting.value = false;
  }
}
</script>
