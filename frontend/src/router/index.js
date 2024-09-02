import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import store from '@/store';
import LoginPage from "@/views/LoginPage.vue";

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  { path: '/tasks', name: 'Task', component: () => import('../views/tasks') },
  { path: '/login', name: 'Login', component: LoginPage },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.authenticated) {
        next({ name: 'Login' });
    } else {
        next();
    }
});
export default router
