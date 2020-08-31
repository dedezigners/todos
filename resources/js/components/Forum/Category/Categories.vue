<template>
  <v-data-table
    :headers="headers"
    :items="categories"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="#f0f0f0">
        <v-toolbar-title color="cyan">Categories</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn class="my-2 mr-5" fab dark medium color="error" v-bind="attrs" v-on="on">
              <v-icon dark>mdi-plus</v-icon>
            </v-btn>

          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field v-model="form.name" label="Category Name"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>

    <template v-slot:item.actions="{ item }">
      <div v-if="isOwner(item.user_id)">
      
        <v-btn fab small color="cyan" class="mr-3" @click="editItem(item)">
          <v-icon color="white">mdi-pencil</v-icon>
        </v-btn>

        <v-btn fab small color="red" @click="deleteItem(item)">
          <v-icon color="white">mdi-delete</v-icon>
        </v-btn>

      </div>
    </template>
    
  </v-data-table>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      headers: [
        {
          text: 'Categories',
          align: 'start',
          value: 'name',
        },
        { text: 'Slug', value: 'slug', sortable: false },
        { text: 'Created By', value: 'created_by' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      categories: [],
      editedIndex: -1,
      defaultItem: {
        name: '',
        slug: '',
        created_by: '',
        created_at: '',
      },
      form: {
        name: null
      },
      updateCategory: null
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Add Category' : 'Edit Category'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        axios.get('/api/categories')
        .then(res => this.categories = res.data.data)
        .catch(err => console.log(err.response.data))
      },

      editItem (item) {
        this.editedIndex = this.categories.indexOf(item)
        this.form = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.categories.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.categories.splice(index, 1) &&
        axios.delete(`/api/category/${item.slug}`)
        .then(res => console.log(res.data))
        .catch(err => console.log(err.response.data))
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.form = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          axios.patch(`/api/category/${this.categories[this.editedIndex].slug}`, this.form)
          .then(res => this.updateCategory = res.data)
          .catch(err => console.log(err.response.data))

          Object.assign(this.categories[this.editedIndex], this.updateCategory)
        } else {

          axios.post('/api/category', this.form)
          .then(res => this.categories.unshift(res.data))
          .catch(err => console.log(err.response.data))

          // this.categories.push(this.editedItem)
        }
        this.close()
      },

      isOwner(id) {
        return User.isOwner(id)
      }
    },
  }
</script>

<style>

</style>
