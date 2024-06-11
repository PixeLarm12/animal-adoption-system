import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import './css/output.css'

import App from './App.vue'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import Catalog from './pages/Catalog.vue'
import CatalogDetail from './pages/CatalogDetail.vue'
import Animals from './pages/Animals.vue'

const routes = [
    { path: '/', name: "home", component: Home, meta: { title: 'Home'} },
    { path: '/login', name: "login", component: Login, meta: { title: 'Login'} },
    { path: '/catalogs', name: "catalogs", component: Catalog, meta: { title: 'Catalog'} },
    { path: '/catalogs/detail/:id', name: "catalogs-detail", component: CatalogDetail, meta: { title: 'CatalogDetail'} },
    { path: '/animals', name: "animals", component: Animals, meta: { title: 'Animals'} },
    // { path: '/animals/create', name: "animals-create", component: AnimalCreate, meta: { title: 'AnimalCreate'} },
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
