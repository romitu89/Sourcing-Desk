<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>
             
               <AmCandidateFeedback 
               v-if="title=='Candidate Feedback'"/>

               <AmCandidateSchedule 
               v-if="title=='Candidate Schedule'"/>
   
           </div>
       </div>
</template>

<script>
import AmCandidateFeedback from './AmCandidateFeedback.vue'
import AmCandidateSchedule from './AmCandidateSchedule.vue'


export default {
    name:'AmCandidatePopup',

    components:{
        AmCandidateFeedback,
        AmCandidateSchedule
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
       components: { AmCandidateFeedback,AmCandidateSchedule }

}

</script>