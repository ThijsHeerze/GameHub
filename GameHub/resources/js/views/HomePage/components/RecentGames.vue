<template>
    <div class="games flex flex-wrap flex-col justify-center gap-8 mb-60">
      <h2 class="text-2xl font-semibold mb-4 w-100 text-center text-white">Recent Games</h2>
      <ul class="games flex flex-wrap justify-center gap-8">
        <li v-for="game in recentGames" :key="game.id" class="game-card bg-raisin rounded-lg shadow-lg p-6 w-1/4 text-left">
          <router-link :to="game.path">
            <img :src="game.image" :alt="game.name" class="rounded-md mb-4 w-full h-64 object-cover" />
            <p class="text-xl text-white font-semibold italic mb-4">{{ game.name }}</p>
            <button
                @click="$emit('goToGame', game.path)"
                class="bg-purple-800 px-4 py-2 text-white rounded hover:bg-violet mt-3">
                Speel Nu
            </button>
          </router-link>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        recentGames: [
          {
            id: "fuck-the-dealer",
            name: "Fuck the Dealer",
            image: "/image/FTD.jpg",
            path: "/Home",
          },
          {
            id: "paarden-race",
            name: "Paarden Race",
            image: "/image/paardenRace.jpg",
            path: "/paardenRace",
          },
          {
            id: "toepen",
            name: "Toepen",
            image: "/image/toepen.jpg",
            path: "/toepen",
          },
        ],
      };
    },
    methods: {
        goToGame(gameId) {
            this.$router.push(`/game/${gameId}`);
        },
    },
  };
</script>