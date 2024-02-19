<template>

    <div class="container">
 
    <div class="form" @click="clientReportPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
         <h4>Client Report</h4>
     </div>
 
     <div class="form" @click="clientManagerPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
        <h4>Client Manager Report</h4>
     </div>

     <div class="form" @click="matrixPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
        <h4>Matrix</h4>
     </div>
 
     </div>
     
     <AmClientMisPopup
    :showPopUp="popup"
    @closePopup ="closePopup" 
    :title="title"
   v-if="popup">

   </AmClientMisPopup>
 </template>
 
 <script>
 import AmClientMisPopup from './AmClientMisPopup.vue'
 
     export default {
         name: 'AmClientMis',

         components:{
            AmClientMisPopup,
         },

         data ()
       {
        return{
            popup:false,
            title:'',
        };
       },
       methods:{
        clientReportPopUp(){
            this.popup=true;
            this.title="Client Report"
        },
        closePopup(data){
            this.popup = data;
        },

        clientManagerPopUp(){
            this.popup=true;
            this.title="Client Manager Report"
        },
        matrixPopUp(){
            this.popup=true;
            this.title="Matrix"
        },

       }
     
     }
 </script>
 
 