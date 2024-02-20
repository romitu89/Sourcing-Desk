<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <CallingCandidateScreening
               v-if="title=='Recruiter Screening'"/>

           </div>
       </div>
       
</template>

<script>
import CallingCandidateScreening from './CallingCandidateScreening.vue'


export default {
    
    name:'CallingCandidatePopup',

    components:{
        CallingCandidateScreening,
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
       components: { CallingCandidateScreening }

}

</script>
