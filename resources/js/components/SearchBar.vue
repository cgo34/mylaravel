<template>
    <v-container fluid>
        <v-layout wrap class="bg-white">
            <v-flex xs12 md12>
                <div id="filters">
                    <v-layout row wrap>
                        <v-flex xs12 md3 offset-md1>
                            <v-text-field
                                    label="Location"
                                    prepend-icon="place"
                                    v-model="request.city"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 md3>
                            <v-combobox
                                    :filter="filter"
                                    :hide-no-data="!search"
                                    :items="items"
                                    :search-input.sync="search"
                                    hide-selected
                                    label="Dispositif"
                                    multiple
                                    small-chips
                                    prepend-icon="account_balance"
                                    v-model="request.disp"
                            >
                                <template v-slot:no-data>
                                    <v-list-tile>
                                        <span class="subheading">Create</span>
                                        <v-chip
                                                :color="`${colors[nonce - 1]} lighten-3`"
                                                label
                                                small
                                        >
                                            {{ search }}
                                        </v-chip>
                                    </v-list-tile>
                                </template>
                                <template v-slot:selection="{ item, parent, selected }">
                                    <v-chip
                                            v-if="item === Object(item)"
                                            :color="`${item.color} lighten-3`"
                                            :selected="selected"
                                            label
                                            small
                                    >
                                        <span class="pr-2">
                                          {{ item.text }}
                                        </span>
                                        <v-icon
                                                small
                                                @click="parent.selectItem(item)"
                                        >close</v-icon>
                                    </v-chip>
                                </template>
                                <template v-slot:item="{ index, item }">
                                    <v-list-tile-content>
                                        <v-chip
                                                :color="`${item.color} lighten-3`"
                                                dark
                                                label
                                                small
                                        >
                                            {{ item.text }}
                                        </v-chip>
                                    </v-list-tile-content>

                                </template>
                            </v-combobox>
                        </v-flex>
                        <v-flex xs12 md3>
                            <v-text-field
                                    label="Budget"
                                    prepend-icon="euro_symbol"
                                    v-model="request.price"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12 md2>
                            <v-btn color="#65D6B5" fab dark small  icon round depressed dark @click="userSearch()"><v-icon>search</v-icon></v-btn>
                        </v-flex>
                    </v-layout>
                </div>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "SearchBar",
        props: ['dispositifs'],
        data: function() {
            return {
                activator: null,
                attach: null,
                colors: ['blue', 'red', 'green', 'purple', 'indigo', 'cyan', 'teal', 'orange'],
                editing: null,
                index: -1,
                items: [],
                nonce: 1,
                menu: false,
                x: 0,
                search: null,
                y: 0,
                request: {
                    disp: null,
                    city: null,
                    price: null,
                },
                results: '',

            }
        },
        watch: {
            model (val, prev) {
                if (val.length === prev.length) return

                this.model = val.map(v => {
                    if (typeof v === 'string') {
                        v = {
                            text: v,
                            color: this.colors[this.nonce - 1]
                        }

                        this.items.push(v)

                        this.nonce++
                    }

                    return v
                })
            }
        },
        mounted() {
            axios.get('/dispositifs' ).then((response) => {
                var _this = this;
                response.data.forEach(function(element) {
                    _this.items.push({text: element.name, color: _this.colors[_this.nonce - 1]})
                    _this.nonce++
                });

            }).catch(error => {
                console.log(error.response);
            });

            /*var _this = this;
            var test = JSON.parse(this.dispositifs, true);
            console.log('mounted');
            console.log(test);
            test.forEach(function(element) {
                _this.items.push({text: element, color: _this.colors[_this.nonce - 1]})
                _this.nonce++
            });*/
        },
        methods: {
            filter (item, queryText, itemText) {
                if (item.header) return false

                const hasValue = val => val != null ? val : ''

                const text = hasValue(itemText)
                const query = hasValue(queryText)

                return text.toString()
                    .toLowerCase()
                    .indexOf(query.toString().toLowerCase()) > -1
            },
            userSearch() {
                console.log('search');
                var _this = this;
                axios.post('/search', _this.request ).then((response) => {
                    console.log(response);
                    _this.results = response.data;
                    console.log(_this.results);
                    var url = "http://" + window.location.host + "/search";
                    console.log(url);
                    window.location.href = url;

                }).catch(error => {
                    console.log(error.response);
                });
            }
        }
    }
</script>

<style scoped>

</style>