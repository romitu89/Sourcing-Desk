<template>

    <div class="container">
 
    <div class="form" @click="updatePopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
         <h4>Feedback</h4>
     </div>
 
     <div class="form" @click="workingPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
        <h4>Schedule</h4>
     </div>
 
     </div>
     
     <AmCandidatePopup
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

   </AmCandidatePopup>
 </template>
 
 <script>
 import AmCandidatePopup from './AmCandidatePopup.vue'
 
     export default {
         name: 'AmCandidate',

         components:{
            AmCandidatePopup,

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
            this.title="Candidate Feedback"
        },
        closePopUp(data){
            this.popup = data;
        },

        workingPopUp(){
            this.popup=true;
            this.title="Candidate Schedule"
        },

       }
     
     }
 </script>
 
 