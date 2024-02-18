<template>
 <div class="popup">
        <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
        <div class="popup-inner">
            <h2 class="title">{{ title }}</h2>
          
            <CandidateUpdate 
            v-if="title=='Candidate Update'"/>

            <WorkingCandidate 
            v-if="title=='Working Candidate'"/>

        </div>
    </div>
</template>

<script>
import CandidateUpdate from './CandidateUpdate.vue'
import WorkingCandidate from './WorkingCandidate.vue'

    export default {
        name:'CandidatePopup',

        components:{
            CandidateUpdate,
            WorkingCandidate,
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
    components: { CandidateUpdate, WorkingCandidate }

    }
</script>