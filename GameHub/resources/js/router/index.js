import { createRouter, createWebHistory } from 'vue-router';
import { createApp } from 'vue';

import Home from '../views/FTD/Home.vue';
import Game from '../views/FTD/Game.vue';

const routes = [
  { path: '/Home', name: 'Home', component: Home },
  { path: '/game/:id', name: 'Game', component: Game },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
