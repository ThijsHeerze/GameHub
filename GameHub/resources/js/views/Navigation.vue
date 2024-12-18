
<template>
    <div id="app" class="bg-raisin border-b-2 border-violet">
      <nav class="flex justify-center items-center h-14 pr-10 text-white text-lg font-medium italic gap-x-4">
        <router-link to="/">Home</router-link> <span class="text-lavender text-xl font-bold">|</span> 
        <router-link to="/Home">FTD</router-link> <span class="text-lavender text-xl font-bold">|</span>  
        <router-link to="/PaardenRace/1">Paarden Race</router-link> 
      </nav>
    </div>
  </template>
  
  <script>
  export default {
    name: "Navigation",
  };
  </script>