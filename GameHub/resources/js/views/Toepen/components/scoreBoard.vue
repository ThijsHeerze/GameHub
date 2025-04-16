<template>
  <div class="grid grid-cols-2 gap-4">
    <div
      v-for="(score, index) in scores"
      :key="index"
      class="bg-gray-800 text-center p-4 rounded-lg shadow-md"
    >
      <h3 class="text-lg font-semibold">{{ players[index] }}</h3>
      <p class="text-2xl">{{ score }}</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  players: Array,
  scores: Array,
});
</script>
