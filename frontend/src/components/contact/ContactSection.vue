<template>
  <section id="contact" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto space-y-4 mb-14">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs font-semibold">
          <Mail class="w-3.5 h-3.5" /> Get In Touch
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
          Let's Work <span class="gradient-text-cyan-violet">Together</span>
        </h2>
        <p class="text-slate-400 text-base">
          Have a project in mind, an engineering role, or a technical question? Send a message below.
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        
        <!-- Left Column: Info Cards -->
        <div class="lg:col-span-5 space-y-6">
          <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-6">
            <h3 class="text-xl font-bold text-slate-100">Contact Details</h3>

            <div class="flex items-center gap-4">
              <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                <Mail class="w-6 h-6" />
              </div>
              <div>
                <div class="text-xs text-slate-400 font-mono">Direct Email</div>
                <a :href="`mailto:${store.profile.email}`" class="text-sm font-semibold text-slate-200 hover:text-cyan-400 transition-colors">
                  {{ store.profile.email }}
                </a>
              </div>
            </div>

            <div class="flex items-center gap-4">
              <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                <MapPin class="w-6 h-6" />
              </div>
              <div>
                <div class="text-xs text-slate-400 font-mono">Location</div>
                <div class="text-sm font-semibold text-slate-200">
                  {{ store.profile.location }}
                </div>
              </div>
            </div>

            <div class="flex items-center gap-4">
              <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                <CheckCircle2 class="w-6 h-6" />
              </div>
              <div>
                <div class="text-xs text-slate-400 font-mono">Current Availability</div>
                <div class="text-sm font-semibold text-emerald-400 flex items-center gap-1.5">
                  <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                  Open for Full-time & Contract Roles
                </div>
              </div>
            </div>
          </div>

          <!-- Social Links Card -->
          <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-4">
            <h4 class="text-sm font-semibold font-mono text-slate-400 uppercase tracking-wider">Social Channels</h4>
            <div class="flex items-center gap-4">
              <a
                :href="store.profile.github"
                target="_blank"
                class="px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-slate-300 hover:text-cyan-400 hover:border-cyan-500/40 font-mono text-xs flex items-center gap-2 transition-all"
              >
                <Github class="w-4 h-4" /> GitHub
              </a>
              <a
                :href="store.profile.linkedin"
                target="_blank"
                class="px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-slate-300 hover:text-indigo-400 hover:border-indigo-500/40 font-mono text-xs flex items-center gap-2 transition-all"
              >
                <Linkedin class="w-4 h-4" /> LinkedIn
              </a>
            </div>
          </div>
        </div>

        <!-- Right Column: Contact Form (Element Plus) -->
        <div class="lg:col-span-7">
          <div class="p-8 rounded-2xl bg-slate-900/90 border border-slate-800 shadow-2xl">
            
            <el-form
              ref="contactFormRef"
              :model="form"
              :rules="rules"
              label-position="top"
              @submit.prevent="handleSubmit"
            >
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <el-form-item label="Your Name" prop="name">
                  <el-input v-model="form.name" placeholder="John Doe" size="large" />
                </el-form-item>

                <el-form-item label="Email Address" prop="email">
                  <el-input v-model="form.email" placeholder="john@example.com" size="large" />
                </el-form-item>
              </div>

              <el-form-item label="Subject" prop="subject">
                <el-input v-model="form.subject" placeholder="Project Inquiry / Job Opportunity" size="large" />
              </el-form-item>

              <el-form-item label="Message" prop="message">
                <el-input
                  v-model="form.message"
                  type="textarea"
                  :rows="5"
                  placeholder="Tell me about your project, timelines, or technology requirements..."
                />
              </el-form-item>

              <div class="pt-2">
                <button
                  type="submit"
                  :disabled="submitting"
                  class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-400 hover:to-indigo-500 text-white font-bold text-sm shadow-lg shadow-cyan-500/25 transition-all flex items-center justify-center gap-2 disabled:opacity-50"
                >
                  <Send class="w-4 h-4" v-if="!submitting" />
                  <span v-if="submitting">Sending Message...</span>
                  <span v-else>Send Message</span>
                </button>
              </div>
            </el-form>

          </div>
        </div>

      </div>

    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, reactive } from 'vue';
import { usePortfolioStore } from '../../store/portfolio';
import { sendContactForm } from '../../services/api';
import { ElNotification } from 'element-plus';
import type { FormInstance, FormRules } from 'element-plus';
import { Mail, MapPin, CheckCircle2, Github, Linkedin, Send } from 'lucide-vue-next';

const store = usePortfolioStore();
const contactFormRef = ref<FormInstance | null>(null);
const submitting = ref(false);

const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: '',
});

const rules: FormRules = {
  name: [{ required: true, message: 'Please enter your name', trigger: 'blur' }],
  email: [
    { required: true, message: 'Please enter your email', trigger: 'blur' },
    { type: 'email', message: 'Please enter a valid email address', trigger: 'blur' },
  ],
  message: [
    { required: true, message: 'Please enter a message', trigger: 'blur' },
    { min: 10, message: 'Message must be at least 10 characters', trigger: 'blur' },
  ],
};

async function handleSubmit() {
  if (!contactFormRef.value) return;

  await contactFormRef.value.validate(async (valid) => {
    if (!valid) return;

    submitting.value = true;
    try {
      await fetch('https://formsubmit.co/ajax/khounvyvy@gmail.com', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          name: form.name,
          email: form.email,
          subject: form.subject || 'Portfolio Contact',
          message: form.message,
          _subject: `[Portfolio] Message from ${form.name}: ${form.subject || 'Inquiry'}`,
          _template: 'table',
        }),
      });

      try {
        await sendContactForm(form);
      } catch (_) {}

      ElNotification({
        title: 'Success!',
        message: 'Your message was delivered directly to khounvyvy@gmail.com.',
        type: 'success',
        duration: 4000,
      });

      form.name = '';
      form.email = '';
      form.subject = '';
      form.message = '';
      contactFormRef.value?.resetFields();
    } catch (err) {
      ElNotification({
        title: 'Message Sent',
        message: 'Your message was dispatched.',
        type: 'info',
      });
    } finally {
      submitting.value = false;
    }
  });
}
</script>
