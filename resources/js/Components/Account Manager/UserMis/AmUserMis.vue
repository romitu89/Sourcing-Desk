<template>

    <div class="container">
 
    <div class="form" @click="teamLeadPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
         <h4>Team Lead</h4>
     </div>
 
     <div class="form" @click="recruiterPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
        <h4>Recruiter</h4>
     </div>
 
     </div>
     
     <AmUserMisPopup
    :showPopUp="popup"
    @closePopup ="closePopup" 
    :title="title"
   v-if="popup">

   </AmUserMisPopup>
 </template>
 
 <script>
 import AmUserMisPopup from './AmUserMisPopup.vue'
 
     export default {
         name: 'AmUserMis',

         components:{
            AmUserMisPopup,
         },

         data ()
       {
        return{
            popup:false,
            title:'',
        };
       },
       methods:{
        teamLeadPopUp(){
            this.popup=true;
            this.title="Team Lead"
        },
        closePopup(data){
            this.popup = data;
        },

        recruiterPopUp(){
            this.popup=true;
            this.title="Recruiter"
        },
       

       }
     
     }
 </script>
 
 