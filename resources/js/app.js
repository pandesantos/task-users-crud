import './bootstrap';

import { createApp } from 'vue'
import App from "./Components/App.vue";
import {createVuetify} from "vuetify";
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import 'vuetify/styles'
import router from "./router.js";

const vuetify = createVuetify({
    components,
    directives,
});

createApp(App).use(vuetify).use(router).mount('#app')