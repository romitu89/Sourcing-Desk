<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>
             
               <AmClientReport 
               v-if="title =='Client Report'"/>

               <AmClientManagerReport 
               v-if="title =='Client Manager Report'"/>

               <AmClientMatrix 
               v-if="title =='Matrix'"/>
   
           </div>
       </div>
</template>

<script>
import AmClientReport from './AmClientReport.vue'
import AmClientManagerReport from './amclientmanagerreport.vue'
import AmClientMatrix from './amclientmatrix.vue'


export default {
    name:'AmClientMisPopup',

    components:{
        AmClientReport,
        AmClientManagerReport,
        AmClientMatrix
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
       components: { AmClientReport, AmClientManagerReport, AmClientMatrix }

}

</script>