<template>
    <div class="home ">
      <header class="header text-gray-50">
        <h1>Welkom bij GameHub</h1>
        <p>Kies een game en begin met spelen!</p>
      </header>
  
      <div class="games">
        <div v-for="game in games" :key="game.id" class="game-card">
          <h2>{{ game.name }}</h2>
          <p>{{ game.description }}</p>
          <button @click="goToGame(game.id)">Speel Nu</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "Home",
    data() {
      return {
        games: [
          {
            id: "fuck-the-dealer",
            name: "Fuck the Dealer",
            description:
              "Een spannend drankspel waarbij je moet raden welke kaart er ligt. Daag je vrienden uit!",
          },
          {
            id: "paarden-race",
            name: "Paarden Race",
            description:
              "Test je geheugen met dit uitdagende kaartenspel. Kun jij alle paren vinden?",
          },
        ],
      };
    },
    methods: {
      goToGame(gameId) {
        this.$router.push(`/game/${gameId}`);
      },
    },
  };
  </script>
  
  <style scoped>
  .home {
    font-family: Arial, sans-serif;
    text-align: center;
    padding: 2rem;
  }
  
  .header {
    margin-bottom: 2rem;
  }
  
  .games {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
  }
  
  .game-card {
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 1rem;
    width: 300px;
    text-align: left;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .game-card h2 {
    margin: 0 0 0.5rem;
  }
  
  .game-card p {
    font-size: 0.9rem;
    margin: 0 0 1rem;
  }
  
  .game-card button {
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 0.5rem 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .game-card button:hover {
    background-color: #45a049;
  }
  </style>
  