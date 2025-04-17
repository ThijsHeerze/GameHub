<template>
  <div v-if="game && !loading" class="bg-night min-h-screen flex flex-col items-center justify-center gap-24 text-lavender">
    <h2>Spelers</h2>
    <ul>
      <li v-for="(player, index) in game.players" :key="index">
        {{ player }} - {{ game.scores[index] }} punten
        <button @click="addPoint(index)">+1 Punt</button>
      </li>
    </ul>

    <button @click="endGame">Beëindig Spel</button>
  </div>

  <!-- Loading indicator -->
  <!-- <div v-if="loading" class="loading-indicator">
    Laden...
  </div> -->
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const router = useRouter();

const game = ref(null);
const loading = ref(true);

onMounted(async () => {
  const gameId = route.params.id;

  try {
    const response = await axios.get(`/toepen/${gameId}`);
    game.value = response.data.game;
  } catch (error) {
    console.error("Fout bij ophalen van spel:", error);
  } finally {
    loading.value = false;
  }
});

function addPoint(index) {
  game.value.scores[index] += 1;
}

async function endGame() {
  try {
    const response = await axios.post(`/toepen/${game.value.id}/end`);
    if (response.status === 200) {
      alert("Het spel is beëindigd!");
      router.push('/toepen');
    }
  } catch (error) {
    console.error("Fout bij beëindigen van spel:", error);
  }
}
</script>
