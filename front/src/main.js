import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import './css/output.css'

import App from './App.vue'
import Home from './pages/Home.vue'

const routes = [
    { path: '/', name: "home", component: Home, meta: { title: 'Home'} },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title

    next()
});

createApp(App).use(router).mount('#app')
