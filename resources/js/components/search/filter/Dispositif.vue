<template>
    <div>
        <v-select
            solo
            color="#00e094"
            prepend-inner-icon="account_balance"
            v-model="disposelected"
            :items="dispositifs"
            label="Dispositif"
        >
        </v-select>
        <input type="hidden" id="dispositif" name="dispositif" v-model="disposelected">
    </div>
</template>

<script>
  export default {
      name: "Dispositif",
      data: function() {
          return {
              dispositifs: [],
              page: '',
              disposelected: '',
              sd: '',
          };
      },
      mounted () {
          var _this = this;
          this.disposelected = this.selectedispo;
          axios.get('/dispositifs' ).then((response) => {
              response.data.forEach(function(element) {
                  _this.dispositifs.push({value: element.id, text: element.name});
              });
          }).catch(error => {
              console.log(error.response);
          });
      },
  };
</script>

<style scoped>

</style>
