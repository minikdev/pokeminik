import {createApp} from "vue";
import App from "./components/App.vue";
// import { createVuetify } from "vuetify";
import vuetify from "./plugins/vuetify";
import router from "./router/router";
const app = createApp(App)

app.use(vuetify)
app.use(router)

app.mount('#app')
