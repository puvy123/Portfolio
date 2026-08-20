import { createApp } from 'vue';
import { createPinia } from 'pinia';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import * as ElementPlusIconsVue from '@element-plus/icons-vue';

import router from './router';
import App from './App.vue';
import './assets/main.css';

// Automatically handle both hash and direct routes (e.g. /#/admin/login -> /admin/login)
if (typeof window !== 'undefined' && window.location.hash.startsWith('#/')) {
  const target = window.location.hash.substring(1);
  window.history.replaceState(null, '', target);
}

const app = createApp(App);

for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
  app.component(key, component);
}

app.use(createPinia());
app.use(router);
app.use(ElementPlus);

app.mount('#app');
