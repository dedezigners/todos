<template>
  <v-card class="mb-3">
    <v-list-item>
      <v-list-item-avatar color="grey"></v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title class="headline">{{ reply.user }}</v-list-item-title>
        <v-list-item-subtitle>at {{ reply.created_at }}</v-list-item-subtitle>
      </v-list-item-content>
      <v-spacer></v-spacer>
      <v-btn icon tile small @click="likeIt">
        <v-icon :color="color">mdi-heart</v-icon>
        <strong>{{ likeCount }}</strong>
      </v-btn>
    </v-list-item>

    <v-card-text>{{ reply.reply }}</v-card-text>

    <v-card-actions v-if="isOwner">
        <v-btn color="primary" fab small dark @click="editReply()">
            <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn color="error" fab small dark @click="deleteReply()">
            <v-icon>mdi-delete</v-icon>
        </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
    props: ['reply', 'index'],
    data() {
        return {
          isLiked: this.reply.liked,
          likeCount: this.reply.like_count
        }
    },
    computed: {
        isOwner() {
            return User.isOwner(this.reply.user_id)
        },
        color() {
          return this.isLiked ? 'red' : 'red lighten-4'
        }
    },
    methods: {
        deleteReply() {
            EventBus.$emit('deleteReply', this.index)
        },
        editReply() {
            EventBus.$emit('editReply', this.index)
        },
        likeIt() {
          if (User.loggedIn()) {
            this.isLiked ? this.decr() : this.incr()
            this.isLiked = !this.isLiked
          }
        },
        decr() {
          axios.delete(`/api/like/${this.reply.id}`)
          .then(res => this.likeCount--)
          .catch(err => console.log(err.response.data))
          
        },
        incr() {
          axios.post(`/api/like/${this.reply.id}`)
          .then(res => this.likeCount++)
          .catch(err => console.log(err.response.data))
        }
    }
}
</script>

<style scoped>

</style>
