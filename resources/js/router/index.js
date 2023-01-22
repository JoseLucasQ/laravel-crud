import { createRouter, createWebHistory } from "vue-router";

import clientesIndex from '../components/clientes/index.vue'
import clienteNew from '../components/clientes/new.vue'
import clienteEdit from '../components/clientes/edit.vue'

import notFound from '../components/notFound.vue'

const routes = [

    {
        path:'/',
        component: clientesIndex
    },
    {
        path:'/cliente/new',
        component: clienteNew
    },
    {
        path:'/cliente/edit/:id',
        component: clienteEdit,
        props:true
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