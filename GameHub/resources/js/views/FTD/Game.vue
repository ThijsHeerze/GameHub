<template>
  <div class="p-6 bg-gray-100 min-h-screen flex flex-col items-center">
    <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
      <h1 class="text-3xl font-bold text-blue-600 mb-4 text-center">
        Spel ID: {{ gameId }}
      </h1>

      <div v-if="game">
        <p class="text-gray-600 mb-4">Kaarten over: <span class="font-bold">{{ remainingCards }}</span></p>

        <div v-if="currentPlayer" class="mb-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">
            {{ currentPlayer?.name }}, raad een kaart
          </h3>
          <div class="flex items-center space-x-4">
            <input
              v-model="guess"
              placeholder="Kaartwaarde (2-10, J, Q, K, A)"
              class="px-4 py-2 border rounded-lg flex-1 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            />
            <button
              @click="submitGuess"
              class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600"
            >
              Indienen
            </button>
          </div>
        </div>

        <div v-else class="mb-6">
          <p class="text-gray-600">Wachten op andere spelers...</p>
        </div>

        <h3 class="text-lg font-semibold text-gray-800 mb-4">Resultaten</h3>
        <ul class="space-y-4">
          <li
            v-for="turn in turns"
            :key="turn.id"
            class="p-4 bg-gray-50 border rounded-lg shadow-sm flex justify-between items-center"
          >
            <span class="text-gray-700">
              <span class="font-semibold">{{ turn.player?.name }}</span> raadde
              <span class="font-semibold">{{ turn.guess }}</span>:
            </span>
            <span
              :class="turn.correct ? 'text-green-500' : 'text-red-500'"
              class="font-bold"
            >
              <span v-if="turn.correct">Correct!</span>
              <span v-else>Fout, moest {{ turn.drinks_taken }} drinken</span>
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      game: null,
      // dealer: null,
      currentPlayer: null,
      remainingCards: 0,
      guess: "",
      turns: [],
    };
  },
  computed: {
    gameId() {
      return this.$route.params.id;
    },
  },
  async created() {
    await this.loadGame();
  },
  methods: {
    async loadGame() {
      try {
        const response = await axios.get(`/game/${this.gameId}`);
        
        this.game = response.data;
        console.log('Game data:', this.game); // Log the entire game data for debugging
        
        if (this.game.players && Array.isArray(this.game.players)) {
          console.log('Players array:', this.game.players); // Log the players array for debugging
          this.game.players.forEach((player, index) => {
            console.log(`Player ${index}:`, player); // Log each player for debugging
          });
        } else {
          console.error('Players array is missing or not an array');
        }

        this.currentPlayer =
          this.game.players[this.game.turns.length % this.game.players.length] || null;
        this.remainingCards = 52 - this.game.turns.length; // Bijv. kaarten nog in het spel
        this.turns = this.game.turns;
      } catch (error) {
        console.error("Fout bij het laden van het spel", error);
      }
    },
    async submitGuess() {
      if (!this.currentPlayer) {
        console.error("Geen huidige speler gevonden");
        return;
      }

      try {
        const payload = {
          guess: this.guess,
        };
        console.log('Submitting guess with payload:', payload); // Log the payload for debugging

        const response = await axios.post(
          `/player/${this.currentPlayer.id}/guess`,
          payload
        );
        console.log('Response data:', response.data); // Log the response data for debugging
        this.turns.push(response.data);
        this.guess = "";
        await this.loadGame();
      } catch (error) {
        console.error("Fout bij het indienen van een gok", error);
        if (error.response) {
          console.error('Server responded with:', error.response.data); // Log server response
        }
      }
    },
  },
};
</script>

<style>
/* Custom styling can be added here if needed */
</style>
