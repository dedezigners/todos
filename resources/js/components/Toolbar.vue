<template>
  <v-toolbar>
    <v-toolbar-title>
      <router-link to="/forum"><v-btn text>DeFourm</v-btn></router-link>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <router-link
    v-for="item in items"
    :key="item.title"
    :to="item.to"
    v-if="item.show">
      <v-btn text>{{ item.title }}</v-btn>
    </router-link>

  </v-toolbar>
</template>

<script>
export default {
  data() {
    return {
      items: [
        {title: 'Forum', to: '/forum', show: false},
        {title: 'Categories', to: '/categories', show: User.loggedIn()},
        {title: 'Ask Question', to: '/ask-question', show: User.loggedIn()},
        {title: 'Logout', to: '/logout', show: User.loggedIn()},
        {title: 'Login', to: '/login', show: !User.loggedIn()},
      ]
    }
  },
  created() {
    EventBus.$on('logout', () => {
      User.logout()
    })
  }
}
</script>

<style>

</style>
