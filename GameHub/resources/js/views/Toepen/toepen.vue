<template>
  <div class="bg-night min-h-screen flex flex-col items-center justify-center text-lavender">
    <h1 class="text-3xl font-bold mb-6">Toepen</h1>  

    <!-- Formulier om spelers toe te voegen -->
      <div v-if="!gameStarted" class="flex items-center gap-4">
        <input
          v-model="playerName"
          class="bg-night p-2 border-2 border-lavender rounded"
          type="text"
          placeholder="Voeg een speler toe"
          required
        />

        <button  
          type="button" 
          @click="addPlayer(index)"
          class="bg-violet px-6 py-3 w-[10rem] rounded-lg hover:bg-purple-600 active:scale-95 transform transition-all duration-800 text-white"
        >
          Toevoegen
        </button>
      </div>
      <div v-if="!gameStarted" class="">
        <h2 class="text-xl font-bold mb-4">Spelers</h2>
        <ul>
          <li v-for="(player, index) in game.players" :key="index">
            {{ player }} - 
            <button 
              type="button" 
              @click="removePlayer(index)" 
              class="text-red-500 hover:text-red-700"
            >
              Verwijder
            </button>
          </li>
        </ul>
      </div>
      <button
        v-if="!gameStarted"
        @click="startGame"
        class="bg-violet px-6 py-3 w-[10rem] rounded-lg hover:bg-purple-600 active:scale-95 transform transition-all duration-800 text-white"
      >
        Start Spel
      </button>


    <!-- Lijst met spelers en scores -->
    <div v-if="gameStarted" class="">
      <h2>Spelers</h2>
      <ul>
        <li v-for="(player, index) in game.players" :key="index">
          {{ player }} - {{ game.scores[index] }} punten
          <button @click="addPoint(index)">+1 Punt</button>
        </li>
      </ul>

      <!-- Beëindig spel -->
      <button @click="endGame">Beëindig Spel</button>
    </div>

    <!-- Meldingen -->
    <!-- <p v-if="message" :class="{ success: isSuccess, error: !isSuccess }">{{ message }}</p> -->
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      playerName: "",
      gameStarted: false,
      game: {
        players: [],
        scores: []
      },
      message: "",
      isSuccess: false,
    };
  },
  methods: {
    async addPlayer() {
      if (!this.playerName.trim()) return;

      try {
        const response = await axios.post('/toepen/add-player', {
          player: this.playerName,
        });

        this.game = response.data.game;
        this.playerName = "";
      } catch (error) {
        console.error("Fout bij toevoegen van speler:", error);
      }
    },
    async removePlayer(index) {
      const playerToRemove = this.game.players[index];
      try {
        await axios.post('/toepen/remove-player', { player: playerToRemove });
        this.game.players.splice(index, 1);
        this.game.scores.splice(index, 1);
      } catch (error) {
        console.error("Fout bij verwijderen speler:", error);
      }
    },




    
    async startGame() {
      try {
        const response = await axios.post('/toepen/start', { players: this.players });
        this.$router.push(`/toepen/${response.data.id}`);
      } catch (error) {
        console.error("Fout bij het starten van het spel", error);
      }
    },
    async mounted() {
      try {
        const response = await axios.get('/api/toepen');
        this.game = response.data;
      } catch (error) {
        console.error("Fout bij ophalen van het spel:", error);
      }
    }
  },
};
</script>