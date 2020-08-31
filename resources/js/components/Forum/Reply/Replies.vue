<template>
    <v-container>
        <v-row>
            <v-col md="12">
                <reply
                v-for="(reply, index) in replies"
                :key="index"
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
                    <v-btn color="green" dark type="submit">Reply</v-btn>
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
            }
        }
    },
    methods: {
        submitForm() {
            console.log(this.questionSlug)
            axios.post(`/api/question/${this.questionSlug}/reply`, this.form)
            .then(res => {
                this.form.reply = null,
                this.replies.unshift(res.data)
            })
            .catch(err => console.log(err.response.data))
        }
    }
}
</script>

<style scoped>

</style>
