<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="8"
      >
        <question
        v-for="question in questions"
        :key="question.title"
        :data="question"
        ></question>
      </v-col>
      <v-col
        cols="6"
        md="4"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
          Categories
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Question from "./Question"

export default {
  data() {
    return {
      questions: null
    }
  },
  components: {
    Question,
  },
  created() {
    axios.get('/api/questions')
    .then(res => this.questions = res.data.data)
    .catch(error => console.log(error.response.data))
  }
}
</script>

<style>

</style>
