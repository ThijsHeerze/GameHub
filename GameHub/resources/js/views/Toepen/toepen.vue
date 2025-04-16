<template>
  <div class="bg-night min-h-screen flex flex-col items-center justify-center text-lavender">
    <h1 class="text-3xl font-bold mb-6">Toepen</h1>  

    <!-- Formulier om spelers toe te voegen -->
    <form v-if="!gameStarted" class="flex flex-col items-center gap-8" @submit.prevent="addPlayer">
      <div class="flex items-center gap-4">
        <input class="bg-night p-2 border-2 border-lavender rounded" v-model="newPlayer" type="text" placeholder="Voeg een speler toe" required />
        <button  class="bg-violet px-6 py-3 w-[10rem] rounded-lg hover:bg-purple-600 active:scale-95 transform transition-all duration-800 text-white" type="submit">Toevoegen</button>
      </div>
      
      <button
        v-if="!gameStarted"
        @click="startGame"
        class="bg-violet px-6 py-3 w-[10rem] rounded-lg hover:bg-purple-600 active:scale-95 transform transition-all duration-800 text-white"
      >
        Start Spel
      </button>
    </form>


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
    <p v-if="message" :class="{ success: isSuccess, error: !isSuccess }">{{ message }}</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      gameStarted: false,
      game: null,
      newPlayer: "",
      message: "",
      isSuccess: true,
    };
  },
  created() {
    this.fetchGame();
  },
  methods: {
    // Haal het huidige spel op
    async fetchGame() {
      try {
        const response = await axios.get("/api/toepen");
        this.game = response.data;
      } catch (error) {
        this.setMessage("Fout bij ophalen van het spel.", false);
      }
    },
    // Start het spel
    async startGame() {
      try {
        const response = await axios.post("/paardenRace/start");
        console.log(response.data);
        this.raceId = response.data.race_id;
        this.gameStarted = true;
        this.winner = null;
      } catch (error) {
        console.error("Fout bij het starten van het spel", error);
        if (error.response) {
          console.error('Server responded with:', error.response.data); 
        }
      }
    },
    // Voeg een speler toe
    async addPlayer() {
      try {
        const response = await axios.post("/toepen/add-player", {
          player: this.newPlayer,
        });
        this.game = response.data.game;
        this.newPlayer = "";
        this.setMessage("Speler toegevoegd!", true);
      } catch (error) {
        console.log(error);
        this.setMessage("Fout bij toevoegen van speler.", false);
      }
    },
    // Voeg een punt toe aan een speler
    async addPoint(playerIndex) {
      try {
        const response = await axios.post(`/api/toepen/add-point/${playerIndex}`);
        this.game = response.data;
        this.setMessage("Punt toegevoegd!", true);
      } catch (error) {
        this.setMessage("Fout bij toevoegen van punt.", false);
      }
    },
    // Beëindig het spel
    async endGame() {
      try {
        await axios.post("/api/toepen/end-game");
        this.game = null;
        this.setMessage("Het spel is beëindigd.", true);
      } catch (error) {
        this.setMessage("Fout bij beëindigen van het spel.", false);
      }
    },
    // Stel een bericht in
    setMessage(text, success) {
      this.message = text;
      this.isSuccess = success;
      setTimeout(() => (this.message = ""), 3000);
    },
  },
};
</script>

<style>
.success {
  color: green;
}
.error {
  color: red;
}
</style>
