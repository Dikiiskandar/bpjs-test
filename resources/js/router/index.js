import { createRouter, createWebHistory } from "vue-router";

import Home from '../pages/Home.vue'
import ProfileCreate from '../pages/Profile/Create.vue';
import ProfileUpdate from '../pages/Profile/Update.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/profile/create',
        name: 'profile.create',
        component: ProfileCreate,
    },
    {
        path: '/profile/update/:id',
        name: 'profile.update',
        component: ProfileUpdate,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
