<template>
  <div class="flex flex-col items-center justify-center min-h-screen gap-20">
    <header class="header text-gray-50 text-center">
      <h1 class="text-3xl font-bold mb-2">Welkom bij GameHub</h1>
      <p class="text-lg">Kies een game en begin met spelen!</p>
    </header>

    <div class="flex flex-row justify-center items-center min-h-auto gap-20">
      <!-- Carousel -->
      <div class="relative w-full max-w-[60rem] flex items-center justify-center">
        <div class="w-full h-[40rem] overflow-hidden">
          <div class="relative flex items-center justify-center">
            <img :src="state.image" :alt="state.name" class="w-[60rem] h-[40rem] object-cover rounded-lg" />
            <div class="absolute w-2/5 bottom-5 left-5 bg-black bg-opacity-70 text-white p-4 rounded-lg">
              <h2 class="text-2xl font-bold">{{ state.name }}</h2>
              <p class="mt-2">{{ state.description }}</p>
              <button class="bg-purple-800 px-4 py-2 rounded hover:bg-violet mt-3" @click="goToGame(state.id)">
                Speel Nu
              </button>
            </div>
          </div>
        </div>
        <button @click="prev()" class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-3xl text-white px-4 py-2 rounded-lg">
          <
        </button>
        <button @click="next()" class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-3xl text-white px-4 py-2 rounded-lg">
          >
        </button>
      </div>

      <!-- Sidebar -->
      <div class="w-1/4 text-white py-10 px-6">
        <h2 class="text-xl font-bold mb-6">Aangeklikte Games</h2>
        <div
          v-for="game in games"
          :key="game.id"
          class="mb-6 flex items-center gap-4"
        >
          <img
            :src="game.thumbnail"
            alt="Game Thumbnail"
            class="w-16 h-16 rounded-lg object-cover"
          />
          <div>
            <h3 class="text-lg font-semibold">{{ game.name }}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { ref } from 'vue';
import { useCycleList } from '@vueuse/core';

export default {
  setup() {
    const games = ref([
      {
        id: "1",
        name: "Fuck The Dealer",
        description: "Fuck the Dealer is een drankspel waarbij de dealer kaartwaarden raadt, en spelers drinken op basis van fouten.",
        image: "/image/FTD.jpg",
        thumbnail: "/image/FTD.jpg",
      },
      {
        id: "2",
        name: "Paarden Race",
        description: "Paardenrace is een drankspel waarbij spelers inzetten op  paarden die een race houden, en drinken afhankelijk van het resultaat.",
        image: "/image/paardenRace.jpg",
        thumbnail: "/image/paardenRace.jpg",
      },
      {
        id: "3",
        name: "Toepen",
        description: "Drankspel Toepen is een variant van Toepen, waarbij de verliezer van een slag of ronde een slok neemt.",
        image: "/image/toepen.jpg",
        thumbnail: "/image/toepen.jpg",
      },
    ]);

    const { state, next, prev } = useCycleList(games.value);

    const goToGame = (gameId) => {
      this.$router.push(`/game/${gameId}`);
    };

    return { games, state, next, prev, goToGame };
  },
};
</script>