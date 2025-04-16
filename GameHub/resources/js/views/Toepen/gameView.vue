<template>
  <div class="min-h-screen bg-gray-900 text-white flex flex-col items-center justify-center p-6">
    <h1 class="text-4xl font-bold mb-6">Toepen</h1>

    <div class="bg-gray-800 rounded-xl shadow-xl p-6 w-full max-w-xl">
      <PlayerList :players="game.players" />
      <ScoreBoard :players="game.players" :scores="game.scores" />
      <ActionButtons @play-turn="handleTurn" @end-game="handleEnd" />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import PlayerList from '@/components/PlayerList.vue';
import ScoreBoard from '@/components/ScoreBoard.vue';
import ActionButtons from '@/components/ActionButtons.vue';

const game = ref({
  players: ['Ruben', 'Thijs'],
  scores: [0, 0],
});

const handleTurn = () => {
  console.log('Beurt gespeeld');
};

const handleEnd = () => {
  console.log('Spel gestopt');
};
</script>
