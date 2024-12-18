<template>
  <div class="p-6 bg-gray-100 min-h-screen flex flex-col items-center">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">PaardenRace</h1>

    <div v-if="winner" class="text-center mb-6">
      <h2 class="text-2xl font-bold text-green-500">De winnaar is: {{ winner }}</h2>
    </div>

    <button
      v-if="!gameStarted"
      @click="startGame"
      class="mb-4 px-6 py-2 bg-blue-500 text-white font-bold rounded-lg"
    >
      Start Spel
    </button>

    <button
      v-if="gameStarted && !winner"
      @click="drawCard"
      class="mb-4 px-6 py-2 bg-blue-500 text-white font-bold rounded-lg"
    >
      Trek een kaart
    </button>

    <div v-if="progress" class="w-full max-w-4xl">
      <h2 class="text-lg font-semibold mb-4">Voortgang:</h2>
      <div v-for="(steps, suit) in progress" :key="suit" class="mb-4">
        <p class="text-gray-700 font-bold">{{ suit }}</p>
        <div class="bg-gray-300 h-4 w-full rounded-full overflow-hidden">
          <P></P>
          <div
            class="bg-blue-500 h-4 rounded-full"
            :style="{ width: (steps / 10) * 100 + '%' }"
          ></div>
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
