<template>
  <v-container
  class="py-10">
    <v-card
    class="pa-5">
    
    <v-card-title>{{ data.title }}</v-card-title>
    <v-card-subtitle>{{ data.created_by }} said at {{ data.created_at }}</v-card-subtitle>
    <v-btn text>{{ data.reply_count }} Replies</v-btn>

    <v-card-text v-html="questionDescription"></v-card-text>

    <div v-if="isOwner">
      <v-divider></v-divider>
      <v-card-actions>
        <v-btn fab dark large color="cyan" @click="edit">
          <v-icon dark>mdi-pencil</v-icon>
        </v-btn>
        <v-btn fab dark large color="error" @click="destroy">
            <v-icon>mdi-delete</v-icon>
          </v-btn>
      </v-card-actions>
    </div>

    </v-card>
  </v-container>
</template>

<script>
export default {
  props: ['data'],
  data() {
    return {
      isOwner: User.isOwner(this.data.user_id)
    }
  },
  computed: {
    questionDescription() {
      return MD.parse(this.data.desc)
    }
  },
  created() {
    EventBus.$on('deleteReply', (index) => {
        this.data.reply_count--
    })

    EventBus.$on('newReply', (index) => {
        this.data.reply_count++
    })

    Echo.private('App.User.' + User.id())
    .notification((notification) => {
        this.data.reply_count++
    });

    Echo.channel('delete-reply')
    .listen('DeleteReplyEvent', (e) => {
        this.data.reply_count--
    });
  },
  methods: {
    destroy() {
      // console.log(this.data.slug)
      axios.delete(`/api/question/${this.data.slug}`)
      .then(res => this.$router.push({name: 'forum'}))
      .catch(err => console.log(err.response))
    },
    edit() {
      EventBus.$emit('startEditing')
    }
  }
}
</script>

<style>

</style>
