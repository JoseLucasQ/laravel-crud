import { createRouter, createWebHistory } from "vue-router";

import clientesIndex from '../components/clientes/index.vue'

import notFound from '../components/notFound.vue'

const routes = [

    {
        path:'/',
        component: clientesIndex
    },
    {
        path:'/:pathMatch(.*)*',
        component: notFound
    }

]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
})
export default router