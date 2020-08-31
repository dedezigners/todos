<template>
    <v-card>
        <v-toolbar dark class="mb-5">
            <v-toolbar-title>Categories</v-toolbar-title> 
        </v-toolbar>
        <v-list>
            <v-list-item v-for="(category, i) in categories" :key="i">
                <v-list-item-content>
                    <v-list-item-title>{{ category.name }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            categories: {}
        }
    },
    created() {
        axios.get('/api/categories')
        .then(res => this.categories = res.data.data)
        .catch(err => console.log(err.response.data))
    }
}
</script>

<style lang="sass" scoped>

</style>
