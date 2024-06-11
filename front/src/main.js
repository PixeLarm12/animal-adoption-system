import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import './css/output.css'

import App from './App.vue'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import Catalogs from './pages/Catalogs.vue'
import CatalogDetail from './pages/CatalogDetail.vue'
import Animals from './pages/Animals.vue'
import AnimalCreateOrEdit from './pages/AnimalCreateOrEdit.vue'

const routes = [
    { path: '/', name: "home", component: Home, meta: { title: 'Home'} },
    { path: '/login', name: "login", component: Login, meta: { title: 'Login'} },
    { path: '/catalogs', name: "catalogs", component: Catalogs, meta: { title: 'Catalogs'} },
    { path: '/catalogs/detail/:id', name: "catalogs-detail", component: CatalogDetail, meta: { title: 'CatalogDetail'} },
    { path: '/animals', name: "animals", component: Animals, meta: { title: 'Animals'} },
    { path: '/animals/create', name: "animals-create", component: AnimalCreateOrEdit, meta: { title: 'AnimalCreateOrEdit'} },
    { path: '/animals/edit/:id', name: "animals-edit", component: AnimalCreateOrEdit, meta: { title: 'AnimalCreateOrEdit'} },
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
