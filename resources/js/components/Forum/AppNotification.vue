<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                v-bind="attrs"
                v-on="on"
                icon>
                    <v-icon color="red">mdi-bell</v-icon> {{ unreadCount }}
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="(item, index) in unreadNotifications" :key="index">
                    <router-link :to="item.data.question_path">
                        <v-list-item-title @click="markRead(item.id)">{{ item.data.qusetion_title }}</v-list-item-title>
                    </router-link>
                </v-list-item>
                <v-list-item v-for="(item, index) in readNotificaitons" :key="index">
                    <v-list-item-title @click="markRead(item.id)">{{ item.data.qusetion_title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
  </div>
</template>

<script>
export default {
    data() {
        return {
            unreadCount: 0,
            readNotificaitons: {},
            unreadNotifications: {},
        }
    },
    created() {
        if (User.loggedIn()) {
            this.getNotifications()
        }
    },
    methods: {
        getNotifications() {
            axios.get('/api/notificaitons')
            .then(res => {
                this.readNotificaitons = res.data.read,
                this.unreadNotifications = res.data.unread,
                this.unreadCount = this.unreadNotifications.length
            })
            .catch(err => console.log(err.response.data))
        },
        markRead(notifyId, index) {
            axios.post('/api/notificaitons/mark-as-read', {id: notifyId})
            .then(res => {
                this.readNotificaitons.push(this.unreadNotifications[index])
                this.unreadNotifications.splice(index, 1)
                this.unreadCount--
            })
            .catch(err => console.log(err.response.data))
        }
    }
}
</script>

<style scoped>

</style>
