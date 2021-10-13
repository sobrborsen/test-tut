
import * as Vue from '/js/lib/vue.esm-browser.js';
import { Http } from '/js/Http.js';
import { Reverse } from '/js/Reverse.js';

const app = Vue.createApp(Reverse);
app.config.globalProperties.http = new Http();
app.mount('#app')
