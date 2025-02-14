import {createRouter, createWebHistory} from 'vue-router'

import Index from './views/Index.vue';
import Stats from './views/Stats.vue';
import Users from './views/Users.vue';
import Login from './views/auth/Login.vue';
import Register from './views/auth/Register.vue';

const routes = [
    {
        path: '/',
        name: 'Index',
        component: Index,
        meta: { requiresAuth: true } 
    },
    {
        path: '/stats',
        name: 'Stats',
        component: Stats,
        meta: { requiresAuth: true } 
    },
    {
        path: '/awaiting',
        name: 'UsersAwaiting',
        component: Users,
        meta: { requiresAuth: true } 
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

// Global Navigation Guard
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem("token") != undefined;

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (isAuthenticated) {
            next();
        } else {
            next("/login");
        }
    }else{
        next();
    }
});

export default router