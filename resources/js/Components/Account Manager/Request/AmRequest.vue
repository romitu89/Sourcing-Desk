<template>

    <div class="container">
 
    <div class="form" @click="updatePopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
         <h4>Request Creation</h4>
     </div>
 
 
     </div>
     <AmRequestPopup
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

   </AmRequestPopup>
 </template>
 
 <script>
 import AmRequestPopup from './AmRequestPopup.vue'
 
     export default {
         name: 'AmRequest',

         components:{
            AmRequestPopup,
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
            this.title="Request Creation"
        },
        closePopUp(data){
            this.popup = data;
        },

       }
     
     }
 </script>
 
 