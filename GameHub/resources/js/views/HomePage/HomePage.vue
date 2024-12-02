<template>
    <div class="home flex flex-col bg-night min-h-screen py-4 gap-52">
        <Home />
        <RecentGames />
    </div>  
</template>
  
<script>
import Home from "./components/Home.vue";
import RecentGames from "./components/RecentGames.vue";

export default {
  name: "HomePage",
  components: {
    Home,
    RecentGames,
  },
  data() {
    return {
      games: [
        {
          id: "fuck-the-dealer",
          name: "Fuck the Dealer",
          image: "/image/FTD.jpg",
        },
        {
          id: "paarden-race",
          name: "Paarden Race",
          image: "/image/paardenRace.jpg",
        },
        {
          id: "toepen",
          name: "Toepen",
          image: "/image/toepen.jpg",
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