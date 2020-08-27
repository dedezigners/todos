<template>
  <v-container
  class="py-10">
    <question
    :data="question"
    ></question>
  </v-container>
</template>

<script>
import Question from "./SignleQuestion/Question"

export default {
  components: {
    Question
  },
  data() {
    return {
      question: {}
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
