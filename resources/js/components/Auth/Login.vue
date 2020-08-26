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

          <v-card-title class="text-center">Login</v-card-title>
          <v-divider class="mt-2"></v-divider>
          <v-card-text>
          <form
            @submit.prevent="login"
          >
            <v-text-field
              label="E-mail"
              v-model="form.email"
              required
            ></v-text-field>

            <v-text-field
              label="Password"
              v-model="form.password"
              type="password"
              required
            ></v-text-field>

            <v-btn dark class="mr-4" type="submit">Login</v-btn>
            <router-link to="/signup">
              <v-btn text>Signup</v-btn>
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
      form : {
          email: null,
          password: null
      }
    }
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({name: 'forum'})
    }
  },
  methods: {
    login() {
      User.login(this.form)
      // this.$router.push({name: 'forum'})
    }
  }
}
</script>

<style>

</style>
