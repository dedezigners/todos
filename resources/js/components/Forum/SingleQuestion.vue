<template>
  <v-container
  class="py-10">
    <v-card
    class="pa-5">
      <h1>Single Question</h1>
    </v-card>
  </v-container>
</template>

<script>
import Question from "./Question"

export default {
  data() {
    return {
      question: null
    }
  },
  created() {
    axios.get(`/api/question/${this.$route.params.slug}`)
    .then(res => this.question = res.data.data)
    .catch(error => console.log(error.response.data))
  }
}
</script>

<style>

</style>
