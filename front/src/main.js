import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import './css/output.css'

import App from './App.vue'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'

// CATALOGS
import Catalogs from './pages/Catalogs/Catalogs.vue'
import CatalogCreateOrEdit from './pages/Catalogs/CatalogCreateOrEdit.vue'
import CatalogDetail from './pages/Catalogs/CatalogDetail.vue'

// ANIMALS
import Animals from './pages/Animals/Animals.vue'
import AnimalCreateOrEdit from './pages/Animals/AnimalCreateOrEdit.vue'

// ADOPTIONS
import Adoptions from './pages/Adoptions/Adoptions.vue'
import AdoptionCreateOrEdit from './pages/Adoptions/AdoptionCreateOrEdit.vue'

// USERS
import Users from './pages/Users/Users.vue'
import UserCreateOrEdit from './pages/Users/UserCreateOrEdit.vue'

const routes = [
    { path: '/', name: "home", component: Home, meta: { title: 'Home'} },
    { path: '/login', name: "login", component: Login, meta: { title: 'Login'} },
    
    // catalogs
    { path: '/catalogs', name: "catalogs", component: Catalogs, meta: { title: 'Catalogs'} },
    { path: '/catalogs/create', name: "catalogs-create", component: CatalogCreateOrEdit, meta: { title: 'CatalogCreateOrEdit'} },
    { path: '/catalogs/edit/:id', name: "catalogs-edit", component: CatalogCreateOrEdit, meta: { title: 'CatalogCreateOrEdit'} },
    { path: '/catalogs/detail/:id', name: "catalogs-detail", component: CatalogDetail, meta: { title: 'CatalogDetail'} },
    
    // animals
    { path: '/animals', name: "animals", component: Animals, meta: { title: 'Animals'} },
    { path: '/animals/create', name: "animals-create", component: AnimalCreateOrEdit, meta: { title: 'AnimalCreateOrEdit'} },
    { path: '/animals/edit/:id', name: "animals-edit", component: AnimalCreateOrEdit, meta: { title: 'AnimalCreateOrEdit'} },
    
    // adoptions
    { path: '/adoptions', name: "adoptions", component: Adoptions, meta: { title: 'Adoptions'} },
    { path: '/adoptions/create', name: "adoptions-create", component: AdoptionCreateOrEdit, meta: { title: 'AdoptionCreateOrEdit'} },
    { path: '/adoptions/edit/:id', name: "adoptions-edit", component: AdoptionCreateOrEdit, meta: { title: 'AdoptionCreateOrEdit'} },
    
    // users
    { path: '/users', name: "users", component: Users, meta: { title: 'Users'} },
    { path: '/users/create', name: "users-create", component: UserCreateOrEdit, meta: { title: 'UserCreateOrEdit'} },
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
