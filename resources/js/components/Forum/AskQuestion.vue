<template>
  <v-container>
    <v-row
      class="my-10"
      justify="center"
      no-gutters
    >
      <v-col sm="6">
        <v-card
          class="pa-2"
        >

          <v-card-title class="text-center">Ask Question</v-card-title>
          <v-divider class="mt-2"></v-divider>
          <v-card-text>
          <form
            @submit.prevent="askQuestion"
          >
            <v-text-field
              label="Title"
              v-model="form.title"
              filled
            ></v-text-field>

            <v-autocomplete
              label="Category"
              v-model="form.categoryId"
              :items="categories"
              item-text="name"
              item-value="id"
              dense
              filled
            ></v-autocomplete>

            <vue-simplemde v-model="form.desc" />

            <v-btn dark class="mr-4" type="submit">Ask Question</v-btn>
          </form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import VueSimplemde from 'vue-simplemde'

export default {
  data() {
    return {
      form: {
        title: null,
        categoryId: null,
        desc: null
      },
      categories: {}
    }
  },
  components: {
    VueSimplemde
  },
  created() {
    axios.get('/api/categories')
    .then(res => this.categories = res.data.data)
    .catch(err => console.log(err.response.data))
  },
  methods: {
    askQuestion() {
      axios.post('/api/question')
      .then(res => console.log(res.data))
      .catch(err => console.log(err.response.data))
    }
  }
}
</script>

<style>

</style>
