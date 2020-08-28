<template>
  <v-container
  class="py-10"
  v-if="question">

    <edit-question
    :data="question"
    v-if="editQuestion"
    ></edit-question>

    <question
    :data="question"
    v-else
    ></question>

  </v-container>
</template>

<script>
import Question from "./SignleQuestion/Question"
import EditQuestion from "./EditQuestion"

export default {
  components: {
    Question,
    EditQuestion
  },
  data() {
    return {
      question: null,
      editQuestion: false
    }
  },
  created() {
    this.listen()
    this.getQuestion()
  },
  methods: {
    listen() {
      EventBus.$on('startEditing', ()=>{
        this.editQuestion = true
      })

      EventBus.$on('cancleEditing', ()=>{
        this.editQuestion = false
      })
    },
    getQuestion() {
      axios.get(`/api/question/${this.$route.params.slug}`)
      .then(res => this.question = res.data.data)
      .catch(error => console.log(error.response.data))
    }
  }
}
</script>

<style>

</style>
