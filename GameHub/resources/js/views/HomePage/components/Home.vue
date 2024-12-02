<template>
    <div class="flex flex-col items-center justify-center min-h-screen gap-20">
      <header class="header text-gray-50 text-center">
        <h1 class="text-3xl font-bold mb-2">Welkom bij GameHub</h1>
        <p class="text-lg">Kies een game en begin met spelen!</p>
      </header>
  
      <div class="flex flex-row justify-center items-center min-h-auto gap-20">
        <!-- Carousel -->
        <div class="relative w-full max-w-[60rem] flex items-center justify-center">

            <swiper
                class="w-full h-[40rem] overflow-hidden"
                :slides-per-view="1"
                :space-between="0"
                :loop="true"
                :autoplay="{ delay: 10 }"
                :pagination="{ clickable: true }"
                >
                <!-- Navigation buttons -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <swiper-slide v-for="game in games" :key="game.id" class="relative flex items-center justify-center">
                    <img :src="game.image" :alt="game.name" class="w-full h-[40rem] object-cover rounded-lg" />
                    <div class="absolute bottom-5 left-5 bg-black bg-opacity-50 text-white p-4 rounded-lg">
                    <h2 class="text-2xl font-bold">{{ game.name }}</h2>
                    <p class="mt-2">{{ game.description }}</p>
                    <button class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 mt-3" @click="goToGame(game.id)">
                        Speel Nu
                    </button>
                    </div>
                </swiper-slide>
                </swiper>
        </div>
  
        <!-- Sidebar -->
        <div class="w-1/4 text-white py-10 px-6">
          <h2 class="text-xl font-bold mb-6">Aangeklikte Games</h2>
          <div
            v-for="game in games"
            :key="game.id"
            class="mb-6 flex items-center gap-4"
          >
            <img
              :src="game.thumbnail"
              alt=""
              class="w-16 h-16 rounded-lg object-cover"
            />
            <div>
              <h3 class="text-lg font-semibold">{{ game.name }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { Swiper, SwiperSlide } from "swiper/vue";
  import "swiper/swiper-bundle.css";
  
  export default {
    components: {
      Swiper,
      SwiperSlide,
    },
    data() {
      return {
        games: [
          {
            id: "1",
            name: "Fuck The Dealer",
            description: "Embody the superhuman skill of a Space Marine.",
            image: "/image/FTD.jpg",
            thumbnail: "/image/FTD.jpg",
          },
          {
            id: "2",
            name: "Paarden Race",
            description: "Explore the eerie Chernobyl Exclusion Zone.",
            image: "/image/paardenRace.jpg",
            thumbnail: "/image/paardenRace.jpg",
          },
          {
            id: "3",
            name: "Toepen",
            description: "A dark fantasy action RPG.",
            image: "/image/toepen.jpg",
            thumbnail: "/image/toepen.jpg",
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
  