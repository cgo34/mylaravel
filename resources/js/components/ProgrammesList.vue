<template>
    <div class="container">

        <div v-for="programme in programmes" :key="programme.id">
            <programmes
                    :id="programme.id"
                    :name="programme.name"
                    :description="programme.description"
                    :ville="programme.ville"
                    :images="programme.images"
                    :dispositifs="programme.dispositifs"
                    :programme="programme">

            </programmes>
        </div>
    </div>
</template>
<script>
    import Programmes from './Programmes'


    export default {
        resource: null,
        /*props: ['programmes'],*/
        data () {
            return {
                programmes: {},
                count: 0,
                priceProgramme: 1000000000,
            }
        },
        mounted () {
            axios.get('/programmeslist')
                .then((response) => {
                    this.programmes = response.data
                    this.count = this.programmes.length
                })
        },
        components: {
            Programmes,
        }
    }
</script>