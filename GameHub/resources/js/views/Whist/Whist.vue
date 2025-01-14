<template>
    <div class="p-6 bg-gray-100 min-h-screen">
      <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">
        Whist Score Formulier
      </h1>
  
      <!-- Ronde nummer -->
      <div class="mb-4">
        <label for="round" class="block text-lg font-semibold text-gray-700">Ronde Nummer:</label>
        <input
          v-model="roundNumber"
          type="number"
          id="round"
          class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
          placeholder="Ronde #"
        />
      </div>
  
      <!-- Spelers Sectie -->
      <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Spelers</h2>
  
        <!-- Spelerslijst -->
        <div
          v-for="(player, index) in players"
          :key="index"
          class="bg-white shadow rounded-lg p-4 mb-4"
        >
          <label class="block font-semibold text-gray-700">Speler Naam:</label>
          <input
            v-model="player.name"
            type="text"
            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
            placeholder="Naam Speler"
          />
  
          <label class="block font-semibold text-gray-700 mt-4">Bieding:</label>
          <input
            v-model.number="player.bid"
            type="number"
            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
            placeholder="Bieding"
          />
  
          <label class="block font-semibold text-gray-700 mt-4">Slagen:</label>
          <input
            v-model.number="player.tricks"
            type="number"
            class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
            placeholder="Slagen"
          />
  
          <label class="block font-semibold text-gray-700 mt-4">Score:</label>
          <input
            :value="calculateScore(player)"
            type="number"
            class="mt-1 w-full border rounded-lg px-4 py-2 bg-gray-200"
            readonly
          />
  
          <!-- Verwijder speler -->
          <button
            @click="removePlayer(index)"
            class="mt-4 text-red-500 font-semibold hover:text-red-700"
          >
            - Verwijder Speler
          </button>
        </div>
      </div>
  
      <!-- Voeg speler toe -->
      <button
        @click="addPlayer"
        class="w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-bold"
      >
        + Voeg Speler Toe
      </button>
  
      <!-- Totale score -->
      <div class="mt-8">
        <label class="block text-lg font-semibold text-gray-700">Totale Score:</label>
        <input
          :value="calculateTotalScore"
          type="number"
          class="mt-1 w-full border rounded-lg px-4 py-2 bg-gray-200"
          readonly
        />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        roundNumber: 1, // Huidige ronde nummer
        players: [
          { name: "Speler 1", bid: 0, tricks: 0 }, // Standaard speler
        ],
      };
    },
    methods: {
      // Voeg een nieuwe speler toe
      addPlayer() {
        this.players.push({ name: "", bid: 0, tricks: 0 });
      },
      // Verwijder een speler
      removePlayer(index) {
        this.players.splice(index, 1);
      },
      // Bereken de score van een speler
      calculateScore(player) {
        const { bid, tricks } = player;
        if (bid === tricks) {
          return 10 + tricks; // Correcte bieding
        }
        return -Math.abs(bid - tricks); // Foutieve bieding
      },
      async startGame() {
      try {
        const response = await axios.post('/whist', { players: this.players });
        this.$router.push(`/whist/${response.data.submit}`);
      } catch (error) {
        console.error("Fout bij het starten van het spel", error);
      }
    },
    },
    computed: {
      // Bereken de totale score
      calculateTotalScore() {
        return this.players.reduce((total, player) => {
          return total + this.calculateScore(player);
        }, 0);
      },
    },
  };
  </script>
  
  <style>
  /* Optionele extra styling */
  </style>
  