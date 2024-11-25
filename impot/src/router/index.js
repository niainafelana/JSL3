import { createRouter, createWebHistory } from 'vue-router'
import Caisse from '@/views/Caisse.vue'
import Virement from '@/views/Virement.vue'
import Accueil from '../views/Accueil.vue'
import Login from '../views/Login.vue'
import Transfert from '../views/Transfert.vue'
import Bordereau from '../views/Bordereau.vue'
import Dashboard from '../views/Dashboard.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    /*{
      path: '/',
      name: 'home',
      component: HomeView
    },*/
    {
      path: '/accueil',
      name: 'accueil',
      component: Accueil,
      meta: {requiresAuth: true}
    },
    {
      path: '/bordereau',
      name: 'bordereau',
      component: Bordereau,
      meta: {requiresAuth: true}
    },
    {
      path: '/transfert',
      name: 'transfert',
      component: Transfert,
      meta: {requiresAuth: true}
    },
    
    {
      path: '/dash',
      name: 'dash',
      component:Dashboard,
    },
    {
      path: '/caisse',
      name: 'caisse',
      component:Caisse ,
      meta: {requiresAuth: false}
    },
    {
      path: '/',
      name: 'login',
      component: Login,
      meta: {requiresAuth: false}
    },
    {
      path: '/virement',
      name: 'virement',
      component: Virement,
      meta: {requiresAuth: true}
    },
    /*{
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    }*/
  ]
})

export default router
