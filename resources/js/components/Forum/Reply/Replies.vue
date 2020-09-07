<template>
    <v-container>
        <v-row>
            <v-col md="12">
                <reply
                v-for="(reply, index) in replies"
                :key="index"
                :index="index"
                :reply="reply"
                ></reply>
            </v-col>
        </v-row>
        <v-divider></v-divider>
        <v-row>
            <v-col md="12">
                <h3 class="mb-3">Leave your reply</h3>
                <form @submit.prevent="submitForm">
                    <v-textarea
                    outlined
                    v-model="form.reply"
                    label="Reply"
                    required
                    ></v-textarea>
                    <v-btn color="green" dark type="submit">{{ submitText }}</v-btn>
                </form>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import Reply from './Reply'

export default {
    props: ['replies', 'questionSlug'],
    components: {
        Reply,
    },
    data() {
        return {
            form:{
                reply: null
            },
            isUpdate: false,
        }
    },
    created() {
        this.listen()
    },
    computed: {
        submitText() {
            return this.isUpdate ? "Update Reply" : 'Reply'
        }
    },
    methods: {
        submitForm() {
            this.isUpdate ? this.updateReply() : this.createReply()
        },

        createReply() {
            axios.post(`/api/question/${this.questionSlug}/reply`, this.form)
            .then(res => {
                this.form.reply = null,
                this.replies.unshift(res.data)
            })
            .catch(err => console.log(err.response.data))
        },

        updateReply() {
            axios.patch(`/api/question/${this.questionSlug}/reply/${this.isUpdate}`, this.form)
            .then(res => {
                this.form.reply = null,
                this.isUpdate = false
                this.replies.unshift(res.data)
            })
            .catch(err => console.log(err.response.data))
        },

        listen() {
            EventBus.$on('deleteReply', (index) => {
                axios.delete(`/api/question/${this.questionSlug}/reply/${this.replies[index].id}`)
                .then(res => this.replies.splice(index, 1))
                .catch(err => console.log(err.response.data))
            })
            
            EventBus.$on('editReply', (index) => {
                this.form.reply = this.replies[index].reply
                this.isUpdate = this.replies[index].id
                this.replies.splice(index, 1)
            })

            Echo.private('App.User.' + User.id())
            .notification((notification) => {
                this.replies.unshift(notification.reply)
            });

            Echo.channel('delete-reply')
            .listen('DeleteReplyEvent', (e) => {
                for (let index = 0; index < this.replies.length; index++) {
                    if (this.replies[index].id === e.id) {
                        this.replies.splice(index, 1)
                    }
                    
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
