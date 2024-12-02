<template>
    <div class="games flex flex-wrap flex-col justify-center gap-8 mb-60">
        <h2 class="text-2xl font-semibold mb-4 w-100 text-center text-white">Recent gespeelde games:</h2>
            <div class="games flex flex-wrap justify-center gap-8">
                <div
                    v-for="game in games"
                    :key="game.id"
                    class="game-card bg-raisin rounded-lg shadow-lg p-6 w-1/4 text-left">
                    <h2 class="text-xl text-white font-semibold italic mb-4">{{ game.name }}</h2>
                    <img :src="game.image" alt="" class="rounded-md mb-4 w-full h-64 object-cover" />
                    <button
                    @click="$emit('goToGame', game.id)"
                    class="bg-purple-900 text-white py-3 px-8 rounded-md hover:bg-violet transition">
                    Speel Nu
                    </button>
                </div>
            </div>
    </div>
</template>
  
<script>
    export default {
        name: "RecentGames",
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
  