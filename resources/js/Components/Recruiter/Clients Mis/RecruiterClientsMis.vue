<template>
    <div class="container">

<div class="form" @click="updatePopUp()">
     <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
     <h4>Client Report</h4>
 </div>

 <div class="form" @click="managerPopUp()">
     <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
     <h4>Client Manager Report</h4>
 </div>

 </div>

 <RecruiterClientsMisPopup
:showPopUp="popup"
@closePopup ="closePopUp"
:title="title"
v-if="popup">

</RecruiterClientsMisPopup>
</template>

<script>
import RecruiterClientsMisPopup from './RecruiterClientsMisPopup.vue'

    export default {
        name:'RecruiterClientsMis',

        components:{
            RecruiterClientsMisPopup,

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
            this.title="Client Report"
        },
        closePopUp(data){
            this.popup = data;
        },

        managerPopUp(){
            this.popup=true;
            this.title="Manager Report"
        },

       }
        
    }
</script>