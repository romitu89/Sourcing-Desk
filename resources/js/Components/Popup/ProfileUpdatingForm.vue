<template>
    <div class="popup">

<div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
<div class="popup-inner">
    <h2 class="title">{{ title }}</h2>

    <ProfileCreate 
    v-if="title=='Profile Create'"/>

    <ProfileView 
    v-if="title=='Profile View'"/>

</div>
</div>
</template>

<script>
import ProfileCreate from './FormComponents/Profile Updating/ProfileCreate.vue'
import ProfileView from './FormComponents/Profile Updating/ProfileView.vue'

export default {
    name:'ProfileUpdatingForm',

    components:{
        ProfileCreate,
        ProfileView,
    },

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



}
</script>