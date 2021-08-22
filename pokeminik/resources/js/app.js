import {createApp} from "vue";
import App from "./App.vue"
// import { createVuetify } from "vuetify";
import vuetify from "./plugins/vuetify";
import router from "./router/router";
import store from "../js/store/index";
const app = createApp(App)

app.use(vuetify)
app.use(router)
app.use(store)
app.mount('#app')
