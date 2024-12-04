import { createRouter, createWebHistory } from 'vue-router';

import HomePage from '../views/HomePage/HomePage.vue';
import Home from '../views/FTD/Home.vue';
import Game from '../views/FTD/Game.vue';
import paardenRace from '../views/PaardenRace/paardenRace.vue';

const routes = [
  //Routes for HomePage
  { path: '/', name: 'HomePage', component: HomePage },

  //Routes for FTD
  { path: '/Home', name: 'Home', component: Home },
  { path: '/game/:id', name: 'Game', component: Game },

  //Routes for paardenRace
  { path: '/paardenRace', name: 'paardenRace', component: paardenRace },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
