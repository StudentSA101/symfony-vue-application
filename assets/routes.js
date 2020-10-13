import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './js/pages/home.vue';
import fourOhFour from './js/pages/404.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes:[
    {path:'/', name:'home', component:Home},
    {path:'/*', name:'404', component:fourOhFour}
  ]
});

export default router;