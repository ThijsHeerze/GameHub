<template>
    <div>
      <h1>Spel ID: {{ gameId }}</h1>
      <div v-if="game">
        <h2>Huidige Dealer: {{ dealer?.name }}</h2>
        <p>Kaarten over: {{ remainingCards }}</p>
  
        <div v-if="currentPlayer">
          <h3>{{ currentPlayer.name }}, raad een kaart</h3>
          <input v-model="guess" placeholder="Kaartwaarde (2-10, J, Q, K, A)" />
          <button @click="submitGuess">Indienen</button>
        </div>
  
        <div v-else>
          <p>Wachten op andere spelers...</p>
        </div>
  
        <h3>Resultaten</h3>
        <ul>
          <li v-for="turn in turns" :key="turn.id">
            {{ turn.player.name }} raadde {{ turn.guess }}: 
            <span v-if="turn.correct">Correct!</span>
            <span v-else>Fout, moest {{ turn.drinks_taken }} drinken</span>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        game: null,
        dealer: null,
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
          this.dealer = this.game.players.find((p) => p.is_dealer);
          this.currentPlayer = this.game.players[this.game.turns.length % this.game.players.length];
          this.remainingCards = 52 - this.game.turns.length; // Bijv. kaarten nog in het spel
          this.turns = this.game.turns;
        } catch (error) {
          console.error("Fout bij het laden van het spel", error);
        }
      },
      async submitGuess() {
        try {
          const response = await axios.post(`/player/${this.currentPlayer.id}/guess`, {
            guess: this.guess,
          });
          this.turns.push(response.data);
          this.guess = "";
          await this.loadGame();
        } catch (error) {
          console.error("Fout bij het indienen van een gok", error);
        }
      },
    },
  };
  </script>
  