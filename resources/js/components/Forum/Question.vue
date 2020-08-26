<template>
  <v-card
  class="pa-2 mb-5"
  tile>
    <v-card-title>
      <router-link
      :to="'question/' + data.slug">
        {{ data.title }}
      </router-link>
    </v-card-title>
    <v-card-subtitle class="grey--text">Created at: {{ data.created_at }}</v-card-subtitle>
    <v-card-text>{{ data.desc }}</v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ['data']
}
</script>

<style scoped>

</style>
