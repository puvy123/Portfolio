<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-mono font-medium"
        :class="store.isDark ? 'bg-zinc-900 border-zinc-800 text-zinc-300' : 'bg-zinc-100 border-zinc-200 text-zinc-700'"
      >
        <Send class="w-3.5 h-3.5 text-blue-500" /> Direct Contact
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-tight" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
        Let's Connect
      </h1>
      <p class="text-xs sm:text-sm leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
        Whether you have an IT support inquiry, a project collaboration, or a question — send a message below to reach my email directly.
      </p>
    </div>

    <!-- Contact Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
      <!-- Contact Information Cards -->
      <div class="lg:col-span-5 space-y-6">
        <div
          class="p-6 sm:p-8 rounded-2xl border space-y-6 transition-colors"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <h3 class="text-lg font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">Contact Details</h3>
          <p class="text-xs leading-relaxed" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">
            I respond promptly to all client inquiries and technical consultations.
          </p>

          <div class="space-y-3 text-xs font-mono">
            <div
              class="flex items-center gap-3 p-3.5 rounded-xl border transition-colors"
              :class="store.isDark ? 'bg-zinc-950/60 border-zinc-800' : 'bg-zinc-50 border-zinc-200'"
            >
              <div class="w-8 h-8 rounded-lg border flex items-center justify-center"
                :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-white border-zinc-200 text-zinc-700'"
              >
                <Mail class="w-4 h-4 text-blue-500" />
              </div>
              <div class="truncate">
                <span class="block text-[10px]" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Email</span>
                <a :href="'mailto:' + contactEmail" class="font-semibold hover:text-blue-500 transition-colors" :class="store.isDark ? 'text-zinc-200' : 'text-zinc-800'">
                  {{ contactEmail }}
                </a>
              </div>
            </div>

            <div
              class="flex items-center gap-3 p-3.5 rounded-xl border transition-colors"
              :class="store.isDark ? 'bg-zinc-950/60 border-zinc-800' : 'bg-zinc-50 border-zinc-200'"
            >
              <div class="w-8 h-8 rounded-lg border flex items-center justify-center"
                :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-white border-zinc-200 text-zinc-700'"
              >
                <Phone class="w-4 h-4 text-blue-500" />
              </div>
              <div>
                <span class="block text-[10px]" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Phone & Telegram</span>
                <a :href="'tel:+855963454358'" class="font-semibold hover:text-blue-500 transition-colors" :class="store.isDark ? 'text-zinc-200' : 'text-zinc-800'">
                  +855 963454358
                </a>
              </div>
            </div>

            <div
              class="flex items-center gap-3 p-3.5 rounded-xl border transition-colors"
              :class="store.isDark ? 'bg-zinc-950/60 border-zinc-800' : 'bg-zinc-50 border-zinc-200'"
            >
              <div class="w-8 h-8 rounded-lg border flex items-center justify-center"
                :class="store.isDark ? 'bg-zinc-800 border-zinc-700 text-zinc-300' : 'bg-white border-zinc-200 text-zinc-700'"
              >
                <MapPin class="w-4 h-4 text-blue-500" />
              </div>
              <div>
                <span class="block text-[10px]" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Location</span>
                <span class="font-semibold" :class="store.isDark ? 'text-zinc-200' : 'text-zinc-800'">
                  {{ store.profile.location }}
                </span>
              </div>
            </div>
          </div>

          <!-- Social Links Grid -->
          <div class="pt-3 border-t space-y-2.5" :class="store.isDark ? 'border-zinc-800' : 'border-zinc-100'">
            <span class="text-[10px] font-mono uppercase tracking-wider" :class="store.isDark ? 'text-zinc-500' : 'text-zinc-400'">Social Networks</span>
            <div class="flex flex-wrap gap-2">
              <a
                v-for="soc in store.socialLinks"
                :key="soc.id"
                :href="soc.url"
                target="_blank"
                class="px-2.5 py-1 rounded-xl border text-xs font-mono transition-colors duration-150 flex items-center gap-1.5"
                :class="store.isDark
                  ? 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-white hover:border-zinc-700'
                  : 'bg-zinc-50 border-zinc-200 text-zinc-600 hover:text-zinc-900 hover:border-zinc-300'"
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
          class="p-6 sm:p-8 rounded-2xl border space-y-6 transition-colors"
          :class="store.isDark ? 'bg-zinc-900/60 border-zinc-800' : 'bg-white border-zinc-200 shadow-xs'"
        >
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold" :class="store.isDark ? 'text-zinc-100' : 'text-zinc-900'">
              Send a Message
            </h3>
            <span class="text-[11px] font-mono flex items-center gap-1" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-500'">
              <Mail class="w-3 h-3 text-blue-500" /> Direct to Gmail
            </span>
          </div>

          <!-- Alert Notification -->
          <div
            v-if="statusMessage"
            class="p-3.5 rounded-xl text-xs font-mono border"
            :class="isSuccess ? 'bg-emerald-950/40 border-emerald-800 text-emerald-300' : 'bg-red-950/40 border-red-800 text-red-300'"
          >
            {{ statusMessage }}
          </div>

          <form @submit.prevent="handleSubmit" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="space-y-1.5">
                <label class="text-xs font-mono" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">Your Name *</label>
                <input
                  v-model="form.name"
                  required
                  type="text"
                  class="w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono outline-none transition-colors"
                  :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-200 focus:border-blue-500' : 'bg-zinc-50 border-zinc-300 text-zinc-900 focus:border-blue-600'"
                />
              </div>

              <div class="space-y-1.5">
                <label class="text-xs font-mono" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">Your Email *</label>
                <input
                  v-model="form.email"
                  required
                  type="email"
                  class="w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono outline-none transition-colors"
                  :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-200 focus:border-blue-500' : 'bg-zinc-50 border-zinc-300 text-zinc-900 focus:border-blue-600'"
                />
              </div>
            </div>

            <div class="space-y-1.5">
              <label class="text-xs font-mono" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">Subject</label>
              <input
                v-model="form.subject"
                type="text"
                class="w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono outline-none transition-colors"
                :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-200 focus:border-blue-500' : 'bg-zinc-50 border-zinc-300 text-zinc-900 focus:border-blue-600'"
              />
            </div>

            <div class="space-y-1.5">
              <label class="text-xs font-mono" :class="store.isDark ? 'text-zinc-400' : 'text-zinc-600'">Message *</label>
              <textarea
                v-model="form.message"
                required
                rows="5"
                class="w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono outline-none transition-colors resize-none"
                :class="store.isDark ? 'bg-zinc-950 border-zinc-800 text-zinc-200 focus:border-blue-500' : 'bg-zinc-50 border-zinc-300 text-zinc-900 focus:border-blue-600'"
              ></textarea>
            </div>

            <div class="space-y-3 pt-2">
              <button
                :disabled="submitting"
                type="submit"
                class="w-full py-3 rounded-xl font-semibold text-xs font-mono transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-98 disabled:opacity-50"
                :class="store.isDark ? 'bg-white text-zinc-950 hover:bg-zinc-100' : 'bg-zinc-900 text-white hover:bg-zinc-800'"
              >
                <Send v-if="!submitting" class="w-4 h-4" />
                <span>{{ submitting ? 'Sending message...' : 'Send Message' }}</span>
              </button>

              <div class="text-center">
                <a
                  :href="mailtoLink"
                  class="text-[11px] font-mono hover:underline inline-flex items-center gap-1"
                  :class="store.isDark ? 'text-zinc-400 hover:text-white' : 'text-zinc-600 hover:text-zinc-900'"
                >
                  <Mail class="w-3 h-3" /> Or send directly via Gmail app
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
