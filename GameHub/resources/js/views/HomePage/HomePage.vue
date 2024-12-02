<template>
    <div class="home flex flex-col bg-night min-h-screen py-20 gap-10">
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

      <div class="recent-games flex flex-col items-center mt-8">
        <h2 class="text-2xl font-semibold mb-4 w-100 text-white">Recent gespeelde games:</h2>
        <div class="">
          <div class="flex gap-4">
            <div class="recent-game bg-raisin rounded-lg shadow-lg p-6 w-80 text-left">
                <h3 class="text-lg font-semibold mb">   </h3>
                <img src="../../../../public/image/FTD.jpg" alt="" class="rounded-md mb-4 w-full h-48 object-cover" />
                <p class="text-sm text-white">Spelers: RubyRuub, Sleepy Tus, en 3 anderen</p>
                <button
                    @click="goToGame(game.id)"
                    class="bg-purple-900 text-white py-2 px-4 rounded hover:bg-violet transition">
                    Speel Nu
                </button>
            </div>
            <div class="recent-game bg-raisin rounded-lg shadow-lg p-6 w-80 text-left">
                <h3 class="text-lg font-semibold mb">   </h3>
                <img src="../../../../public/image/paardenRace.jpg" alt="" class="rounded-md mb-4 w-full h-48 object-cover" />
                <p class="text-sm text-white">Spelers: RubyRuub, Sleepy Tus, en 3 anderen</p>
                <button
                    @click="goToGame(game.id)"
                    class="bg-purple-900 text-white py-2 px-4 rounded hover:bg-violet transition">
                    Speel Nu
                </button>
            </div>
          </div>
        </div>  
      </div>
    </div>  
</template>
  
<script>
  export default {
    name: "Home",
    data() {
      return {
        games: [
          {
            id: "fuck-the-dealer",
            name: "Fuck the Dealer",
            image: "/image/FTD.jpg",
          },
          {
            id: "paarden-race",
            name: "Paarden Race",
            image: "/image/paardenRace.jpg",
          },
          {
            id: "toepen",
            name: "Toepen",
            image: "/image/toepen.jpg",
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
