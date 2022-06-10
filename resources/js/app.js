import './bootstrap';

import {createApp} from "vue";
import subscribe from './components/Subscribe.vue';
import PrimeVue from 'primevue/config';

window.Vue = require('vue').default;

const app = createApp({});

app.use(PrimeVue);
app.component('subscribe', subscribe);
app.mount('#app');
