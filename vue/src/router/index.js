import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import EstudanteView from '../views/Estudante/View.vue'
import EstudanteNovo from '../views/Estudante/Novo.vue'
import EstudanteEditar from '../views/Estudante/Editar.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'paginaInicial',
      component: HomeView
    },
    {
      path: '/sobre',
      name: 'sobre',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/estudante',
      name: 'estudante',
      component: EstudanteView
    },
    {
      path: '/estudante/novo',
      name: 'estudanteNovo',
      component: EstudanteNovo
    },
    {
      path: '/estudantes/:id/editar',
      name: 'estudanteEditar',
      component: EstudanteEditar
    }
  ]
})

export default router
