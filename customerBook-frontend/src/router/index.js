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
    meta: { requiresAuth: true }, 
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
    meta: { requiresAuth: true }, 
  },
  {
    path: '/CustomerUpdate/:id',
    name: 'CustomerUpdate',
    component: UpdateCustomer,
    props: true,
    meta: { requiresAuth: true }, 
  },
  {
    path: '/add-customer',
    name: 'AddCustomer',
    component: CustomerForm,
    meta: { requiresAuth: true },
  },
  {
    path: '/search',
    name: 'Search',
    component: SearchCustomer,
    meta: { requiresAuth: true }, 
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('token') !== null;

  if (to.meta.requiresAuth && !isAuthenticated) {
    next('/login');
  } else if (to.path === '/login' && isAuthenticated) {
    next('/');
  } else {
    next(); 
  }
});

export default router;
