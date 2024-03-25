<template>

<div class="popup">
        <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
        <div class="popup-inner">
            <h2 class="title">{{ title }}</h2>

            <ClientCreateForm @closePopup="closePopup()"
            v-if="title=='Client Create'"/>

            <ClientViewForm @closePopup="closePopup()"
            v-if="title=='Client View'"/>


        </div>
    </div>
</template>

<script>
import ClientCreateForm from './ClientCreateForm.vue'
import ClientViewForm from './ClientViewForm.vue'

export default {

    name:'ClientForm',

    props: {
        showPopUp: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: 'Head'
        }
    },
    watch: {
        tab(newVal) {
            this.showUserCreate = newVal;
        }
    },
    data() {
        return {
            showUserCreate: this.tab,
        };
    },
    methods: {
        closePopup() {
            console.log(this.showUserCreate);
            this.showUserCreate = false;
            this.$emit('closePopup', this.showUserCreate);
        }
    },
    components:{ClientCreateForm, ClientViewForm},
}

</script>
