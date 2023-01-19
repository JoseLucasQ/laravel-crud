import './bootstrap';

//import { createApp } from 'vue/dist/vue';
import { createApp } from 'vue';

import router from './router';

import app from './components/app.vue'

createApp(app).use(router).mount('#app')
