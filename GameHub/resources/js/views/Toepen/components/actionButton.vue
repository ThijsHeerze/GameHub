<template>
  <div class="flex justify-between mt-6">
    <button
      class="bg-green-600 hover:bg-green-500 px-4 py-2 rounded-lg font-semibold"
      @click="$emit('play-turn')"
    >
      Speel Beurt
    </button>
    <button
      class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded-lg font-semibold"
      @click="$emit('end-game')"
    >
      Stop Spel
    </button>
  </div>
</template>
