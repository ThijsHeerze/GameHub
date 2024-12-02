
<template>
  <div id="app" class="bg-raisin">
    <Navigation />
    <router-view />
    <Footer />
  </div>
</template>

<script>
import Footer from './views/Footer.vue';
import Navigation from './views/Navigation.vue';
export default {
  name: "App",
  components: {
    Navigation,
    Footer,
  },
};
</script>