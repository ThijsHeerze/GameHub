<template>
    <div>
      <h1>Fuck the Dealer</h1>
      <form @submit.prevent="startGame">
        <label v-for="(player, index) in players" :key="index">
          Speler {{ index + 1 }}:
          <input type="text" v-model="players[index]" placeholder="Naam invoeren" />
        </label>
        <button type="button" @click="addPlayer">+ Voeg speler toe</button>
        <button type="submit">Start Spel</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        players: ["", ""], // Begin met twee spelers
      };
    },
    methods: {
      addPlayer() {
        this.players.push("");
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
  