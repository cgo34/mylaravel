<template>
    <v-btn id="addAdvert" class="text-none pl-2 pr-2" round flat outline large color="#00e094" dark @click="goToAddAdvertPage()">Déposer une annonce</v-btn>
</template>

<script>
export default {
  name: "AddAdvertButton",
    methods: {
      goToAddAdvertPage() {
          window.location.href = "/annonces/add";
      },
    },
};
</script>

<style scoped>
    .v-toolbar__items #addAdvert:not(.v-btn--floating):not(.v-btn--icon) {
        height: 36px;
    }
</style>
