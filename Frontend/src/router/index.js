    import { createRouter, createWebHistory } from 'vue-router';
    import Home from '../views/Register.vue';
    import Login from '../views/Login.vue';

    const routes = [
      { path: '/', component: Register },
      { path: '/login', component: Login }
    ];

    const router = createRouter({
      history: createWebHistory(),
      routes
    });

    export default router;