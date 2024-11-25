//import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import 'bootstrap-icons/font/bootstrap-icons.css'
import { createApp } from 'vue'
import App from './App.vue'
import Accueil from './views/Accueil.vue'
import Caisse from './views/Caisse.vue'
import Login from './views/Login.vue'
import Virement from './views/Virement.vue'
import Essai from './views/Essai.vue'

import router from './router'
//Vue.config.productionTip = false;

const app = createApp(App)

app.use(router)
app.mount('#app')
