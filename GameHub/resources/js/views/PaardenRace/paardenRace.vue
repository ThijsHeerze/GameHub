<template>
  <div class="bg-night min-h-screen flex flex-col items-center justify-center text-lavender">
    <h1 class="text-3xl font-bold mb-6">PaardenRace</h1>  
    <button
      v-if="!gameStarted"
      @click="startGame"
      class="bg-purple-800 px-4 py-2 rounded hover:bg-violet mt-3 text-white"
    >
      Start Spel
    </button>
    <div v-if="winner" class="text-center mb-6">
      <h2 class="text-2xl font-bold text-green-500">De winnaar is: {{ winner }}</h2>
    </div>
    <button
      v-if="winner"
      @click="startGame"
      class="bg-purple-800 px-4 py-2 rounded hover:bg-violet mt-3 text-white"
    >
      Nieuw spel
    </button>


    <button
      v-if="gameStarted && !winner"
      @click="drawCard"
      class="bg-purple-800 px-4 py-2 rounded hover:bg-violet mt-3 text-white"
    >
      Trek een kaart
    </button>
       
    <div v-if="progress" class="w-full max-w-4xl mt-8">
      <h2 class="text-xl font-bold mb-4">Voortgang:</h2>
      <div v-for="(steps, suit) in progress" :key="suit" class="mb-4">
        <p class="font-bold">{{ suit }}</p>
        <div class="flex items-center gap-8">
          <div class="bg-raisin h-4 w-full rounded-full overflow-hidden">
              <div
                class="bg-lavender h-4 rounded-full"
                :style="{ width: (steps / 6) * 100 + '%' }"
              ></div>
          </div>
          <p class="text-lg font-bold">{{ steps }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      gameStarted: false,
      progress: null,
      winner: null,
      raceId: null,
    };
  },
  methods: {
    async startGame() {
      try {
        const response = await axios.post("/paardenRace/start");
        console.log(response.data);
        this.raceId = response.data.race_id;
        this.gameStarted = true;
        this.progress = { Harten: 0, Schoppen: 0, Klaveren: 0, Ruiten: 0 };
        this.winner = null;
      } catch (error) {
        console.error("Fout bij het starten van het spel", error);
        if (error.response) {
          console.error('Server responded with:', error.response.data); // Log server response
        }
      }
    },
    async drawCard() {
      try {
        const response = await axios.post(`/paardenRace/draw/${this.raceId}`);
        this.progress = response.data.progress;
        this.winner = response.data.winner || null;
      } catch (error) {
        console.error("Fout bij het trekken van een kaart", error);
      }
    },
  },
};
</script>
