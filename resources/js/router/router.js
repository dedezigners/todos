import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from "../components/Auth/Login"
import Signup from "../components/Auth/Signup"
import Logout from "../components/Auth/Logout"
import Forum from "../components/Forum/Forum"
import Categories from "../components/Forum/Category/Categories"
import AskQuestion from "../components/Forum/AskQuestion"
import SingleQuestion from "../components/Forum/SingleQuestion"

const routes = [
  // Auth
  { path: '/login', component: Login, name: 'login' },
  { path: '/signup', component: Signup, name: 'signup' },
  { path: '/logout', component: Logout, name: 'logout' },

  // Forum
  { path: '/forum', component: Forum, name: 'forum' },
  { path: '/ask-question', component: AskQuestion, name: 'question' },
  { path: '/question/:slug', component: SingleQuestion, name: 'singleQuestion' },

  // Category
  { path: '/categories', component: Categories, name: 'categories' },
]

const router = new VueRouter({
  mode: 'history',
  hashbang: false,
  routes // short for `routes: routes`
})

export default router
