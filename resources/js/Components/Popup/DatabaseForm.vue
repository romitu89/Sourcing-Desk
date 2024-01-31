<template>
    <div class="popup">

<div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
<div class="popup-inner">
    <h2 class="title">{{ title }}</h2>

    <WorkingCandidateForm 
    v-if="title=='Working Candidate'"/>

    <FilteredDatabaseForm 
    v-if="title=='Filtered Database'"/>

</div>
</div>
</template>

<script>
import WorkingCandidateForm from './FormComponents/Database Form/WorkingCandidateForm.vue'
import FilteredDatabaseForm from './FormComponents/Database Form/FilteredDatabaseForm.vue'

    export default {
        name:'DatabaseForm',

        components:{
            WorkingCandidateForm,
            FilteredDatabaseForm,
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