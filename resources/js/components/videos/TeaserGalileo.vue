<template>
    <v-dialog
        v-model="teaserModal"
        width="800"
        persistent
        v-show="teaserModal"
        v-closable="{
              exclude: ['button'],
              handler: 'onClose'
            }"
        class="popup-box"
    >
        <template v-slot:activator="{ on }">
            <button
                type="button"
                v-on="on"
                ref="button"
                class="toggle-button v-btn v-btn--floating v-btn--icon theme--dark"
                @click="teaserModal = !teaserModal"
            >
                <div class="v-btn__content">
                    <v-icon color="white" x-large>play_circle_outline</v-icon>
                </div>
            </button>
        </template>
        <v-card color="transparent">
            <video id="teaser" width="100%"  controls :src="source">Ici la description alternative</video>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "TeaserGalileo",
    data: function () {
        return {
            teaserModal: false,
            source: '/assets/video/teaser-galileo-light.mp4',
        }
    },
    methods: {
        hide(){
            this.$emit('update:teaserModal', false);
            this.source = '';
            $('#teaser').pause();
        },
        onClose() {
            this.teaserModal = false
        },
    },
};

let handleOutsideClick;
Vue.directive('closable', {
    bind (el, binding, vnode) {
        handleOutsideClick = (e) => {
            console.log(e);
            e.stopPropagation();
            const { handler, exclude } = binding.value;
            console.log(handler);
            console.log(exclude);
            let clickedOnExcludedEl = false;
            exclude.forEach(refName => {
                if (!clickedOnExcludedEl) {
                    const excludedEl = vnode.context.$refs[refName];
                    console.log(excludedEl);
                    console.log(e.target);
                    clickedOnExcludedEl = excludedEl.contains(e.target);

                }
            });
            if (!el.contains(e.target) && !clickedOnExcludedEl) {
                vnode.context[handler]();
            }
            console.log('here for stop video');
            //$('#teaser').trigger('stop');
            var mediaElement = document.getElementById("teaser");
            mediaElement.pause();
            mediaElement.currentTime = 0;
        }
        document.addEventListener('click', handleOutsideClick);
        document.addEventListener('touchstart', handleOutsideClick);
    },
    unbind () {
        document.removeEventListener('click', handleOutsideClick);
        document.removeEventListener('touchstart', handleOutsideClick);
    }
})
</script>

<style scoped>

</style>
