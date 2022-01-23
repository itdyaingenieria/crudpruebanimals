import Vue from 'vue'
import VueRouter from 'vue-router'

//  vue router
Vue.use(VueRouter);

import dashboard from '../pages/dashboard.vue'
// corrales
import index_corrales from '../pages/corrales/index.vue'
import create_corrales from '../pages/corrales/create.vue'
import add_animales from '../pages/corrales/addanimals.vue'
import edit_corrales from '../pages/corrales/edit.vue'
// animales
import index_animal from '../pages/animales/index.vue'
import create_animal from '../pages/animales/create.vue'
import edit_animal from '../pages/animales/edit.vue'

const routes = [

    {
        name: 'animales',
        path: '/animales',
        meta: 'Animales',
        component: index_animal,
        beforeEnter: (to, from, next) => {
            document.title = "Prueba - " + to.meta //
            next() // 
        },
    },
    {
        name: 'add_animales',
        path: '/corrales/addanimals/:id',
        meta: 'Adicionar Animales',
        component: add_animales,
        props: true,
        beforeEnter: (to, from, next) => {
            document.title = "Prueba - " + to.meta
            next()
        },
    },
    {
        name: 'create_animal',
        path: '/animales/create',
        meta: 'Creacion Animales',
        component: create_animal,
        beforeEnter: (to, from, next) => {
            document.title = "Prueba - " + to.meta
            next()
        },
    },
    {
        name: 'edit_animal',
        path: '/animales/:id',
        meta: 'Editar animal',
        component: edit_animal,
        props: true,
        beforeEnter: (to, from, next) => {
            document.title = "Prueba - " + to.meta
            next()
        },
    },
    {
        name: 'corrales',
        path: '/corrales',
        meta: 'corrales',
        component: index_corrales,
        beforeEnter: (to, from, next) => {
            document.title = "Prueba - " + to.meta
            next()
        },
    },
    {
        name: 'create_corrales',
        path: '/corrales/create',
        meta: 'Crear corrales',
        component: create_corrales,
        beforeEnter: (to, from, next) => {
            document.title = "Prueba - " + to.meta
            next()
        },
    },
    {
        name: 'edit_corrales',
        path: '/corrales/:id',
        meta: 'Edit corrales',
        component: edit_corrales,
        props: true,
        beforeEnter: (to, from, next) => {
            document.title = "Prueba - " + to.meta
            next()
        },
    },
    {
        name: 'dashboard',
        path: '*',
        meta: 'Dashboard',
        component: dashboard,
        beforeEnter: (to, from, next) => {
            document.title = "Prueba - " + to.meta
            next()
        }
    },
]

const router = new VueRouter({
    LinkaAtiveClass: 'active',
    mode: 'history',
    routes
})


export default router
