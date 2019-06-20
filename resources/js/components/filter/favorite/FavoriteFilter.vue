<template>
    <div>
        *{{ types }}*
        <v-tabs v-model="active" light grow slider-color="red">
            <v-tab v-for="filter in types" :key="filter.name">{{ filter.name }}</v-tab>

            <v-tab-item v-for="filter in types" :key="filter.name">

                <v-layout row wrap>
                    <v-flex v-for="(store, index) in storeFilter(filter.name.toLowerCase())" :key="index" xs6 sm4 md2 lg2 xl3>
                        <v-card light>
                            <v-card-text class="blue">{{ store }}</v-card-text>

                        </v-card>
                    </v-flex>
                </v-layout>
            </v-tab-item>
        </v-tabs>
        <v-layout>

            <v-tabs
                fixed-tabs
                v-model="favorites"
            >
                <v-tab
                    v-for="(type, index) in types"
                    :key="index"
                    :href="`#${type.name}`"
                >
                    {{ type.name }}
                </v-tab>
            </v-tabs>
        </v-layout>
        <v-layout>
            <v-tabs-items>
                <v-tab-item
                    v-model="favorites"
                    v-for="(type, index) in types"
                    :key="index"
                    :value="type.name"
                >
                    <v-card flat>
                        <v-card-text>
                            {{ favorites }}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </v-layout>
    </div>
</template>

<script>
export default {
    name: "FavoriteFilter",
    props: ['types'],
    data() {
      return {
          favorites: '',
          active: null,
          stores: [
              'Amazon',
              'BookMyShow',
              'BookmyFlowers',
              'Ebay',
              'Expedia',
              'FabHotels'
          ],
          filterList: [
              {
                  title: '#'
              }, {
                  title: 'A',
                  term: 'a'
              }, {
                  title: 'B',
                  term: 'b'
              }, {
                  title: 'C',
                  term: 'c'
              }, {
                  title: 'D',
                  term: 'd'
              }, {
                  title: 'E',
                  term: 'e'
              }, {
                  title: 'F',
                  term: 'f'
              }
          ]
      };
    },
    mounted() {
          var test;
          test = this.types;
          console.log(test);
          var add_object = {"id": 0, "name": "All"};
            this.types.splice(0, 0, add_object);

    },
    computed: {
      lot() {
          return 'test lot';
      }
    },
    methods: {
        storeFilter(char) {
            if (char) {
                console.log(char);
                return this.char();
            }
            return res
        }
    }
};
</script>

<style scoped>

</style>
