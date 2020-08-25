import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from "../components/Auth/Login"

const routes = [
  { path: '/login', component: Login },
]

const router = new VueRouter({
  mode: 'history',
  hashbang: false,
  routes // short for `routes: routes`
})

export default router
