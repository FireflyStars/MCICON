/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import './bootstrap';
import Vue from 'vue';
// Router information
import Routes from '@/js/route.js';

// Component file
import App from '@/js/views/App';
window.$ = window.jQuery = require('jquery');

// Multi Languages
import i18n from '@/js/i18n';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import header from '@/js/components/common/header';
import footer from '@/js/components/common/footer';
Vue.component('app-header', header);
Vue.component('app-footer', footer);
import store from '@/js/stores/index';
// import { VueRecaptcha } from 'vue-recaptcha-v3'
// Vue.use(VueRecaptcha, { siteKey: '6LejtcMUAAAAANQGbPjjaQWgHZMGDzfurFKFz3N5' })
// Date format
Vue.use(require('vue-moment'));

const app = new Vue({
    el: '#app',
    i18n,
    store,
    router: Routes,
    render: h => h(App)
});

export default app;