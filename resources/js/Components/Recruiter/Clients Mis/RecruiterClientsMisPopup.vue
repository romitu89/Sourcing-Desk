<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <RecruiterClientReport @closePopup="closePopup()"
               v-if="title=='Client Report'"/>

               <RecruiterManagerReport @closePopup="closePopup()"
               v-if="title=='Manager Report'"/>

           </div>
       </div>

</template>

<script>
import RecruiterClientReport from './RecruiterClientReport.vue'
import RecruiterManagerReport from './RecruiterManagerReport.vue'


export default {

    name:'RecruiterClientsMisPopup',

    components:{
        RecruiterClientReport, RecruiterManagerReport
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
       components: { RecruiterClientReport, RecruiterManagerReport }

}

</script>
