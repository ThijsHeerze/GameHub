<template>
      <header class="header text-gray-50 text-center mb-8">
        <h1 class="text-3xl font-bold mb-2">Welkom bij GameHub</h1>
        <p class="text-lg">Kies een game en begin met spelen!</p>
      </header>
  
      <div class="games flex flex-wrap justify-center gap-8">
        <div
          v-for="game in games"
          :key="game.id"
          class="game-card bg-raisin rounded-lg shadow-lg p-6 w-1/4 text-left">
          <h2 class="text-xl text-white font-semibold italic mb-4">{{ game.name }}</h2>
          <img :src="game.image" alt="" class="rounded-md mb-4 w-full h-64 object-cover" />
          <button
            @click="goToGame(game.id)"
            class="bg-purple-900 text-white py-3 px-8 rounded-md hover:bg-violet transition">
            Speel Nu
          </button>
        </div>
      </div>
</template>
  
<script>
  export default {
    name: "Home",
  };
</script>