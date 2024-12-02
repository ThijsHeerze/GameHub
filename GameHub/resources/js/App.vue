
<template>
  <div id="app" class="bg-raisin">
    <nav class="flex justify-center items-center h-14 pr-10 text-white text-lg font-medium gap-x-4">
      <router-link to="/">Home</router-link> <span class="text-lavender text-xl font-bold">|</span> 
      <router-link to="/Home">FTD</router-link> <span class="text-lavender text-xl font-bold">|</span>  
      <router-link to="/PaardenRace">Paarden Race</router-link> 
    </nav>
    <router-view />
    <footer class="flex justify-center items-center h-14 pr-10 border-t-2 text-gray-50 gap-x-4 border-purple-500">
      &copy; 2025 - Made with ❤️ by RubyRuub & Sleepy Tus
    </footer>
  </div>
</template>

<script>
export default {};
</script>