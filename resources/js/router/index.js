import Vue from 'vue';
import VueRouter from 'vue-router';
import TodoList from '../pages/TodoList.vue';
import Profile from '../pages/Profile.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/tasks',
        name: 'Tasks',
        component: TodoList,
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile,
    },
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
});

export default router;
