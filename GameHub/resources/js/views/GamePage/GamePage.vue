<template>
  <div class="game-page">
    <h1>{{ gameName }}</h1>
    <p>Hier kun je {{ gameName }} spelen!</p>
  </div>
</template>

<script>
export default {
  name: "Game",
  data() {
    return {
      gameName: "",
    };
  },
  mounted() {
    const gameId = this.$route.params.id;
    const games = {
      "fuck-the-dealer": "Fuck the Dealer",
      "tic-tac-toe": "Tic Tac Toe",
      "memory-game": "Memory Game",
    };

    this.gameName = games[gameId] || "Onbekend Spel";
  },
};
</script>

<style scoped>
.game-page {
  text-align: center;
  margin-top: 2rem;
}

.game-page a {
  color: #4caf50;
  text-decoration: none;
}
</style>
