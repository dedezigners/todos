<template>
  <v-container
  class="py-10">
    <v-card
    class="pa-5">
    
    <v-card-title>{{ data.title }}</v-card-title>
    <v-card-subtitle>{{ data.created_by }} said at {{ data.created_at }}</v-card-subtitle>
    <v-btn text>10 Replies</v-btn>

    <v-card-text v-html="questionDescription"></v-card-text>

    

    </v-card>
  </v-container>
</template>

<script>
export default {
  props: ['data'],
  computed: {
    questionDescription() {
      return MD.parse(this.data.desc)
    }
  }
}
</script>

<style>

</style>
