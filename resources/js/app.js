// import 'bootstrap/dist/css/bootstrap.min.css'
import './bootstrap'

import { createApp,h } from 'vue'
import Router from './router.js'
import App from './App.vue'

const app  = createApp({
    render: ()=>h(App)
});

app.use(Router).mount('#app')
