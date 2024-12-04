import { createRouter, createWebHistory } from 'vue-router';
import CustomerList from '../views/CustomerList.vue';
import Login from '../views/Login.vue';
import CustomerForm from '@/components/CustomerForm.vue';
import UpdateCustomer from '../views/UpdateCustomer.vue';
import SearchCustomer from '@/components/SearchCustomer.vue';
import Signup from '../views/Signup.vue';

const routes = [
  {
    path: '/signup',
    name: 'Signup',
    component: Signup,
  },
  {
    path: '/',
    name: 'CustomerList',
    component: CustomerList,
    meta: { requiresAuth: true }, // Requires authentication
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  
  {
    path: '/customerform',
    name: 'CustomerForm',
    component: CustomerForm,
    meta: { requiresAuth: true }, // Requires authentication
  },
  {
    path: '/CustomerUpdate/:id',
    name: 'CustomerUpdate',
    component: UpdateCustomer,
    props: true,
    meta: { requiresAuth: true }, // Requires authentication
  },
  {
    path: '/add-customer',
    name: 'AddCustomer',
    component: CustomerForm,
    meta: { requiresAuth: true }, // Requires authentication
  },
  {
    path: '/search',
    name: 'Search',
    component: SearchCustomer,
    meta: { requiresAuth: true }, // Requires authentication
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

// Navigation Guard
router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('token') !== null;

  // Check if the route requires authentication
  if (to.meta.requiresAuth && !isAuthenticated) {
    // If not authenticated, redirect to login page
    next('/login');
  } else if (to.path === '/login' && isAuthenticated) {
    // If already authenticated, redirect from login page to home
    next('/');
  } else {
    next(); // Allow navigation
  }
});

export default router;
