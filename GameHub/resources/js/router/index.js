import { createRouter, createWebHistory } from 'vue-router';
import { createApp } from 'vue';

import HomePage from '../views/HomePage/HomePage.vue';
import Home from '../views/FTD/Home.vue';
import Game from '../views/FTD/Game.vue';

const routes = [
  //Routes for HomePage
  { path: '/', name: 'HomePage', component: HomePage },

  //Routes for FTD
  { path: '/Home', name: 'Home', component: Home },
  { path: '/game/:id', name: 'Game', component: Game },

  //Routes for Whist
  // { path: '/Home', name: 'Home', component: Home },
  // { path: '/Home', name: 'Home', component: Home },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
