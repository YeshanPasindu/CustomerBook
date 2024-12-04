<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from './components/Navbar.vue'
</script>

<template>
  <div class="app-container">
    <Navbar />
    <main class="content">
      <RouterView />
    </main>
  </div>
</template>

<style scoped>
.app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  font-family: 'Arial', sans-serif;
  background-color: #f4f4f4;
}

.content {
  flex: 1;
  padding: 20px;
  background-color: #fff;
}

nav {
  width: 100%;
  font-size: 14px;
  text-align: center;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0.5rem 1rem;
  border-left: 1px solid var(--color-border);
  color: #fff;
  text-decoration: none;
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  .app-container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .content {
    max-width: 1200px;
    width: 100%;
    margin-top: 2rem;
  }

  nav {
    text-align: left;
    font-size: 16px;
  }
}
</style>
