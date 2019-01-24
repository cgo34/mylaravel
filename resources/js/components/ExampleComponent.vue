<template>
    <div class="container">
        <h2>Test Exemple Component</h2>
        <div v-for="programme in programmes">
            <h4>{{ programme.name }}</h4>
        </div>
    </div>
</template>
<script>
    export default {
        resource: null,
        data () {
            return {
                programmes: {}
            }
        },
        mounted () {
            this.resource = this.$resource('/programmes{/id}')
            this.resource.get().then((response) => {
                this.programmes = response.body
            })
        }
    }
</script>