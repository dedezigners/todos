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
          <v-card-title class="text-center">Edit Question</v-card-title>
          <v-divider class="mt-2"></v-divider>
          <v-card-text>
          <form @submit.prevent="editQuestion">

            <v-text-field
              label="Title"
              v-model="form.title"
              filled
            ></v-text-field>

            <v-autocomplete
              label="Category"
              v-model="form.category_id"
              :items="categories"
              item-text="name"
              item-value="id"
              dense
              filled
            ></v-autocomplete>

            <vue-simplemde v-model="form.description" />

            <v-card-actions>
              <v-btn dark class="mr-4" type="submit">Edit Question</v-btn>
              <v-btn dark @click="cancleEditing">Cancle</v-btn>
            </v-card-actions>
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
  props: ['data'],
  data() {
    return {
      form: {
        title: null,
        category_id: null,
        description: null
      },
      categories: {}
    }
  },
  components: {
    VueSimplemde
  },
  mounted() {
    axios.get('/api/categories')
    .then(res => this.categories = res.data.data)
    .catch(err => console.log(err.response.data))

    axios.get(`/api/category/${this.data.category}`)
    .then(res => this.form.category_id = res.data.data.id)
    .catch(err => console.log(err.response.data))

    this.form.title = this.data.title
    this.form.description = this.data.desc
  },
  methods: {
    editQuestion() {
      axios.patch(`/api/question/${this.data.slug}`, this.form)
      .then(res => this.cancleEditing())
      .catch(err => console.log(err.response.data))
    },
    cancleEditing() {
      EventBus.$emit('cancleEditing')
    }
  }
}
</script>

<style>

</style>
