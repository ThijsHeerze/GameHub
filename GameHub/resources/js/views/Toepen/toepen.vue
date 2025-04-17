<template>
  <div class="bg-night min-h-screen flex flex-col items-center justify-center gap-24 text-lavender">
    <h1 class="text-3xl font-bold mb-6">Toepen</h1>  

      <div v-if="!gameStarted" class="flex justify-center w-full gap-20">
        <div class="flex flex-col items-center justify-center w-full max-w-md gap-4">
          <input
            v-model="playerName"
            ref="playerNameInput"
            class="bg-night px-4 py-2 border-2 border-lavender rounded"
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
        <div v-if="!gameStarted" class="flex flex-col items-center w-full max-w-md">
          <h2 class="text-xl font-bold mb-4">Spelers</h2>
          <ul
            :class="[
              'grid gap-4 w-full',
              game.players.length <= 4 ? 'grid-cols-1' : 'grid-cols-2'
            ]"
          >
            <li
              class="font-semibold flex justify-between items-center p-1"
              v-for="(player, index) in game.players"
              :key="index"
            >
              {{ player }}
              <button 
                type="button" 
                @click="removePlayer(index)" 
                class="text-red-500 hover:text-red-700 font-light"
              >
                Verwijder
              </button>
            </li>
          </ul>
        </div>
      </div>
      <button
        v-if="!gameStarted"
        type="button" 
        @click="startGame"
        class="bg-violet px-6 py-3 w-[10rem] rounded-lg hover:bg-purple-600 active:scale-95 transform transition-all duration-800 text-white"
      >
        Start Spel
      </button>


      <GameView v-if="gameStarted" :game="game" />
    <!-- Meldingen -->
    <!-- <p v-if="message" :class="{ success: isSuccess, error: !isSuccess }">{{ message }}</p> -->
  </div>
</template>

<script>
import axios from 'axios';
import GameView from './GameView.vue';

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
      if (this.gameStarted) {
        this.message = "Het spel is al gestart!";
        this.isSuccess = false;
        return;
      }
      if (this.game.players.length >= 8) {
        this.message = "Maximaal 8 spelers toegestaan.";
        this.isSuccess = false;
        return;
      }
      if (!this.playerName.trim()) return;

      try {
        const response = await axios.post('/toepen/add-player', {
          player: this.playerName,
        });

        this.game = response.data.game;
        this.playerName = "";

        this.$nextTick(() => {
          this.$refs.playerNameInput.focus();
        });

        localStorage.setItem('toepen_game', JSON.stringify(this.game));
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
        localStorage.setItem('toepen_game', JSON.stringify(this.game));

      } catch (error) {
        console.error("Fout bij verwijderen speler:", error);
      }
    },
    async startGame() {
      if (this.game.players.length < 2) {
        alert("Minimaal 2 spelers vereist.");
        return;
      }

      try {
        const response = await axios.post('/toepen/start', { players: this.game.players });
        this.game = response.data.game;
        this.gameStarted = true;
        localStorage.setItem('toepen_game', JSON.stringify(this.game));

        this.$router.push(`/toepen/${this.game.id}`);
      } catch (error) {
        console.error("Fout bij het starten van het spel", error);
      }
    }
  },
  mounted() {
    const saved = localStorage.getItem('toepen_game');
    if (saved) {
      this.game = JSON.parse(saved);
    }
  }
};
</script>