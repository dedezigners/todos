<template>
  <v-card class="mb-3">
    <v-list-item>
      <v-list-item-avatar color="grey"></v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title class="headline">{{ reply.user }}</v-list-item-title>
        <v-list-item-subtitle>at {{ reply.created_at }}</v-list-item-subtitle>
      </v-list-item-content>
      <v-spacer></v-spacer>
      <v-btn icon tile small>
        <v-icon>mdi-heart</v-icon>
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
        return {}
    },
    computed: {
        isOwner() {
            return User.isOwner(this.reply.user_id)
        }
    },
    methods: {
        deleteReply() {
            EventBus.$emit('deleteReply', this.index)
        },
        editReply() {
            EventBus.$emit('editReply', this.index)
        }
    }
}
</script>

<style scoped>

</style>
