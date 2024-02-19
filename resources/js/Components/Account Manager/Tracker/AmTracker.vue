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
     
     <AmTrackerPopup
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

   </AmTrackerPopup>

 </template>
 
 <script>
 import AmTrackerPopup from './AmTrackerPopup.vue'
 
     export default {
         name: 'AmTracker',

         components:{
            AmTrackerPopup,
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
            this.title="Tracker Create"
        },
        closePopUp(data){
            this.popup = data;
        },
        workingPopUp(){
            this.popup=true;
            this.title="Tracker View"
        },

       }
     
     }
 </script>
 
 