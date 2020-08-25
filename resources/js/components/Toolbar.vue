<template>
  <v-toolbar>
    <v-toolbar-title>
      <router-link to="/"><v-btn text>DeFourm</v-btn></router-link>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <router-link to="/fourm"><v-btn text>Fourm</v-btn></router-link>
    <router-link to="/ask-question"><v-btn text>Ask Question</v-btn></router-link>
    <router-link to="/category"><v-btn text>Category</v-btn></router-link>
    <router-link to="/login"><v-btn text>Login</v-btn></router-link>
  </v-toolbar>
</template>

<script>
export default {
    
}
</script>

<style>

</style>
