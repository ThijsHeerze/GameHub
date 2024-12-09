<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">Fuck the Dealer</h1>
      <form @submit.prevent="startGame" class="space-y-4">
        <div v-for="(player, index) in players" :key="index" class="flex items-center space-x-4">
          <label class="flex-1">
            <span class="block text-sm font-medium text-gray-700">
              Speler {{ index + 1 }}:
            </span>
            <input
              type="text"
              v-model="players[index]"
              placeholder="Naam invoeren"
              class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            />
          </label>
          <button
            v-if="players.length > 2"
            type="button"
            @click="removePlayer(index)"
            class="text-red-500 hover:text-red-700"
          >
            Verwijder
          </button>
        </div>
        <div class="space-x-4 text-center">
          <button
            type="button"
            @click="addPlayer"
            class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600"
          >
            + Voeg speler toe
          </button>
          <button
            type="submit"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600"
          >
            Start Spel
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      players: ["speler1", "speler2"], // Begin met twee spelers
    };
  },
  methods: {
    addPlayer() {
      this.players.push("");
    },
    removePlayer(index) {
      this.players.splice(index, 1);
    },
    async startGame() {
      try {
        const response = await axios.post('/game/start', { players: this.players });
        this.$router.push(`/game/${response.data.id}`);
      } catch (error) {
        console.error("Fout bij het starten van het spel", error);
      }
    },
  },
};
</script>
