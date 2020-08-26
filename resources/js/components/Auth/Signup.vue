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

          <v-card-title class="text-center">Signup</v-card-title>
          <v-divider class="mt-2"></v-divider>
          <v-card-text>
          <form
            @submit.prevent="signup"
          >
            <v-text-field
              label="Name"
              v-model="form.name"
            ></v-text-field>
            <span class="red--text" v-if="errors.name">{{ errors.name[0] }}</span>

            <v-text-field
              label="E-mail"
              v-model="form.email"
            ></v-text-field>
            <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>

            <v-text-field
              label="Password"
              v-model="form.password"
              type="password"
            ></v-text-field>
            <span class="red--text" v-if="errors.password">{{ errors.password[0] }}</span>

            <v-text-field
              label="Confirm Password"
              v-model="form.password_confirmation"
              type="password"
            ></v-text-field>

            <v-btn dark class="mr-4" type="submit">Signup</v-btn>
            <router-link to="/login">
              <v-btn text>Login</v-btn>
            </router-link>
          </form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
          name: null,
          email: null,
          password: null,
          password_confirmation: null
      },
      errors: {}
    }
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({name: 'forum'})
    }
  },
  methods: {
    signup() {
      axios.post('/api/auth/register', this.form)
      .then(res => {
        User.responseAfterLogin(res)
        this.$router.push({name: 'forum'})
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>

<style>

</style>
