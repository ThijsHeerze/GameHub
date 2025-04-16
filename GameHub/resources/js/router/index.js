import { createRouter, createWebHistory } from 'vue-router';

import HomePage from '../views/HomePage/HomePage.vue';
import Home from '../views/FTD/Home.vue';
import Whist from '../views/Whist/Whist.vue';
import Game from '../views/FTD/Game.vue';
import PaardenRace from '../views/PaardenRace/paardenRace.vue';
import toepen from '../views/Toepen/toepen.vue';
import GameView from '../views/Toepen/gameView.vue';

const routes = [
  //Routes for HomePage
  { path: '/', name: 'HomePage', component: HomePage },

  //Routes for FTD
  { path: '/Home', name: 'Home', component: Home },
  { path: '/game/:id', name: 'Game', component: Game },

  //Routes for Whist
  { path: '/Whist', name: 'Whist', component: Whist },

  //Routes for paardenRace
  { path: '/paardenRace/:id', name: 'PaardenRace', component: PaardenRace },

  //Routes for toepen
  { path: '/toepen', name: 'toepen', component: toepen },
  { path: '/toepen/:id', name: 'gameView', component: GameView },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
