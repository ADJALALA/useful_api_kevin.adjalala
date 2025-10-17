<script setup>
    import { createApp } from 'vue';
    import App from './App.vue';
    import router from './router';

    const app = createApp(App);
    app.use(router);
    app.mount('#app');
</script>

<template>
  <router-link to="/">Register</router-link>
  <router-link to="/login">Se connecter</router-link>

</template>

<style scoped>

</style>
