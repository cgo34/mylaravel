<template>
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex xs12>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-layout row wrap>
                        <v-flex xs3>
                            <v-text-field
                                    v-model="city"
                                    :rules="cityRules"
                                    :counter="10"
                                    label="Ville"
                                    required
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md3>
                            <v-text-field
                                    label="Solo"
                                    solo
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field
                                    v-model="city"
                                    :rules="cityRules"
                                    :counter="10"
                                    label="Ville"
                                    required
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs3>
                            <v-btn
                                    :disabled="!valid"
                                    @click="submit"
                            >
                                submit
                            </v-btn>
                            <v-btn @click="clear">clear</v-btn>
                        </v-flex>
                    </v-layout>



                </v-form>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Search",
        data: () => ({
            valid: true,
            city: '',
            cityRules: [
                v => !!v || 'City is required',
                v => (v && v.length <= 10) || 'City must be less than 10 characters'
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            select: null,
            items: [
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4'
            ],
            checkbox: false
        }),

        methods: {
            submit () {
                if (this.$refs.form.validate()) {
                    // Native form submission is not yet supported
                    axios.post('/api/submit', {
                        name: this.name,
                        email: this.email,
                        select: this.select,
                        checkbox: this.checkbox
                    })
                }
            },
            clear () {
                this.$refs.form.reset()
            }
        }
    }

</script>

<style scoped>

</style>