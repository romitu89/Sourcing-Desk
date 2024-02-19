<template>

    <div class="container">
 
    <div class="form" @click="updatePopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
         <h4>Request For Approval</h4>
     </div>
 
 
     </div>
     
     <AmSubmissionPopup
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

   </AmSubmissionPopup>
 </template>
 
 <script>
 import AmSubmissionPopup from './AmSubmissionPopup.vue'
 
 
     export default {
         name: 'AmSubmission',

         components:{
            AmSubmissionPopup,
         },
         data ()
       {
        return{
            popup:false,
            title:'',
        };
       },
       methods:{
        updatePopUp(){
            this.popup=true;
            this.title="Submission Request"
        },
        closePopUp(data){
            this.popup = data;
        },

       }
     
     }
 </script>
 
 