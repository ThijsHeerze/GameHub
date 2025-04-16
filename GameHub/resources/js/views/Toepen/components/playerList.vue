<template>
  <ul class="space-y-2">
    <li
      v-for="(player, index) in players"
      :key="index"
      class="bg-gray-700 p-2 rounded shadow hover:scale-105 transition"
    >
      {{ player }}
    </li>
  </ul>
</template>

<script setup>
defineProps({
  players: Array,
});
</script>
