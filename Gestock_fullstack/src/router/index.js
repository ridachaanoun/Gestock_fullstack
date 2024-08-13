import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/LoginPage.vue';
import Register from '../views/RegisterPage.vue';
import Home from '../views/HomePage.vue';
import AdminDashboard from '../views/AdminDashboard.vue'; 
import UserDashboard from '../views/UserDashboard.vue'; 
import UserList from '@/components/UserList.vue';

const routes = [
  { path: '/', component: Login },
  { path: '/register', component: Register },
  { path: '/home', component: Home, meta: { requiresAuth: true } },
  { 
    path: '/admin', 
    component: AdminDashboard, 
    meta: { requiresAuth: true, requiresAdmin: true },
    children: [
      { path: '', component: UserList, meta: { requiresAuth: true, requiresAdmin: true } }, // Default route for /admin
      { path: 'users', component: UserList, meta: { requiresAuth: true, requiresAdmin: true } }
    ]
  },
  { path: '/user', component: UserDashboard, meta: { requiresAuth: true } },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('authToken');
  const userRole = localStorage.getItem('userRole');

  if (to.meta.requiresAuth && !isAuthenticated) {
    return next('/');
  }

  if (to.path.startsWith('/admin') && userRole !== 'admin') {
    return next('/'); // Redirect to home or another route if not authorized
  }

  next();
});

export default router;
