<template>

    <div class="container">
 
    <div class="form" @click="updatePopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
         <h4>Create</h4>
     </div>
 
     <div class="form" @click="workingPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
        <h4>View</h4>
     </div>
 
     </div>

     <AmTeamManagementPopup
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

   </AmTeamManagementPopup>
 </template>
 
 <script>
 import AmTeamManagementPopup from './AmTeamManagementPopup.vue'
 
     export default {
         name: 'AmTeamManagement',

         components:{
            AmTeamManagementPopup,
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
            this.title="Team Management Create"
        },
        closePopUp(data){
            this.popup = data;
        },
        workingPopUp(){
            this.popup=true;
            this.title="Team Management View"
        },

       }
     
     }
 </script>
 
 