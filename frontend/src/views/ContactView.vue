<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16 font-mono">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-slate-100 border-slate-300 text-slate-700'"
      >
        <Send class="w-3.5 h-3.5 text-emerald-400" /> transmission.open()
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-slate-100' : 'text-slate-900'">
        <span class="text-emerald-400">&lt;</span>Contact & Inquiries <span class="text-emerald-400">/&gt;</span>
      </h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
        // Send a message directly to my Gmail inbox via secure cloud payload.
      </p>
    </div>

    <!-- Contact Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
      <!-- Contact Information Cards -->
      <div class="lg:col-span-5 space-y-6">
        <div
          class="p-6 sm:p-8 rounded-2xl border space-y-6 transition-colors"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800 shadow-xl' : 'bg-white border-slate-300 shadow-xs'"
        >
          <h3 class="text-base font-bold text-emerald-400">// Channel Endpoints</h3>
          <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-slate-400' : 'text-slate-600'">
            Direct contact info for project collaborations, technical support contracts, or inquiries.
          </p>

          <div class="space-y-3 text-xs">
            <div
              class="flex items-center gap-3 p-3 rounded-lg border transition-colors"
              :class="store.isDark ? 'bg-[#050811] border-slate-800' : 'bg-slate-50 border-slate-300'"
            >
              <div class="w-7 h-7 rounded border flex items-center justify-center"
                :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-white border-slate-300 text-slate-700'"
              >
                <Mail class="w-3.5 h-3.5 text-emerald-400" />
              </div>
              <div class="truncate">
                <span class="block text-[10px] text-slate-500">// email_address</span>
                <a :href="'mailto:' + contactEmail" class="font-bold text-emerald-400 hover:underline">
                  {{ contactEmail }}
                </a>
              </div>
            </div>

            <div
              class="flex items-center gap-3 p-3 rounded-lg border transition-colors"
              :class="store.isDark ? 'bg-[#050811] border-slate-800' : 'bg-slate-50 border-slate-300'"
            >
              <div class="w-7 h-7 rounded border flex items-center justify-center"
                :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-white border-slate-300 text-slate-700'"
              >
                <Phone class="w-3.5 h-3.5 text-emerald-400" />
              </div>
              <div>
                <span class="block text-[10px] text-slate-500">// phone_telegram</span>
                <a :href="'tel:+855963454358'" class="font-bold text-emerald-400 hover:underline">
                  +855 963454358
                </a>
              </div>
            </div>

            <div
              class="flex items-center gap-3 p-3 rounded-lg border transition-colors"
              :class="store.isDark ? 'bg-[#050811] border-slate-800' : 'bg-slate-50 border-slate-300'"
            >
              <div class="w-7 h-7 rounded border flex items-center justify-center"
                :class="store.isDark ? 'bg-[#0b1120] border-emerald-500/30 text-emerald-400' : 'bg-white border-slate-300 text-slate-700'"
              >
                <MapPin class="w-3.5 h-3.5 text-emerald-400" />
              </div>
              <div>
                <span class="block text-[10px] text-slate-500">// geo_location</span>
                <span class="font-bold" :class="store.isDark ? 'text-slate-200' : 'text-slate-800'">
                  {{ store.profile.location }}
                </span>
              </div>
            </div>
          </div>

          <!-- Social Links Grid -->
          <div class="pt-3 border-t border-slate-800 space-y-2">
            <span class="text-[10px] text-slate-500">// social_links</span>
            <div class="flex flex-wrap gap-2">
              <a
                v-for="soc in store.socialLinks"
                :key="soc.id"
                :href="soc.url"
                target="_blank"
                class="px-2.5 py-1 rounded border text-xs transition-colors duration-150 flex items-center gap-1.5"
                :class="store.isDark
                  ? 'bg-[#050811] border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/40'
                  : 'bg-slate-100 border-slate-300 text-slate-700 hover:text-slate-900'"
              >
                {{ soc.platform }} ↗
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Message Form (Coder Terminal Style) -->
      <div class="lg:col-span-7">
        <div
          class="rounded-2xl border overflow-hidden transition-colors"
          :class="store.isDark ? 'bg-[#0b1120] border-slate-800 shadow-xl' : 'bg-white border-slate-300 shadow-xs'"
        >
          <!-- Terminal Title Header -->
          <div class="px-4 py-2.5 bg-[#050811] border-b border-slate-800 flex items-center justify-between text-xs text-slate-400">
            <div class="flex items-center gap-1.5">
              <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
              <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
              <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
              <span class="ml-2 text-slate-300 font-bold">send_payload.sh</span>
            </div>
            <span class="text-emerald-400 text-[11px]">&gt; direct_to_gmail</span>
          </div>

          <div class="p-6 sm:p-8 space-y-5">
            <!-- Alert Notification -->
            <div
              v-if="statusMessage"
              class="p-3.5 rounded-lg text-xs font-mono border"
              :class="isSuccess ? 'bg-emerald-950/50 border-emerald-500/40 text-emerald-400' : 'bg-rose-950/50 border-rose-500/40 text-rose-400'"
            >
              {{ statusMessage }}
            </div>

            <form @submit.prevent="handleSubmit" class="space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                  <label class="text-xs text-slate-400">const sender_name =</label>
                  <input
                    v-model="form.name"
                    required
                    type="text"
                    placeholder='"Your Name"'
                    class="w-full px-3.5 py-2.5 rounded-lg border text-xs font-mono outline-none transition-colors"
                    :class="store.isDark ? 'bg-[#050811] border-slate-800 text-emerald-300 focus:border-emerald-500' : 'bg-slate-50 border-slate-300 text-slate-900 focus:border-emerald-500'"
                  />
                </div>

                <div class="space-y-1">
                  <label class="text-xs text-slate-400">const sender_email =</label>
                  <input
                    v-model="form.email"
                    required
                    type="email"
                    placeholder='"you@example.com"'
                    class="w-full px-3.5 py-2.5 rounded-lg border text-xs font-mono outline-none transition-colors"
                    :class="store.isDark ? 'bg-[#050811] border-slate-800 text-emerald-300 focus:border-emerald-500' : 'bg-slate-50 border-slate-300 text-slate-900 focus:border-emerald-500'"
                  />
                </div>
              </div>

              <div class="space-y-1">
                <label class="text-xs text-slate-400">const subject =</label>
                <input
                  v-model="form.subject"
                  type="text"
                  placeholder='"IT Support or Web Dev Inquiry"'
                  class="w-full px-3.5 py-2.5 rounded-lg border text-xs font-mono outline-none transition-colors"
                  :class="store.isDark ? 'bg-[#050811] border-slate-800 text-emerald-300 focus:border-emerald-500' : 'bg-slate-50 border-slate-300 text-slate-900 focus:border-emerald-500'"
                />
              </div>

              <div class="space-y-1">
                <label class="text-xs text-slate-400">const payload_message =</label>
                <textarea
                  v-model="form.message"
                  required
                  rows="5"
                  placeholder='"Write message details here..."'
                  class="w-full px-3.5 py-2.5 rounded-lg border text-xs font-mono outline-none transition-colors resize-none"
                  :class="store.isDark ? 'bg-[#050811] border-slate-800 text-emerald-300 focus:border-emerald-500' : 'bg-slate-50 border-slate-300 text-slate-900 focus:border-emerald-500'"
                ></textarea>
              </div>

              <div class="space-y-3 pt-2">
                <button
                  :disabled="submitting"
                  type="submit"
                  class="w-full py-3 rounded-lg font-bold text-xs font-mono transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50"
                  :class="store.isDark ? 'bg-emerald-500 hover:bg-emerald-400 text-slate-950 shadow-lg shadow-emerald-500/20' : 'bg-slate-900 text-emerald-400 hover:bg-slate-800'"
                >
                  <Send v-if="!submitting" class="w-4 h-4" />
                  <span>{{ submitting ? '$ dispatching payload...' : '$ send_message --to khounvyvy@gmail.com' }}</span>
                </button>

                <div class="text-center">
                  <a
                    :href="mailtoLink"
                    class="text-[11px] hover:underline inline-flex items-center gap-1 text-slate-400 hover:text-emerald-400"
                  >
                    <Mail class="w-3 h-3" /> or click here to open native mailto client
                  </a>
                </div>
              </div>
            </form>
          </div>
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
    const response = await fetch(`https://formsubmit.co/ajax/${contactEmail}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        name: form.value.name,
        email: form.value.email,
        subject: form.value.subject || 'New Portfolio Inquiry',
        message: form.value.message,
        _subject: `[Portfolio] Message from ${form.value.name}: ${form.value.subject || 'Inquiry'}`,
        _template: 'table',
      }),
    });

    const data = await response.json();

    try {
      await store.submitContact(form.value);
    } catch (_) {}

    if (response.ok || data.success === 'true' || data.success === true) {
      isSuccess.value = true;
      statusMessage.value = `✓ Thank you ${form.value.name}! Your message was delivered directly to ${contactEmail}.`;
      form.value = { name: '', email: '', subject: '', message: '' };
    } else {
      throw new Error(data.message || 'Submission failed');
    }
  } catch (err: any) {
    window.location.href = mailtoLink.value;
    isSuccess.value = true;
    statusMessage.value = `Opening email client to dispatch message directly to ${contactEmail}...`;
  } finally {
    submitting.value = false;
  }
}
</script>
