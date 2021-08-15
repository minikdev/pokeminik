import {createApp} from "vue";
import App from "./components/App.vue";
// import { createVuetify } from "vuetify";
import vuetify from "./plugins/vuetify";
const app = createApp(App)

app.use(vuetify)

app.mount('#app')
