import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from "../components/Auth/Login"
import Signup from "../components/Auth/Signup"
import Logout from "../components/Auth/Logout"
import Forum from "../components/Forum/Forum"
import Category from "../components/Forum/Category"
import AskQuestion from "../components/Forum/AskQuestion"

const routes = [
  { path: '/login', component: Login, name: 'login' },
  { path: '/signup', component: Signup, name: 'signup' },
  { path: '/logout', component: Logout, name: 'logout' },
  { path: '/forum', component: Forum, name: 'forum' },
  { path: '/category', component: Category, name: 'category' },
  { path: '/ask-question', component: AskQuestion, name: 'question' },
]

const router = new VueRouter({
  mode: 'history',
  hashbang: false,
  routes // short for `routes: routes`
})

export default router
